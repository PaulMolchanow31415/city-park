<script setup>
import { inject } from 'vue';

const id = inject('idGeneration')

defineProps({
  multiple: {
    type: Boolean,
    default: false,
  },
  label: {
    type: String,
    default: 'Добавить изображение',
  },
})

defineEmits(['change'])
</script>

<template>
<!--mb-1 inline-block text-gray-900 dark:text-white-->
  <label>
    <span class="app-label">{{ label }}</span>
    <input class="relative m-0 block w-full min-w-0 flex-auto cursor-pointer
                rounded border border-gray-300 bg-clip-padding py-2.5 px-3
                text-xs font-normal text-gray-900 transition duration-300 ease-in-out file:-mx-3
                file:-my-3 file:cursor-pointer file:overflow-hidden file:rounded-none file:border-0
                file:border-solid file:border-inherit file:bg-gray-100 file:px-3 file:py-2.5
                file:text-gray-900 file:transition file:duration-150 file:ease-in-out
                file:[border-inline-end-width:1px] file:[margin-inline-end:0.75rem]
                hover:file:bg-gray-200 focus:border-primary focus:text-neutral-700 focus:shadow-te-primary
                focus:outline-none"
           type="file"
           :multiple="multiple"
           @change="$emit('change', $event)"
    >
  </label>

</template>
