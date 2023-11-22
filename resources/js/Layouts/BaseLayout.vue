<script setup>
import AppHeader from '@/Components/AppHeader.vue';
import AppFooter from '@/Components/AppFooter.vue';
</script>

<template>
    <div class="min-h-screen h-auto flex flex-col ">
        <AppHeader/>
        <div class="flex-grow"><slot/></div>
        <AppFooter class="mt-28"/>
    </div>
</template>

<style scoped lang="postcss">
</style>
