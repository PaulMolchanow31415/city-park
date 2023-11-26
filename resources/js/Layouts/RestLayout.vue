<script setup>
import MenuSection from '@/Components/MenuSection.vue';
</script>

<template>
  <slot class="mb-32"/>
  <MenuSection class="mt-28" :items="[
            {id: 1, name: 'Вкусный чай', price: 200, weight: '600 г' },
            {id: 2, name: 'Вкусный limon', description: 'cold and sweet', price: 300, weight: '100 г', isOnlineSaleAvailable: true },
            {id: 3, name: 'Вкусный cake',  price: 1550, weight: '200 г' }
        ]"/>
</template>
