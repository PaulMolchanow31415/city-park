<script setup>
import AppLogo from "@/Components/AppLogo.vue";
</script>

<template>
    <Head title="Главная" />
    <header class="px-1 md:px-3">
        <nav class="container mx-auto flex items-center justify-between gap-4">
            <AppLogo class="w-20 pb-5" />
            <ul class="flex gap-5">
                <li>
                    <Link class="link" :href="route('home')">
                        <font-awesome-icon size="xs" :icon="['fas', 'house']" />
                        Главная
                    </Link>
                </li>
                <li>
                    <Link class="link" :href="route('welcome')">
                        <font-awesome-icon
                            size="xs"
                            :icon="['fas', 'utensils']"
                        />
                        Ресторан и летнее кафе
                    </Link>
                </li>
                <li>
                    <Link class="link" :href="route('dashboard')">
                        <font-awesome-icon size="xs" :icon="['fas', 'hotel']" />
                        Отель-люкс
                    </Link>
                </li>
                <li>
                    <Link class="link" :href="route('home')">
                        <font-awesome-icon :icon="['fas', 'address-book']" />
                        Контакты
                    </Link>
                </li>
                <li>
                    <Link class="link" :href="route('login')">
                        <font-awesome-icon
                            size="xs"
                            :icon="['fas', 'right-to-bracket']"
                        />
                        Войти
                    </Link>
                </li>
            </ul>
        </nav>
    </header>
    <div class="slider"></div>
    <h1 class="text-center mt-32 text-xl">Вкусные щи</h1>
</template>

<style scoped lang="scss">
.link {
    @apply flex gap-1.5 px-5 py-3 relative items-center;
    &::after {
        @apply absolute block bottom-3 left-5 w-0 h-px content-[''] opacity-0 transition-all ease-in-out;
        background: var(--secondary-dark-color);
    }
    &:hover {
        color: var(--secondary-dark-color);
        &::after {
            @apply w-10 opacity-100;
        }
    }
}
</style>
