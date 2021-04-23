import * as types from './mutation-types'
import Cookie from 'js-cookie'
import axios from 'axios'
// state
export const state = () => {
  return {
    cart: [],
    items: [],
    sitewideCoupon: [],
    loading: false
  }
}

// getters
export const getters = {
  cart: state => state.cart,
  items: state => state.items,
  sitewideCoupon: state => state.sitewideCoupon,
  loading: state => state.loading
}

// mutations
export const mutations = {
  [types.SET_CART_ITEMS] (state, { data }) {
    state.cart = data.cart
    state.items = data.items
    state.sitewideCoupon = data.sitewideCoupon
  },
  
  [types.SET_LOADING](state, payload){
    state.loading = payload
  }
}

// actions
export const actions = {
  async addToCart({ commit }, form){
    const response = await form.post(`/api/cart`)
  },
  
  async moveBuyNowToCart({ commit }, uuid){
    await commit(types.SET_LOADING, true)
    await axios.get(`/api/cart/checkout/express/course/${uuid}`)
    commit(types.SET_LOADING, false)
  },
  
  async removeFromCart({ commit, dispatch }, payload){
    const response = await axios.post(`/api/cart/items/remove`, payload)
    dispatch('fetchCartItems')
  },
  
  async fetchCartItems({ commit }){
    await commit(types.SET_LOADING, true)
    const response = await axios.get(`/api/cart/items`)
    let data = response.data
    await commit(types.SET_CART_ITEMS, { data })
    setTimeout(() => {
      commit(types.SET_LOADING, false)  
    }, 1000)
    
  },
  
  applyCoupon({ dispatch }, form){
    form.post(`/api/cart/applyCoupon`)
      .then(response => {
        dispatch('fetchCartItems')
      }).catch(e => {
        form.errors.set('code', e.response.data.message)
      })
  },
  
  async removeCoupon({ dispatch }, payload){
    const response = await axios.post(`/api/cart/removeCoupon`, payload)
    dispatch('fetchCartItems', 'default')
  }
  
}







