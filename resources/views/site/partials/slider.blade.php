@if($sliders->count())
    <section class="ft-hero-slider swiper">
        <div class="swiper-wrapper">
            @foreach($sliders as $slider)
                <div class="swiper-slide">
                    <div class="ft-hero-slide" style="background-image: url('{{ asset($slider->image) }}');">
                        <div class="container">
                            <div class="ft-hero-content" data-aos="fade-up">
                                @if($slider->title)
                                    <h1 class="ft-hero-title">
                                        {{ $slider->title }}
                                    </h1>
                                @endif

                                @if($slider->description)
                                    <p class="ft-hero-description">
                                        {{ $slider->description }}
                                    </p>
                                @endif

                                @if($slider->button_link && $slider->button_text)
                                    <a href="{{ $slider->button_link }}"
                                       target="{{ $slider->button_target }}"
                                       class="ft-hero-btn">
                                        {{ $slider->button_text }}
                                        <i class="bi bi-arrow-right"></i>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="swiper-pagination"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
    </section>
@else
    <section class="py-5 bg-light">
        <div class="container">
            <h1 class="display-5 fw-bold">
                {{ setting('home_hero_title_' . app()->getLocale(), setting('home_hero_title_en', 'Fresh Produce, Trusted Trade')) }}
            </h1>

            <p class="lead">
                {{ setting('home_hero_subtitle_' . app()->getLocale(), setting('home_hero_subtitle_en', 'Premium fruits and vegetables for import and export.')) }}
            </p>

            <a href="{{ route('site.products.index') }}" class="btn btn-success">
                View Products
            </a>
        </div>
    </section>
@endif

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const sliderElement = document.querySelector('.ft-hero-slider');

            if (sliderElement) {
                new Swiper(sliderElement, {
                    modules: [
                        window.SwiperModules.Navigation,
                        window.SwiperModules.Pagination,
                        window.SwiperModules.Autoplay,
                        window.SwiperModules.EffectFade,
                    ],
                    loop: true,
                    effect: 'fade',
                    speed: 900,
                    autoplay: {
                        delay: 5000,
                        disableOnInteraction: false,
                    },
                    pagination: {
                        el: '.swiper-pagination',
                        clickable: true,
                    },
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev',
                    },
                });
            }
        });
    </script>
@endpush