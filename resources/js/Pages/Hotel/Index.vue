<script setup>
import { useBreadcrumbs } from '@/Composables/index.js';
import { Head } from '@inertiajs/vue3';
import Breadcrumbs from '@/Components/Breadcrumbs.vue';
import TitleUnderlined from '@/Components/TitleUnderlined.vue';

const breadcrumbs = useBreadcrumbs()
const pageTitle = breadcrumbs.value[breadcrumbs.value.length - 1].title

</script>

<template>
    <Head :title="pageTitle"/>

    <div class="container mt-20">
        <Breadcrumbs :breadcrumbs="breadcrumbs"/>
        <TitleUnderlined as="h2" class="mt-5 mb-10 ml-5">{{ pageTitle }}</TitleUnderlined>
    </div>
    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci aliquam atque, autem doloremque eligendi est, et eveniet illum magnam obcaecati provident quibusdam voluptates voluptatum. Adipisci animi at atque officia vitae?
</template>

<style scoped lang="postcss">

</style>