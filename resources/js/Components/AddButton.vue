<script setup>
defineEmits(['add'])
</script>

<template>
  <button class="btn-3" type="button" @click="$emit('add')">
    <font-awesome-icon :icon="['fas', 'plus']" size="lg" />Добавить
  </button>
</template>

<style scoped lang="postcss">

</style>