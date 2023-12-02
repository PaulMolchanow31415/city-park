<script setup>
import { useClickOutside, useEventListener } from '@/Composables/index.js';
import { inject, ref } from 'vue';

const locations = ref([])
const showHint = ref(null)
const componentBody = ref(null)
const autocompleteApiKey = inject('autocompleteApiKey')
const emit = defineEmits(['update:modelValue'])
const props = defineProps({ modelValue: String, placeholder: String })

const handleInput = (event) => {
  const { value } = event.target
  axios.get(`https://suggest-maps.yandex.ru/v1/suggest?apikey=${autocompleteApiKey}&text=${value}`, {
    headers: [{ 'Access-Control-Allow-Origin': '*' }],
  })
  .then(res => {
    const { results } = res.data
    locations.value = results.map(item => item.title.text)
    showHint.value = true
    emit('update:modelValue', value)
  })
}

useEventListener('scroll', () => {
  showHint.value = false
});

useClickOutside(componentBody, () => {
  showHint.value = false
});
</script>

<template>
<div ref="componentBody" class="flex flex-col gap-2 relative">
  <input @input="handleInput"
         :value="modelValue"
         :placeholder="placeholder"
         class="app-input"
  >
  <ul v-if="locations.length > 0 && showHint"
      class="flex flex-col p-1 bg-white rounded-lg drop-shadow
             absolute top-full transform translate-y-2 left-0 w-full"
  >
    <li v-for="(loc, index) in locations" :key="index">
      <button @click="emit('update:modelValue', loc)" role="option" type="button"
              class="text-left block w-full px-5 py-2.5 rounded transition hover:bg-slate-100"
      >
        {{ loc }}
      </button>
    </li>
  </ul>
</div>
</template>
