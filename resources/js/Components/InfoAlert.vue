<script setup>
</script>

<template>
  <transition leave-active-class="transition ease-in duration-1000"
              leave-from-class="opacity-100"
              leave-to-class="opacity-0 transform translate-x-1/2">
    <div
      class="flex items-center p-4 mb-4 text-sm text-blue-800 border border-blue-500 rounded-lg bg-blue-50"
      role="alert">
      <div>
        <span class="font-medium"><slot/></span>
      </div>
    </div>
  </transition>
</template>
