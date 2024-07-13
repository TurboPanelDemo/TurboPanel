<?php

namespace App;

class TurboConfig
{
    public static function get($key, $default = null)
    {
        // Parse without sections
        $configIni = base_path() . "/turbo-config.ini";
        if (file_exists($configIni)) {
            $iniArray = parse_ini_file($configIni);
            if (isset($iniArray[$key])) {
                return $iniArray[$key];
            }
        }

        return $default;
    }

    public static function getAll()
    {
        // Parse without sections
        $configIni = base_path() . "/turbo-config.ini";
        if (file_exists($configIni)) {
            $iniArray = parse_ini_file($configIni);
            return $iniArray;
        }

        return [];
    }
}
