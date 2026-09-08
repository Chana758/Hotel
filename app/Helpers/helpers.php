<?php

/**
 * Helper function to retrieve a value from the settings table by key.
 */
if (!function_exists('get_setting')) {
    function get_setting($key, $default = null) {
        try {
                
            $setting = \App\Models\Setting::where('key', $key)->first();
            return $setting ? $setting->value : $default;
        } catch (\Exception $e) {
           // Return the default value if an error occurs.
            return $default;
        }
    }
}