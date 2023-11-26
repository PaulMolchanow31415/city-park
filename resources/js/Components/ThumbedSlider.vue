<script>
import { Swiper, SwiperSlide } from 'swiper/vue';
import { FreeMode, Thumbs, Autoplay, EffectFade } from 'swiper/modules';
import { defineComponent, ref } from 'vue';

export default defineComponent({
  components: { Swiper, SwiperSlide },
  props: {
    slides: {
      type: Array,
      required: true,
    },
  },
  setup() {
    const modules = [FreeMode, Thumbs, Autoplay, EffectFade]
    const thumbsSwiper = ref(null);
    const setThumbsSwiper = (swiper) => thumbsSwiper.value = swiper;
    return { modules, thumbsSwiper, setThumbsSwiper }
  },
})
</script>

<template>
  <div>
    <Swiper
      class="mb-2.5"
      :thumbs="{swiper:thumbsSwiper}"
      :modules="modules"
      effect="fade"
      loop
      :autoplay="{delay:6000, reverseDirection:true, disableOnInteraction:true, pauseOnMouseEnter:true}"
    >
      <SwiperSlide v-for="slide in slides">
        <img class="w-full h-full" :src="slide.src" :alt="slide.alt"/>
      </SwiperSlide>
    </Swiper>
    <Swiper
      :space-between="20"
      :slides-per-view="slides.length < 4 ? slides.length - 1 : 3"
      :free-mode="true"
      :modules="modules"
      grab-cursor
      @swiper="setThumbsSwiper"
    >
      <SwiperSlide v-for="slide in slides">
        <img class="w-full h-full" :src="slide.src" :alt="slide.alt"/>
      </SwiperSlide>
    </Swiper>
  </div>
</template>
