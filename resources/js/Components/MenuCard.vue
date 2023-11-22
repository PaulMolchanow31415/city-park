<script setup>
import { reactive } from 'vue';

let isHoveredToCta = reactive({ $v: false });

defineProps({
  data: {
    type: Object,
    required: true,
  },
  isOnlineSaleAvailable: {
    type: Boolean,
    default: false,
  },
});

defineEmits(['addToCart']);
</script>

<template>
  <div :data-tooltip="!isOnlineSaleAvailable ? 'Онлайн продажа не доступна' : null"
       :class="{'with-tooltip' : !isOnlineSaleAvailable}"
       class="max-w-[380px] border border-border flex flex-col" :title="data.name">
    <div class="hovered relative w-[380px] h-[240px] bg-slate-100 animate-pulse">
      <img v-if="data.src" :src="data.src" :alt="data.name" class="object-cover w-full h-full max-h-[240px]">
      <div class="hovered__description absolute left-0 top-0 right-0 bottom-0 bg-shadow flex items-center p-4">
        <span class="font-serif text-white font-bold line-clamp-6 overflow-ellipsis">{{ data.description }}</span>
      </div>
    </div>
    <div class="pt-4 px-4 pb-5 transition" :class="{'bg-slate-100': isHoveredToCta.$v}">
      <p class="block mb-4 line-clamp-1 overflow-ellipsis">{{ data.name }}</p>
      <div class="flex justify-between items-center gap-4">
        <div class="flex flex-col gap-1">
          <span class="price text-xl">{{ data.price }} ₽</span>
          <hr class="h-px border-border w-14">
          <span class="font-medium">{{ data.weight }}</span>
        </div>
        <div @mouseenter="isHoveredToCta.$v = true" @mouseleave="isHoveredToCta.$v = false">
          <button v-if="isOnlineSaleAvailable" @click="$emit('addToCart')" class="p-2.5" type="button">
            <font-awesome-icon :icon="['fas', 'cart-plus']" size="lg" class="text-maroon"/>
          </button>
          <a v-else href="tel:89183119791" class="block p-2.5">
            <font-awesome-icon :icon="['fas', 'phone']" size="lg" class="text-maroon"/>
          </a>
        </div>
      </div>
    </div>
  </div>
</template>
