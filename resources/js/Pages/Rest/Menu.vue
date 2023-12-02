<script>
import AddressInput from '@/Components/AddressInput.vue';
import AppInput from '@/Components/AppInput.vue';
import DatePicker from '@/Components/DatePicker.vue';
import InfoAlert from '@/Components/InfoAlert.vue';
import InfoBox from '@/Components/InfoBox.vue';
import MenuCard from '@/Components/MenuCard.vue';
import Modal from '@/Components/Modal.vue';
import PhoneInput from '@/Components/PhoneInput.vue';
import BaseLayout from '@/Layouts/BaseLayout.vue';
import MenuLayout from '@/Layouts/MenuLayout.vue';
import { Link, useForm } from '@inertiajs/vue3';
import { defineComponent } from 'vue';
import { mapGetters, mapMutations } from 'vuex';

export default defineComponent({
  name: 'Menu',
  layout: [BaseLayout, MenuLayout],
  components: { AppInput, PhoneInput, AddressInput, DatePicker, Modal, InfoAlert, InfoBox, MenuCard, Link },
  props: {
    menuItems: Array,
    order: Object,
  },
  data() {
    return {
      showInfoBox: false,
      showMessage: false,
      showOrderModal: false,
    }
  },
  setup() {
    const form = useForm({
      selectedDate: null,
      withDelivery: true,
      timeOrderPick: null,
      address: '',
      name: '',
      phone: '',
      email: '',
      wishes: '',
      privacyPolicyAgree: true,
      cart: []
    })
    return { form }
  },
  computed: {
    ...mapGetters(['getCart', 'getOrderSum', 'isFreeDeliveryAvailable', 'getCartDto']),
    showCalendar() {
      return this.form.timeOrderPick === 'В определенное время'
    },
  },
  watch: {
    'getCart.size'(updated, old) {
      if (updated > old) {
        if (updated === 1) {
          this.showInfoBox = true
        }
        this.showMessage = true
      }
      setTimeout(() => this.showMessage = false, 2000)
    },
    'form.timeOrderPick'(updated) {
      if (updated === 'В ближайшее время') {
        this.form.selectedDate = null
      }
    },
  },
  methods: {
    ...mapMutations(['addCartItem', 'removeCartItem', 'removeAllCartItems', 'clearCart']),
    handleInput(item, oldValue, newValue) {
      newValue > oldValue ? this.addCartItem(item) : this.removeCartItem(item)
    },
    handleOrder() {
      if (!this.form.privacyPolicyAgree) {
        return
      }

      this.form.cart = this.getCartDto

      this.form.post(route('order.create'), {
        onSuccess: () => {
          this.showOrderModal = false
          this.showInfoBox = false
          this.clearCart()
        },
      })
    },
  },
})
</script>

<template>
<MenuCard v-for="item in menuItems"
          :key="item.id"
          :data="item"
          size="sm"
          @add-to-card="addCartItem(item)"
          @remove-from-cart="removeAllCartItems(item)"
/>
<InfoBox :show="showInfoBox && getCart.size > 0">
  <!--   POPUP    -->
  <div class="p-2.5 bg-white rounded-lg drop-shadow-xl">
    <div class="flex flex-col">
      <button @click="showInfoBox = false" class="p-1 text-slate-800 self-start" type="button">
        <font-awesome-icon :icon="['fas', 'xmark']" size="lg"/>
      </button>
      <button @click="clearCart" class="text-brown text-xs self-end hover:text-maroon" type="button">Удалить всё
      </button>
    </div>
    <div class="flex flex-col gap-1.5 mt-1">
      <!--  ITEM  -->
      <div v-for="item in getCart" :key="item[0].id"
           class="flex items-center gap-2.5 py-1.5 px-2.5 border border-border"
      >
        <div class="pr-1 basis-[45%]">
          <p class="block mb-1">{{ item[0].name }}</p>
          <span class="price leading-none">{{ item[0].price }}</span>
        </div>
        <button @click="addCartItem(item[0])" class="modal-btn bg-lime text-dark" type="button">
          <font-awesome-icon :icon="['fas', 'plus']"/>
        </button>
        <input :value="item[1]"
               @input="handleInput(item[0], item[1], $event.target.value)"
               class="w-14 h-10 p-1.5 border-border rounded-md font-normal"
               type="number"
        />
        <button @click="removeCartItem(item[0])" class="modal-btn bg-dark text-white" type="button">
          <font-awesome-icon :icon="['fas', 'minus']"/>
        </button>
        <div class="flex items-center">
          <hr class="h-6 w-px bg-border"/>
        </div>
        <button @click="removeAllCartItems(item[0])" class="modal-btn bg-maroon text-white" type="button">
          <font-awesome-icon :icon="['fas', 'trash-can']"/>
        </button>
      </div>
    </div>
    <!-- PRICING  -->
    <div class="w-full text-center mt-1.5">
      <span class="text-brown text-xs" v-show="isFreeDeliveryAvailable">Бесплатная доставка по городу!</span>
      <div class="flex gap-2.5 justify-center items-center">
        <p>Сумма заказа:</p>
        <span class="price text-xl">{{ getOrderSum }}</span>
      </div>
    </div>
    <!--  CONTROLS  -->
    <div class="flex justify-center items-stretch gap-2.5 mt-5">
      <button @click="showInfoBox = false" class="btn-2 bg-brown" type="button">
        <font-awesome-icon :icon="['fas', 'circle-xmark']" size="lg"/>
        Отмена
      </button>
      <button @click="showOrderModal = true" class="btn-3 italic" type="button">
        <font-awesome-icon :icon="['fas', 'circle-check']" size="lg"/>
        Оформить заказ
      </button>
    </div>
  </div>
  <InfoAlert v-show="showMessage">Товар добавлен в корзину!</InfoAlert>
</InfoBox>

<!-- BUY MODAL -->
<Modal :show="showOrderModal" @close="showOrderModal = false" closeable>
  <form @submit.prevent="handleOrder" class="p-5 flex flex-col gap-5">

    <div>
      <div class="flex justify-between items-end mb-2.5">
        <h6 class="text-maroon text-2xl">Оформление заказа</h6>
        <button @click="showOrderModal = false" class="p-3 text-border transition hover:text-dark" type="button">
          <font-awesome-icon :icon="['fas', 'xmark']" size="xl"/>
        </button>
      </div>
      <hr class="mx-5 border-border">
    </div>
    <div class="flex items-center justify-between gap-5">
      <div class="flex-grow flex flex-col">
        <label class="inline-flex items-center">
          <input v-model="form.timeOrderPick" name="time" value="В ближайшее время" type="radio" class="form-radio"
                 checked
          >
          <span class="ml-2">В ближайшее время</span>
        </label>
        <label class="inline-flex items-center">
          <input v-model="form.timeOrderPick" name="time" value="В определенное время" type="radio" class="form-radio">
          <span class="ml-2">В определенное время</span>
        </label>
      </div>
      <div v-if="showCalendar">
        <DatePicker class="px-2.5" v-model="form.selectedDate"/>
      </div>
    </div>
    <div class="flex flex-col gap-2.5">
      <label class="inline-flex items-center">
        <input v-model="form.withDelivery" type="checkbox" class="form-checkbox rounded-sm">
        <span class="ml-2">Доставка</span>
      </label>
      <AddressInput v-show="form.withDelivery" v-model="form.address" placeholder="Начните вводить адрес"/>
    </div>
    <input v-model="form.name" class="app-input" type="text" placeholder="Имя">
    <div class="flex gap-2.5 items-center">
      <PhoneInput v-model="form.phone" placeholder="Контактный телефон" class="flex-grow"/>
      <AppInput v-model="form.email" label="Email" type="email" class="flex-grow" placeholder="test@mail.com"/>
    </div>
    <textarea v-model="form.wishes" class="app-textarea" placeholder="Ваши пожелания"></textarea>
    <div>
      <p v-show="form.withDelivery && !isFreeDeliveryAvailable" class="block text-brown">
        Стоимость доставки: {{ 100 }}₽
      </p>
      <div class="flex items-center gap-1.5">
        <p class="font-serif text-2xl">К оплате:</p>
        <p class="price text-3xl text-dark">{{ getOrderSum }}</p>
      </div>
    </div>
    <label class="inline-flex items-center">
      <input v-model="form.privacyPolicyAgree" type="checkbox" class="form-checkbox rounded-sm">
      <span class="ml-2">С&nbsp;
        <Link :href="route('private-policy')" class="underline">политикой конфиденциальности</Link>&nbsp;согласен
      </span>
    </label>
    <div class="flex justify-center items-center gap-2.5 mt-5">
      <button @click="showOrderModal = false" type="button" class="btn-2 bg-brown">
        <font-awesome-icon :icon="['fas', 'circle-xmark']" size="lg"/>Отмена
      </button>
      <button type="submit" class="btn-3 italic">
        <!--  Todo Далее  -->
        <font-awesome-icon :icon="['fas', 'circle-check']" size="lg"/>Отправить
      </button>
    </div>
  </form>

</Modal>

<!-- BUTTON -->
<teleport to="body">
  <button v-if="!showInfoBox && getCart.size > 0" @click="showInfoBox = true"
          class="fixed-btn bg-lime w-16 h-16"
          aria-label="Открыть корзину"
  >
    <span class="sr-only">Открыть корзину</span>
    <font-awesome-icon :icon="['fas', 'cart-shopping']" size="lg"/>
  </button>
  <Link
    v-if="order"
    :href="route('order.cancel', { id: order.id })"
    method="delete"
    as="button"
    type="button"
    preserve-scroll
    class="fixed-btn bg-maroon text-white px-5 py-2.5"
  >
    <font-awesome-icon :icon="['fas', 'circle-xmark']"/>Отменить заказ
  </Link>
</teleport>
</template>

<style lang="postcss" scoped>
.modal-btn {
  @apply w-12 h-10 rounded-md flex justify-center items-center transition;
}
.fixed-btn {
  @apply fixed bottom-10 right-10 rounded-full flex justify-center items-center transition-[all] animate-bounce gap-1.5;
}
</style>
