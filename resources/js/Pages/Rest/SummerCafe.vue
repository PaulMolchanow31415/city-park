<script setup>

import { useBreadcrumbs } from '@/Composables/index.js'
import Breadcrumbs from '@/Components/Breadcrumbs.vue'
import { Head, Link } from '@inertiajs/vue3'
import TitleUnderlined from '@/Components/TitleUnderlined.vue'
import ThumbedSlider from '@/Components/ThumbedSlider.vue';
import PanoramaLink from '@/Components/PanoramaLink.vue';
import MenuSection from '@/Components/MenuSection.vue';

const breadcrumbs = useBreadcrumbs()
const pageTitle = breadcrumbs.value[breadcrumbs.value.length - 1].title

defineProps({ menuItems: Object })
</script>

<template>
  <Head :title="pageTitle"/>

  <div class="container mt-20">
    <Breadcrumbs :breadcrumbs="breadcrumbs"/>
    <TitleUnderlined as="h2" class="mt-5 mb-10 ml-5">{{ pageTitle }}</TitleUnderlined>
    <div class="flex gap-10">
      <ThumbedSlider class="w-1/2" :slides="[
         {src: 'https://cityparkvip.ru/static/media/cafe_2.337b105e.jpg', alt: '1'},
                {src: 'https://cityparkvip.ru/static/media/photo1.8978bd41.jpg', alt: '2'},
                {src: 'https://cityparkvip.ru/static/media/photo2.31d496d5.jpg', alt: '3'},
                {src: 'https://cityparkvip.ru/static/media/image1.45a3a304.jpg', alt: '4'},
                {src: 'https://cityparkvip.ru/static/media/image3.856ba718.jpg', alt: '4'},
                {src: 'https://cityparkvip.ru/static/media/image4.44f519ce.jpg', alt: '4'},
                {src: 'https://cityparkvip.ru/static/media/image6.de4b7339.jpg', alt: '4'},
              ]"
      />

      <div class="with-content">
        <h6>Уютное летнее кафе, где вы всегда можете укрыться от городского зноя в прохладной тени или уединиться в застекленной охлаждаемой террасе.</h6>
        <p>В летнем кафе City Park вы насладитесь восхитительными блюдами европейской и японской кухни от первоклассных поваров, а также приятными прохладительными напитками из широкого ассортимента бара. Через большие окна террасы в холодное время года вы можете наслаждаться великолепным пейзажем городского парка.</p>
        <p>На всей территории РГК City Park доступен бесплатный Wi-fi</p>
        <p>Забронировать столик или заказать доставку еды по Белореченску вы можете по телефону
          <a class="underline font-bold" href="tel:79183119791">+7-918-311-97-91</a> или на
          <Link class="underline font-bold" :href="route('rest.index')">
            сайте РГК City Park www.cityparkvip.ru в разделе "Меню"
          </Link>
        </p>
        <div class="flex mt-10 gap-5">
          <Link class="btn-1" :href="route('rest.restaurant')">Перейти к ресторану</Link>
          <PanoramaLink class="bg-lime text-dark hover:bg-dark hover:text-white"
                        src="https://cityparkvip.ru/tour/kafe.html"
          />
        </div>
      </div>
    </div>

  </div>

  <MenuSection class="mt-28" :items="menuItems.data"/>

</template>
