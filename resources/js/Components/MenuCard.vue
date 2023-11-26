<script>
import { defineComponent } from 'vue';
import { mapGetters } from 'vuex';
import InfoAlert from '@/Components/InfoAlert.vue';
import InfoBox from '@/Components/InfoBox.vue';

export default defineComponent({
  components: { InfoBox, InfoAlert },
  data() {return { isHoveredToCta: false }},
  props: {
    data: {
      type: Object,
      required: true,
    },
    size: {
      type: String,
      default: 'lg',
    },
  },
  computed: {
    ...mapGetters(['getCart']),
    iconSize() {
      return {
        'sm': '1x',
        'lg': 'lg',
      }[this.size]
    },
  },
  emits: ['addToCard', 'removeFromCart'],
})
</script>

<template>
  <div :data-tooltip="!data.isOnlineSaleAvailable ? 'Онлайн продажа не доступна' : null"
       class="border border-border flex"
       :class="{'with-tooltip' : !data.isOnlineSaleAvailable, 'flex-col': size === 'lg'}"
       :title="data.name">
    <div class="hovered relative bg-slate-100 animate-pulse"
         :class="{
            'aspect-[19/12]': size === 'lg',
            'aspect-[4/3]' : size === 'sm',
            'basis-[55%]': size === 'sm',
      }">
      <img v-if="data.src" :src="data.src" :alt="data.name" class="object-cover w-full h-full">
      <div class="hovered__description absolute left-0 top-0 right-0 bottom-0 bg-shadow flex items-center p-4">
        <span class="font-serif text-white font-bold line-clamp-6 overflow-ellipsis"
              :class="{'text-xs': size === 'sm'}">{{ data.description }}</span>
      </div>
    </div>
    <div class="pt-4 px-4 pb-5 transition"
         :class="{
            'bg-slate-100': isHoveredToCta,
            'flex flex-col justify-between': size === 'sm',
            'basis-[45%]': size === 'sm',
    }">
      <p class="block mb-4 line-clamp-1 overflow-ellipsis" :class="{'text-sm': size === 'sm'}">{{ data.name }}</p>
      <div class="flex justify-between items-center gap-4">
        <div class="flex flex-col gap-1">
          <span class="price" :class="{'text-xl': size === 'lg'}">{{ data.price }}</span>
          <hr class="h-px border-border" :class="{'w-14': size === 'lg', 'w-10': size === 'sm'}">
          <span class="font-medium" :class="{'text-sm': size === 'sm'}">{{ data.weight }}</span>
        </div>
        <div @mouseenter="isHoveredToCta = true" @mouseleave="isHoveredToCta = false">

          <template v-if="data.isOnlineSaleAvailable">
            <button v-if="getCart.has(this.data)"
                    @click="$emit('removeFromCart')"
                    class="p-2.5" type="button">
              <font-awesome-icon :icon="['fas', 'trash-can']" :size="iconSize" class="text-maroon"/>
            </button>
            <button v-else
                    @click="$emit('addToCard')"
                    class="p-2.5" type="button">
              <font-awesome-icon :icon="['fas', 'cart-plus']" :size="iconSize" class="text-maroon"/>
            </button>
          </template>

          <a v-else href="tel:89183119791" class="block p-2.5">
            <font-awesome-icon :icon="['fas', 'phone']" :size="iconSize" class="text-maroon"/>
          </a>
        </div>
      </div>
    </div>
  </div>
</template>
