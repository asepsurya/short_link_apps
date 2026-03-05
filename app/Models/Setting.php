<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['key', 'value'];

    /**
     * Get a setting value, loading from DB and caching it.
     */
    public static function get($key, $default = null)
    {
        try {
            return \Illuminate\Support\Facades\Cache::rememberForever($key, function () use ($key, $default) {
                $setting = self::where('key', $key)->first();
                return $setting ? $setting->value : $default;
            });
        } catch (\Exception $e) {
            // Either the settings table or the cache table doesn't exist yet
            return $default;
        }
    }

    /**
     * Set a setting value, saving to DB and updating cache.
     */
    public static function set($key, $value)
    {
        try {
            self::updateOrCreate(['key' => $key], ['value' => $value]);
            \Illuminate\Support\Facades\Cache::forever($key, $value);
        } catch (\Exception $e) {
            // Ignore if tables aren't migrated yet
        }
    }

    /**
     * Check if a setting exists.
     */
    public static function has($key)
    {
        $val = self::get($key);
        return $val !== null && $val !== '';
    }

    /**
     * Remove a setting from DB and cache.
     */
    public static function forget($key)
    {
        self::where('key', $key)->delete();
        \Illuminate\Support\Facades\Cache::forget($key);
    }
}
