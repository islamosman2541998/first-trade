<div>
    <div class="card admin-card">
        <div class="card-header bg-white d-flex flex-wrap align-items-center justify-content-between gap-3">
            <div>
                <strong>{{ __('site.home_sections') }}</strong>
                <div class="small text-muted">{{ __('site.manage_home_sections') }}</div>
            </div>
        </div>

        <div class="card-body">
            <div class="row g-3 mb-4">
                <div class="col-md-8">
                    <input
                        type="text"
                        wire:model.live.debounce.400ms="search"
                        class="form-control"
                        placeholder="{{ __('site.search_home_sections') }}">
                </div>

                <div class="col-md-4">
                    <select wire:model.live="status" class="form-select">
                        <option value="">{{ __('site.all_status') }}</option>
                        <option value="1">{{ __('site.active') }}</option>
                        <option value="0">{{ __('site.inactive') }}</option>
                    </select>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table align-middle admin-table">
                    <thead>
                        <tr>
                            <th>{{ __('site.order') }}</th>
                            <th>{{ __('site.key') }}</th>
                            <th>{{ __('site.title') }}</th>
                            <th>{{ __('site.items') }}</th>
                            <th>{{ __('site.status') }}</th>
                            <th class="text-end">{{ __('site.actions') }}</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($sections as $section)
                            <tr wire:key="home-section-{{ $section->id }}">
                                <td style="width: 110px;">
                                    <input
                                        type="number"
                                        class="form-control form-control-sm"
                                        value="{{ $section->sort_order }}"
                                        wire:change="updateSortOrder({{ $section->id }}, $event.target.value)">
                                </td>

                                <td>
                                    <code>{{ $section->key }}</code>
                                </td>

                                <td>
                                    <strong>{{ $section->title_en ?: '-' }}</strong>
                                    <div class="small text-muted">{{ $section->title_ar ?: '-' }}</div>
                                </td>

                                <td>
                                    <span class="badge bg-light text-dark">
                                        {{ $section->items()->count() }} {{ __('site.items') }}
                                    </span>
                                </td>

                                <td>
                                    <button
                                        type="button"
                                        wire:click="toggleStatus({{ $section->id }})"
                                        class="btn btn-sm {{ $section->is_active ? 'btn-success' : 'btn-outline-secondary' }}">
                                        {{ $section->is_active ? __('site.active') : __('site.inactive') }}
                                    </button>
                                </td>

                                <td class="text-end">
                                    <a href="{{ route('admin.home-sections.edit', $section) }}" class="btn btn-sm btn-admin-primary">
                                        <i class="bi bi-pencil-square"></i>
                                        {{ __('site.edit') }}
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">
                                    {{ __('site.no_home_sections_found') }}
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $sections->links() }}
            </div>
        </div>
    </div>
</div>