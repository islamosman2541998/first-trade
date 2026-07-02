<div>
    <div class="card admin-card">
        <div class="card-header bg-white d-flex flex-wrap align-items-center justify-content-between gap-3">
            <div>
                <strong>{{ __('admin.contact_messages') }}</strong>
                <div class="small text-muted">{{ __('admin.contact_messages_hint') }}</div>
            </div>

            <button wire:click="resetFilters" class="btn btn-outline-secondary">
                {{ __('admin.reset_filters') }}
            </button>
        </div>

        <div class="card-body">
            <div class="row g-3 mb-4">
                <div class="col-lg-4">
                    <input
                        type="text"
                        wire:model.live.debounce.400ms="search"
                        class="form-control"
                        placeholder="{{ __('admin.search_contact_messages') }}">
                </div>

                <div class="col-lg-2 col-md-6">
                    <select wire:model.live="status" class="form-select">
                        <option value="">{{ __('admin.all_status') }}</option>
                        @foreach($statuses as $status)
                            <option value="{{ $status }}">{{ __('admin.contact_status_' . $status) }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-lg-2 col-md-6">
                    <select wire:model.live="method" class="form-select">
                        <option value="">{{ __('admin.all_methods') }}</option>
                        @foreach($methods as $method)
                            <option value="{{ $method }}">{{ __('admin.contact_method_' . $method) }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-lg-2 col-md-6">
                    <input type="date" wire:model.live="dateFrom" class="form-control">
                </div>

                <div class="col-lg-2 col-md-6">
                    <input type="date" wire:model.live="dateTo" class="form-control">
                </div>
            </div>

            <div class="table-responsive">
                <table class="table align-middle admin-table">
                    <thead>
                        <tr>
                            <th>{{ __('admin.customer') }}</th>
                            <th>{{ __('admin.subject') }}</th>
                            <th>{{ __('admin.contact') }}</th>
                            <th>{{ __('admin.method') }}</th>
                            <th>{{ __('admin.status') }}</th>
                            <th>{{ __('admin.date') }}</th>
                            <th class="text-end">{{ __('admin.actions') }}</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($messages as $message)
                            <tr wire:key="contact-message-{{ $message->id }}" class="{{ $message->isUnread() ? 'table-warning' : '' }}">
                                <td>
                                    <strong>{{ $message->name }}</strong>
                                    @if($message->company)
                                        <div class="small text-muted">{{ $message->company }}</div>
                                    @endif
                                </td>

                                <td>
                                    <strong>{{ $message->subject ?: '-' }}</strong>
                                    <div class="small text-muted">
                                        {{ \Illuminate\Support\Str::limit($message->message, 70) }}
                                    </div>
                                </td>

                                <td>
                                    @if($message->phone)
                                        <div>{{ $message->phone }}</div>
                                    @endif

                                    @if($message->email)
                                        <div class="small text-muted">{{ $message->email }}</div>
                                    @endif
                                </td>

                                <td>
                                    {{ $message->preferred_contact_method ? __('admin.contact_method_' . $message->preferred_contact_method) : '-' }}
                                </td>

                                <td style="min-width: 160px;">
                                    <select
                                        class="form-select form-select-sm"
                                        wire:change="updateStatus({{ $message->id }}, $event.target.value)">
                                        @foreach($statuses as $status)
                                            <option value="{{ $status }}" @selected($message->status === $status)>
                                                {{ __('admin.contact_status_' . $status) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>

                                <td>
                                    {{ $message->created_at->format('Y-m-d') }}
                                    <div class="small text-muted">{{ $message->created_at->format('H:i') }}</div>
                                </td>

                                <td class="text-end">
                                    <a href="{{ route('admin.contact-messages.show', $message) }}" class="btn btn-sm btn-admin-primary">
                                        {{ __('admin.view') }}
                                    </a>

                                    <button type="button" wire:click="deleteMessage({{ $message->id }})" class="btn btn-sm btn-outline-danger">
                                        {{ __('admin.delete') }}
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">
                                    {{ __('admin.no_contact_messages_found') }}
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $messages->links() }}
            </div>
        </div>
    </div>
</div>