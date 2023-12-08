<script>

import { Link } from '@inertiajs/vue3';
import { defineComponent, provide, ref } from 'vue';

export default defineComponent({
  components: { Link },
  setup() {
    const sorting = ref('')
    provide('sortBy', sorting)
    return { sorting }
  },
  routes: [
    { name: 'Новости', value: 'admin.news' },
    { name: 'Пользователи', value: 'admin.users' },
    { name: 'Меню', value: 'admin.menu.list', },
    { name: 'Заказы', value: 'admin.order.list', },
    { name: 'Входящие сообщения', value: 'admin.feedback.list', },
    /*routes: [
        { name: 'Категории продуктов', value: 'admin.categories' },
      ],*/
    /*{
      name: 'Страницы', value: 'admin.pages', routes: [
        { name: 'Публичная оферта', value: 'admin.pages.public-offer' },
        { name: 'Политика конфиденциальности', value: 'admin.pages.private-policy' },
        { name: 'Ресторан и летнее кафе', value: 'admin.pages.rest' },
        { name: 'Летнее кафе', value: 'admin.pages.cafe' },
        { name: 'Ресторан', value: 'admin.pages.restaurant' },
      ],
    },*/
  ],
})
</script>

<template>
  <div class="container flex gap-10 mt-10">
      <aside class="self-start sticky top-5 left-0 flex flex-col gap-2.5 py-5 px-2.5 max-w-sm basis-1/3
                          rounded-lg drop-shadow-lg bg-white"
      >
        <template v-for="r in $options.routes.filter(item => !('routes' in item))">
          <Link :href="route(r.value)"
                class="link"
                :class="{'selected': route().current(r.value)}"
          >
            <hr class="line"/>
            {{ r.name }}
          </Link>
        </template>
        <template v-for="r in $options.routes.filter(item => 'routes' in item)">
          <Link :href="route(r.value)"
                class="link"
                :class="{'selected': route().current(r.value)}"
          >
            <hr class="line"/>
            {{ r.name }}
          </Link>
          <ul class="flex flex-col gap-1.5 ml-6">
            <li v-for="innerRoute in r.routes" class="list-[circle]">
              <Link :href="route(innerRoute.value)"
                    class="link inside"
                    :class="{'selected': route().current(innerRoute.value)}"
              >
                <hr class="line">
                {{ innerRoute.name }}
              </Link>
            </li>
          </ul>
        </template>
      </aside>
      <div class="flex flex-col gap-5 basis-2/3">
<!--        <input v-model="sorting"
               class="app-input sticky top-5 z-50 drop-shadow-xl"
               type="text"
               placeholder="Сортировка">-->
        <slot/>
      </div>
    </div>
</template>

<style scoped lang="postcss">
.link {
  @apply flex items-center gap-1.5 py-1.5 px-2.5 rounded-md transition duration-200;
  .line {@apply h-px w-0 bg-white transition delay-75 duration-700;}
  &:hover {@apply bg-slate-100;}
  &.selected {
    @apply bg-brown text-white;
    .line {@apply w-5;}
  }
  &.inside {
    @apply pl-0;
  }
}
</style>