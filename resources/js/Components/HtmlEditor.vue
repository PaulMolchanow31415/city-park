<script>
import { QuillEditor } from '@vueup/vue-quill';

export default {
  name: 'HtmlEditor',
  components: { QuillEditor },
  props: {
    modelValue: String,
    toolbarTheme: {
      type: String,
      default: 'default',
    },
  },
  emits: ['update:modelValue'],
  toolbar: [
    ['bold', 'italic', 'underline', 'link', 'clean'],
    [{ 'header': 1 }],
    [{ 'list': 'ordered' }],
    [{ 'indent': '-1' }, { 'indent': '+1' }],
    [{ 'size': ['small', false, 'large'] }],
    // [{ 'font': ['sans', 'serif'] }],
    ['image'],
  ],
  created() {
    if (this.toolbarTheme === 'admin') {
      this.$options.toolbar[1] = [
        { 'header': 1 }, { 'header': 2 }, { 'header': 3 }, { 'header': 4 }, { 'header': 5 }, { 'header': 6 },
      ]
    }
  },
}
</script>

<template>
  <QuillEditor content-type="html"
               :content="modelValue"
               :toolbar="$options.toolbar"
               @update:content="$emit('update:modelValue', $event)"
               placeholder="Текст сообщения"
  />
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