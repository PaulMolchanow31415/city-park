<script>
import AppLogo from '@/Components/AppLogo.vue';
import { Link } from '@inertiajs/vue3';
import { Dropdown } from 'v-dropdown';
import { defineComponent } from 'vue';

export default defineComponent({
  components: { AppLogo, Link, Dropdown },
  methods: {},
  computed: {
    user() {
      return this.$page.props.auth.user
    }
  }
})
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
              <Link class="link" :href="route('rest.index')">
                <FontAwesomeIcon size="xs" :icon="['fas', 'utensils']"/>
                Ресторан и летнее кафе
              </Link>
            </template>
            <ol>
              <li><Link class="link__dropdown-item" :href="route('rest.menu.index')">Меню</Link></li>
              <li><Link class="link__dropdown-item" :href="route('rest.restaurant')">Ресторан</Link></li>
              <li><Link class="link__dropdown-item" :href="route('rest.cafe')">Летнее кафе</Link></li>
              <li><Link class="link__dropdown-item" :href="route('rest.news.index')">Новости и мероприятия</Link></li>
              <!--              <li><Link class="link__dropdown-item" :href="route('rest.blog')">Блог шеф-повара</Link></li>-->
            </ol>
          </Dropdown>
        </li>
        <!--        <li>
                  <Dropdown align="center" trigger="hover" :animated="true">
                    <template #trigger>
                      <Link class="link" :href="route('hotel.index')">
                        <FontAwesomeIcon size="xs" :icon="['fas', 'hotel']"/>
                        Отель-люкс
                      </Link>
                    </template>
                    <ol>
                      <li><Link class="link__dropdown-item" :href="route('hotel.catalog')">Каталог номеров</Link></li>
                      <li><a class="link__dropdown-item"
                             href="https://drive.google.com/file/d/15_tvhFIXuKay99wGLIPtsPTycd4iHEfz/view?usp=sharing"
                             target="_blank"> Документация</a></li>
                    </ol>
                  </Dropdown>
                </li>-->
        <li>
          <Link class="link" :href="route('contacts')">
            <FontAwesomeIcon :icon="['fas', 'address-book']"/>Контакты
          </Link>
        </li>
        <template v-if="user">
          <li v-if="user.role === 'admin'">
            <Link class="link" :href="route('admin.index')">
              <FontAwesomeIcon :icon="['fas', 'wand-magic-sparkles']"/>Администрирование
            </Link>
          </li>
          <li>
            <Dropdown align="center" trigger="hover" :animated="true">
              <template #trigger>
                <Link class="link" :href="route('logout')" method="post" as="button" type="button">
                  <FontAwesomeIcon :icon="['fas', 'right-from-bracket']"/>Выйти
                </Link>
              </template>
              <ol>
                <li>
                  <Link class="link__dropdown-item" :href="route('profile.show')">
                    Профиль
                  </Link>
                </li>
              </ol>
            </Dropdown>
          </li>
        </template>
        <Link v-else class="link" :href="route('login')">
          <FontAwesomeIcon size="xs" :icon="['fas', 'right-to-bracket']"/>Войти
        </Link>
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
