<script>
import { defineComponent } from 'vue';
import BaseLayout from '@/Layouts/BaseLayout.vue';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Swiper, SwiperSlide } from 'swiper/vue';
import { Dropdown } from 'v-dropdown';
import { Link } from '@inertiajs/vue3';
import PlaceLink from '@/Components/PlaceLink.vue';
import AdminBadge from '@/Components/AdminBadge.vue';

export default defineComponent({
  components: { AdminBadge, PlaceLink, Link, Dropdown, BaseLayout, AdminLayout, Swiper, SwiperSlide },
  layout: [BaseLayout, AdminLayout],
  props: { orders: Array },
  inject: ['formatTime', 'formatPhoneToHref'],
  data() {
    return {
      ordersInfoSelected: Array(this.orders.length).fill(false),
    }
  },
  computed: {
    filteredOrders() {
      return this.orders.toSorted((a, b) => a.isCompleted - b.isCompleted)
    }
  }
})

</script>

<template>

  <div class="flex flex-col gap-10">

    <!--  ORDER ITEM  -->
    <div v-for="(order, orderIndex) in filteredOrders" :key="order.id" class="px-2.5 py-5 border w-min">
      <!--  SHOP ITEM   -->

      <div class="max-w-[700px]">
        <Swiper :slidesPerView="2" :spaceBetween="10" grab-cursor>
          <SwiperSlide v-for="shopItem in order.cart" :key="shopItem.id" class="border select-none">
              <img :src="'/storage/' + shopItem.item.src" :alt="shopItem.item.name"
                   class="aspect-video object-cover mx-auto w-full">
            <div class="relative overflow-x-auto pt-2.5">
              <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                <tbody>
                  <tr>
                    <th>Название:</th>
                    <th>{{ shopItem.item.name }}</th>
                  </tr>
                  <tr>
                    <th>Количество:</th>
                    <th>{{ shopItem.amount }}</th>
                  </tr>
                  <tr>
                    <th>Цена:</th>
                    <th>{{ shopItem.item.price }} ₽</th>
                  </tr>
                  <tr>
                    <th>Общая цена:</th>
                    <th>{{ shopItem.item.price * shopItem.amount }} ₽</th>
                  </tr>
                </tbody>
              </table>
            </div>

          </SwiperSlide>
        </Swiper>
      </div>

      <button @click="ordersInfoSelected[orderIndex] = !ordersInfoSelected[orderIndex]"
              type="button"
              class="text-brown underline leading-none mt-5 mb-2.5 block w-full text-left select-none"
      >
        {{ ordersInfoSelected[orderIndex] ? 'Скрыть данные' : 'Показать личные данные' }}
      </button>

      <transition
        enter-active-class="ease-out duration-300"
        enter-from-class="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        enter-to-class="opacity-100 translate-y-0 sm:scale-100"
        leave-active-class="ease-in duration-200"
        leave-from-class="opacity-100 translate-y-0 sm:scale-100"
        leave-to-class="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
      >
       <div v-show="ordersInfoSelected[orderIndex]" class="relative overflow-x-auto py-2.5">
         <table class="text-sm text-left rtl:text-right text-gray-500 w-full">
           <colgroup>
             <col class="w-1/6">
             <col class="1/2">
           </colgroup>
           <tbody>
             <tr>
               <th>Адрес:</th>
               <th><PlaceLink :place-name="order.address">{{ order.address }}</PlaceLink></th>
             </tr>
             <tr>
               <th>
                 <font-awesome-icon icon="calendar-days" size="sm"/>
                 Время доставки</th>
               <th>{{ formatTime(new Date(order.selectedDate)) }}</th>
             </tr>
             <tr>
               <th>Имя</th>
               <th>{{ order.name }}</th>
             </tr>
             <tr>
               <th>Телефон</th>
               <th><a :href="formatPhoneToHref(order.phone)">{{ order.phone }}</a></th>
             </tr>
             <tr>
               <th>Email</th>
               <th><a :href="'mailto:' + order.email">{{ order.email }}</a></th>
             </tr>
           </tbody>
         </table>
       </div>
      </transition>

      <blockquote v-if="order.wishes && order.wishes.length" class="p-4 my-4 border-s-2 border-brown bg-blue-50">
       <p class="max-w-prose">Пожелания: <q>{{ order.wishes }}</q></p>
      </blockquote>

      <div class="flex justify-center">
        <Dropdown align="center" :animated="true" class="cursor-pointer">
            <template #trigger>
              <AdminBadge class="px-5 py-2.5" :theme="order.isCompleted ? 'green' : 'gray'">
                {{ order.isCompleted ? 'Выполнен' : 'В процессе выполнения' }}
              </AdminBadge>
            </template>
            <ol>
              <li><Link class="block px-5 py-2 transition hover:bg-slate-100 w-full text-left"
                        :href="route('admin.order.complete')"
                        :data="{id: order.id, isCompleted: true}"
                        preserve-scroll
                        method="put"
                        as="button"
              >
                Выполнен
              </Link></li>
              <li><Link class="block px-5 py-2 transition hover:bg-slate-100 w-full text-left"
                        :href="route('admin.order.complete')"
                        :data="{id: order.id, isCompleted: false}"
                        preserve-scroll
                        method="put"
                        as="button"
              >
                В процессе выполнения
              </Link></li>
            </ol>
          </Dropdown>
      </div>
  </div>
</div>
</template>

<style scoped lang="postcss">
tr {
  @apply even:bg-white odd:bg-gray-50;
}
th {
  @apply px-2.5 py-1 font-medium text-gray-900 whitespace-nowrap ;
}
</style>