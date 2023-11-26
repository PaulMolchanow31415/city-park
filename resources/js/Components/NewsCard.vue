<script setup>
import { Link } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps({
  data: {
    type: Object,
    required: true,
  },
  to: {
    type: String,
    default: '/',
  },
  size: {
    type: String,
    default: 'sm',
  },
});

function formatDate(date) {
  const day = String(date.getDate()).padStart(2, '0');
  const month = String(date.getMonth() + 1).padStart(2, '0');
  const year = String(date.getFullYear()).slice(2);
  return `${day}.${month}.${year}`;
}

const imageClasses = computed(() => {
    return {
      'md': 'w-60 h-60',
      'lg': 'w-full',
      'sm': 'w-20 h-20'
    }[props.size]
})

</script>

<template>
    <Link class="block relative w-full bg-white border border-border transition hover:bg-slate-100"
          :href="to"
          :title="data.title"
    >
        <div class="flex" :class="{'flex-col': size === 'lg', 'items-center': size === 'sm' }">
            <div class="animate-pulse aspect-square" :class="imageClasses">
                <img v-if="data.src"
                     :src="data.src"
                     :alt="data.title"
                     class="w-full h-full object-cover">
                <div v-else class="w-full h-full bg-border"></div>
            </div>
            <div class="flex justify-between gap-5" :class="{ 'p-5': size !== 'sm', 'items-center': size !== 'md' }">
                <div :class="{'px-1.5': size === 'sm'}">
                    <p class="font-serif text-maroon line-clamp-1 overflow-ellipsis"
                       :class="{ 'text-base': size === 'sm', 'text-2xl mb-2.5': size !== 'sm' }"
                    >{{ data.title }}</p>
                    <span class="line-clamp-2 overflow-ellipsis leading-tight"
                          :class="{'text-xs': size === 'sm'}">
                        {{ data.content }}
                    </span>
                </div>
                <font-awesome-icon v-if="size === 'lg'"
                                   :icon="['fas', 'arrow-right']"
                                   size="xl"
                                   class="text-maroon" />
            </div>

            <span v-if="size === 'sm'" class="absolute top-1.5 right-1.5 text-xs text-brown">
                {{ formatDate(data.datetime) }}
            </span>
        </div>
    </Link>
</template>

<style scoped lang="postcss">

</style>
