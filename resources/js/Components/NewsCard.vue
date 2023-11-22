<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    data: {
        type: Object,
        required: true,
    },
    to: {
        type: String,
        default: 'home',
    },
});

function formatDate(date) {
    const day = String(date.getDate()).padStart(2, '0');
    const month = String(date.getMonth() + 1).padStart(2, '0');
    const year = String(date.getFullYear()).slice(2);
    return `${day}.${month}.${year}`;
}
</script>

<template>
    <Link
        class="block relative w-full bg-white border border-border transition hover:bg-slate-100"
        :href="route(to)">
        <div class="flex items-center">
            <div class="w-20 h-20 animate-pulse">
                <img v-if="data.src"
                     :src="data.src"
                     :alt="data.title"
                     class="w-full h-full">
                <div v-else class="w-full h-full bg-border"></div>
            </div>
            <div class="px-1.5">
                <p class="font-serif text-base text-maroon line-clamp-1 overflow-ellipsis">{{ data.title }}</p>
                <span class="text-xs line-clamp-2 overflow-ellipsis">{{ data.content }}</span>
            </div>
            <span class="absolute top-1.5 right-1.5 text-xs text-brown">{{ formatDate(data.datetime) }}</span>
        </div>
    </Link>
</template>

<style scoped lang="postcss">

</style>
