<script setup>
defineProps({
  src: {
    type: String,
    required: true,
  },
})
</script>

<template>
  <a target="_blank" :href="src" class="btn-2"> 3D панорама
    <font-awesome-icon :icon="['fas', 'vr-cardboard']" size="lg"/>
  </a>
</template>
