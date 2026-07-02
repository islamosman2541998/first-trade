<div>
    <div class="card admin-card">
        <div class="card-body">
            <div class="d-flex flex-wrap justify-content-between gap-2 mb-4">
                <div>
                    <a href="{{ route('admin.products.create') }}" class="btn btn-admin-primary">
                        <i class="bi bi-plus-lg"></i> {{ __('admin.add_product') }}
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
                <div class="col-md-3">
                    <input type="text"
                           wire:model.live.debounce.400ms="search"
                           class="form-control"
                           placeholder="{{ __('admin.search') }}">
                </div>

                <div class="col-md-2">
                    <select wire:model.live="category" class="form-select">
                        <option value="">{{ __('admin.categories') }}</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2">
                    <select wire:model.live="status" class="form-select">
                        <option value="">{{ __('admin.status') }}</option>
                        <option value="1">{{ __('admin.active') }}</option>
                        <option value="0">{{ __('admin.inactive') }}</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <select wire:model.live="featured" class="form-select">
                        <option value="">{{ __('admin.featured') }}</option>
                        <option value="1">{{ __('admin.featured') }}</option>
                        <option value="0">{{ __('admin.not_featured') }}</option>
                    </select>
                </div>

                <div class="col-md-1">
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
                        <th>{{ __('admin.product_image') }}</th>
                        <th>{{ __('admin.title') }}</th>
                        <th>{{ __('admin.categories') }}</th>
                        <th>{{ __('admin.sku') }}</th>
                        <th>{{ __('admin.featured') }}</th>
                        <th>{{ __('admin.status') }}</th>
                        <th class="text-end">{{ __('admin.actions') }}</th>
                    </tr>
                    </thead>

                    <tbody>
                    @forelse($products as $product)
                        <tr wire:key="product-{{ $product->id }}">
                            <td>
                                <input type="checkbox" value="{{ $product->id }}" wire:model.live="selected">
                            </td>

                            <td>
                                @if($product->main_image)
                                    <img src="{{ asset($product->main_image) }}"
                                         style="width: 74px; height: 54px; object-fit: cover;"
                                         class="rounded">
                                @else
                                    -
                                @endif
                            </td>

                            <td>
                                <strong>{{ $product->name ?: '-' }}</strong>
                                <div class="small text-muted">
                                    <code>{{ $product->slug }}</code>
                                </div>
                            </td>

                            <td>{{ $product->category?->name ?? '-' }}</td>

                            <td>{{ $product->sku ?? '-' }}</td>

                            <td>
                                <button wire:click="toggleFeatured({{ $product->id }})"
                                        class="btn btn-sm {{ $product->is_featured ? 'btn-warning' : 'btn-light' }}">
                                    {{ $product->is_featured ? __('admin.featured') : __('admin.not_featured') }}
                                </button>
                            </td>

                            <td>
                                <button wire:click="toggleActive({{ $product->id }})"
                                        class="btn btn-sm {{ $product->is_active ? 'btn-success' : 'btn-secondary' }}">
                                    {{ $product->is_active ? __('admin.active') : __('admin.inactive') }}
                                </button>
                            </td>

                            <td class="text-end">
                                <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-sm btn-light">
                                    <i class="bi bi-pencil"></i>
                                </a>

                                <button wire:click="confirmDelete({{ $product->id }})" class="btn btn-sm btn-outline-danger">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted py-4">
                                {{ __('admin.no_products_found') }}
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</div>