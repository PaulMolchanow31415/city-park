<script>
import { defineComponent } from 'vue';

export default defineComponent({
  name: 'AppInput',
  inputId: '',
  props: {
    modelValue: {
      type: [String, Number]
    },
    type: {
      type: String,
      default: 'text'
    },
    label: {
      type: String,
      required: true
    },
    placeholder: {
      type: String,
    },
    required: {
      type: Boolean,
      default: false
    }
  },
  emits: ['update:modelValue'],
  inject: ['idGeneration'],
  created() {
    this.$options.inputId = this.idGeneration(this.label)
  }
})
</script>

<template>
    <div>
        <label :for="$options.inputId"
               class="block mb-2 pl-1.5 text-sm font-medium text-gray-900 dark:text-white">
            {{ label }}
        </label>
        <input :type="type || 'text'"
               :id="$options.inputId"
               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                      block w-full py-2.5 px-3 transition duration-200 focus:ring-blue-500 focus:border-blue-500
                      placeholder:font-sans"
               :placeholder="placeholder"
               :required="required"
               @input="$emit('update:modelValue', $event.target.value)"
        >
    </div>
</template>

<style scoped lang="postcss">

</style>