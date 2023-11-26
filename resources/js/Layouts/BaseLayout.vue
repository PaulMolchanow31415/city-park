<script setup>
import AppHeader from '@/Components/AppHeader.vue';
import AppFooter from '@/Components/AppFooter.vue';
import { provide } from 'vue';

provide('idGeneration', function (salt) {
  const dec2hex = (dec) => dec.toString(16).padStart(2, "0")
  const epsilon = Math.round(Math.random()) * 3
  const length = Math.ceil(salt.length)
  let uint8Array = new Uint8Array(( length + epsilon || 40) / 2)
  crypto.getRandomValues(uint8Array)
  return Array.from(uint8Array, dec2hex).join('')
})
</script>

<template>
    <div class="min-h-screen h-auto flex flex-col ">
        <AppHeader/>
        <div class="flex-grow"><slot/></div>
        <AppFooter class="mt-28"/>
    </div>
</template>
