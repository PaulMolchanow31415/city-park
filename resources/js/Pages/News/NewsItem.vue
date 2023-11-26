<script setup>
import { useBreadcrumbs } from '@/composables/index.js';
import TitleUnderlined from '@/Components/TitleUnderlined.vue';
import { Head } from '@inertiajs/vue3';
import Breadcrumbs from '@/Components/Breadcrumbs.vue';
import NewsCard from '@/Components/NewsCard.vue';

const props = defineProps({
  oneNews: Object,
  news: Array,
})

// const breadcrumbs = useBreadcrumbs()
// breadcrumbs.push('/', props.oneNews.title)
</script>

<template>
    <Head :title="oneNews.title"/>

    <div class="container mt-20 mb-16">
        <!--        <Breadcrumbs :breadcrumbs="breadcrumbs"/>-->
        <TitleUnderlined as="h3" class="mt-5 mb-10 ml-5">{{ oneNews.title }}</TitleUnderlined>
        <div class="flex items-end gap-2.5 text-brown mb-5">
            <font-awesome-icon :icon="['fas', 'calendar-days']" size="lg"/>
            <span class="leading-none">{{ oneNews.datetime }}</span>
        </div>
        <p v-html="oneNews.content"/>
    </div>

    <div class="container">
        <TitleUnderlined class="mb-10">Последние новости</TitleUnderlined>
        <div class="flex gap-5">
            <!--        <NewsCard v-for="item in news" :data="item" :key="item.id" />-->
            <NewsCard :data="{title: 'Hello', content: 'World!!', datetime: new Date('12.12.2222')}" size="lg"/>
            <NewsCard :data="{title: 'Hello', content: 'World!!', datetime: new Date('12.12.2222')}" size="lg"/>
            <NewsCard :data="{title: 'Hello', content: 'World!!', datetime: new Date('12.12.2222')}" size="lg"/>
        </div>
    </div>
</template>

<style scoped lang="postcss">

</style>