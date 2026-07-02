<div>
    <div class="card admin-card">
        <div class="card-header bg-white d-flex flex-wrap align-items-center justify-content-between gap-3">
            <div>
                <strong>{{ __('site.section_items') }}</strong>
                <div class="small text-muted">
                    {{ __('site.section_items_hint') }}
                </div>
            </div>

            <button type="button" wire:click="resetForm" class="btn btn-outline-secondary">
                {{ __('site.new_item') }}
            </button>
        </div>

        <div class="card-body">
            <form wire:submit.prevent="saveItem" class="mb-4">
                <div class="home-item-form">
                    <div class="row g-3">
                        <div class="col-12">
                            <strong>
                                {{ $editingItemId ? __('site.edit_item') : __('site.add_new_item') }}
                            </strong>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">{{ __('site.title_en') }}</label>
                            <input type="text" wire:model="title_en" class="form-control">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">{{ __('site.title_ar') }}</label>
                            <input type="text" wire:model="title_ar" class="form-control" dir="rtl">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">{{ __('site.title_nl') }}</label>
                            <input type="text" wire:model="title_nl" class="form-control">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">{{ __('site.description_en') }}</label>
                            <textarea wire:model="description_en" class="form-control" rows="3"></textarea>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">{{ __('site.description_ar') }}</label>
                            <textarea wire:model="description_ar" class="form-control" rows="3" dir="rtl"></textarea>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">{{ __('site.description_nl') }}</label>
                            <textarea wire:model="description_nl" class="form-control" rows="3"></textarea>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">{{ __('site.icon_class') }}</label>
                            <input type="text" wire:model="icon" class="form-control" placeholder="bi bi-check2-circle">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">{{ __('site.order') }}</label>
                            <input type="number" wire:model="sort_order" class="form-control">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">{{ __('site.button_link') }}</label>
                            <input type="text" wire:model="button_link" class="form-control" placeholder="/products">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">{{ __('site.button_target') }}</label>
                            <select wire:model="button_target" class="form-select">
                                <option value="_self">{{ __('site.same_tab') }}</option>
                                <option value="_blank">{{ __('site.new_tab') }}</option>
                            </select>
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

                        <div class="col-md-6">
                            <label class="form-label">{{ __('site.item_image') }}</label>
                            <input type="file" wire:model="image" class="form-control">

                            <div wire:loading wire:target="image" class="small text-muted mt-2">
                                {{ __('site.uploading_image') }}
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label d-block">{{ __('site.status') }}</label>
                            <div class="form-check form-switch mt-2">
                                <input class="form-check-input" type="checkbox" wire:model="is_active" id="itemStatus">
                                <label class="form-check-label" for="itemStatus">{{ __('site.active_item') }}</label>
                            </div>
                        </div>

                        <div class="col-md-3 d-flex align-items-end justify-content-end">
                            <button type="submit" class="btn btn-admin-primary w-100">
                                {{ $editingItemId ? __('site.update_item') : __('site.add_item') }}
                            </button>
                        </div>

                        @if($image || $currentImage)
                            <div class="col-md-4">
                                @if($image)
                                    <img src="{{ $image->temporaryUrl() }}" class="rounded w-100" style="height: 160px; object-fit: cover;">
                                @elseif($currentImage)
                                    <img src="{{ asset($currentImage) }}" class="rounded w-100" style="height: 160px; object-fit: cover;">
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table align-middle admin-table">
                    <thead>
                        <tr>
                            <th>{{ __('site.order') }}</th>
                            <th>{{ __('site.icon_or_image') }}</th>
                            <th>{{ __('site.title') }}</th>
                            <th>{{ __('site.status') }}</th>
                            <th class="text-end">{{ __('site.actions') }}</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($items as $item)
                            <tr wire:key="home-section-item-{{ $item->id }}">
                                <td>{{ $item->sort_order }}</td>

                                <td>
                                    @if($item->image)
                                        <img src="{{ asset($item->image) }}" style="width: 56px; height: 56px; object-fit: cover;" class="rounded">
                                    @elseif($item->icon)
                                        <span class="home-item-icon-preview">
                                            <i class="{{ $item->icon }}"></i>
                                        </span>
                                    @else
                                        -
                                    @endif
                                </td>

                                <td>
                                    <strong>{{ $item->title_en ?: '-' }}</strong>
                                    <div class="small text-muted">{{ $item->title_ar ?: '-' }}</div>
                                </td>

                                <td>
                                    <button
                                        type="button"
                                        wire:click="toggleItemStatus({{ $item->id }})"
                                        class="btn btn-sm {{ $item->is_active ? 'btn-success' : 'btn-outline-secondary' }}">
                                        {{ $item->is_active ? __('site.active') : __('site.inactive') }}
                                    </button>
                                </td>

                                <td class="text-end">
                                    <button type="button" wire:click="editItem({{ $item->id }})" class="btn btn-sm btn-outline-primary">
                                        {{ __('site.edit') }}
                                    </button>

                                    <button type="button" wire:click="deleteItem({{ $item->id }})" class="btn btn-sm btn-outline-danger">
                                        {{ __('site.delete') }}
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">
                                    {{ __('site.no_items_added') }}
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>