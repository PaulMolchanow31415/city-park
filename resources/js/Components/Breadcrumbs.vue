<script setup>
defineProps({ breadcrumbs: Array });
</script>

<template>
  <nav v-if="breadcrumbs">
    <ol class="inline-flex">
      <li v-for="page in breadcrumbs">
        <span v-if="page ==='/'" class="text-brown">&nbsp;/&nbsp;</span>
        <a v-else :href="page.url">{{ page.title }}</a>
        <!-- :class="{ 'border-b border-blue-400': page.current }" -->
      </li>
    </ol>
  </nav>
</template>
