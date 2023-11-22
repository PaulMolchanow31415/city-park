<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <Link :href="route('home')" class="block">
        <img class="w-full object-cover" src="../../images/logo.png" alt="City Park">
    </Link>
</template>
