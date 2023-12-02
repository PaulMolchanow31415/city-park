<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { Swiper, SwiperSlide } from 'swiper/vue';
import { Autoplay, EffectFade, Pagination } from 'swiper/modules';
import TitleUnderlined from '@/Components/TitleUnderlined.vue';
import NewsCard from '@/Components/NewsCard.vue';
import MapChapter from '@/Components/MapChapter.vue';
import MenuSection from '@/Components/MenuSection.vue';

const modules = [Pagination, EffectFade, Autoplay];

defineProps({
  news: Object,
  menuItems: Object,
});

</script>

<template>
  <Head title="Главная"/>
  <main>
    <section class="-mt-[90px] slider">
      <Swiper :grabCursor="true" :pagination="true" :modules="modules" effect="fade" :autoplay="{delay: 5000}">
        <SwiperSlide class="slider__item"/>
        <SwiperSlide class="slider__item"/>
        <SwiperSlide class="slider__item"/>
      </Swiper>
      <div class="absolute left-0 bottom-0 bg-white rounded-tr-lg py-5 pr-5 pl-[2vw] z-10 max-w-md">
        <TitleUnderlined class="mb-10">Новости и мероприятия</TitleUnderlined>
        <div class="flex flex-col gap-2.5 mb-10">
          <NewsCard v-for="item in news.data" :data="item" :key="item.id"/>
        </div>
        <div class="w-full flex justify-end">
          <Link :href="route('rest.news.index')"
                class="btn-1">
            Подробнее
          </Link>
        </div>
      </div>
    </section>
    <MenuSection class="mt-28" :items="menuItems.data"/>

    <!--  <section class="mt-28 container">
      <div class="flex items-center justify-between gap-7">
        <div class="flex gap-5 px-5 items-center">
          <span class="font-serif font-normal text-8xl text-maroon leading-tight">{{ amountFreeRooms }}</span>
          <p class="text-2xl">свободны{{ amountFreeRooms > 1 ? 'x' : 'й' }} номер{{
              amountFreeRooms > 1 ? 'а' : ''
                              }}</p>
        </div>
        <TitleUnderlined>Каталог номеров</TitleUnderlined>
      </div>
    <div class="grid grid-cols-3 gap-5">
        <HotelRoomCard class="flex-grow" isAvailable :data="{
                    id: 1,
                    title: 'Одноместные номера',
                    description: 'Двухместные номера с двумя односпальными кроватями или с двуспальной кроватью',
                        pricePerDay: '3000-5000'
                }"/>
        <HotelRoomCard class="flex-grow" :data="{
                    id: 2,
                    title: 'Двухместные номера',
                    description: 'Одноместные номера с двуспальной кроватью.',
                    pricePerDay: '3500'
                }"/>
        <HotelRoomCard class="flex-grow" isAvailable :data="{
                    id: 3,
                    title: 'VIP-номер',
                    description: 'Двухкомнатный номер (гостиная + спальня) с балконом.',
                    pricePerDay: '6000'
                }"/>
      </div>
    </section>-->

    <TitleUnderlined class="container mb-10 mt-32">Контактная информация</TitleUnderlined>
    <MapChapter/>
  </main>

</template>

<style lang="postcss" scoped>
.slider {
  position: relative;
  &__item {
    @apply min-h-screen min-w-full;
    --linear: linear-gradient(180deg, #fff 0%, rgba(255, 255, 255, 0.00) 52.14%, rgba(255, 255, 255, 0.09) 67.25%, #fff 100%);
    &:first-child {background: var(--linear), center / cover no-repeat url('../../images/home-slider/1.jpg');}
    &:nth-child(2) {background: var(--linear), center / cover no-repeat url('../../images/home-slider/2.jpg'); }
    &:last-child {background: var(--linear), center / cover no-repeat url('../../images/home-slider/3.jpg'); }
  }
}

</style>

<style lang="postcss">
.swiper-pagination-fraction, .swiper-pagination-custom, .swiper-horizontal > .swiper-pagination-bullets, .swiper-pagination-bullets.swiper-pagination-horizontal {
  @apply w-auto mb-10 right-1/4 left-auto;
}
.swiper-pagination-bullet {@apply w-4 h-4 border-2 border-brown bg-transparent;}
.swiper-pagination-bullet-active {@apply bg-brown;}
</style>
