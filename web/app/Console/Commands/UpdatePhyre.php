<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class UpdateTurbo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'turbo:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Turbo to the latest version.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Updating Turbo...');

        $output = '';
        $output .= exec('mkdir -p /usr/local/turbo/update');
        $output .= exec('wget https://raw.githubusercontent.com/TurboPanelDemo/TurboPanel/main/update/update-web-panel.sh -O /usr/local/turbo/update/update-web-panel.sh');
        $output .= exec('chmod +x /usr/local/turbo/update/update-web-panel.sh');

        $this->info($output);

        shell_exec('bash /usr/local/turbo/update/update-web-panel.sh');

        $this->info('Turbo updated successfully.');
    }
}
