import './bootstrap.js';

import store from '@/store/index.js';
import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import YandexMaps, { yandexMap, ymapMarker } from 'vue-yandex-maps';
import './plugins/font-awesome.js';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import BaseLayout from './Layouts/BaseLayout.vue';
import '../pcss/main.pcss';
import './plugins/swiper.js'
import './plugins/quil-editor.js'

const mapApiKey = import.meta.env.VITE_YANDEX_MAPS_KEY
const autocompleteApiKey = import.meta.env.VITE_YANDEX_AUTOCOMPLETE_KEY
const appName = import.meta.env.VITE_APP_NAME || 'РГК «City Park»'

createInertiaApp({
  title: title => title ? `${title} - ${appName}` : appName,
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
    .use(YandexMaps, { apiKey: mapApiKey })
    .use(store)
    .component('YandexMap', yandexMap)
    .component('YmapMarker', ymapMarker)
    .component('FontAwesomeIcon', FontAwesomeIcon)
    .provide('autocompleteApiKey', autocompleteApiKey)
    .mount(el)
  },
  progress: {
    color: '#3c1c11',
  },
}).then();
