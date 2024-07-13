<?php

namespace App\Listeners;


use App\Events\ModelTurboServerCreated;
use App\Models\TurboServer;
use Illuminate\Remote\Connection;
use phpseclib3\Net\SSH2;
use Spatie\Ssh\Ssh;

class ModelTurboServerCreatedListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ModelTurboServerCreated $event): void
    {
        $findTurboServer =  TurboServer::where('id', $event->model->id)->first();
        if (!$findTurboServer) {
            return;
        }
        if ($findTurboServer->status == 'installing') {
            return;
        }
        $username = $event->model->username;
        $password = $event->model->password;
        $ip = $event->model->ip;

        $ssh = new SSH2($ip);
        if ($ssh->login($username, $password)) {

            $ssh->exec('wget https://raw.githubusercontent.com/TurboPanelDemo/TurboPanel/main/installers/install.sh');
            $ssh->exec('chmod +x install.sh');
            $ssh->exec('./install.sh  >turbo-install.log 2>&1 </dev/null &');

            $findTurboServer->status = 'installing';
            $findTurboServer->save();

        } else {
            $findTurboServer->status = 'can\'t connect to server';
            $findTurboServer->save();
        }
    }
}
