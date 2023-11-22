<script setup>

import { useBreadcrumbs } from '@/composables/index.js'
import Breadcrumbs from '@/Components/Breadcrumbs.vue'
import { Head } from '@inertiajs/vue3'
import TitleUnderlined from '@/Components/TitleUnderlined.vue'
import { Swiper, SwiperSlide } from 'swiper/vue';
import BaseLayout from '@/Layouts/BaseLayout.vue';
import RestLayout from '@/Layouts/RestLayout.vue';

const breadcrumbs = useBreadcrumbs()
const pageTitle = breadcrumbs.value[breadcrumbs.value.length - 1].title

defineOptions({
    layout: [BaseLayout, RestLayout]
})
</script>

<template>
    <Head :title="pageTitle"/>

    <div class="container mt-20">
        <Breadcrumbs :breadcrumbs="breadcrumbs"/>
        <TitleUnderlined as="h2" class="mt-5 mb-10 ml-5">{{ pageTitle }}</TitleUnderlined>
        <Swiper slides-per-view="1">
            <SwiperSlide>slider</SwiperSlide>
            <SwiperSlide>slider</SwiperSlide>
            <SwiperSlide>slider</SwiperSlide>
        </Swiper>
    </div>

</template>
