<script>
import { useEventListener } from '@/composables/index.js';
import { defineComponent, ref } from 'vue';

export default defineComponent({
  name: 'AddressInput',
  inject: ['autocompleteApiKey'],
  data() {
    return {
      value: '',
      locations: ['mos', 'dada', 'add'],
    }
  },
  props: {
    placeholder: String,
  },
  setup() {
    let showHint = ref(null)
    useEventListener('scroll', () => {
      showHint.value = false
    })
    return { showHint }
  },
  watch: {
    value(updated) {
      axios.get(`https://suggest-maps.yandex.ru/v1/suggest?apikey=${this.autocompleteApiKey}&text=${updated}`, {
        headers: [{ 'Access-Control-Allow-Origin': '*' }],
      })
      .then(res => {
        const { results } = res.data
        this.locations = results.reduce((acc, item) => { acc.push(item.title.text); return acc}, [])
        this.showHint = true
      })
    },
  },
})
</script>

<template>
<div class="flex flex-col gap-2 relative">
  <input v-model.trim.lazy="value" :placeholder="placeholder" class="app-input">
  <ul v-if="locations.length > 0 && showHint"
      class="flex flex-col p-1 bg-white rounded-lg drop-shadow
             absolute top-full transform translate-y-2 left-0 w-full">
    <li v-for="loc in locations" :key="loc">
      <button @click="value = loc" role="option" type="button"
              class="text-left block w-full px-5 py-2.5 rounded transition hover:bg-slate-100">
        {{ loc }}
      </button>
    </li>
  </ul>
</div>
</template>
