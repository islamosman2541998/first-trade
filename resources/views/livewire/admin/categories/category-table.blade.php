<div>
    <div class="card admin-card">
        <div class="card-body">
            <div class="d-flex flex-wrap justify-content-between gap-2 mb-4">
                <div>
                    <a href="{{ route('admin.categories.create') }}" class="btn btn-admin-primary">
                        <i class="bi bi-plus-lg"></i> {{ __('admin.add_category') }}
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
                <div class="col-md-4">
                    <input type="text"
                           wire:model.live.debounce.400ms="search"
                           class="form-control"
                           placeholder="{{ __('admin.search') }}">
                </div>

                <div class="col-md-2">
                    <select wire:model.live="status" class="form-select">
                        <option value="">{{ __('admin.status') }}</option>
                        <option value="1">{{ __('admin.active') }}</option>
                        <option value="0">{{ __('admin.inactive') }}</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <select wire:model.live="type" class="form-select">
                        <option value="">{{ __('admin.type') }}</option>
                        <option value="parent">{{ __('admin.main_category') }}</option>
                        <option value="child">{{ __('admin.sub_category') }}</option>
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
                        <th>{{ __('admin.category_image') }}</th>
                        <th>{{ __('admin.title') }}</th>
                        <th>{{ __('admin.parent_category') }}</th>
                        <th>{{ __('admin.slug') }}</th>
                        <th>{{ __('admin.sort_order') }}</th>
                        <th>{{ __('admin.status') }}</th>
                        <th class="text-end">{{ __('admin.actions') }}</th>
                    </tr>
                    </thead>

                    <tbody>
                    @forelse($categories as $category)
                        <tr wire:key="category-{{ $category->id }}">
                            <td>
                                <input type="checkbox" value="{{ $category->id }}" wire:model.live="selected">
                            </td>

                            <td>
                                @if($category->image)
                                    <img src="{{ asset($category->image) }}"
                                         style="width: 74px; height: 54px; object-fit: cover;"
                                         class="rounded">
                                @else
                                    -
                                @endif
                            </td>

                            <td>
                                <strong>{{ $category->name ?: '-' }}</strong>
                                <div class="small text-muted">
                                    {{ $category->parent_id ? __('admin.sub_category') : __('admin.main_category') }}
                                </div>
                            </td>

                            <td>
                                {{ $category->parent?->name ?? '-' }}
                            </td>

                            <td>
                                <code>{{ $category->slug }}</code>
                            </td>

                            <td>{{ $category->sort_order }}</td>

                            <td>
                                <button wire:click="toggleActive({{ $category->id }})"
                                        class="btn btn-sm {{ $category->is_active ? 'btn-success' : 'btn-secondary' }}">
                                    {{ $category->is_active ? __('admin.active') : __('admin.inactive') }}
                                </button>
                            </td>

                            <td class="text-end">
                                <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-sm btn-light">
                                    <i class="bi bi-pencil"></i>
                                </a>

                                <button wire:click="confirmDelete({{ $category->id }})" class="btn btn-sm btn-outline-danger">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted py-4">
                                {{ __('admin.no_categories_found') }}
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $categories->links() }}
            </div>
        </div>
    </div>
</div>