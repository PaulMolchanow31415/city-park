<script>
import { defineComponent } from 'vue';
import InfoAlert from '@/Components/InfoAlert.vue';
import InfoBox from '@/Components/InfoBox.vue';
import { Head, Link } from '@inertiajs/vue3';
import TitleUnderlined from '@/Components/TitleUnderlined.vue';
import Breadcrumbs from '@/Components/Breadcrumbs.vue';
import { useBreadcrumbs } from '@/Composables/index.js';

export default defineComponent({
  name: 'MenuLayout',
  components: { Breadcrumbs, Head, TitleUnderlined, Link, InfoAlert, InfoBox },
  props: { categories: Object },
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
                          rounded-lg drop-shadow-lg bg-white"
      >
        <Link v-for="category in categories"
              :href="route('rest.menu.show-by-category', {name: category})"
              :key="category"
              class="link"
              :class="{'active': route().current('rest.menu.show-by-category', {name: category})}"
        >
          <hr class="line"/>
          {{ category }} <!--<span v-if="category.name === null">({{ category.time }})</span>-->
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
  &.active {
    @apply bg-brown text-white;
    .line {@apply w-5;}
  }
}
</style>