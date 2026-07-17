<?php

use Illuminate\Support\Facades\Cache;
use Modules\Shared\App\Models\Setting;

if (! function_exists('setting_cache_key')) {
    function setting_cache_key(): string
    {
        $tenantId = \App\Models\Tenant::current()?->getKey();

        return 'settings.all.'.($tenantId ?? 'without-tenant');
    }
}

if (! function_exists('setting')) {
    /**
     * Get a setting value by key.
     *
     * @param  mixed  $default
     * @return mixed
     */
    function setting(string $key, $default = null)
    {
        return Cache::rememberForever(setting_cache_key(), function () {
            return Setting::query()
                ->get()
                ->pluck('value', 'key')
                ->toArray();
        })[$key] ?? $default;
    }
}

if (! function_exists('setting_dot')) {
    /**
     * Get a setting value using dot notation.
     * Example: setting_dot('site_config.theme')
     *
     * @param  mixed  $default
     * @return mixed
     */
    function setting_dot(string $path, $default = null)
    {
        [$key, $nested] = array_pad(explode('.', $path, 2), 2, null);

        $value = setting($key);

        return $nested
            ? data_get($value, $nested, $default)
            : $value ?? $default;
    }
}

if (! function_exists('set_setting')) {
    /**
     * Create or update a setting.
     *
     * @param  mixed  $value
     */
    function set_setting(string $key, $value): void
    {
        Setting::updateOrCreate(
            ['key' => $key],
            ['value' => $value]
        );

        Cache::forget(setting_cache_key());
    }
}

if (! function_exists('forget_setting')) {
    /**
     * Delete a setting by key.
     */
    function forget_setting(string $key): void
    {
        Setting::where('key', $key)->delete();

        Cache::forget(setting_cache_key());
    }
}

if (! function_exists('has_setting')) {
    /**
     * Check if a setting exists.
     */
    function has_setting(string $key): bool
    {
        return array_key_exists(
            $key,
            Cache::rememberForever(setting_cache_key(), function () {
                return Setting::pluck('value', 'key')->toArray();
            })
        );
    }
}
