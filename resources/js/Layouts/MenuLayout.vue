<script>
import { defineComponent } from 'vue';
import InfoAlert from '@/Components/InfoAlert.vue';
import InfoBox from '@/Components/InfoBox.vue';
import { Head, Link } from '@inertiajs/vue3';
import TitleUnderlined from '@/Components/TitleUnderlined.vue';
import Breadcrumbs from '@/Components/Breadcrumbs.vue';
import { useBreadcrumbs } from '@/composables/index.js';

export default defineComponent({
  name: 'MenuLayout',
  components: { Breadcrumbs, Head, TitleUnderlined, Link, InfoAlert, InfoBox },
  categories: [
    { name: 'Спецпредложение', time: '40min' },
    { name: 'Постное меню', time: '20min' },
    { name: 'Бургеры', time: '10min' },
    { name: 'Завтраки', time: '10min' },
    { name: 'Завтраки', time: '10min' },
    { name: 'Завтраки', time: '10min' },
    { name: 'Бургеры', time: '10min' },
    { name: 'Бургеры', time: '10min' },
    { name: 'Бургеры', time: '10min' },
  ],
  props: { selectedCategory: String },
  setup() {
    const breadcrumbs = useBreadcrumbs()
    const pageTitle = breadcrumbs.value[breadcrumbs.value.length - 1].title
    return { breadcrumbs, pageTitle }
  },
})
</script>

<template>
  <Head :title="pageTitle"/>

  <div class="container my-20">
    <Breadcrumbs :breadcrumbs="breadcrumbs"/>
    <TitleUnderlined as="h6" class="mt-5 mb-10 ml-5">{{ pageTitle }}</TitleUnderlined>
    <div class="flex gap-10">
      <aside class="self-start sticky top-5 left-0 flex flex-col gap-2.5 py-5 px-2.5 max-w-sm basis-1/3
                          rounded-lg drop-shadow-lg bg-white">
        <!-- !!!!! :href="route('name-route')" :active="route().current('name-route')"  -->
        <Link v-for="(category, index) in $options.categories"
              :href="route('rest.menu.show', {id: category.name})"
              :key="index"
              class="link"
              :class="{'active': category.name === selectedCategory}">
          <hr class="line"/>
          {{ category.name }} <span v-if="category.name === selectedCategory">({{ category.time }})</span>
        </Link>
      </aside>
      <div class="basis-2/3 grid grid-cols-2 gap-y-2.5 gap-x-5 self-start">
        <slot/>
      </div>
    </div>
    <div class="w-[66.66%] mx-auto mt-28">
      <h6 class="mb-5 text-maroon text-2xl">
        При заказе на сумму от 500 рублей доставка еды по Белореченску БЕСПЛАТНО.<br/> Заказы принимаются с 10:00 до
        23:00 по телефону: <a href="tel:89183119791">8-918-311-97-91</a>.
      </h6>
      <p class="w-1/2">
        Доставка еды в Белореченске от ресторана City Park.<br/> <a class="underline" href="tel:89183119791">8-918-311-97-91</a>.
        <Link class="underline" :href="route('home')">www.cityparkvip.ru</Link>
      </p>
    </div>
  </div>
</template>

<style scoped lang="postcss">
.link {
  @apply flex items-center gap-1.5 py-1.5 px-2.5 rounded-md transition duration-200;
  .line {@apply h-px w-0 bg-white transition delay-75 duration-700;}
  &:hover {@apply bg-slate-100;}
  .active {
    @apply bg-brown text-white;
    .line {@apply w-5;}
  }
}
</style>