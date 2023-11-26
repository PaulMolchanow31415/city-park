import { createStore } from 'vuex';

export default createStore({
  state: {
    cart: new Map(),
  },
  getters: {
    getCart: state => state.cart,
    getOrderSum: state => {
      let sum = 0
      state.cart.forEach((value, key) => sum += value * key.price)
      return sum
    },
    isFreeDeliveryAvailable: (state, getters) => getters.getOrderSum > 499
  },
  mutations: {
    addCartItem(state, item) {
      if (state.cart.has(item)) {
        state.cart.set(item, state.cart.get(item) + 1)
      } else {
        state.cart.set(item, 1)
      }
      // console.log('adding', state.cart)
    },
    removeCartItem(state, item) {
      if (!state.cart.has(item)) {
        return
      }
      const count = state.cart.get(item)
      if (count > 1) {
        state.cart.set(item, count - 1)
      } else {
        state.cart.delete(item)
      }
      // console.log('removing', state.cart)
    },
    removeAllCartItems: (state, item) => state.cart.delete(item),
    clearCart: state => state.cart.clear()
  },
})