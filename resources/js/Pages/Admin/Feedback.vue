<script>
import { defineComponent } from 'vue';
import BaseLayout from '@/Layouts/BaseLayout.vue';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import PlaceLink from '@/Components/PlaceLink.vue';
import { Link } from '@inertiajs/vue3';
import AdminBadge from '@/Components/AdminBadge.vue';
import { Dropdown } from 'v-dropdown';

export default defineComponent({
  components: { Dropdown, AdminBadge, Link, PlaceLink, BaseLayout, AdminLayout },
  data() {
    return {
      feedInfoSelected: Array(this.feedbackItems.length).fill(false),
    }
  },
  props: {
    feedbackItems: Array,
  },
  layout: [BaseLayout, AdminLayout],
  computed: {
    filteredFeedbacks() {
      return this.feedbackItems.toSorted((a, b) => a.isRead - b.isRead)
    }
  }
})
</script>

<template>
<div class="flex flex-col gap-10">

  <!-- FEEDBACK ITEM -->
  <div v-for="(item, index) in filteredFeedbacks" :key="item.id" class="px-2.5 py-5 border">
    <div class="relative overflow-x-auto pt-2.5">
      <table class="w-full text-sm text-left rtl:text-right text-gray-500">
         <colgroup>
           <col class="w-1/6">
           <col class="1/2">
         </colgroup>
         <tbody>
           <tr>
             <th>Имя</th>
             <th>{{ item.name }}</th>
           </tr>
           <tr>
             <th>Тема</th>
             <th>{{ item.theme }}</th>
           </tr>
           <tr>
             <th>Email</th>
             <th><a :href="'mailto:' + item.email">{{ item.email }}</a></th>
           </tr>
         </tbody>
      </table>
    </div>

     <button @click="feedInfoSelected[index] = !feedInfoSelected[index]"
             type="button"
             class="text-brown underline leading-none mt-5 mb-2.5 block w-full text-left select-none"
     >
        {{ feedInfoSelected[index] ? 'Скрыть сообщение' : 'Показать текст сообщения' }}
      </button>

      <transition
        enter-active-class="ease-out duration-300"
        enter-from-class="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        enter-to-class="opacity-100 translate-y-0 sm:scale-100"
        leave-active-class="ease-in duration-200"
        leave-from-class="opacity-100 translate-y-0 sm:scale-100"
        leave-to-class="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
      >
       <div v-show="feedInfoSelected[index]" class="relative overflow-x-auto py-2.5">
          <blockquote class="p-4 my-4 border-s-2 border-brown bg-blue-50">
          <div class="max-w-prose blockquote-content" v-html="item.message"></div>
          </blockquote>
       </div>
      </transition>

       <div class="flex justify-center">
        <Dropdown align="center" :animated="true" class="cursor-pointer">
            <template #trigger>
              <AdminBadge class="px-5 py-2.5" :theme="item.isRead ? 'green' : 'gray'">
                {{ item.isRead ? 'Прочитан' : 'Не прочитан' }}
              </AdminBadge>
            </template>
            <ol>
              <li><Link class="block px-5 py-2 transition hover:bg-slate-100 w-full text-left"
                        :href="route('admin.feedback.change-status')"
                        :data="{id: item.id, isRead: true}"
                        preserve-scroll
                        method="put"
                        as="button"
              >
                Прочитан
              </Link></li>
              <li><Link class="block px-5 py-2 transition hover:bg-slate-100 w-full text-left"
                        :href="route('admin.feedback.change-status')"
                        :data="{id: item.id, isRead: false}"
                        preserve-scroll
                        method="put"
                        as="button"
              >
                Не прочитан
              </Link></li>
            </ol>
          </Dropdown>
      </div>
  </div>

</div>
</template>

<style lang="postcss">
.blockquote-content {
  & ul, & ol {
    padding-left: 1rem;
  }
  & li {
    list-style: auto;
  }
  & a {
    color: theme('colors.blue.500');
  }
}
</style>
