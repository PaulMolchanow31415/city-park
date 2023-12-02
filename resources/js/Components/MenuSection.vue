<script>

import { Link } from '@inertiajs/vue3';
import TitleUnderlined from '@/Components/TitleUnderlined.vue';
import MenuCard from '@/Components/MenuCard.vue';
import { defineComponent } from 'vue';

export default defineComponent({
  components: { Link, TitleUnderlined, MenuCard },
  props: {
    items: {
      type: Array,
      required: true,
    },
  },
  methods: {
    handleAddToCart(item) {
      this.$store.commit('addCartItem', item)
      this.$inertia.visit(route('rest.menu.show-by-category', {name: item.category}))
    },
  },
})
</script>

<template>
  <section class="container">
    <TitleUnderlined class="mb-10" as="h5">Меню ресторана</TitleUnderlined>
    <div class="grid grid-cols-3 gap-5 mb-10">
      <MenuCard v-for="item in items"
                :data="item"
                :key="item.id"
                @add-to-card="handleAddToCart(item)"
                class="flex-grow"
      />
    </div>
    <div class="flex justify-center">
      <Link :href="route('rest.menu.index')" class="btn-1 mx-auto">Наше меню</Link>
    </div>
  </section>
</template>

<style scoped lang="postcss">

</style>
