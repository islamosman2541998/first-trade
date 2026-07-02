@extends('admin.layouts.app')

@section('title', __('admin.dashboard'))
@section('page_title', __('admin.dashboard'))

@section('content')
    <div class="dashboard-hero-card mb-4">
        <div>
            <span>{{ __('admin.dashboard_overview') }}</span>
            <h2>{{ __('admin.welcome_dashboard') }}</h2>
            <p>{{ __('admin.dashboard_intro') }}</p>
        </div>

        <a href="{{ route('site.home') }}" target="_blank" class="btn btn-admin-primary">
            {{ __('admin.view_website') }}
            <i class="bi bi-box-arrow-up-right"></i>
        </a>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-6 col-xl-3">
            <a href="{{ route('admin.categories.index') }}" class="dashboard-stat-card">
                <div class="dashboard-stat-icon">
                    <i class="bi bi-grid"></i>
                </div>

                <div>
                    <span>{{ __('admin.categories') }}</span>
                    <h3>{{ $categoriesCount }}</h3>
                    <small>{{ $parentCategoriesCount }} {{ __('admin.main_categories') }}</small>
                </div>
            </a>
        </div>

        <div class="col-md-6 col-xl-3">
            <a href="{{ route('admin.products.index') }}" class="dashboard-stat-card">
                <div class="dashboard-stat-icon">
                    <i class="bi bi-box-seam"></i>
                </div>

                <div>
                    <span>{{ __('admin.products') }}</span>
                    <h3>{{ $productsCount }}</h3>
                    <small>{{ $activeProductsCount }} {{ __('admin.active_products') }}</small>
                </div>
            </a>
        </div>

        <div class="col-md-6 col-xl-3">
            <a href="{{ route('admin.contact-messages.index') }}" class="dashboard-stat-card">
                <div class="dashboard-stat-icon">
                    <i class="bi bi-envelope"></i>
                </div>

                <div>
                    <span>{{ __('admin.contact_messages') }}</span>
                    <h3>{{ $contactMessagesCount }}</h3>
                    <small>{{ $newContactMessagesCount }} {{ __('admin.new_messages') }}</small>
                </div>
            </a>
        </div>

        <div class="col-md-6 col-xl-3">
            <a href="{{ route('admin.quote-requests.index') }}" class="dashboard-stat-card">
                <div class="dashboard-stat-icon">
                    <i class="bi bi-file-earmark-text"></i>
                </div>

                <div>
                    <span>{{ __('admin.quote_requests') }}</span>
                    <h3>{{ $quoteRequestsCount }}</h3>
                    <small>{{ $newQuoteRequestsCount }} {{ __('admin.new_requests') }}</small>
                </div>
            </a>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-xl-8">
            <div class="card admin-card dashboard-chart-card h-100">
                <div class="card-header bg-white d-flex flex-wrap align-items-center justify-content-between gap-3">
                    <div>
                        <strong>{{ __('admin.monthly_activity') }}</strong>
                        <div class="small text-muted">{{ __('admin.monthly_activity_hint') }}</div>
                    </div>
                </div>

                <div class="card-body">
                    <canvas id="monthlyActivityChart" height="115"></canvas>
                </div>
            </div>
        </div>

        <div class="col-xl-4">
            <div class="card admin-card dashboard-chart-card h-100">
                <div class="card-header bg-white">
                    <strong>{{ __('admin.products_by_category') }}</strong>
                    <div class="small text-muted">{{ __('admin.products_by_category_hint') }}</div>
                </div>

                <div class="card-body">
                    <canvas id="categoryProductsChart" height="210"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-xl-6">
            <div class="card admin-card dashboard-list-card h-100">
                <div class="card-header bg-white d-flex justify-content-between align-items-center gap-3">
                    <div>
                        <strong>{{ __('admin.latest_contact_messages') }}</strong>
                        <div class="small text-muted">{{ __('admin.latest_contact_messages_hint') }}</div>
                    </div>

                    <a href="{{ route('admin.contact-messages.index') }}" class="dashboard-card-link">
                        {{ __('admin.view_all') }}
                    </a>
                </div>

                <div class="card-body p-0">
                    @forelse($latestContactMessages as $message)
                        <a href="{{ route('admin.contact-messages.show', $message) }}" class="dashboard-list-item">
                            <div class="dashboard-list-avatar">
                                {{ mb_substr($message->name, 0, 1) }}
                            </div>

                            <div class="dashboard-list-content">
                                <div class="d-flex justify-content-between gap-3">
                                    <strong>{{ $message->name }}</strong>
                                    <small>{{ $message->created_at->diffForHumans() }}</small>
                                </div>

                                <p>{{ $message->subject ?: \Illuminate\Support\Str::limit($message->message, 65) }}</p>
                            </div>

                            @if($message->status === \App\Models\ContactMessage::STATUS_NEW)
                                <span class="dashboard-status-badge new">{{ __('admin.new') }}</span>
                            @endif
                        </a>
                    @empty
                        <div class="dashboard-empty-state">
                            {{ __('admin.no_contact_messages_found') }}
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="col-xl-6">
            <div class="card admin-card dashboard-list-card h-100">
                <div class="card-header bg-white d-flex justify-content-between align-items-center gap-3">
                    <div>
                        <strong>{{ __('admin.latest_quote_requests') }}</strong>
                        <div class="small text-muted">{{ __('admin.latest_quote_requests_hint') }}</div>
                    </div>

                    <a href="{{ route('admin.quote-requests.index') }}" class="dashboard-card-link">
                        {{ __('admin.view_all') }}
                    </a>
                </div>

                <div class="card-body p-0">
                    @forelse($latestQuoteRequests as $request)
                        <a href="{{ route('admin.quote-requests.show', $request) }}" class="dashboard-list-item">
                            <div class="dashboard-list-avatar">
                                {{ mb_substr($request->name, 0, 1) }}
                            </div>

                            <div class="dashboard-list-content">
                                <div class="d-flex justify-content-between gap-3">
                                    <strong>{{ $request->name }}</strong>
                                    <small>{{ $request->created_at->diffForHumans() }}</small>
                                </div>

                                <p>
                                    {{ $request->product?->name ?: ($request->product_name ?: __('admin.quote_request')) }}
                                </p>
                            </div>

                            @if($request->status === \App\Models\QuoteRequest::STATUS_NEW)
                                <span class="dashboard-status-badge new">{{ __('admin.new') }}</span>
                            @endif
                        </a>
                    @empty
                        <div class="dashboard-empty-state">
                            {{ __('admin.no_quote_requests_found') }}
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                if (typeof window.Chart === 'undefined') {
                    return;
                }

                const monthlyActivityCanvas = document.getElementById('monthlyActivityChart');
                const categoryProductsCanvas = document.getElementById('categoryProductsChart');

                if (monthlyActivityCanvas) {
                    new window.Chart(monthlyActivityCanvas, {
                        type: 'line',
                        data: {
                            labels: @json($chartMonths),
                            datasets: [
    {
        label: @json(__('admin.contact_messages')),
        data: @json($contactMessagesMonthly),
        borderColor: '#2F6E3B',
        backgroundColor: 'rgba(47, 110, 59, 0.14)',
        pointBackgroundColor: '#2F6E3B',
        pointBorderColor: '#ffffff',
        borderWidth: 3,
        tension: 0.42,
        fill: true,
        pointRadius: 4,
        pointHoverRadius: 6,
    },
    {
        label: @json(__('admin.quote_requests')),
        data: @json($quoteRequestsMonthly),
        borderColor: '#F2C514',
        backgroundColor: 'rgba(242, 197, 20, 0.20)',
        pointBackgroundColor: '#F2C514',
        pointBorderColor: '#ffffff',
        borderWidth: 3,
        tension: 0.42,
        fill: true,
        pointRadius: 4,
        pointHoverRadius: 6,
    }
]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: true,
                            plugins: {
                                legend: {
                                    position: 'bottom',
                                    labels: {
                                        usePointStyle: true,
                                        boxWidth: 8,
                                        font: {
                                            weight: 'bold'
                                        }
                                    }
                                },
                                tooltip: {
                                    mode: 'index',
                                    intersect: false,
                                }
                            },
                            interaction: {
                                mode: 'index',
                                intersect: false,
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    ticks: {
                                        precision: 0
                                    },
                                    grid: {
                                        color: 'rgba(15, 23, 42, 0.06)'
                                    }
                                },
                                x: {
                                    grid: {
                                        display: false
                                    }
                                }
                            }
                        }
                    });
                }

                if (categoryProductsCanvas) {
                    new window.Chart(categoryProductsCanvas, {
                        type: 'doughnut',
                        data: {
                            labels: @json($categoryProductLabels),
                            datasets: [
    {
        data: @json($categoryProductData),
        backgroundColor: [
            '#2F6E3B',
            '#24572E',
            '#F2C514',
            '#E8A48A',
            '#CBEAF1',
            '#7AA874',
            '#DFA878',
            '#A0C49D',
        ],
        borderColor: '#ffffff',
        borderWidth: 3,
    }
]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: true,
                            cutout: '68%',
                            plugins: {
                                legend: {
                                    position: 'bottom',
                                    labels: {
                                        usePointStyle: true,
                                        boxWidth: 8,
                                        font: {
                                            weight: 'bold'
                                        }
                                    }
                                }
                            }
                        }
                    });
                }
            });
        </script>
    @endpush
@endsection