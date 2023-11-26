<script setup>
import NewsCard from '@/Components/NewsCard.vue';
import TitleUnderlined from '@/Components/TitleUnderlined.vue';
import Breadcrumbs from '@/Components/Breadcrumbs.vue';
import { Head, Link } from '@inertiajs/vue3';
import { useBreadcrumbs } from '@/composables/index.js';

const breadcrumbs = useBreadcrumbs()
const pageTitle = breadcrumbs.value[breadcrumbs.value.length - 1].title
</script>

<template>
    <Head :title="pageTitle"/>

    <div class="container mt-20">
        <Breadcrumbs :breadcrumbs="breadcrumbs"/>
        <TitleUnderlined as="h2" class="mt-5 mb-10 ml-5">{{ pageTitle }}</TitleUnderlined>
        <div class="flex gap-5">
            <div class="flex gap-5 flex-col flex-grow basis-5/12">
                <NewsCard size="lg"
                          :to="route('rest.news.show', {id: 1})"
                          :data="{title: 'Спецпредложение в октябре', content: 'Try new salad', datetime: new Date('7.10.1234')}"/>
                <NewsCard size="md"
                          :data="{title: 'Hello', content: 'Try new salad', datetime: new Date('7.10.1234')}"/>
            </div>
            <div class="flex gap-5 flex-col flex-grow basis-7/12">
                <NewsCard size="md"
                          :data="{title: 'Hello', content: 'Попробуйте наши новые салаты', datetime: new Date('7.10.1234')}"/>
                <NewsCard size="md"
                          :data="{title: 'Hello', content: 'Try new salad', datetime: new Date('7.10.1234')}"/>
                <NewsCard size="md"
                          :data="{title: 'Hello', content: 'Try new salad', datetime: new Date('7.10.1234')}"/>
            </div>
        </div>
        <div class="flex justify-center mt-10">
            <!-- .all -->
            <Link :href="route('rest.news')" class="btn-2 px-10 text-dark bg-white border-dark hover:bg-dark hover:text-white">
                <font-awesome-icon :icon="['fas', 'arrow-down']" size="sm"/>Ещё
            </Link>
        </div>
    </div>
</template>

<style scoped lang="postcss">

</style>