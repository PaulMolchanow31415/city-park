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
import { Link } from '@inertiajs/vue3';
import { defineComponent } from 'vue';
import { mapGetters, mapMutations } from 'vuex';

export default defineComponent({
  name: 'Menu',
  layout: [BaseLayout, MenuLayout],
  components: { AppInput, PhoneInput, AddressInput, DatePicker, Modal, InfoAlert, InfoBox, MenuCard, Link },
  data() {
    return {
      showInfoBox: false,
      showMessage: false,
      showOrderModal: false,
      selectedDate: null,
      withDelivery: true,
      timeOrderPick: null,
      name: '',
      phone: '',
      email: '',
      wishes: '',
      privacyPolicyAgree: true,
    }
  },
  computed: {
    ...mapGetters(['getCart', 'getOrderSum', 'isFreeDeliveryAvailable']),
    showCalendar() {
      return this.timeOrderPick === 'В определенное время'
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
  },
  tempdata: [
    { id: 1, name: 'Вкусный чай', price: 200, weight: '600 г' },
    { id: 2, name: 'Вкусный limon', description: 'cold and sweet', price: 300, weight: '100 г', isOnlineSaleAvailable: true },
    { id: 3, name: 'Вкусный cake', price: 1550, weight: '200 г', isOnlineSaleAvailable: true },
    { id: 4, name: 'Вкусный cake', price: 1550, weight: '200 г' },
  ],
  methods: {
    ...mapMutations(['addCartItem', 'removeCartItem', 'removeAllCartItems', 'clearCart']),
    handleInput(item, oldValue, newValue) {
      newValue > oldValue ? this.addCartItem(item) : this.removeCartItem(item)
    },
    handleOrder() {
      this.showOrderModal = false
      this.showInfoBox = false
      console.log('do order...')
      this.clearCart()
    },
  },
})
</script>

<template>
<MenuCard v-for="item in $options.tempdata"
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
<Modal :show="showOrderModal" @close="showOrderModal = false">
  <form @submit.prevent="console.log('submitting...')" class="p-5 flex flex-col gap-5">

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
          <input v-model="timeOrderPick" name="time" value="В ближайшее время" type="radio" class="form-radio" checked>
          <span class="ml-2">В ближайшее время</span>
        </label>
        <label class="inline-flex items-center">
          <input v-model="timeOrderPick" name="time" value="В определенное время" type="radio" class="form-radio">
          <span class="ml-2">В определенное время</span>
        </label>
      </div>
      <div v-show="showCalendar">
        <DatePicker class="px-2.5" v-model="selectedDate"/>
      </div>
    </div>
    <div class="flex flex-col gap-2.5">
      <label class="inline-flex items-center">
        <input v-model="withDelivery" type="checkbox" class="form-checkbox rounded-sm">
        <span class="ml-2">Доставка</span>
      </label>
      <AddressInput v-show="withDelivery" placeholder="Начните вводить адрес"/>
    </div>
    <input v-model="name" class="app-input" type="text" placeholder="Имя">
    <div class="flex gap-2.5 items-center">
      <PhoneInput v-model="phone" placeholder="Контактный телефон" class="flex-grow"/>
      <AppInput v-model="email" label="Email" type="email" class="flex-grow" placeholder="test@mail.com"/>
    </div>
    <textarea v-model="wishes" class="app-textarea" placeholder="Ваши пожелания"></textarea>
    <div>
      <p v-show="withDelivery && !isFreeDeliveryAvailable" class="block text-brown">Стоимость доставки: {{ 100 }}₽</p>
      <div class="flex items-center gap-1.5">
        <p class="font-serif text-2xl">К оплате:</p>
        <p class="price text-3xl text-dark">{{ getOrderSum }}</p>
      </div>
    </div>
    <label class="inline-flex items-center">
      <input v-model="privacyPolicyAgree" type="checkbox" class="form-checkbox rounded-sm">
      <span class="ml-2">С&nbsp;
        <Link :href="route('private-policy')" class="underline">политикой конфиденциальности</Link>&nbsp;согласен
      </span>
    </label>
    <div class="flex justify-center items-center gap-2.5 mt-5">
      <button @click="showOrderModal = false" type="button" class="btn-2 bg-brown">
        <font-awesome-icon :icon="['fas', 'circle-xmark']" size="lg"/>Отмена
      </button>
      <button @click="handleOrder" type="button" class="btn-3 italic">
        <font-awesome-icon :icon="['fas', 'circle-check']" size="lg"/>Далее
      </button>
    </div>
  </form>
</Modal>
</template>

<style lang="postcss" scoped>
.modal-btn {
  @apply w-12 h-10 rounded-md flex justify-center items-center transition;
}
</style>
