<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { Swiper, SwiperSlide } from 'swiper/vue';
import { Autoplay, EffectFade, Pagination } from 'swiper/modules';
import TitleUnderlined from '@/Components/TitleUnderlined.vue';
import NewsCard from '@/Components/NewsCard.vue';
import MenuCard from '@/Components/MenuCard.vue';
import HotelRoomCard from '@/Components/HotelRoomCard.vue';
import MapChapter from '@/Components/MapChapter.vue';
import MenuSection from '@/Components/MenuSection.vue';

const modules = [Pagination, EffectFade, Autoplay];

defineProps({
    amountFreeRooms: {
        type: Number,
        default: 2,
    },
});

</script>

<template>
    <Head title="Главная"/>
    <main>
        <section class="-mt-[90px] slider">
            <Swiper class="cursor-grab active:cursor-grabbing" :pagination="true" :modules="modules" effect="fade"
                    :autoplay="{delay: 5000}">
                <SwiperSlide class="slider__item"/>
                <SwiperSlide class="slider__item"/>
                <SwiperSlide class="slider__item"/>
            </Swiper>
            <div class="absolute left-0 bottom-0 bg-white rounded-tr-lg py-5 pr-5 pl-[2vw] z-10">
                <TitleUnderlined class="mb-10">Новости и мероприятия</TitleUnderlined>
                <div class="flex flex-col gap-2.5 mb-10">
                    <NewsCard :data="{title: 'Hello', content: 'Try new salad', datetime: new Date('12.12.2222')}"/>
                    <NewsCard :data="{title: 'Hello', content: 'Try new salad', datetime: new Date('11.10.1234')}"/>
                    <NewsCard :data="{title: 'Hello', content: 'Try new salad', datetime: new Date('7.10.1234')}"/>
                </div>
                <div class="w-full flex justify-end">
                    <Link :href="route('home')"
                          class="btn">
                        Подробнее
                    </Link>
                </div>
            </div>
        </section>
        <MenuSection class="mt-28" :items="[
            {id: 1, name: 'Вкусный чай', price: 200, weight: '600 г' },
            {id: 2, name: 'Вкусный limon', description: 'cold and sweet', price: 300, weight: '100 г', isOnlineSaleAvailable: true },
            {id: 3, name: 'Вкусный cake',  price: 1550, weight: '200 г' }
        ]" />

        <section class="mt-28 container">
            <div class="flex items-center justify-between gap-7">
                <div class="flex gap-5 px-5 items-center">
                    <span class="font-serif font-normal text-8xl text-maroon leading-tight">{{ amountFreeRooms }}</span>
                    <p class="text-2xl">свободны{{ amountFreeRooms > 1 ? 'x' : 'й' }}
                        номер{{ amountFreeRooms > 1 ? 'а' : '' }}</p>
                </div>
                <TitleUnderlined>Каталог номеров</TitleUnderlined>
            </div>
            <div class="flex gap-5">
                <HotelRoomCard isAvailable :data="{
                    id: 1,
                    title: 'Одноместные номера',
                    description: 'Двухместные номера с двумя односпальными кроватями или с двуспальной кроватью',
                        pricePerDay: '3000-5000'
                }"/>
                <HotelRoomCard :data="{
                    id: 2,
                    title: 'Двухместные номера',
                    description: 'Одноместные номера с двуспальной кроватью.',
                    pricePerDay: '3500'
                }"/>
                <HotelRoomCard isAvailable :data="{
                    id: 3,
                    title: 'VIP-номер',
                    description: 'Двухкомнатный номер (гостиная + спальня) с балконом.',
                    pricePerDay: '6000'
                }"/>
            </div>
        </section>
        <MapChapter class="mt-28"/>
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

.btn { @apply inline-block py-4 px-5 rounded border border-brown transition hover:bg-brown hover:text-white;}
</style>

<style lang="postcss">
.swiper-pagination-fraction, .swiper-pagination-custom, .swiper-horizontal > .swiper-pagination-bullets, .swiper-pagination-bullets.swiper-pagination-horizontal {
    @apply w-auto mb-10 right-1/4 left-auto;
}
.swiper-pagination-bullet {@apply w-4 h-4 border-2 border-brown bg-transparent;}
.swiper-pagination-bullet-active {@apply bg-brown;}
</style>
