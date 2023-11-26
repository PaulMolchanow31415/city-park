<script setup>
import { reactive } from 'vue';
import { Link } from '@inertiajs/vue3';

let isHoveredToCta = reactive({ $v: false });
defineProps({
  data: {
    type: Object,
    required: true,
  },
  isAvailable: {
    type: Boolean,
    default: false,
  },
});
</script>

<template>
  <div :data-tooltip="!isAvailable ? 'Данные номера не доступны' : null"
       :class="{'with-tooltip' : !isAvailable}"
       class="border border-border flex flex-col" :title="data.title">
    <div class="hovered relative aspect-[19/14] bg-slate-100 animate-pulse">
      <img v-if="data.src" :src="data.src" :alt="data.title" class="object-cover w-full h-full">
      <div class="hovered__description absolute left-0 top-0 right-0 bottom-0
                        bg-shadow flex items-center justify-center p-4">
        <span class="font-serif text-white font-bold line-clamp-6 overflow-ellipsis">{{ data.title }}</span>
      </div>
    </div>
    <div class="p-4 transition flex flex-col justify-between grow" :class="{'bg-slate-100': isHoveredToCta.$v}">
      <p class="block mb-4 w-3/4 line-clamp-1 overflow-ellipsis">{{ data.description }}</p>
      <div class="flex justify-between items-center gap-4">
        <div class="flex flex-col gap-1">
          <span class="price text-xl">{{ data.pricePerDay }}</span>
          <hr class="h-px border-border w-14">
          <span class="font-medium">в сутки</span>
        </div>
        <!--  <Link :href="route(`hotel/${data.id}`)">-->
        <Link class="p-2.5 block"
              @mouseenter="isHoveredToCta.$v = true"
              @mouseleave="isHoveredToCta.$v = false"
              :href="route(`home`)"
        >
          <font-awesome-icon :icon="['fas', 'eye']" size="lg" class="text-maroon"/>
        </Link>
      </div>
    </div>
  </div>
</template>

<style scoped lang="postcss">

</style>
