<script setup>
defineProps({
    as: {
        type: String,
        default: 'h6',
    }
})
</script>

<template>
    <Component
        :is="as"
        class="relative after:block after:absolute after:content-[''] after:-bottom-1 after:h-px after:w-14 after:bg-dark">
        <slot />
    </Component>
</template>
