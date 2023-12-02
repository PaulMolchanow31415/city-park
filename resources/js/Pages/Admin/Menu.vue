<script setup>
import BaseLayout from '@/Layouts/BaseLayout.vue';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { inject, ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import AddButton from '@/Components/AddButton.vue';
import AdminCard from '@/Components/AdminCard.vue';
import Modal from '@/Components/Modal.vue';
import AdminBadge from '@/Components/AdminBadge.vue';
import AppInput from '@/Components/AppInput.vue';
import FileInput from '@/Components/FileInput.vue';

defineOptions({ layout: [BaseLayout, AdminLayout] })
const props = defineProps({ menuItems: Array })
const showEditorModal = ref(false)
const deleteConfirmationModalOpen = ref(false)
const formatDate = inject('formatDate')
let form = useForm({
  id: null,
  isOnlineSaleAvailable: false,
  name: null,
  description: null,
  price: null,
  weight: null,
  category: null,
  image: null,
})

function handleDelete() {
  form.delete(route('admin.menu.destroy', { id: form.id }), {
    onSuccess: () => deleteConfirmationModalOpen.value = false,
  })
}

function handleSave() {
  form.post(route('admin.menu.store'), {
    onSuccess: () => showEditorModal.value = false,
  })
}

function handleOpenAddEditor() {
  form = useForm({
    id: null,
    isOnlineSaleAvailable: false,
    name: null,
    description: null,
    price: null,
    weight: null,
    category: null,
    image: null,
  })
  showEditorModal.value = true
}

function handleOpenEditor(selected) {
  form = useForm({
    id: selected.id,
    isOnlineSaleAvailable: selected.isOnlineSaleAvailable,
    name: selected.name,
    description: selected.description,
    price: selected.price,
    weight: selected.weight,
    category: selected.category,
    image: selected.image,
  })
  showEditorModal.value = true
}

function handleOpenDeleteModal(selected) {
  form = useForm({
    id: selected.id,
    name: selected.name,
  })
  deleteConfirmationModalOpen.value = true
}
</script>

<template>
<AddButton class="w-min ml-auto" @add="handleOpenAddEditor"/>

<div class="flex flex-col gap-2.5 mt-2.5">
  <AdminCard v-for="item in menuItems"
             :key="item.id"
             :data="item"
             @edit="handleOpenEditor(item)"
             @delete="handleOpenDeleteModal(item)"
  >
    <template #image>
      <img :src="'/storage/' + item.src" :alt="item.name" class="w-full h-full object-cover">
    </template>
    <template #content>
      <div class="flex items-center gap-10">
        <div class="flex flex-col pl-2.5 py-1.5">
          <div class="flex items-center gap-2.5 mb-1.5">
            <p class="font-serif text-maroon line-clamp-1">
              {{ item.name }}
            </p>
            <AdminBadge :theme="item.isOnlineSaleAvailable ? 'green' : 'purple'">
               {{ item.isOnlineSaleAvailable ? 'Онлайн продажа доступна' : 'Онлайн продажа не доступна' }}
            </AdminBadge>
          </div>
          <span class="line-clamp-1 leading-tight text-[.7rem] overflow-ellipsis max-w-sm mb-2"
                :title="item.description"
          >
            {{ item.description }}
          </span>
          <div class="flex gap-1.5 mb-1.5 text-[.6rem] leading-none">
            <span class="text-maroon">Вес: {{ item.weight }}гр</span>
            <span>Категория: {{ item.category }}</span>
          </div>
          <p class="text-[.6rem] leading-none text-brown">Цена: {{ item.price }}₽</p>
        </div>
      </div>
    </template>
  </AdminCard>
</div>

<Modal :show="showEditorModal" @close="showEditorModal = false" :closeable="true">

  <form @submit.prevent="handleSave" class="p-5 flex flex-col gap-5">
    <div>
      <div class="flex justify-between items-end mb-2.5">
        <h6 class="text-maroon text-2xl">Редактирование продукта</h6>
        <button @click="showEditorModal = false" class="p-3 text-border transition hover:text-dark" type="button">
          <font-awesome-icon :icon="['fas', 'xmark']" size="xl"/>
        </button>
      </div>
      <hr class="mx-5 border-border">
    </div>

    <label class="inline-flex items-center">
        <input v-model="form.isOnlineSaleAvailable" checked type="checkbox" class="form-checkbox rounded-sm">
        <span class="ml-2">Доступен для онлайн продажи</span>
    </label>
    <AppInput label="Название" v-model="form.name"/>
    <label>
      <span class="app-label">Описание</span>
      <textarea v-model="form.description" class="app-textarea" placeholder="Описание"></textarea>
    </label>
    <label>
       <span class="app-label">Цена в рублях</span>
       <input v-model="form.price"
              type="number"
              class="app-input"
              min="10" step="10"
              @keydown.shift.up="form.price += 100"
              @keydown.shift.down="form.price -= 100"
       >
    </label>
    <label>
       <span class="app-label">Вес в граммах</span>
       <input v-model="form.weight"
              type="number"
              class="app-input"
              step="10" min="10"
              @keydown.shift.up="form.weight += 100"
              @keydown.shift.down="form.weight -= 100"
       >
    </label>
    <AppInput label="Категория" v-model="form.category"/>
    <FileInput @change="form.image = $event.target.files[0]"/>

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
  <button @click="showEditorModal = false" class="ml-auto block p-3 text-border transition hover:text-dark"
          type="button"
  >
    <font-awesome-icon :icon="['fas', 'xmark']" size="xl"/>
  </button>
  <div class="p-5 flex flex-col gap-5 items-center">
    <p class="font-serif font-medium mt-10 mb-5">
      Вы точно хотите удалить "<span class="text-blue-600">{{ form.name }}</span>"?<br>
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
</Modal>
</template>

<style scoped lang="postcss">

</style>