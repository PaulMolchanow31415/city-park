<script>
import { defineComponent } from 'vue';
import { QuillEditor } from '@vueup/vue-quill';
import { Head } from '@inertiajs/vue3';
import Breadcrumbs from '@/Components/Breadcrumbs.vue';
import TitleUnderlined from '@/Components/TitleUnderlined.vue';
import { useBreadcrumbs } from '@/composables/index.js';
import AppInput from '@/Components/AppInput.vue';
import PhoneInput from '@/Components/PhoneInput.vue';
// https://vueup.github.io/vue-quill/api/#:~:text=QuillEditor%20component%20globally-,Usage%3A,-js

export default defineComponent({
  components: { PhoneInput, AppInput, TitleUnderlined, Breadcrumbs, QuillEditor, Head },
  data() {
    return {
      message: '',
      name: '',
      email: '',
      theme: '',
    }
  },
  toolbar: [
    ['bold', 'italic', 'underline', 'link', 'clean'],
    [{ 'header': 1 }],
    [{ 'list': 'ordered' }],
    [{ 'indent': '-1' }, { 'indent': '+1' }],
    [{ 'size': ['small', false, 'large'] }],
    // [{ 'font': ['sans', 'serif'] }],
    ['image'],
  ],
  setup() {
    const breadcrumbs = useBreadcrumbs()
    const pageTitle = breadcrumbs.value[breadcrumbs.value.length - 1].title
    return { breadcrumbs, pageTitle }
  },
})
</script>

<template>
    <Head :title="pageTitle"/>
    <div class="container mt-10">
        <Breadcrumbs class="text-center" :breadcrumbs="breadcrumbs"/>
        <h6 class="text-center mt-5 mb-10">{{ pageTitle }}</h6>

        <form class="flex flex-col gap-10 items-center"
              @submit.prevent="console.log('form submitting...')">
            <div class="flex flex-col max-w-[400px] gap-5">
                <AppInput label="Имя" v-model.trim="name" placeholder="Имя"/>
                <AppInput label="Email" v-model="email" type="email" placeholder="test@mail.com"/>
                <AppInput label="Тема" v-model="theme" placeholder="Тема"/>
                <div class="mt-5">
                    <QuillEditor content-type="html"
                                 v-model:content="message"
                                 :toolbar="$options.toolbar"
                                 placeholder="Текст сообщения"
                    />
                </div>
            </div>
            <button class="btn-3" type="submit">
                <font-awesome-icon :icon="['fas', 'paper-plane']"/>
                Отправить
            </button>
        </form>
    </div>

</template>

<style lang="postcss">
.ql-editor {@apply font-sans;}
.ql-editor.ql-blank::before {font-style: normal; }
.ql-toolbar {@apply rounded-t-xl;}
.ql-container {@apply rounded-b-lg;}
.ql-snow .ql-stroke {@apply stroke-maroon;}
.ql-snow .ql-picker {@apply text-maroon;}
.ql-snow .ql-fill, .ql-snow .ql-stroke.ql-fill {@apply fill-maroon;}
.ql-picker-options {@apply rounded-b-lg; }
.ql-toolbar.ql-snow + .ql-container.ql-snow {@apply bg-gray-50;}
.ql-snow.ql-toolbar button:hover, .ql-snow .ql-toolbar button:hover, .ql-snow.ql-toolbar button:focus, .ql-snow .ql-toolbar button:focus, .ql-snow.ql-toolbar .ql-picker-label:hover, .ql-snow .ql-toolbar .ql-picker-label:hover, .ql-snow.ql-toolbar .ql-picker-item:hover, .ql-snow .ql-toolbar .ql-picker-item:hover {
  @apply rounded ;
}
.ql-snow.ql-toolbar button.ql-active, .ql-snow .ql-toolbar button.ql-active, .ql-snow.ql-toolbar .ql-picker-label.ql-active, .ql-snow .ql-toolbar .ql-picker-label.ql-active, .ql-snow.ql-toolbar .ql-picker-item.ql-selected, .ql-snow .ql-toolbar .ql-picker-item.ql-selected {
  @apply bg-dark fill-white;
}
.ql-snow.ql-toolbar button.ql-active, .ql-snow .ql-toolbar button.ql-active, .ql-snow.ql-toolbar .ql-picker-label.ql-active, .ql-snow .ql-toolbar .ql-picker-label.ql-active, .ql-snow.ql-toolbar .ql-picker-item.ql-selected, .ql-snow .ql-toolbar .ql-picker-item.ql-selected {
  @apply bg-border text-dark;
}
.ql-snow.ql-toolbar button.ql-active .ql-fill, .ql-snow .ql-toolbar button.ql-active .ql-fill, .ql-snow.ql-toolbar .ql-picker-label.ql-active .ql-fill, .ql-snow .ql-toolbar .ql-picker-label.ql-active .ql-fill, .ql-snow.ql-toolbar .ql-picker-item.ql-selected .ql-fill, .ql-snow .ql-toolbar .ql-picker-item.ql-selected .ql-fill, .ql-snow.ql-toolbar button.ql-active .ql-stroke.ql-fill, .ql-snow .ql-toolbar button.ql-active .ql-stroke.ql-fill, .ql-snow.ql-toolbar .ql-picker-label.ql-active .ql-stroke.ql-fill, .ql-snow .ql-toolbar .ql-picker-label.ql-active .ql-stroke.ql-fill, .ql-snow.ql-toolbar .ql-picker-item.ql-selected .ql-stroke.ql-fill, .ql-snow .ql-toolbar .ql-picker-item.ql-selected .ql-stroke.ql-fill {
  @apply fill-dark;
}
.ql-snow.ql-toolbar button.ql-active .ql-stroke, .ql-snow .ql-toolbar button.ql-active .ql-stroke, .ql-snow.ql-toolbar .ql-picker-label.ql-active .ql-stroke, .ql-snow .ql-toolbar .ql-picker-label.ql-active .ql-stroke, .ql-snow.ql-toolbar .ql-picker-item.ql-selected .ql-stroke, .ql-snow .ql-toolbar .ql-picker-item.ql-selected .ql-stroke, .ql-snow.ql-toolbar button.ql-active .ql-stroke-miter, .ql-snow .ql-toolbar button.ql-active .ql-stroke-miter, .ql-snow.ql-toolbar .ql-picker-label.ql-active .ql-stroke-miter, .ql-snow .ql-toolbar .ql-picker-label.ql-active .ql-stroke-miter, .ql-snow.ql-toolbar .ql-picker-item.ql-selected .ql-stroke-miter, .ql-snow .ql-toolbar .ql-picker-item.ql-selected .ql-stroke-miter {
  @apply stroke-dark;
}
a.ql-action, a.ql-remove {
  @apply text-maroon;
}
.ql-tooltip {
  @apply rounded;
}
.ql-snow .ql-picker.ql-size .ql-picker-label::before, .ql-snow .ql-picker.ql-size .ql-picker-item::before {
  content: 'Обычный';
}
.ql-snow .ql-picker.ql-size .ql-picker-item[data-value=small]::before {
  content: 'Мелкий';
}
.ql-snow .ql-picker.ql-size .ql-picker-label[data-value=small]::before, .ql-snow .ql-picker.ql-size .ql-picker-item[data-value=small]::before {
  content: 'Мелкий';
}
.ql-snow .ql-picker.ql-size .ql-picker-item[data-value=large]::before {
  content: 'Крупный';
}
.ql-snow .ql-picker.ql-size .ql-picker-label[data-value=large]::before, .ql-snow .ql-picker.ql-size .ql-picker-item[data-value=large]::before {
  content: 'Крупный';
}
.ql-snow .ql-picker.ql-font .ql-picker-label::before, .ql-snow .ql-picker.ql-font .ql-picker-item::before {
  content: 'Без засечек';
}
.ql-snow .ql-picker.ql-font .ql-picker-item[data-value=serif]::before {
  content: 'С засечками';
}
.ql-snow .ql-tooltip[data-mode=link]::before {
  content: 'Введите ссылку';
}
.ql-snow .ql-tooltip.ql-editing a.ql-action::after {
  content: 'Сохранить';
}
.ql-snow .ql-tooltip::before {
  content: 'Посетить ссылку';
}
.ql-snow .ql-tooltip a.ql-action::after {
  content: 'Редактировать';
}
.ql-snow .ql-tooltip a.ql-remove::before {
  content: 'Удалить';
}
</style>