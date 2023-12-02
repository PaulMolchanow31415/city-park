<script setup>
import BaseLayout from '@/Layouts/BaseLayout.vue';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { inject, ref } from 'vue';
import { useForm, usePage } from '@inertiajs/vue3';
import AdminCard from '@/Components/AdminCard.vue';
import Modal from '@/Components/Modal.vue';
import AdminBadge from '@/Components/AdminBadge.vue';

defineOptions({ layout: [BaseLayout, AdminLayout] })
const props = defineProps({ users: Array, roles: Array })
const showEditorModal = ref(false)
const deleteConfirmationModalOpen = ref(false)
const formatDate = inject('formatDate')
const formatPhoneNumber = inject('formatPhoneToHref')
const page = usePage()
let form = useForm({
  id: null,
  name: null,
  /*email: null,
  phone: null,*/
  role: null,
})


function handleDelete() {
  form.delete(route('admin.users.destroy', { id: form.id }), {
    onSuccess: () => deleteConfirmationModalOpen.value = false,
  })
}

function handleSave() {
  form.put(route('admin.users.change-role'), {
    onSuccess: () => showEditorModal.value = false,
  })
}

function handleOpenEditor(selected) {
  if (selected.id === page.props.auth.user.id) {
    return
  }
  form = useForm({
    id: selected.id,
    role: selected.role,
  })
  showEditorModal.value = true
}

function handleOpenDeleteModal(selected) {
  if (selected.id === page.props.auth.user.id) {
    return
  } // todo error modal
  form = useForm({
    id: selected.id,
    name: selected.name,
    role: selected.role,
  })
  deleteConfirmationModalOpen.value = true
}

</script>

<template>

<div class="flex flex-col gap-2.5 mt-2.5">
  <AdminCard v-for="user in users"
             :key="user.id"
             :data="user"
             @edit="handleOpenEditor(user)"
             @delete="handleOpenDeleteModal(user)"
             :enable-poster="false"
  >
    <template #content>
      <div class="flex items-center gap-10">
        <div class="flex flex-col pl-2.5 py-1.5">
          <div class="flex items-center gap-1.5 mb-1.5">
            <p class="font-serif text-maroon line-clamp-1">
              {{ user.name }}
            </p>
            <AdminBadge :theme="user.role === 'admin' ? 'green' : 'purple'">
               {{ user.role }}
            </AdminBadge>
          </div>
          <span class="line-clamp-2 leading-tight text-xs mb-2 max-w-sm">
            {{ user.email }}
          </span>
          <a :href="formatPhoneNumber(user.phone)" class="text-[.6rem] leading-none text-brown">{{ user.phone }}</a>
        </div>
      </div>
    </template>
  </AdminCard>
</div>

<Modal :show="showEditorModal" @close="showEditorModal = false" :closeable="true" max-width="sm">

  <form @submit.prevent="handleSave" class="p-5 flex flex-col gap-5">
    <div>
      <div class="flex justify-between items-end mb-2.5">
        <h6 class="text-maroon text-2xl">Редактирование роли</h6>
        <button @click="showEditorModal = false" class="p-3 text-border transition hover:text-dark" type="button">
          <font-awesome-icon :icon="['fas', 'xmark']" size="xl"/>
        </button>
      </div>
      <hr class="mx-5 border-border">
    </div>

    <select class="form-select border-gray-300 text-gray-900 text-sm rounded" v-model="form.role">
      <option v-for="option in roles"
              :value="option"
      >
        {{ option === 'user' ? 'Пользователь' : 'Администратор' }}
      </option>
    </select>

    <div class="flex justify-center items-center gap-2.5 mt-5">
      <button @click="showEditorModal = false" type="button" class="btn-2 bg-brown">
        <font-awesome-icon :icon="['fas', 'circle-xmark']" size="lg"/>Отмена
      </button>
      <button type="submit" class="btn-3 italic">
        <font-awesome-icon :icon="['fas', 'circle-check']" size="lg"/>Сохранить
      </button>
    </div>
  </form>
</Modal>

<Modal :show="deleteConfirmationModalOpen" :closeable="true" max-width="sm">
  <div>
    <button @click="deleteConfirmationModalOpen = false" class="ml-auto block p-3 text-border transition hover:text-dark"
            type="button"
    >
      <font-awesome-icon :icon="['fas', 'xmark']" size="xl"/>
    </button>
    <div class="p-5 flex flex-col gap-5 items-center">
      <p class="font-serif font-medium my-32">
        Вы точно хотите удалить пользователя "<span class="text-blue-600">{{ form.name }}</span>"?<br>
        Отменить это действие невозможно
      </p>
      <div class="flex items-center justify-center gap-2.5">
        <button class="btn-1" @click="deleteConfirmationModalOpen = false">Закрыть</button>

        <button type="button" class="btn-3 bg-maroon text-white italic"
                :disabled="form.processing"
                @click="handleDelete"
        >
          <font-awesome-icon :icon="['fas', 'circle-check']" size="lg"/>Удалить
        </button>
      </div>
    </div>
  </div>
</Modal>
</template>

<style scoped lang="postcss">

</style>