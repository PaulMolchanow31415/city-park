<template>
    <swiper
        :effect="'coverflow'"
        :grabCursor="true"
        :centeredSlides="true"
        :slidesPerView="'auto'"
        :coverflowEffect="{
            rotate: 50,
            stretch: 0,
            depth: 100,
            modifier: 1,
            slideShadows: true,
        }"
        :pagination="true"
        :modules="modules"
        class="mySwiper"
    >
        <swiper-slide
            ><img
                src="https://plus.unsplash.com/premium_photo-1699600552748-3bb02605fc4e?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxlZGl0b3JpYWwtZmVlZHwyfHx8ZW58MHx8fHx8"
                alt=""
        /></swiper-slide>
        <swiper-slide
            ><img
                src="https://plus.unsplash.com/premium_photo-1699600552748-3bb02605fc4e?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxlZGl0b3JpYWwtZmVlZHwyfHx8ZW58MHx8fHx8"
                alt=""
        /></swiper-slide>
        <swiper-slide
            ><img
                src="https://plus.unsplash.com/premium_photo-1699600552748-3bb02605fc4e?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxlZGl0b3JpYWwtZmVlZHwyfHx8ZW58MHx8fHx8"
                alt=""
        /></swiper-slide>
    </swiper>
</template>
<script>
// import Swiper core and required modules
import "swiper/css";
import { Swiper, SwiperSlide } from "swiper/vue";

import "swiper/css/effect-coverflow";
import "swiper/css/pagination";

// import required modules
import { EffectCoverflow, Pagination } from "swiper/modules";

// Import Swiper styles
export default {
    components: {
        Swiper,
        SwiperSlide,
    },
    data() {
        return {
            modules: [EffectCoverflow, Pagination],
        };
    },
};
</script>
