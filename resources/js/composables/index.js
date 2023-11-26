import { computed, onMounted, onUnmounted } from 'vue';
import { usePage } from '@inertiajs/vue3';

export function useBreadcrumbs() {
  const insertBetween = (items, insertion) => {
    return items.flatMap(
      (value, index, array) =>
        array.length - 1 !== index
          ? [value, insertion]
          : value,
    );
  };

  return computed(() => insertBetween(
    usePage().props.breadcrumbs || [], '/'),
  );
}

export function useEventListener(event, callback, target = document) {
  onMounted(() => target.addEventListener(event, callback))
  onUnmounted(() => target.removeEventListener(event, callback))
}