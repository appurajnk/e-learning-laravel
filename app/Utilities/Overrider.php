<?php

namespace App\Utilities;

class Overrider
{

    public static function load($type)
    {
        $method = 'load' . ucfirst($type);
        static::$method();
    }

    protected static function loadSettings()
    {
        if (config('settings.overrider')) {
            foreach (config('settings.overrider') as $config_key => $setting_key) {
                
                $config_key = $config_key ?: $setting_key;
                
                try {
                    $value = setting($setting_key);
                    if (is_null($value)) {
                        continue;
                    }
                } catch (\Exception $e) {
                    continue;
                }
                config([$config_key => $value]);
            }
        }
    }

}