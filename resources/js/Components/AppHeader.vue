<script setup>
import AppLogo from '@/Components/AppLogo.vue';
import { Link } from '@inertiajs/vue3';
import { Dropdown } from 'v-dropdown';
</script>

<template>
    <header class="px-1 md:px-3 z-50">
        <nav class="container flex items-center justify-between gap-4">
            <AppLogo class="w-20 pb-5"/>

            <ul class="flex gap-5">
                <li>
                    <Link class="link" :href="route('home')">
                        <FontAwesomeIcon size="xs" :icon="['fas', 'house']"/>
                        Главная
                    </Link>
                </li>
                <li>
                    <Dropdown align="center" trigger="hover" :animated="true">
                        <template #trigger>
                            <Link class="link" :href="route('rest')">
                                <FontAwesomeIcon
                                    size="xs"
                                    :icon="['fas', 'utensils']"/>
                                Ресторан и летнее кафе
                            </Link>
                        </template>
                        <!--
                            .menu
                            .restaurant
                            .kafe
                            .news
                            .shefblog
                         -->
                        <ol>
                            <li><Link class="link__dropdown-item" :href="route('rest')">Меню</Link></li>
                            <li><Link class="link__dropdown-item" :href="route('rest')">Ресторан</Link></li>
                            <li><Link class="link__dropdown-item" :href="route('rest')">Летнее кафе</Link></li>
                            <li><Link class="link__dropdown-item" :href="route('rest')">Новости и мероприятия</Link></li>
                            <li><Link class="link__dropdown-item" :href="route('rest')">Блог шеф-повара</Link></li>
                        </ol>
                    </Dropdown>
                </li>
                <li>
                    <Dropdown align="center" trigger="hover" :animated="true">
                        <template #trigger>
                            <Link class="link" :href="route('hotel')">
                                <FontAwesomeIcon size="xs" :icon="['fas', 'hotel']"/>
                                Отель-люкс
                            </Link>
                        </template>
                        <!--
                        .katalog-nomerov
                        .test0
                         -->
                        <ol>
                            <li><Link class="link__dropdown-item" :href="route('hotel')">Каталог номеров</Link></li>
                            <li><Link class="link__dropdown-item" :href="route('hotel')">Документация</Link></li>
                        </ol>
                    </Dropdown>
                </li>
                <li>
                    <Link class="link" :href="route('home')">
                        <FontAwesomeIcon :icon="['fas', 'address-book']"/>
                        Контакты
                    </Link>
                </li>
                <li>
                    <Link class="link" :href="route('login')">
                        <FontAwesomeIcon
                            size="xs"
                            :icon="['fas', 'right-to-bracket']"/>
                        Войти
                    </Link>
                </li>
            </ul>
        </nav>
    </header>
</template>

<style scoped lang="postcss">
.link {
    @apply flex gap-1.5 px-5 py-3 relative items-center;
    &::after {
        @apply absolute block bottom-2.5 left-5 w-0 h-px content-[''] opacity-0 transition-all ease-in-out bg-maroon;
    }
    &:hover {
        color: theme('colors.maroon');
        &::after {
            @apply w-10 opacity-100;
        }
    }
    &__dropdown-item {
        @apply block px-5 py-2 transition;
        &:hover {
            @apply bg-slate-100;
        }
    }
}
</style>
