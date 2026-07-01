<?php

namespace App\Services;

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;

class SettingService
{
    public static function all(): array
    {
        return Cache::rememberForever('app_settings', function () {
            return Setting::query()
                ->pluck('value', 'key')
                ->toArray();
        });
    }

    public static function get(string $key, mixed $default = null): mixed
    {
        return self::all()[$key] ?? $default;
    }

    public static function set(string $key, mixed $value, string $type = 'text', string $group = 'general'): void
    {
        Setting::updateOrCreate(
            ['key' => $key],
            [
                'value' => $value,
                'type' => $type,
                'group' => $group,
            ]
        );

        self::forgetCache();
    }

    public static function forgetCache(): void
    {
        Cache::forget('app_settings');
    }
}