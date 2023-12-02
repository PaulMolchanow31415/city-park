<script setup>
import { Link } from '@inertiajs/vue3';
import { computed, inject } from 'vue';

const props = defineProps({
  data: {
    type: Object,
    required: true,
  },
  size: {
    type: String,
    default: 'sm',
  },
});

const formatDate = inject('formatDate')

const imageClasses = computed(() => {
    return {
      'md': 'w-64 h-64',
      'lg': 'w-full',
      'sm': 'w-20 h-20'
    }[props.size]
})

</script>

<template>
    <Link class="block relative w-full bg-white border border-border transition hover:bg-slate-100"
          :href="route('rest.news.show', {id: data.id})"
          :title="data.title"
    >
        <div class="flex" :class="{'flex-col': size === 'lg', 'items-center': size === 'sm' }">
            <div class="aspect-square" :class="imageClasses">
                <img v-if="data.photo_path"
                     :src="'/storage/' + data.photo_path"
                     :alt="data.title"
                     class="w-full h-full object-cover aspect-square">
                <div v-else class="w-full h-full bg-border animate-pulse"></div>
            </div>
            <div class="flex justify-between gap-5" :class="{ 'p-5': size !== 'sm', 'items-center': size !== 'md' }">
                <div :class="{'px-1.5': size === 'sm'}">
                    <p class="font-serif text-maroon line-clamp-1 overflow-ellipsis"
                       :class="{ 'text-base': size === 'sm', 'text-2xl mb-2.5': size !== 'sm' }"
                    >{{ data.title }}</p>
                    <span class="overflow-ellipsis leading-tight line-clamp-2"
                          :class="{'text-xs': size === 'sm', 'line-clamp-3': size === 'md'}">
                        {{ data.content }}
                    </span>
                </div>
                <font-awesome-icon v-if="size === 'lg'"
                                   :icon="['fas', 'arrow-right']"
                                   size="xl"
                                   class="text-maroon" />
            </div>

            <span v-if="size === 'sm'" class="absolute top-1.5 right-1.5 text-xs text-brown">
                {{ formatDate(new Date(data.datetime)) }}
            </span>
        </div>
    </Link>
</template>

<style scoped lang="postcss">

</style>
