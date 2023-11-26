<script setup>

import { useBreadcrumbs } from '@/composables/index.js'
import Breadcrumbs from '@/Components/Breadcrumbs.vue'
import { Head, Link } from '@inertiajs/vue3'
import TitleUnderlined from '@/Components/TitleUnderlined.vue'
import BaseLayout from '@/Layouts/BaseLayout.vue';
import RestLayout from '@/Layouts/RestLayout.vue';
import ThumbedSlider from '@/Components/ThumbedSlider.vue';
import PanoramaLink from '@/Components/PanoramaLink.vue';

const breadcrumbs = useBreadcrumbs()
const pageTitle = breadcrumbs.value[breadcrumbs.value.length - 1].title

defineOptions({ layout: [BaseLayout, RestLayout] })
</script>

<template>
  <Head :title="pageTitle"/>

  <div class="container mt-20">
    <Breadcrumbs :breadcrumbs="breadcrumbs"/>
    <TitleUnderlined as="h2" class="mt-5 mb-10 ml-5">{{ pageTitle }}</TitleUnderlined>
    <div class="flex gap-10">
      <ThumbedSlider class="w-1/2" :slides="[
                {src: 'https://cityparkvip.ru/static/media/restaurant2.ea9042a6.jpg', alt: '1'},
                {src: 'https://cityparkvip.ru/static/media/image1.6eefcdb3.jpg', alt: '2'},
                {src: 'https://cityparkvip.ru/static/media/image2.3516bf50.jpg', alt: '3'},
                {src: 'https://cityparkvip.ru/static/media/image3.8289c923.jpg', alt: '4'}
              ]"/>

      <div class="with-content">
        <h6>Комфортный зал ресторана с самым современным музыкальным оборудованием.</h6>
        <p>Вы приятно проведете время в компании друзей на уютных диванах под сияющим звездным небом. Здесь в любое
          время суток царит романтическая вечерняя атмосфера City Park.</p>
        <p>В ресторане City Park вы можете провести свадьбу, банкет и корпоратив.</p>
        <p>Наш уютный зал вместимостью 50-60 человек приглашает вас с комфортом отдохнуть и весело прtовести ваш
          праздник. Веселитесь на танцполе, наслаждайтесь отличной европейской и японской кухней и общением с близкими
          людьми в самой располагающей для этого обстановке.</p>
        <p>Настоящая джазовая и классическая музыка, chill-out и танцевальные направления.</p>
        <p>На всей территории РГК City Park доступен бесплатный Wi-fi</p>
        <p>Забронировать столик или заказать доставку еды по Белореченску вы можете по телефону
          <a class="underline font-bold" href="tel:79183119791">+7-918-311-97-91</a> или на
          <Link class="underline font-bold" :href="route('home')">
            сайте РГК City Park www.cityparkvip.ru в разделе "Меню"
          </Link>
        </p>

        <div class="flex mt-10 gap-5">
          <Link class="btn-1" :href="route('rest.cafe')">Перейти к летнему кафе</Link>
          <PanoramaLink src="https://cityparkvip.ru/tour/restaurant.html"/>
        </div>
      </div>
    </div>

  </div>

</template>
