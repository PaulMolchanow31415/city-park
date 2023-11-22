import './bootstrap';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import YandexMaps, { yandexMap, ymapMarker } from 'vue-yandex-maps';
import './font-awesome.js';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import BaseLayout from './Layouts/BaseLayout.vue';
import '../pcss/main.pcss';
import 'swiper/css';
import 'swiper/css/pagination';
import 'swiper/css/effect-fade';
import 'swiper/css/autoplay';
import 'swiper/css/free-mode';
import 'swiper/css/thumbs';

const ymap_settings = { apiKey: '85497406-1951-4073-a93a-8bf25f5070a3' }

const app_name = import.meta.env.VITE_APP_NAME || 'City Park'

createInertiaApp({
    title: title => `${title} - ${app_name}`,
    resolve: name => {
        const page = resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob('./Pages/**/*.vue'),
        );
        page.then(module => module.default.layout = module.default.layout || BaseLayout)
        return page
    },
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .use(YandexMaps, ymap_settings)
            .component('YandexMap', yandexMap)
            .component('YmapMarker', ymapMarker)
            .component('FontAwesomeIcon', FontAwesomeIcon)
            .mount(el)
    },
    progress: {
        color: '#3c1c11',
    },
}).then();
