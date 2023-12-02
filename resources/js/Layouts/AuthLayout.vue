<script setup>

import AppLogo from '@/Components/AppLogo.vue';
</script>

<template>
  <div class="flex justify-center items-center w-full min-h-screen">
    <div class="max-w-2xl flex flex-col items-center gap-10 w-1/2">
      <AppLogo class="max-w-[9.375rem]" />
      <slot />
    </div>
  </div>
</template>

<style scoped lang="postcss">

</style>