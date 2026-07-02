<div class="product-premium-gallery" wire:ignore>
    @if($galleryItems->count())
        <div class="product-gallery-main swiper">
            <div class="swiper-wrapper">
                @foreach($galleryItems as $item)
                    <div class="swiper-slide">
                        <div class="product-gallery-slide">
                            <img src="{{ asset($item['image']) }}" alt="{{ $item['title'] }}">

                            <div class="product-gallery-caption">
                                <span>{{ $item['label'] }}</span>
                                <strong>{{ $item['title'] }}</strong>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if($galleryItems->count() > 1)
                <button class="product-gallery-arrow product-gallery-prev" type="button">
                    <i class="bi bi-chevron-left"></i>
                </button>

                <button class="product-gallery-arrow product-gallery-next" type="button">
                    <i class="bi bi-chevron-right"></i>
                </button>

                <div class="product-gallery-pagination"></div>
            @endif
        </div>

        @if($galleryItems->count() > 1)
            <div class="product-gallery-thumbs swiper mt-3">
                <div class="swiper-wrapper">
                    @foreach($galleryItems as $item)
                        <div class="swiper-slide">
                            <div class="product-gallery-thumb">
                                <img src="{{ asset($item['image']) }}" alt="{{ $item['title'] }}">
                                <span>{{ $item['label'] }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    @else
        <div class="product-gallery-empty">
            {{ __('site.no_product_images') }}
        </div>
    @endif
</div>

@push('scripts')
    <script>
        function initProductGalleries() {
            document.querySelectorAll('.product-premium-gallery').forEach(function (gallery) {
                const mainElement = gallery.querySelector('.product-gallery-main');
                const thumbsElement = gallery.querySelector('.product-gallery-thumbs');

                if (!mainElement) return;

                if (mainElement.swiper) {
                    mainElement.swiper.destroy(true, true);
                }

                if (thumbsElement && thumbsElement.swiper) {
                    thumbsElement.swiper.destroy(true, true);
                }

                let thumbsSwiper = null;

                if (thumbsElement) {
                    thumbsSwiper = new Swiper(thumbsElement, {
                        modules: [
                            window.SwiperModules.FreeMode,
                        ],
                        slidesPerView: 4,
                        spaceBetween: 12,
                        freeMode: true,
                        watchSlidesProgress: true,
                        breakpoints: {
                            0: {
                                slidesPerView: 3,
                                spaceBetween: 8,
                            },
                            576: {
                                slidesPerView: 4,
                                spaceBetween: 10,
                            },
                            992: {
                                slidesPerView: 5,
                                spaceBetween: 12,
                            },
                        },
                    });
                }

                new Swiper(mainElement, {
                    modules: [
                        window.SwiperModules.Navigation,
                        window.SwiperModules.Pagination,
                        window.SwiperModules.Autoplay,
                        window.SwiperModules.EffectFade,
                        window.SwiperModules.Thumbs,
                    ],
                    loop: !!thumbsSwiper,
                    effect: 'fade',
                    speed: 800,
                    grabCursor: true,
                    autoplay: thumbsSwiper ? {
                        delay: 3500,
                        disableOnInteraction: false,
                        pauseOnMouseEnter: true,
                    } : false,
                    pagination: {
                        el: gallery.querySelector('.product-gallery-pagination'),
                        clickable: true,
                    },
                    navigation: {
                        nextEl: gallery.querySelector('.product-gallery-next'),
                        prevEl: gallery.querySelector('.product-gallery-prev'),
                    },
                    thumbs: thumbsSwiper ? {
                        swiper: thumbsSwiper,
                    } : undefined,
                });
            });
        }

        document.addEventListener('DOMContentLoaded', initProductGalleries);
        document.addEventListener('livewire:navigated', initProductGalleries);
    </script>
@endpush