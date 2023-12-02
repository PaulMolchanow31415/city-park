<script>
import { defineComponent } from 'vue';

export default defineComponent({
  name: 'AppInput',
  inputId: '',
  props: {
    modelValue: {
      type: [String, Number],
    },
    type: {
      type: String,
      default: 'text',
    },
    label: {
      type: String,
      required: true,
    },
    required: {
      type: Boolean,
      default: false,
    },
    placeholder: String,
    autocomplete: String,
  },
  emits: ['update:modelValue'],

})
</script>

<template>
    <div>
        <label>
          <span class="app-label">{{ label }}</span>
          <input :type="type || 'text'"
                 :id="$options.inputId"
                 :placeholder="placeholder"
                 :required="required"
                 :autocomplete="autocomplete"
                 :value="modelValue"
                 @input="$emit('update:modelValue', $event.target.value)"
                 class="app-input"
          >
        </label>
    </div>
</template>
