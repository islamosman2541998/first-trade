@extends('site.layouts.app')

@section('title', setting('about_hero_title_' . app()->getLocale(), __('site.about')))

@section('content')
    @php
        $locale = app()->getLocale();

        $heroImage = setting('about_hero_image')
            ? asset(setting('about_hero_image'))
            : 'https://placehold.co/1100x760?text=First+Trade';

        $storyImage = setting('about_story_image')
            ? asset(setting('about_story_image'))
            : $heroImage;

        $stats = [
            [
                'number' => setting('about_stat_1_number'),
                'label' => setting('about_stat_1_label_' . $locale),
            ],
            [
                'number' => setting('about_stat_2_number'),
                'label' => setting('about_stat_2_label_' . $locale),
            ],
            [
                'number' => setting('about_stat_3_number'),
                'label' => setting('about_stat_3_label_' . $locale),
            ],
        ];

        $values = [
            [
                'icon' => setting('about_value_1_icon', 'bi bi-award'),
                'title' => setting('about_value_1_title_' . $locale),
                'description' => setting('about_value_1_description_' . $locale),
            ],
            [
                'icon' => setting('about_value_2_icon', 'bi bi-box-seam'),
                'title' => setting('about_value_2_title_' . $locale),
                'description' => setting('about_value_2_description_' . $locale),
            ],
            [
                'icon' => setting('about_value_3_icon', 'bi bi-chat-dots'),
                'title' => setting('about_value_3_title_' . $locale),
                'description' => setting('about_value_3_description_' . $locale),
            ],
        ];
    @endphp

    <section class="about-hero-section">
        <div class="container">
            <div class="about-hero-card">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-6">
                        <span class="section-kicker">
                            {{ setting('about_hero_subtitle_' . $locale, __('site.about')) }}
                        </span>

                        <h1>
                            {{ setting('about_hero_title_' . $locale) }}
                        </h1>

                        <p>
                            {{ setting('about_hero_description_' . $locale) }}
                        </p>

                        <div class="about-hero-actions">
                            <a href="{{ route('site.quote.create') }}" class="btn btn-success px-4 py-3">
                                {{ __('site.request_quote') }}
                            </a>

                            <a href="{{ route('site.contact') }}" class="btn btn-outline-success px-4 py-3">
                                {{ __('site.contact') }}
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="about-hero-image">
                            <img src="{{ $heroImage }}" alt="{{ setting('site_name', 'First Trade') }}">
                        </div>
                    </div>
                </div>

                <div class="about-stats-grid">
                    @foreach($stats as $stat)
                        <div class="about-stat-card">
                            <strong>{{ $stat['number'] }}</strong>
                            <span>{{ $stat['label'] }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="about-story-section">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6">
                    <div class="about-story-image">
                        <img src="{{ $storyImage }}" alt="{{ setting('about_story_title_' . $locale) }}">
                    </div>
                </div>

                <div class="col-lg-6">
                    <span class="section-kicker">
                        {{ setting('about_story_subtitle_' . $locale) }}
                    </span>

                    <h2 class="about-section-title">
                        {{ setting('about_story_title_' . $locale) }}
                    </h2>

                    <p class="about-section-text">
                        {{ setting('about_story_description_' . $locale) }}
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="about-values-section">
        <div class="container">
            <div class="text-center mx-auto about-values-heading">
                <span class="section-kicker">
                    {{ setting('about_values_subtitle_' . $locale) }}
                </span>

                <h2 class="about-section-title">
                    {{ setting('about_values_title_' . $locale) }}
                </h2>
            </div>

            <div class="row g-4">
                @foreach($values as $value)
                    <div class="col-md-4">
                        <div class="about-value-card">
                            <div class="about-value-icon">
                                <i class="{{ $value['icon'] }}"></i>
                            </div>

                            <h3>{{ $value['title'] }}</h3>
                            <p>{{ $value['description'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="about-cta-section">
        <div class="container">
            <div class="about-cta-card">
                <h2>{{ setting('about_cta_title_' . $locale) }}</h2>
                <p>{{ setting('about_cta_description_' . $locale) }}</p>

                <a href="{{ route('site.quote.create') }}" class="btn btn-success px-4 py-3">
                    {{ __('site.request_quote') }}
                </a>
            </div>
        </div>
    </section>
@endsection