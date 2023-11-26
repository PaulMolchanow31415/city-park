<script setup>

import { Link } from '@inertiajs/vue3';
import TitleUnderlined from '@/Components/TitleUnderlined.vue';
import MenuCard from '@/Components/MenuCard.vue';

defineProps({
  items: {
    type: Array,
    required: true,
  },
})
</script>

<template>
  <section class="container">
    <TitleUnderlined class="mb-10" as="h5">Меню ресторана</TitleUnderlined>
    <div class="grid grid-cols-3 gap-5 mb-10">
      <MenuCard v-for="item in items"
                :data="item"
                :is-online-sale-available="item.isOnlineSaleAvailable"
                :key="item.id"
                @add-to-cart="console.log('adding to cart...')"
                class="flex-grow"/>
    </div>
    <div class="flex justify-center">
      <Link :href="route('rest.menu')" class="btn-1 mx-auto">Наше меню</Link>
    </div>
  </section>
</template>

<style scoped lang="postcss">

</style>
