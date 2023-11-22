<script setup>
import AppLogo from '@/Components/AppLogo.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <footer class="py-10 foot">
        <div class="container flex items-center justify-between gap-5">
            <div class="flex flex-col items-center gap-3 text-xs">
                <AppLogo class="w-36"/>
                <ul>
                    <li>ООО «Олимп»</li>
                    <li>ИНН 2309117400</li>
                    <li>ОГРН 1092309002378</li>
                </ul>
            </div>
            <ul class="flex gap-5">
                <li><a class="transition hover:text-maroon" target="_blank" href="https://vk.com/cityparkvip">
                    <font-awesome-icon :icon="['fab', 'vk']" size="3x"/>
                </a></li>
                <li><a class="transition hover:text-maroon" target="_blank" href="https://ok.ru/cityparkvip">
                    <font-awesome-icon :icon="['fab', 'square-odnoklassniki']" size="3x"/>
                </a></li>
                <li><a class="transition hover:text-maroon" target="_blank"
                       href="https://www.instagram.com/cityparkvipru/">
                    <font-awesome-icon :icon="['fab', 'square-instagram']" size="3x"/>
                </a></li>
            </ul>
            <ul class="flex flex-col gap-5">
                <li>
                    <Link class="link" :href="route('home')">Публичная оферта</Link>
                </li>
                <li>
                    <Link class="link" :href="route('home')">Политика конфиденциальности</Link>
                </li>
                <li>
                    <Link class="link" :href="route('home')">Обратная связь</Link>
                </li>
            </ul>
        </div>
    </footer>
</template>

<style scoped lang="postcss">
.foot {background: center / cover no-repeat url('../../images/footer-bg.jpg');}
.link {
    @apply inline-block relative transition-all ease-in-out;
    & + & {margin-top: theme('margin.5');}
    &::after {@apply content-[''] absolute left-0 -bottom-0.5 w-0 h-px bg-maroon transition-all ease-in-out;}
    &:hover {
        @apply text-maroon;
        &::after {@apply w-10;}
    }
}
</style>
