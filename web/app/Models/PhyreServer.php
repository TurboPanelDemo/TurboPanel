<?php

namespace App\Models;

use App\ApiSDK\TurboApiSDK;
use App\Events\ModelTurboServerCreated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use phpseclib3\Net\SSH2;

class TurboServer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'ip',
        'port',
        'username',
        'password',
    ];

    public static function boot()
    {
        parent::boot();

        static::created(function ($model) {
            event(new ModelTurboServerCreated($model));
        });

    }

    public function syncResources()
    {
        // Sync customers
        $centralServerCustomerExternalIds = [];
        $getCentralServerCustomers = Customer::where('turbo_server_id', $this->id)->get();
        if ($getCentralServerCustomers->count() > 0) {
            foreach ($getCentralServerCustomers as $customer) {
                $centralServerCustomerExternalIds[] = $customer->external_id;
            }
        }

        $turboApiSDK = new TurboApiSDK($this->ip, 8443, $this->username, $this->password);
        $getTurboServerCustomers = $turboApiSDK->getCustomers();
        if (isset($getTurboServerCustomers['data']['customers'])) {
            $turboServerCustomerIds = [];
            foreach ($getTurboServerCustomers['data']['customers'] as $customer) {
                $turboServerCustomerIds[] = $customer['id'];
            }

            // Delete customers to main server that are not in external server
            foreach ($centralServerCustomerExternalIds as $centralServerCustomerExternalId) {
                if (!in_array($centralServerCustomerExternalId, $turboServerCustomerIds)) {
                    $getCustomer = Customer::where('external_id', $centralServerCustomerExternalId)
                        ->where('turbo_server_id', $this->id)
                        ->first();
                    if ($getCustomer) {
                        $getCustomer->delete();
                    }
                }
            }

            // Add customers to main server from external server
            foreach ($getTurboServerCustomers['data']['customers'] as $turboServerCustomer) {
                $findCustomer = Customer::where('external_id', $turboServerCustomer['id'])
                    ->where('turbo_server_id', $this->id)
                    ->first();
                if (!$findCustomer) {
                    $findCustomer = new Customer();
                    $findCustomer->turbo_server_id = $this->id;
                    $findCustomer->external_id = $turboServerCustomer['id'];
                }
                $findCustomer->name = $turboServerCustomer['name'];
                $findCustomer->username = $turboServerCustomer['username'];
                $findCustomer->email = $turboServerCustomer['email'];
                $findCustomer->phone = $turboServerCustomer['phone'];
                $findCustomer->address = $turboServerCustomer['address'];
                $findCustomer->city = $turboServerCustomer['city'];
                $findCustomer->state = $turboServerCustomer['state'];
                $findCustomer->zip = $turboServerCustomer['zip'];
                $findCustomer->country = $turboServerCustomer['country'];
                $findCustomer->company = $turboServerCustomer['company'];
                $findCustomer->saveQuietly();
            }
        }

        // Sync Hosting Subscriptions
        $centralServerHostingSubscriptionsExternalIds = [];
        $getCentralHostingSubscriptions = HostingSubscription::where('turbo_server_id', $this->id)->get();
        if ($getCentralHostingSubscriptions->count() > 0) {
            foreach ($getCentralHostingSubscriptions as $customer) {
                $centralServerHostingSubscriptionsExternalIds[] = $customer->external_id;
            }
        }
        $getTurboServerHostingSubscriptions = $turboApiSDK->getHostingSubscriptions();
        if (isset($getTurboServerHostingSubscriptions['data']['HostingSubscriptions'])) {
            foreach ($getTurboServerHostingSubscriptions['data']['HostingSubscriptions'] as $turboServerHostingSubscription) {

                $findHostingSubscription = HostingSubscription::where('external_id', $turboServerHostingSubscription['id'])
                    ->where('turbo_server_id', $this->id)
                    ->first();
                if (!$findHostingSubscription) {
                    $findHostingSubscription = new HostingSubscription();
                    $findHostingSubscription->turbo_server_id = $this->id;
                    $findHostingSubscription->external_id = $turboServerHostingSubscription['id'];
                }

                $findHostingSubscriptionCustomer = Customer::where('external_id', $turboServerHostingSubscription['customer_id'])
                    ->where('turbo_server_id', $this->id)
                    ->first();
                if ($findHostingSubscriptionCustomer) {
                    $findHostingSubscription->customer_id = $findHostingSubscriptionCustomer->id;
                }

                $findHostingSubscription->system_username = $turboServerHostingSubscription['system_username'];
                $findHostingSubscription->system_password = $turboServerHostingSubscription['system_password'];

                $findHostingSubscription->domain = $turboServerHostingSubscription['domain'];
                $findHostingSubscription->save();

            }
        }


//        // Sync Hosting Plans
//        $getHostingPlans = HostingPlan::all();
//        if ($getHostingPlans->count() > 0) {
//            foreach ($getHostingPlans as $hostingPlan) {
//
//            }
//        }
    }

    public function updateServer()
    {
        $ssh = new SSH2($this->ip);
        if ($ssh->login($this->username, $this->password)) {
//
//            $output = $ssh->exec('cd /usr/local/turbo/web && /usr/local/turbo/php/bin/php artisan apache:ping-websites-with-curl');
//            dd($output);

            $output = '';
            $output .= $ssh->exec('wget https://raw.githubusercontent.com/TurboPanelDemo/TurboPanel/main/update/update-web-panel.sh -O /usr/local/turbo/update/update-web-panel.sh');
            $output .= $ssh->exec('chmod +x /usr/local/turbo/update/update-web-panel.sh');
            $output .= $ssh->exec('/usr/local/turbo/update/update-web-panel.sh');

            dd($output);

            $this->healthCheck();
        }
    }

    public function healthCheck()
    {
        try {
            $turboApiSDK = new TurboApiSDK($this->ip, 8443, $this->username, $this->password);
            $response = $turboApiSDK->healthCheck();
            if (isset($response['status']) && $response['status'] == 'ok') {
                $this->status = 'Online';
                $this->save();
            } else {
                $this->status = 'Offline';
                $this->save();
            }
        } catch (\Exception $e) {
            $this->status = 'Offline';
            $this->save();
        }

    }

}
