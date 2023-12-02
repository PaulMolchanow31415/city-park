<script setup>

import MapChapter from '@/Components/MapChapter.vue';
import TitleUnderlined from '@/Components/TitleUnderlined.vue';
import Breadcrumbs from '@/Components/Breadcrumbs.vue';
import { Head } from '@inertiajs/vue3';
import { useBreadcrumbs } from '@/Composables/index.js';

const breadcrumbs = useBreadcrumbs()
const pageTitle = breadcrumbs.value[breadcrumbs.value.length - 1].title
</script>

<template>
    <Head :title="pageTitle"/>

    <div class="container mt-20">
        <Breadcrumbs :breadcrumbs="breadcrumbs"/>
        <TitleUnderlined as="h2" class="mt-5 mb-10 ml-5">{{ pageTitle }}</TitleUnderlined>
    </div>
    <MapChapter />

</template>