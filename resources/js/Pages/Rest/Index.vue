<script setup>

import { useBreadcrumbs } from '@/Composables/index.js'
import Breadcrumbs from '@/Components/Breadcrumbs.vue'
import { Head, Link } from '@inertiajs/vue3'
import TitleUnderlined from '@/Components/TitleUnderlined.vue'
import ThumbedSlider from '@/Components/ThumbedSlider.vue';
import MenuSection from '@/Components/MenuSection.vue';

const breadcrumbs = useBreadcrumbs()
const pageTitle = breadcrumbs.value[breadcrumbs.value.length - 1].title

defineProps({ menuItems: Object })
/*const content = `
<div>
<h6 class="text-maroon text-xl mb-5">Комфортный зал ресторана с самым современным музыкальным оборудованием.</h6>
<p>Вы приятно проведете время в компании друзей на уютных диванах под сияющим звездным небом. Здесь в любое время суток царит романтическая вечерняя атмосфера City Park.</p>
<p>Настоящая джазовая и классическая музыка, chill-out и танцевальные направления.</p>
<p><a href="">Уютное летнее кафе</a>, где вы всегда можете укрыться от городского зноя в прохладной тени или уединиться в застекленной охлаждаемой террасе.</p>
<p>Насладитесь восхитительными блюдами европейской и японской кухни от первоклассных поваров, а также приятными прохладительными напитками из широкого ассортимента бара. Через большие окна террасы в холодное время года вы можете наслаждаться великолепным пейзажем городского парка.</p>
</div>
`*/
/*<div v-once v-html="content" />*/
</script>

<template>
  <Head :title="pageTitle"/>

  <div class="container mt-20">
    <Breadcrumbs :breadcrumbs="breadcrumbs"/>
    <TitleUnderlined as="h2" class="mt-5 mb-10 ml-5">{{ pageTitle }}</TitleUnderlined>
    <div class="flex gap-10">
      <ThumbedSlider class="w-1/2" :slides="[
                {src: 'https://cityparkvip.ru/static/media/city_park_1.19bc7ff8.jpg', alt: 'alter 1'},
                {src: 'https://cityparkvip.ru/static/media/cafe_2.337b105e.jpg', alt: 'jungle 2'},
                {src: 'https://cityparkvip.ru/static/media/cafe_terrasa.0cb327f9.jpg', alt: 'safari 3'}
              ]"
      />

      <div class="with-content">
        <h6>Комфортный зал ресторана с самым современным музыкальным оборудованием.</h6>
        <p>Вы приятно проведете время в компании друзей на уютных диванах под сияющим звездным небом. Здесь в любое
          время суток царит романтическая вечерняя атмосфера City Park.</p>
        <p>Настоящая джазовая и классическая музыка, chill-out и танцевальные направления.</p>
        <p>
          <Link class="underline font-bold" :href="route('rest.index')">Уютное летнее кафе</Link>
          , где вы всегда можете укрыться от городского зноя в прохладной тени или уединиться в застекленной охлаждаемой
          террасе.
        </p>
        <p>Насладитесь
          <Link class="underline font-bold" :href="route('rest.index')">восхитительными блюдами</Link>
          европейской и японской кухни от первоклассных поваров, а также приятными прохладительными напитками из
          широкого ассортимента бара. Через большие окна террасы в холодное время года вы можете наслаждаться
          великолепным пейзажем городского парка.
        </p>
        <div class="flex mt-10 gap-5">
          <Link class="btn-1" :href="route('rest.cafe')">Посмотреть летнее кафе</Link>
          <Link class="btn-1" :href="route('rest.restaurant')">Перейти к ресторану</Link>
        </div>
      </div>
    </div>

  </div>

  <MenuSection class="mt-28" :items="menuItems.data"/>

</template>
