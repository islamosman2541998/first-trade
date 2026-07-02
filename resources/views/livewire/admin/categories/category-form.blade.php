<form wire:submit.prevent="save" enctype="multipart/form-data">
    <div class="card admin-card">
        <div class="card-body">
            <ul class="nav nav-tabs mb-4" role="tablist">
                @foreach(['en' => 'English', 'ar' => 'العربية', 'nl' => 'Dutch'] as $locale => $label)
                    <li class="nav-item">
                        <button class="nav-link @if($loop->first) active @endif"
                                data-bs-toggle="tab"
                                data-bs-target="#category-tab-{{ $locale }}"
                                type="button">
                            {{ $label }}
                        </button>
                    </li>
                @endforeach
            </ul>

            <div class="tab-content mb-4">
                @foreach(['en' => 'English', 'ar' => 'العربية', 'nl' => 'Dutch'] as $locale => $label)
                    <div class="tab-pane fade @if($loop->first) show active @endif" id="category-tab-{{ $locale }}">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">{{ __('admin.title') }} - {{ $label }}</label>
                                <input type="text" wire:model.live="translations.{{ $locale }}.name" class="form-control">
                                @error("translations.$locale.name") <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <div class="col-12">
                                <label class="form-label">{{ __('admin.description') }} - {{ $label }}</label>
                                <textarea wire:model.defer="translations.{{ $locale }}.description"
                                          rows="4"
                                          class="form-control"></textarea>
                                @error("translations.$locale.description") <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <hr>

            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">{{ __('admin.parent_category') }}</label>
                    <select wire:model.defer="parent_id" class="form-select">
                        <option value="">{{ __('admin.no_parent') }}</option>
                        @foreach($parentCategories as $parent)
                            <option value="{{ $parent->id }}">{{ $parent->name }}</option>
                        @endforeach
                    </select>
                    @error('parent_id') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">{{ __('admin.slug') }}</label>
                    <input type="text" wire:model.defer="slug" class="form-control">
                    @error('slug') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">{{ __('admin.category_image') }}</label>
                    <input type="file" wire:model="newImage" class="form-control">
                    @error('newImage') <small class="text-danger">{{ $message }}</small> @enderror

                    <div wire:loading wire:target="newImage" class="small text-muted mt-2">
                        Uploading...
                    </div>

                    @if($newImage)
                        <img src="{{ $newImage->temporaryUrl() }}" class="mt-3 rounded" style="max-height: 120px;">
                    @elseif($image)
                        <img src="{{ asset($image) }}" class="mt-3 rounded" style="max-height: 120px;">
                    @endif
                </div>

                <div class="col-md-3">
                    <label class="form-label">{{ __('admin.sort_order') }}</label>
                    <input type="number" wire:model.defer="sort_order" class="form-control">
                    @error('sort_order') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-3">
                    <label class="form-label">{{ __('admin.status') }}</label>
                    <select wire:model.defer="is_active" class="form-select">
                        <option value="1">{{ __('admin.active') }}</option>
                        <option value="0">{{ __('admin.inactive') }}</option>
                    </select>
                    @error('is_active') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">{{ __('admin.seo_title') }}</label>
                    <input type="text" wire:model.defer="seo_title" class="form-control">
                    @error('seo_title') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">{{ __('admin.seo_description') }}</label>
                    <textarea wire:model.defer="seo_description" rows="3" class="form-control"></textarea>
                    @error('seo_description') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
            </div>

            <div class="mt-4 d-flex gap-2">
                <button class="btn btn-admin-primary px-4" wire:loading.attr="disabled">
                    <span wire:loading.remove>{{ __('admin.save') }}</span>
                    <span wire:loading>{{ __('admin.saving') }}</span>
                </button>

                <a href="{{ route('admin.categories.index') }}" class="btn btn-light">
                    {{ __('admin.cancel') }}
                </a>
            </div>
        </div>
    </div>
</form>