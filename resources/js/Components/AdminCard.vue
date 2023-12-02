<script setup>
defineProps({
  enablePoster: {
    type: Boolean,
    default: true,
  },
})
defineEmits(['edit', 'delete'])
</script>

<template>
  <div class="block relative w-full bg-white border border-border transition hover:bg-slate-100">
    <div class="flex-grow flex justify-between items-center gap-5">
      <div class="flex gap-2.5 items-center">
        <div v-if="enablePoster" class="aspect-square w-24 h-24 relative transition-[all] duration-500 hover:w-32 hover:h-32">
          <div class="w-full h-full bg-border animate-pulse absolute left-0 top-0"></div>
          <slot name="image"/>
        </div>
        <div class="py-1">
          <slot name="content"/>
        </div>
      </div>
      <div class="flex gap-2.5 p-1.5">
        <!--  EDIT  -->
        <button @click="$emit('edit')" class="btn-1 py-3 border-gray-300 text-dark" type="button">
          <font-awesome-icon :icon="['fas', 'pen-to-square']"/>
        </button>
        <!--  DELETE  -->
        <button @click="$emit('delete')" class="btn-2 bg-maroon hover:bg-dark" type="button">
          <font-awesome-icon :icon="['fas', 'trash-can']"/>
        </button>
      </div>
    </div>
  </div>
</template>

<style scoped lang="postcss">

</style>