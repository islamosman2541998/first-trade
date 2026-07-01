<div>
    <div class="card admin-card">
        <div class="card-body">
            <div class="d-flex flex-wrap justify-content-between gap-2 mb-4">
                <div>
                    <a href="{{ route('admin.sliders.create') }}" class="btn btn-admin-primary">
                        <i class="bi bi-plus-lg"></i> {{ __('admin.add_slider') }}
                    </a>
                </div>

                <div class="d-flex gap-2">
                    <button wire:click="export" class="btn btn-outline-success">
                        <i class="bi bi-file-earmark-excel"></i> {{ __('admin.export_excel') }}
                    </button>

                    <button wire:click="confirmBulkDelete" class="btn btn-outline-danger" @disabled(empty($selected))>
                        <i class="bi bi-trash"></i> {{ __('admin.delete_selected') }}
                    </button>
                </div>
            </div>

            <div class="row g-3 mb-4">
                <div class="col-md-5">
                    <input type="text"
                           wire:model.live.debounce.400ms="search"
                           class="form-control"
                           placeholder="{{ __('admin.search') }}">
                </div>

                <div class="col-md-3">
                    <select wire:model.live="status" class="form-select">
                        <option value="">{{ __('admin.status') }}</option>
                        <option value="1">{{ __('admin.active') }}</option>
                        <option value="0">{{ __('admin.inactive') }}</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <select wire:model.live="perPage" class="form-select">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <button wire:click="resetFilters" class="btn btn-light w-100">
                        {{ __('admin.reset') }}
                    </button>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                    <tr>
                        <th width="40">
                            <input type="checkbox" wire:model.live="selectAll">
                        </th>
                        <th>{{ __('admin.slider_image') }}</th>
                        <th>{{ __('admin.title') }}</th>
                        <th>{{ __('admin.button_link') }}</th>
                        <th>{{ __('admin.sort_order') }}</th>
                        <th>{{ __('admin.status') }}</th>
                        <th class="text-end">{{ __('admin.actions') }}</th>
                    </tr>
                    </thead>

                    <tbody>
                    @forelse($sliders as $slider)
                        <tr wire:key="slider-{{ $slider->id }}">
                            <td>
                                <input type="checkbox" value="{{ $slider->id }}" wire:model.live="selected">
                            </td>

                            <td>
                                @if($slider->image)
                                    <img src="{{ asset($slider->image) }}" style="width: 90px; height: 55px; object-fit: cover;" class="rounded">
                                @else
                                    -
                                @endif
                            </td>

                            <td>
                                <strong>{{ $slider->title ?: '-' }}</strong>
                                <div class="small text-muted">
                                    {{ str($slider->description)->limit(70) }}
                                </div>
                            </td>

                            <td>
                                @if($slider->button_link)
                                    <a href="{{ $slider->button_link }}" target="_blank">
                                        {{ $slider->button_link }}
                                    </a>
                                @else
                                    -
                                @endif
                            </td>

                            <td>{{ $slider->sort_order }}</td>

                            <td>
                                <button wire:click="toggleActive({{ $slider->id }})"
                                        class="btn btn-sm {{ $slider->is_active ? 'btn-success' : 'btn-secondary' }}">
                                    {{ $slider->is_active ? __('admin.active') : __('admin.inactive') }}
                                </button>
                            </td>

                            <td class="text-end">
                                <a href="{{ route('admin.sliders.edit', $slider) }}" class="btn btn-sm btn-light">
                                    <i class="bi bi-pencil"></i>
                                </a>

                                <button wire:click="confirmDelete({{ $slider->id }})" class="btn btn-sm btn-outline-danger">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">
                                No sliders found.
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $sliders->links() }}
            </div>
        </div>
    </div>
</div>