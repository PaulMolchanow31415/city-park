<script setup>
import { useBreadcrumbs } from '@/Composables/index.js';
import TitleUnderlined from '@/Components/TitleUnderlined.vue';
import { Head } from '@inertiajs/vue3';
import Breadcrumbs from '@/Components/Breadcrumbs.vue';
import NewsCard from '@/Components/NewsCard.vue';
import { inject } from 'vue';

defineProps({
  oneNews: Object,
  news: Object,
})

const formatTime = inject('formatTime')
const breadcrumbs = useBreadcrumbs()
</script>

<template>
    <Head :title="oneNews.title"/>

    <div class="container mt-20 mb-16">
        <Breadcrumbs :breadcrumbs="breadcrumbs"/>
        <TitleUnderlined as="h3" class="mt-5 mb-10 ml-5">{{ oneNews.title }}</TitleUnderlined>
        <div class="flex items-end gap-2.5 text-brown mb-5">
            <font-awesome-icon :icon="['fas', 'calendar-days']" size="lg"/>
            <span class="leading-none">{{ formatTime(new Date(oneNews.datetime)) }}</span>
        </div>
        <p class="max-w-prose" v-html="oneNews.content"/>
    </div>

    <div class="container">
        <TitleUnderlined class="mb-10">Последние новости</TitleUnderlined>
        <div class="flex gap-5">
            <NewsCard v-for="item in news.data" :data="item" :key="item.id" size="lg"/>
        </div>
    </div>
</template>

<style scoped lang="postcss">

</style>