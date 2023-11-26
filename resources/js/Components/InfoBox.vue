<script>
import { defineComponent } from 'vue';

export default defineComponent({
  name: 'InfoBox',
  props: {
    show: {
      type: Boolean,
      default: false,
      required: true,
    },
  },
})
</script>

<template>
  <teleport to="body">
    <transition
      enter-active-class="duration-300 ease-out"
      enter-from-class="transform opacity-0"
      enter-to-class="opacity-100"
      leave-active-class="duration-200 ease-in"
      leave-from-class="opacity-100"
      leave-to-class="transform opacity-0"
    >
      <div v-show="show" class="fixed top-5 right-5 z-50 flex flex-col gap-5">
        <slot/>
      </div>
    </transition>
  </teleport>
</template>
