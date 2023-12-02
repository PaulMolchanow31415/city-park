<script setup>
import { inject, ref } from 'vue';
import BaseLayout from '@/Layouts/BaseLayout.vue';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import AddButton from '@/Components/AddButton.vue';
import Modal from '@/Components/Modal.vue';
import { useForm } from '@inertiajs/vue3';
import AppInput from '@/Components/AppInput.vue';
import DatePicker from '@/Components/DatePicker.vue';
import FileInput from '@/Components/FileInput.vue';
import AdminCard from '@/Components/AdminCard.vue';

defineOptions({ layout: [BaseLayout, AdminLayout] })

const props = defineProps({ news: Array })
const showEditorModal = ref(false)
const deleteConfirmationModalOpen = ref(false)
const formatDate = inject('formatDate')
// const sortBy = inject('sortBy')
// let filteredNews = useSortable(props.news, sortBy)
let form = useForm({
  id: null,
  title: null,
  datetime: null,
  content: null,
  image: null,
})

function handleSave() {
  form.post(route('admin.news.store'), {
    onSuccess: () => {
      showEditorModal.value = false
      form.reset()
    },
  })
}

function handleDelete() {
  form.delete(route('admin.news.destroy', { id: form.id }), {
    onFinish: () => {
      deleteConfirmationModalOpen.value = false
      form.reset()
    },
  })
}

function handleOpenAddEditor() {
  form.reset('id', 'title', 'datetime', 'content', 'image')
  showEditorModal.value = true
}

function handleOpenEditor(selected) {
  form = useForm({
    id: selected.id,
    title: selected.title,
    datetime: selected.datetime,
    content: selected.content,
    image: null,
  })
  showEditorModal.value = true
}

function handleOpenDeleteModal(selected) {
  form = useForm({
    id: selected.id,
    title: selected.title,
    datetime: selected.datetime,
    content: selected.content,
    image: null,
  })
  deleteConfirmationModalOpen.value = true
}

</script>

<template>
<AddButton class="w-min ml-auto" @add="handleOpenAddEditor"/>

<div class="flex flex-col gap-2.5 mt-2.5">
  <AdminCard v-for="item in news"
             :key="item.id"
             :data="item"
             @edit="handleOpenEditor(item)"
             @delete="handleOpenDeleteModal(item)"
  >
    <template #image>
      <img :src="'/storage/' + item.photo_path" :alt="item.title" class="w-full h-full object-cover">
    </template>
    <template #content>
      <div class="flex flex-col">
        <p class="font-serif text-maroon line-clamp-1 mb-1.5">{{ item.title }}</p>
        <span class="line-clamp-2 leading-tight text-xs mb-2 max-w-sm"
              :title="item.content">
          {{ item.content }}
        </span>
        <span class="text-[.6rem] leading-none text-brown">{{ item.datetime }}</span>
      </div>
    </template>
  </AdminCard>
</div>

<Modal :show="showEditorModal" @close="showEditorModal = false" :closeable="true">

  <form @submit.prevent="handleSave" class="p-5 flex flex-col gap-5">
    <div>
      <div class="flex justify-between items-end mb-2.5">
        <h6 class="text-maroon text-2xl">Редактирование новости</h6>
        <button @click="showEditorModal = false" class="p-3 text-border transition hover:text-dark" type="button">
          <font-awesome-icon :icon="['fas', 'xmark']" size="xl"/>
        </button>
      </div>
      <hr class="mx-5 border-border">
    </div>

    <AppInput label="Заголовок" v-model="form.title"/>
    <label>
      <span class="app-label">Контент</span>
      <textarea v-model="form.content" class="app-textarea" placeholder="Контент"></textarea>
    </label>
    <label>
      <span class="app-label">Выбор даты</span>
      <DatePicker ref="picker" v-model="form.datetime"/>
    </label>
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
  <button @click="showEditorModal = false" class="ml-auto block p-3 text-border transition hover:text-dark" type="button">
    <font-awesome-icon :icon="['fas', 'xmark']" size="xl"/>
  </button>
  <div class="p-5 flex flex-col gap-5 items-center">
    <p class="font-serif font-medium mt-10 mb-5">
      Вы точно хотите удалить "<span class="text-blue-600">{{ form.title }}</span>"?<br>
      Отменить это действие невозможно
    </p>
    <div class="flex items-center justify-center gap-2.5">
      <button class="btn-1" @click="deleteConfirmationModalOpen = false">Закрыть</button>

      <button type="button" class="btn-3 bg-maroon text-white italic"
              :disabled="form.processing"
              @click="handleDelete">
        <font-awesome-icon :icon="['fas', 'circle-check']" size="lg"/>Удалить
      </button>
    </div>
  </div>
</Modal>
</template>

<style scoped lang="postcss">

</style>