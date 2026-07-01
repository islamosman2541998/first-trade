<?php

namespace App\Livewire\Admin\Settings;

use App\Models\Setting;
use App\Services\SettingService;
use Livewire\Component;
use Livewire\WithFileUploads;

class SettingsForm extends Component
{
    use WithFileUploads;

    public array $settings = [];

    public $siteLogo;
    public $adminLogo;
    public $favicon;
    public $loginBackground;

    public function mount(): void
    {
        $this->settings = Setting::query()
            ->pluck('value', 'key')
            ->toArray();
    }

    public function save(): void
    {
        $this->validate([
            'settings.site_default_locale' => ['required', 'in:ar,en,nl'],
            'settings.admin_default_locale' => ['required', 'in:ar,en,nl'],
            'settings.site_name' => ['required', 'string', 'max:190'],

            'siteLogo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,svg', 'max:2048'],
            'adminLogo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,svg', 'max:2048'],
            'favicon' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,ico', 'max:1024'],
            'loginBackground' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
        ]);

        $this->uploadImage('siteLogo', 'site_logo');
        $this->uploadImage('adminLogo', 'admin_logo');
        $this->uploadImage('favicon', 'site_favicon');
        $this->uploadImage('loginBackground', 'login_background_image');

        foreach ($this->settings as $key => $value) {
            $setting = Setting::where('key', $key)->first();

            SettingService::set(
                $key,
                $value,
                $setting?->type ?? 'text',
                $setting?->group ?? 'general'
            );
        }

        SettingService::forgetCache();

        $this->reset(['siteLogo', 'adminLogo', 'favicon', 'loginBackground']);

        $this->settings = Setting::query()
            ->pluck('value', 'key')
            ->toArray();

        $this->dispatch('toastr-success', message: __('admin.saved_successfully'));
    }

    private function uploadImage(string $property, string $settingKey): void
    {
        if (! $this->{$property}) {
            return;
        }

        $path = $this->{$property}->store('settings', 'public');

        $this->settings[$settingKey] = 'storage/' . $path;
    }

  

    public function render()
    {
        return view('livewire.admin.settings.settings-form');
    }
}
