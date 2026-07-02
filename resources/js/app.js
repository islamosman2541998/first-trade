import './bootstrap';

import 'bootstrap';
import Swal from 'sweetalert2';
import toastr from 'toastr';
import AOS from 'aos';
import GLightbox from 'glightbox';

import Swiper from 'swiper';
import {
    Navigation,
    Pagination,
    Autoplay,
    EffectFade,
    Thumbs,
    FreeMode,
} from 'swiper/modules';

import TomSelect from 'tom-select';
import flatpickr from 'flatpickr';
import Sortable from 'sortablejs';

window.Swal = Swal;
window.toastr = toastr;
window.GLightbox = GLightbox;

window.Swiper = Swiper;
window.SwiperModules = {
    Navigation,
    Pagination,
    Autoplay,
    EffectFade,
    Thumbs,
    FreeMode,
};

window.TomSelect = TomSelect;
window.flatpickr = flatpickr;
window.Sortable = Sortable;

AOS.init({
    duration: 700,
    once: true,
});
import {
    Chart,
    LineController,
    BarController,
    LineElement,
    BarElement,
    PointElement,
    CategoryScale,
    LinearScale,
    ArcElement,
    DoughnutController,
    Tooltip,
    Legend,
    Filler,
} from 'chart.js';

Chart.register(
    LineController,
    BarController,
    LineElement,
    BarElement,
    PointElement,
    CategoryScale,
    LinearScale,
    ArcElement,
    DoughnutController,
    Tooltip,
    Legend,
    Filler
);

window.Chart = Chart;