<form wire:submit.prevent="save">
    <div class="card admin-card mb-4">
        <div class="card-header bg-white">
            <strong>{{ __('admin.about_hero') }}</strong>
        </div>

        <div class="card-body">
            @foreach(['en' => 'English', 'ar' => 'العربية', 'nl' => 'Dutch'] as $locale => $label)
                <div class="about-admin-lang-block">
                    <h6>{{ $label }}</h6>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">{{ __('admin.subtitle') }}</label>
                            <input type="text" wire:model.defer="settings.about_hero_subtitle_{{ $locale }}" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">{{ __('admin.title') }}</label>
                            <input type="text" wire:model.defer="settings.about_hero_title_{{ $locale }}" class="form-control">
                        </div>

                        <div class="col-12">
                            <label class="form-label">{{ __('admin.description') }}</label>
                            <textarea wire:model.defer="settings.about_hero_description_{{ $locale }}" class="form-control" rows="3" @if($locale === 'ar') dir="rtl" @endif></textarea>
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="mt-3">
                <label class="form-label">{{ __('admin.about_hero_image') }}</label>
                <input type="file" wire:model="aboutHeroImage" class="form-control">

                <div wire:loading wire:target="aboutHeroImage" class="small text-muted mt-1">
                    {{ __('admin.uploading') }}
                </div>

                @if($aboutHeroImage)
                    <img src="{{ $aboutHeroImage->temporaryUrl() }}" class="about-admin-preview mt-3">
                @elseif(!empty($settings['about_hero_image']))
                    <img src="{{ asset($settings['about_hero_image']) }}" class="about-admin-preview mt-3">
                @endif
            </div>
        </div>
    </div>

    <div class="card admin-card mb-4">
        <div class="card-header bg-white">
            <strong>{{ __('admin.about_story') }}</strong>
        </div>

        <div class="card-body">
            @foreach(['en' => 'English', 'ar' => 'العربية', 'nl' => 'Dutch'] as $locale => $label)
                <div class="about-admin-lang-block">
                    <h6>{{ $label }}</h6>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">{{ __('admin.subtitle') }}</label>
                            <input type="text" wire:model.defer="settings.about_story_subtitle_{{ $locale }}" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">{{ __('admin.title') }}</label>
                            <input type="text" wire:model.defer="settings.about_story_title_{{ $locale }}" class="form-control">
                        </div>

                        <div class="col-12">
                            <label class="form-label">{{ __('admin.description') }}</label>
                            <textarea wire:model.defer="settings.about_story_description_{{ $locale }}" class="form-control" rows="3" @if($locale === 'ar') dir="rtl" @endif></textarea>
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="mt-3">
                <label class="form-label">{{ __('admin.about_story_image') }}</label>
                <input type="file" wire:model="aboutStoryImage" class="form-control">

                <div wire:loading wire:target="aboutStoryImage" class="small text-muted mt-1">
                    {{ __('admin.uploading') }}
                </div>

                @if($aboutStoryImage)
                    <img src="{{ $aboutStoryImage->temporaryUrl() }}" class="about-admin-preview mt-3">
                @elseif(!empty($settings['about_story_image']))
                    <img src="{{ asset($settings['about_story_image']) }}" class="about-admin-preview mt-3">
                @endif
            </div>
        </div>
    </div>

    <div class="card admin-card mb-4">
        <div class="card-header bg-white">
            <strong>{{ __('admin.about_stats') }}</strong>
        </div>

        <div class="card-body">
            <div class="row g-4">
                @for($i = 1; $i <= 3; $i++)
                    <div class="col-lg-4">
                        <div class="about-admin-mini-card">
                            <label class="form-label">{{ __('admin.number') }}</label>
                            <input type="text" wire:model.defer="settings.about_stat_{{ $i }}_number" class="form-control mb-3">

                            @foreach(['en' => 'English', 'ar' => 'العربية', 'nl' => 'Dutch'] as $locale => $label)
                                <label class="form-label">{{ __('admin.label') }} - {{ $label }}</label>
                                <input type="text" wire:model.defer="settings.about_stat_{{ $i }}_label_{{ $locale }}" class="form-control mb-2" @if($locale === 'ar') dir="rtl" @endif>
                            @endforeach
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </div>

    <div class="card admin-card mb-4">
        <div class="card-header bg-white">
            <strong>{{ __('admin.about_values') }}</strong>
        </div>

        <div class="card-body">
            @foreach(['en' => 'English', 'ar' => 'العربية', 'nl' => 'Dutch'] as $locale => $label)
                <div class="about-admin-lang-block">
                    <h6>{{ __('admin.section_title') }} - {{ $label }}</h6>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">{{ __('admin.subtitle') }}</label>
                            <input type="text" wire:model.defer="settings.about_values_subtitle_{{ $locale }}" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">{{ __('admin.title') }}</label>
                            <input type="text" wire:model.defer="settings.about_values_title_{{ $locale }}" class="form-control">
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="row g-4">
                @for($i = 1; $i <= 3; $i++)
                    <div class="col-lg-4">
                        <div class="about-admin-mini-card">
                            <label class="form-label">{{ __('admin.icon_class') }}</label>
                            <input type="text" wire:model.defer="settings.about_value_{{ $i }}_icon" class="form-control mb-3" placeholder="bi bi-award">

                            @foreach(['en' => 'English', 'ar' => 'العربية', 'nl' => 'Dutch'] as $locale => $label)
                                <label class="form-label">{{ __('admin.title') }} - {{ $label }}</label>
                                <input type="text" wire:model.defer="settings.about_value_{{ $i }}_title_{{ $locale }}" class="form-control mb-2" @if($locale === 'ar') dir="rtl" @endif>

                                <label class="form-label">{{ __('admin.description') }} - {{ $label }}</label>
                                <textarea wire:model.defer="settings.about_value_{{ $i }}_description_{{ $locale }}" class="form-control mb-3" rows="2" @if($locale === 'ar') dir="rtl" @endif></textarea>
                            @endforeach
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </div>

    <div class="card admin-card mb-4">
        <div class="card-header bg-white">
            <strong>{{ __('admin.about_cta') }}</strong>
        </div>

        <div class="card-body">
            @foreach(['en' => 'English', 'ar' => 'العربية', 'nl' => 'Dutch'] as $locale => $label)
                <div class="about-admin-lang-block">
                    <h6>{{ $label }}</h6>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">{{ __('admin.title') }}</label>
                            <input type="text" wire:model.defer="settings.about_cta_title_{{ $locale }}" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">{{ __('admin.description') }}</label>
                            <textarea wire:model.defer="settings.about_cta_description_{{ $locale }}" class="form-control" rows="2" @if($locale === 'ar') dir="rtl" @endif></textarea>
                        </div>
                    </div>
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
</form>