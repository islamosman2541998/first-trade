<div>
    <div class="card admin-card">
        <div class="card-header bg-white d-flex flex-wrap align-items-center justify-content-between gap-3">
            <div>
                <strong>{{ __('admin.quote_requests') }}</strong>
                <div class="small text-muted">{{ __('admin.quote_requests_hint') }}</div>
            </div>
        </div>

        <div class="card-body">
            <div class="row g-3 mb-4">
                <div class="col-md-8">
                    <input
                        type="text"
                        wire:model.live.debounce.400ms="search"
                        class="form-control"
                        placeholder="{{ __('admin.search_quote_requests') }}">
                </div>

                <div class="col-md-4">
                    <select wire:model.live="status" class="form-select">
                        <option value="">{{ __('admin.all_status') }}</option>
                        @foreach($statuses as $status)
                            <option value="{{ $status }}">{{ __('admin.quote_status_' . $status) }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table align-middle admin-table">
                    <thead>
                        <tr>
                            <th>{{ __('admin.customer') }}</th>
                            <th>{{ __('admin.product') }}</th>
                            <th>{{ __('admin.contact') }}</th>
                            <th>{{ __('admin.status') }}</th>
                            <th>{{ __('admin.date') }}</th>
                            <th class="text-end">{{ __('admin.actions') }}</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($quoteRequests as $request)
                            <tr wire:key="quote-request-{{ $request->id }}" class="{{ $request->isUnread() ? 'table-warning' : '' }}">
                                <td>
                                    <strong>{{ $request->name }}</strong>
                                    @if($request->company)
                                        <div class="small text-muted">{{ $request->company }}</div>
                                    @endif
                                </td>

                                <td>
                                    <strong>{{ $request->product?->name ?: ($request->product_name ?: '-') }}</strong>
                                    @if($request->category)
                                        <div class="small text-muted">{{ $request->category->name }}</div>
                                    @endif
                                </td>

                                <td>
                                    <div>{{ $request->phone }}</div>
                                    @if($request->email)
                                        <div class="small text-muted">{{ $request->email }}</div>
                                    @endif
                                </td>

                                <td style="min-width: 160px;">
                                    <select
                                        class="form-select form-select-sm"
                                        wire:change="updateStatus({{ $request->id }}, $event.target.value)">
                                        @foreach($statuses as $status)
                                            <option value="{{ $status }}" @selected($request->status === $status)>
                                                {{ __('admin.quote_status_' . $status) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>

                                <td>
                                    {{ $request->created_at->format('Y-m-d') }}
                                    <div class="small text-muted">{{ $request->created_at->format('H:i') }}</div>
                                </td>

                                <td class="text-end">
                                    <a href="{{ route('admin.quote-requests.show', $request) }}" class="btn btn-sm btn-admin-primary">
                                        {{ __('admin.view') }}
                                    </a>

                                    <button
                                        type="button"
                                        wire:click="deleteRequest({{ $request->id }})"
                                        class="btn btn-sm btn-outline-danger">
                                        {{ __('admin.delete') }}
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">
                                    {{ __('admin.no_quote_requests_found') }}
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $quoteRequests->links() }}
            </div>
        </div>
    </div>
</div>