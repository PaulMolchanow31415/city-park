import { computed, onBeforeUnmount, onMounted } from 'vue';
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
  onBeforeUnmount(() => target.removeEventListener(event, callback))
}

export function useSortable(collection, sortBy) {
  return computed(() =>
    collection.filter(item => JSON.stringify(item).includes(sortBy.value)),
  )
}

export function useClickOutside(component, callback) {
  const listener = (event) => {
    if (
      event.target === component.value ||
      event.composedPath().includes(component.value)
    ) {
      return
    }
    if (typeof callback === 'function') {
      callback()
    }
  }

  useEventListener('click', listener, window)
}