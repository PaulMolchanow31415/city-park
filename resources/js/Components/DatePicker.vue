<script>
import { defineComponent } from 'vue';
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'

export default defineComponent({
  name: 'DatePicker',
  components: { VueDatePicker },
  props: ['modelValue'],
  emits: ['update:modelValue'],
})
</script>

<template>
  <!-- inline -->
  <VueDatePicker :model-value="modelValue"
                 @update:model-value="$emit('update:modelValue', $event)"
                 locale="ru"
                 placeholder="Выберите время"
                 text-input
                 auto-apply
                 partial-flow
                 :flow="['calendar', 'time']"
                 :month-change-on-scroll="false"
                 required
                 disable-year-select
                 disable-month-select
                 close-on-scroll
                 :min-date="new Date()"
                 focus-start-date
  >
    <template #input-icon><font-awesome-icon class="ml-2.5" :icon="['fas', 'clock']" size="lg"/></template>
    <template #clock-icon><font-awesome-icon :icon="['fas', 'clock']" /></template>
    <template #calendar-icon><font-awesome-icon icon="calendar-days" /></template>
    <template #clear-icon="{ clear }">
      <button @click="clear" class="mr-1 p-2" type="button">
        <font-awesome-icon :icon="['fas', 'xmark']" />
      </button>
    </template>
  </VueDatePicker>
</template>

<style lang="postcss">
:root {
  /*General*/
  --dp-font-family: theme('fontFamily.sans');
  --dp-border-radius: theme('borderRadius.lg'); /*Configurable border-radius*/
  --dp-cell-border-radius: 4px; /*Specific border radius for the calendar cell*/
  --dp-common-transition: all 0.1s ease-in; /*Generic transition applied on buttons and calendar cells*/

  /*Sizing*/
  --dp-button-height: 35px; /*Size for buttons in overlays*/
  --dp-month-year-row-height: 35px; /*Height of the month-year select row*/
  --dp-month-year-row-button-size: 35px; /*Specific height for the next/previous buttons*/
  --dp-button-icon-height: 20px; /*Icon sizing in buttons*/
  --dp-cell-size: 35px; /*Width and height of calendar cell*/
  --dp-cell-padding: 5px; /*Padding in the cell*/
  --dp-common-padding: 10px; /*Common padding used*/
  --dp-input-icon-padding: 35px; /*Padding on the left side of the input if icon is present*/
  --dp-input-padding: theme('padding[2.5]') theme('padding.14') theme('padding[2.5]') theme('padding.3'); /*Padding in the input*/
  --dp-menu-min-width: 260px; /*Adjust the min width of the menu*/
  --dp-action-buttons-padding: 2px 5px; /*Adjust padding for the action buttons in action row*/
  --dp-row-margin:  5px 0; /*Adjust the spacing between rows in the calendar*/
  --dp-calendar-header-cell-padding:  0.5rem; /*Adjust padding in calendar header cells*/
  --dp-two-calendars-spacing:  10px; /*Space between multiple calendars*/
  --dp-overlay-col-padding:  3px; /*Padding in the overlay column*/
  --dp-time-inc-dec-button-size:  32px; /*Sizing for arrow buttons in the time picker*/
  --dp-menu-padding: 6px 8px; /*Menu padding*/
  /*Font sizes*/
  --dp-font-size: theme('fontSize.sm'); /*Default font-size*/
  --dp-preview-font-size: theme('fontSize.sm'); /*Font size of the date preview in the action row*/
  //--dp-time-font-size: theme('fontSize.sm'); /*Font size in the time picker*/

  /*Transitions*/
  --dp-animation-duration: 0.1s; /*Transition duration*/
  --dp-menu-appear-transition-timing: cubic-bezier(.4, 0, 1, 1); /*Timing on menu appear animation*/
  --dp-transition-timing: ease-out; /*Timing on slide animations*/
}
</style>