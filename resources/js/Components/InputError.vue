<script setup>
defineProps(['message'])
</script>

<template>
<transition
  enter-active-class="transition ease-out duration-100 transform"
  enter-from-class="opacity-0 scale-95"
  enter-to-class="opacity-100 scale-100"
  leave-active-class="transition ease-in duration-75 transform"
  leave-from-class="opacity-100 scale-100"
  leave-to-class="opacity-0 scale-95"
>
  <div v-show="message && message.length > 0" class="text-red-600 text-sm">
    <span>{{ message }}</span>
  </div>
</transition>
</template>

<style scoped lang="postcss">

</style>