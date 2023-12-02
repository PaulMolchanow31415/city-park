<script setup>
import { computed } from 'vue';

const props = defineProps({
  theme: {
    type: String,
    default: 'green',
  },
})

const classes = computed(() => {
  return {
    'green': 'bg-green-100 text-green-800 border-green-400',
    'purple': 'bg-purple-100 text-purple-800 border-purple-400',
    'gray': 'bg-gray-100 text-gray-800 border-gray-400',
  }[props.theme]
})
</script>

<template>
  <span class="text-xs font-medium px-2.5 py-0.5 rounded border" :class="classes">
    <slot/>
  </span>
</template>

<style scoped lang="postcss">

</style>