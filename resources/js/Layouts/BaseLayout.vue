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

provide('formatDate', function (date) {
  const day = String(date.getDate()).padStart(2, '0');
  const month = String(date.getMonth() + 1).padStart(2, '0');
  const year = String(date.getFullYear()).slice(2);
  return `${day}.${month}.${year}`;
})

provide('formatTime', (date) =>
  `${(date.getFullYear() + '').slice(-2)}.${(date.getMonth() + 1).toString().padStart(2, '0')
  }.${date.getDate().toString().padStart(2, '0')} ${date.getHours().toString().padStart(2, '0')
  }:${date.getMinutes().toString().padStart(2, '0')}`
)

provide('formatPhoneToHref', function (phoneNumber) {
  const digits = phoneNumber.replace(/\D/g, ''); // удаляем все нецифровые символы
  return `tel:${digits}`;
})
</script>

<template>
    <div class="min-h-screen h-auto flex flex-col ">
        <AppHeader/>
        <div class="flex-grow"><slot/></div>
        <AppFooter class="mt-28"/>
    </div>
</template>
