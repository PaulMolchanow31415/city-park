<script setup>
import AppLogo from '@/Components/AppLogo.vue';
</script>

<template>
    <Head title="Главная"/>
    <header class="px-1 md:px-3">
        <nav class="container mx-auto flex items-center justify-between gap-4">
            <AppLogo class="w-20 pb-5"/>
            <ul class="flex gap-5">
                <li>
                    <Link class="link" :href="route('home')">
                        <font-awesome-icon size="xs" :icon="['fas', 'house']"/>
                        Главная
                    </Link>
                </li>
            </ul>
        </nav>
    </header>
    <h1 class="text-center mt-32 text-xl">Вкусные щи</h1>
</template>

<style scoped lang="scss">
.link {
    @apply flex gap-1.5 px-5 py-3 relative items-center;
    &::after {
        @apply absolute block bottom-0 left-0 w-1/6;
        content: '';
        height: 1px;
    }
}
</style>
