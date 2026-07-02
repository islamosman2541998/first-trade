<div>
    <form wire:submit.prevent="save">
        <div class="card admin-card">
            <div class="card-header bg-white d-flex flex-wrap align-items-center justify-content-between gap-3">
                <div>
                    <strong>{{ __('site.edit_section') }}: {{ $key }}</strong>
                    <div class="small text-muted">{{ __('site.control_section_content') }}</div>
                </div>

                <div class="d-flex gap-2">
                    <a href="{{ route('admin.home-sections.index') }}" class="btn btn-outline-secondary">
                        {{ __('site.back') }}
                    </a>

                    <button type="submit" class="btn btn-admin-primary">
                        <i class="bi bi-save"></i>
                        {{ __('site.save_section') }}
                    </button>
                </div>
            </div>

            <div class="card-body">
                <div class="row g-4">
                    <div class="col-md-4">
                        <label class="form-label">{{ __('site.section_key') }}</label>
                        <input type="text" class="form-control" value="{{ $key }}" disabled>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">{{ __('site.order') }}</label>
                        <input type="number" wire:model="sort_order" class="form-control">
                        @error('sort_order') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="col-md-4">
                        <label class="form-label d-block">{{ __('site.status') }}</label>
                        <div class="form-check form-switch mt-2">
                            <input class="form-check-input" type="checkbox" wire:model="is_active" id="sectionStatus">
                            <label class="form-check-label" for="sectionStatus">{{ __('site.active_section') }}</label>
                        </div>
                    </div>

                    <div class="col-12">
                        <hr>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">{{ __('site.subtitle_en') }}</label>
                        <input type="text" wire:model="subtitle_en" class="form-control">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">{{ __('site.subtitle_ar') }}</label>
                        <input type="text" wire:model="subtitle_ar" class="form-control" dir="rtl">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">{{ __('site.subtitle_nl') }}</label>
                        <input type="text" wire:model="subtitle_nl" class="form-control">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">{{ __('site.title_en') }}</label>
                        <input type="text" wire:model="title_en" class="form-control">
                        @error('title_en') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">{{ __('site.title_ar') }}</label>
                        <input type="text" wire:model="title_ar" class="form-control" dir="rtl">
                        @error('title_ar') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">{{ __('site.title_nl') }}</label>
                        <input type="text" wire:model="title_nl" class="form-control">
                        @error('title_nl') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">{{ __('site.description_en') }}</label>
                        <textarea wire:model="description_en" class="form-control" rows="5"></textarea>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">{{ __('site.description_ar') }}</label>
                        <textarea wire:model="description_ar" class="form-control" rows="5" dir="rtl"></textarea>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">{{ __('site.description_nl') }}</label>
                        <textarea wire:model="description_nl" class="form-control" rows="5"></textarea>
                    </div>

                    <div class="col-12">
                        <hr>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">{{ __('site.button_text_en') }}</label>
                        <input type="text" wire:model="button_text_en" class="form-control">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">{{ __('site.button_text_ar') }}</label>
                        <input type="text" wire:model="button_text_ar" class="form-control" dir="rtl">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">{{ __('site.button_text_nl') }}</label>
                        <input type="text" wire:model="button_text_nl" class="form-control">
                    </div>

                    <div class="col-md-8">
                        <label class="form-label">{{ __('site.button_link') }}</label>
                        <input type="text" wire:model="button_link" class="form-control" placeholder="/products">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">{{ __('site.button_target') }}</label>
                        <select wire:model="button_target" class="form-select">
                            <option value="_self">{{ __('site.same_tab') }}</option>
                            <option value="_blank">{{ __('site.new_tab') }}</option>
                        </select>
                    </div>

                    <div class="col-12">
                        <hr>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">{{ __('site.section_image') }}</label>
                        <input type="file" wire:model="image" class="form-control">
                        @error('image') <small class="text-danger">{{ $message }}</small> @enderror

                        <div wire:loading wire:target="image" class="small text-muted mt-2">
                            {{ __('site.uploading_image') }}
                        </div>
                    </div>

                    <div class="col-md-6">
                        @if($image)
                            <img src="{{ $image->temporaryUrl() }}" class="rounded w-100" style="max-height: 240px; object-fit: cover;">
                        @elseif($currentImage)
                            <div class="position-relative">
                                <img src="{{ asset($currentImage) }}" class="rounded w-100" style="max-height: 240px; object-fit: cover;">

                                <button type="button" wire:click="removeImage" class="btn btn-sm btn-danger mt-2">
                                    {{ __('site.remove_image') }}
                                </button>
                            </div>
                        @else
                            <div class="text-muted border rounded p-4 text-center">
                                {{ __('site.no_image_uploaded') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>