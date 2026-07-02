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
                <a href="#dashboard-colors" class="list-group-item list-group-item-action">{{ __('admin.dashboard_colors') }}</a>
                <a href="#home" class="list-group-item list-group-item-action">{{ __('admin.home_content') }}</a>
                <a href="#social" class="list-group-item list-group-item-action">{{ __('admin.social_media') }}</a>
                <a href="#footer" class="list-group-item list-group-item-action">{{ __('admin.footer') }}</a>
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
                            {{ __('admin.uploading') }}
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
                            {{ __('admin.uploading') }}
                        </div>

                        @if ($adminLogo)
                            <img src="{{ $adminLogo->temporaryUrl() }}" class="mt-2" style="max-height: 70px;">
                        @elseif(!empty($settings['admin_logo']))
                            <img src="{{ asset($settings['admin_logo']) }}" class="mt-2" style="max-height: 70px;">
                        @endif
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">{{ __('admin.favicon') }}</label>
                        <input type="file" wire:model="favicon" class="form-control">
                        @error('favicon')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                        <div wire:loading wire:target="favicon" class="small text-muted mt-1">
                            {{ __('admin.uploading') }}
                        </div>

                        @if ($favicon)
                            <img src="{{ $favicon->temporaryUrl() }}" class="mt-2" style="max-height: 40px;">
                        @elseif(!empty($settings['site_favicon']))
                            <img src="{{ asset($settings['site_favicon']) }}" class="mt-2" style="max-height: 40px;">
                        @endif
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">{{ __('admin.admin_logo_width') }}</label>
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
                            {{ __('admin.uploading') }}
                        </div>

                        @if ($loginBackground)
                            <img src="{{ $loginBackground->temporaryUrl() }}" class="mt-2 rounded" style="max-height: 90px;">
                        @elseif(!empty($settings['login_background_image']))
                            <img src="{{ asset($settings['login_background_image']) }}" class="mt-2 rounded" style="max-height: 90px;">
                        @endif
                    </div>

                    @foreach ([
                        'login_background_color' => __('admin.background_color'),
                        'login_card_color' => __('admin.card_color'),
                        'login_card_text_color' => __('admin.text_color'),
                        'login_button_color' => __('admin.button_color'),
                        'login_button_text_color' => __('admin.button_text_color'),
                    ] as $key => $label)
                        <div class="col-md-3">
                            <label class="form-label">{{ $label }}</label>
                            <input type="color" wire:model.defer="settings.{{ $key }}" class="form-control form-control-color">
                        </div>
                    @endforeach

                    <div class="col-md-3">
                        <label class="form-label">{{ __('admin.card_opacity') }}</label>
                        <input type="number" step="0.01" min="0.1" max="1" wire:model.defer="settings.login_card_opacity" class="form-control">
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
                            <input type="text" wire:model.defer="settings.meta_title_{{ $locale }}" class="form-control">
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
                        'site_primary_color' => __('admin.primary'),
                        'site_secondary_color' => __('admin.secondary'),
                        'site_cream_color' => __('admin.cream'),
                        'site_yellow_color' => __('admin.yellow'),
                        'site_peach_color' => __('admin.peach'),
                        'site_sky_color' => __('admin.sky'),
                    ] as $key => $label)
                        <div class="col-md-3">
                            <label class="form-label">{{ $label }}</label>
                            <input type="color" wire:model.defer="settings.{{ $key }}" class="form-control form-control-color">
                        </div>
                    @endforeach
                </div>
            </div>

            <div id="dashboard-colors" class="card admin-card mb-4">
                <div class="card-header bg-white"><strong>{{ __('admin.dashboard_colors') }}</strong></div>

                <div class="card-body row g-3">
                    @foreach ([
                        'admin_sidebar_color' => __('admin.sidebar'),
                        'admin_topbar_color' => __('admin.topbar'),
                        'admin_primary_color' => __('admin.primary'),
                        'admin_background_color' => __('admin.background'),
                    ] as $key => $label)
                        <div class="col-md-3">
                            <label class="form-label">{{ $label }}</label>
                            <input type="color" wire:model.defer="settings.{{ $key }}" class="form-control form-control-color">
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
                            <label class="form-label">{{ __('admin.hero_title') }}</label>
                            <input type="text" wire:model.defer="settings.home_hero_title_{{ $locale }}" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">{{ __('admin.hero_subtitle') }}</label>
                            <textarea wire:model.defer="settings.home_hero_subtitle_{{ $locale }}" class="form-control" rows="2"></textarea>
                        </div>
                    @endforeach
                </div>
            </div>

            <div id="social" class="card admin-card mb-4">
                <div class="card-header bg-white"><strong>{{ __('admin.social_media') }}</strong></div>

                <div class="card-body row g-3">
                    <div class="col-md-6">
                        <label class="form-label">{{ __('admin.facebook_url') }}</label>
                        <input type="text" wire:model.defer="settings.facebook_url" class="form-control" placeholder="https://facebook.com/your-page">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">{{ __('admin.instagram_url') }}</label>
                        <input type="text" wire:model.defer="settings.instagram_url" class="form-control" placeholder="https://instagram.com/your-page">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">{{ __('admin.linkedin_url') }}</label>
                        <input type="text" wire:model.defer="settings.linkedin_url" class="form-control" placeholder="https://linkedin.com/company/your-company">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">{{ __('admin.whatsapp_url') }}</label>
                        <input type="text" wire:model.defer="settings.whatsapp_url" class="form-control" placeholder="https://wa.me/201000000000">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">{{ __('admin.youtube_url') }}</label>
                        <input type="text" wire:model.defer="settings.youtube_url" class="form-control" placeholder="https://youtube.com/@your-channel">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">{{ __('admin.tiktok_url') }}</label>
                        <input type="text" wire:model.defer="settings.tiktok_url" class="form-control" placeholder="https://tiktok.com/@your-account">
                    </div>
                </div>
            </div>

            <div id="footer" class="card admin-card mb-4">
                <div class="card-header bg-white"><strong>{{ __('admin.footer') }}</strong></div>

                <div class="card-body row g-3">
                    <div class="col-12">
                        <h6>English</h6>
                    </div>

                    <div class="col-12">
                        <label class="form-label">{{ __('admin.footer_about') }} - English</label>
                        <textarea wire:model.defer="settings.footer_about_en" class="form-control" rows="4"></textarea>
                    </div>

                    <div class="col-12">
                        <h6>العربية</h6>
                    </div>

                    <div class="col-12">
                        <label class="form-label">{{ __('admin.footer_about') }} - العربية</label>
                        <textarea wire:model.defer="settings.footer_about_ar" class="form-control" rows="4" dir="rtl"></textarea>
                    </div>

                    <div class="col-12">
                        <h6>Dutch</h6>
                    </div>

                    <div class="col-12">
                        <label class="form-label">{{ __('admin.footer_about') }} - Dutch</label>
                        <textarea wire:model.defer="settings.footer_about_nl" class="form-control" rows="4"></textarea>
                    </div>
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