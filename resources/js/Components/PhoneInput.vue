<script>
import { defineComponent } from 'vue'
import AppInput from '@/Components/AppInput.vue';

export default defineComponent({
  name: 'PhoneInput',
  components: { AppInput },

  methods: {
    getInputNumbersValue: (input) => input.value.replace(/\D/g, ''),

    handlePaste(event) {
      const input = event.target
      const inputNumbersValue = this.getInputNumbersValue(input)
      const pasted = event.clipboardData

      if (pasted) {
        let pastedText = pasted.getData('Text')
        if (/\D/g.test(pastedText)) {
          input.value = inputNumbersValue
        }
      }
    },

    handleInput(event) {
      let input = event.target
      let inputNumbersValue = this.getInputNumbersValue(input)
      let selectionStart = input.selectionStart
      let formattedInputValue = ''

      if (!inputNumbersValue) {
        return (input.value = '')
      }

      if (input.value.length !== selectionStart) {
        if (input.value && /\D/g.test(input.value)) {
          input.value = inputNumbersValue
        }
        return
      }

      if (['7', '8', '9'].indexOf(inputNumbersValue[0]) > -1) {
        if (inputNumbersValue[0] === '9') {
          inputNumbersValue = '7' + inputNumbersValue
        }
        let firstSymbols = inputNumbersValue[0] === '8' ? '8' : '+7'
        formattedInputValue = input.value = firstSymbols + ' '
        if (inputNumbersValue.length > 1) {
          formattedInputValue += '(' + inputNumbersValue.substring(1, 4)
        }
        if (inputNumbersValue.length >= 5) {
          formattedInputValue += ') ' + inputNumbersValue.substring(4, 7)
        }
        if (inputNumbersValue.length >= 8) {
          formattedInputValue += '-' + inputNumbersValue.substring(7, 9)
        }
        if (inputNumbersValue.length >= 10) {
          formattedInputValue += '-' + inputNumbersValue.substring(9, 11)
        }
      } else {
        formattedInputValue = '+' + inputNumbersValue.substring(0, 16)
      }
      input.value = formattedInputValue
    },

    handleKeyDown(event) {
      const target = event.target
      const inputValue = target.value.replace(/\D/g, '')
      if (event.keyCode === 8 && inputValue.length === 1) {
        target.value = ''
      }
    },
  },
  props: { placeholder: String },
  emits: ['update:modelValue'],
})
</script>

<template>
  <AppInput ref="input"
            label="Телефон"
            type="tel"
            autocomplete="tel"
            required
            :placeholder="placeholder"
            @change="$emit('update:modelValue', $event.target.value)"
            @input="handleInput"
            @keydown="handleKeyDown"
            @paste="handlePaste"
  />
</template>
