<form wire:submit.prevent="save" enctype="multipart/form-data">
    <div class="row g-4">
        <div class="col-lg-3">
            <div class="list-group sticky-top" style="top: 20px;">
                <a href="#general" class="list-group-item list-group-item-action">{{ __('admin.general') }}</a>
                <a href="#language" class="list-group-item list-group-item-action">{{ __('admin.language') }}</a>
                <a href="#branding" class="list-group-item list-group-item-action">{{ __('admin.branding') }}</a>
                <a href="#login" class="list-group-item list-group-item-action">{{ __('admin.login_appearance') }}</a>
                <a href="#seo" class="list-group-item list-group-item-action">{{ __('admin.seo') }}</a>
                <a href="#tracking" class="list-group-item list-group-item-action">{{ __('admin.tracking_pixels') }}</a>
                <a href="#appearance" class="list-group-item list-group-item-action">{{ __('admin.site_colors') }}</a>
                <a href="#dashboard-colors"
                    class="list-group-item list-group-item-action">{{ __('admin.dashboard_colors') }}</a>
                <a href="#home" class="list-group-item list-group-item-action">{{ __('admin.home_content') }}</a>
            </div>
        </div>

        <div class="col-lg-9">
            <div id="general" class="card admin-card mb-4">
                <div class="card-header bg-white"><strong>{{ __('admin.general') }}</strong></div>

                <div class="card-body row g-3">
                    <div class="col-md-6">
                        <label class="form-label">{{ __('admin.site_name') }}</label>
                        <input type="text" wire:model.defer="settings.site_name" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">{{ __('admin.site_email') }}</label>
                        <input type="text" wire:model.defer="settings.site_email" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">{{ __('admin.site_phone') }}</label>
                        <input type="text" wire:model.defer="settings.site_phone" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">{{ __('admin.site_whatsapp') }}</label>
                        <input type="text" wire:model.defer="settings.site_whatsapp" class="form-control">
                    </div>

                    @foreach (['en' => 'English', 'ar' => 'العربية', 'nl' => 'Dutch'] as $locale => $label)
                        <div class="col-12">
                            <label class="form-label">{{ __('admin.site_address') }} - {{ $label }}</label>
                            <textarea wire:model.defer="settings.site_address_{{ $locale }}" class="form-control" rows="2"></textarea>
                        </div>
                    @endforeach
                </div>
            </div>

            <div id="language" class="card admin-card mb-4">
                <div class="card-header bg-white"><strong>{{ __('admin.language') }}</strong></div>

                <div class="card-body row g-3">
                    <div class="col-md-6">
                        <label class="form-label">{{ __('admin.site_default_language') }}</label>
                        <select wire:model.defer="settings.site_default_locale" class="form-select">
                            <option value="en">English</option>
                            <option value="ar">العربية</option>
                            <option value="nl">Dutch</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">{{ __('admin.dashboard_default_language') }}</label>
                        <select wire:model.defer="settings.admin_default_locale" class="form-select">
                            <option value="en">English</option>
                            <option value="ar">العربية</option>
                            <option value="nl">Dutch</option>
                        </select>
                    </div>
                </div>
            </div>

            <div id="branding" class="card admin-card mb-4">
                <div class="card-header bg-white">
                    <strong>{{ __('admin.branding') }}</strong>
                </div>

                <div class="card-body row g-3">
                    <div class="col-md-4">
                        <label class="form-label">{{ __('admin.site_logo') }}</label>
                        <input type="file" wire:model="siteLogo" class="form-control">
                        @error('siteLogo')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                        <div wire:loading wire:target="siteLogo" class="small text-muted mt-1">
                            Uploading...
                        </div>

                        @if ($siteLogo)
                            <img src="{{ $siteLogo->temporaryUrl() }}" class="mt-2" style="max-height: 70px;">
                        @elseif(!empty($settings['site_logo']))
                            <img src="{{ asset($settings['site_logo']) }}" class="mt-2" style="max-height: 70px;">
                        @endif
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">{{ __('admin.admin_logo') }}</label>
                        <input type="file" wire:model="adminLogo" class="form-control">
                        @error('adminLogo')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                        <div wire:loading wire:target="adminLogo" class="small text-muted mt-1">
                            Uploading...
                        </div>

                        @if ($adminLogo)
                            <img src="{{ $adminLogo->temporaryUrl() }}" class="mt-2" style="max-height: 70px;">
                        @elseif(!empty($settings['admin_logo']))
                            <img src="{{ asset($settings['admin_logo']) }}" class="mt-2"
                                style="max-height: 70px;">
                        @endif
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">{{ __('admin.favicon') }}</label>
                        <input type="file" wire:model="favicon" class="form-control">
                        @error('favicon')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                        <div wire:loading wire:target="favicon" class="small text-muted mt-1">
                            Uploading...
                        </div>

                        @if ($favicon)
                            <img src="{{ $favicon->temporaryUrl() }}" class="mt-2" style="max-height: 40px;">
                        @elseif(!empty($settings['site_favicon']))
                            <img src="{{ asset($settings['site_favicon']) }}" class="mt-2"
                                style="max-height: 40px;">
                        @endif
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Admin Logo Width</label>
                        <input type="number" wire:model.defer="settings.admin_logo_width" class="form-control">
                    </div>
                </div>
            </div>

            <div id="login" class="card admin-card mb-4">
                <div class="card-header bg-white"><strong>{{ __('admin.login_appearance') }}</strong></div>

                <div class="card-body row g-3">
                    <div class="col-md-6">
                        <label class="form-label">{{ __('admin.login_background') }}</label>
                        <input type="file" wire:model="loginBackground" class="form-control">
                        @error('loginBackground')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                        <div wire:loading wire:target="loginBackground" class="small text-muted mt-1">
                            Uploading...
                        </div>

                        @if ($loginBackground)
                            <img src="{{ $loginBackground->temporaryUrl() }}" class="mt-2 rounded"
                                style="max-height: 90px;">
                        @elseif(!empty($settings['login_background_image']))
                            <img src="{{ asset($settings['login_background_image']) }}" class="mt-2 rounded"
                                style="max-height: 90px;">
                        @endif
                    </div>
                    @foreach ([
        'login_background_color' => 'Background Color',
        'login_card_color' => 'Card Color',
        'login_card_text_color' => 'Text Color',
        'login_button_color' => 'Button Color',
        'login_button_text_color' => 'Button Text Color',
    ] as $key => $label)
                        <div class="col-md-3">
                            <label class="form-label">{{ $label }}</label>
                            <input type="color" wire:model.defer="settings.{{ $key }}"
                                class="form-control form-control-color">
                        </div>
                    @endforeach

                    <div class="col-md-3">
                        <label class="form-label">Card Opacity</label>
                        <input type="number" step="0.01" min="0.1" max="1"
                            wire:model.defer="settings.login_card_opacity" class="form-control">
                    </div>
                </div>
            </div>

            <div id="seo" class="card admin-card mb-4">
                <div class="card-header bg-white"><strong>{{ __('admin.seo') }}</strong></div>

                <div class="card-body row g-3">
                    @foreach (['en' => 'English', 'ar' => 'العربية', 'nl' => 'Dutch'] as $locale => $label)
                        <div class="col-12">
                            <h6>{{ $label }}</h6>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">{{ __('admin.meta_title') }}</label>
                            <input type="text" wire:model.defer="settings.meta_title_{{ $locale }}"
                                class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">{{ __('admin.meta_description') }}</label>
                            <textarea wire:model.defer="settings.meta_description_{{ $locale }}" class="form-control" rows="2"></textarea>
                        </div>

                        <div class="col-12">
                            <label class="form-label">{{ __('admin.meta_keywords') }}</label>
                            <textarea wire:model.defer="settings.meta_keywords_{{ $locale }}" class="form-control" rows="2"></textarea>
                        </div>
                    @endforeach
                </div>
            </div>

            <div id="tracking" class="card admin-card mb-4">
                <div class="card-header bg-white"><strong>{{ __('admin.tracking_pixels') }}</strong></div>

                <div class="card-body row g-3">
                    <div class="col-md-4">
                        <label class="form-label">{{ __('admin.meta_pixel_id') }}</label>
                        <input type="text" wire:model.defer="settings.meta_pixel_id" class="form-control">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">{{ __('admin.google_analytics_id') }}</label>
                        <input type="text" wire:model.defer="settings.google_analytics_id" class="form-control">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">{{ __('admin.google_tag_manager_id') }}</label>
                        <input type="text" wire:model.defer="settings.google_tag_manager_id" class="form-control">
                    </div>
                </div>
            </div>

            <div id="appearance" class="card admin-card mb-4">
                <div class="card-header bg-white"><strong>{{ __('admin.site_colors') }}</strong></div>

                <div class="card-body row g-3">
                    @foreach ([
        'site_primary_color' => 'Primary',
        'site_secondary_color' => 'Secondary',
        'site_cream_color' => 'Cream',
        'site_yellow_color' => 'Yellow',
        'site_peach_color' => 'Peach',
        'site_sky_color' => 'Sky',
    ] as $key => $label)
                        <div class="col-md-3">
                            <label class="form-label">{{ $label }}</label>
                            <input type="color" wire:model.defer="settings.{{ $key }}"
                                class="form-control form-control-color">
                        </div>
                    @endforeach
                </div>
            </div>

            <div id="dashboard-colors" class="card admin-card mb-4">
                <div class="card-header bg-white"><strong>{{ __('admin.dashboard_colors') }}</strong></div>

                <div class="card-body row g-3">
                    @foreach ([
        'admin_sidebar_color' => 'Sidebar',
        'admin_topbar_color' => 'Topbar',
        'admin_primary_color' => 'Primary',
        'admin_background_color' => 'Background',
    ] as $key => $label)
                        <div class="col-md-3">
                            <label class="form-label">{{ $label }}</label>
                            <input type="color" wire:model.defer="settings.{{ $key }}"
                                class="form-control form-control-color">
                        </div>
                    @endforeach
                </div>
            </div>

            <div id="home" class="card admin-card mb-4">
                <div class="card-header bg-white"><strong>{{ __('admin.home_content') }}</strong></div>

                <div class="card-body row g-3">
                    @foreach (['en' => 'English', 'ar' => 'العربية', 'nl' => 'Dutch'] as $locale => $label)
                        <div class="col-12">
                            <h6>{{ $label }}</h6>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Hero Title</label>
                            <input type="text" wire:model.defer="settings.home_hero_title_{{ $locale }}"
                                class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Hero Subtitle</label>
                            <textarea wire:model.defer="settings.home_hero_subtitle_{{ $locale }}" class="form-control" rows="2"></textarea>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="text-end">
                <button class="btn btn-admin-primary px-5" wire:loading.attr="disabled">
                    <span wire:loading.remove>{{ __('admin.save') }}</span>
                    <span wire:loading>{{ __('admin.saving') }}</span>
                </button>
            </div>
        </div>
    </div>
</form>
