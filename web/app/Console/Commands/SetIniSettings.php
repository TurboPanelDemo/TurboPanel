<?php

namespace App\Console\Commands;

use Dotenv\Dotenv;
use Illuminate\Console\Command;
use Jelix\IniFile\IniModifier;

class SetIniSettings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'turbo:set-ini-settings {key} {value}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $key = $this->argument('key');
        $value = $this->argument('value');

        $ini = new IniModifier('turbo-config.ini');
        $ini->setValue($key, $value, 'turbo');
        $ini->save();

    }
}
