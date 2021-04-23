import axios from 'axios'
import Cookies from 'js-cookie'

// state
export const state = () => {
    return {
      currency: Cookies.get('currency') || 'USD',
      conversion_rate: Cookies.get('conversion_rate') || 1,
      currencies: []
    }
}

// getters
export const getters = {
  currency: state => state.currency,
  currencies: state => state.currencies,
  conversion_rate: state => state.conversion_rate
}

// mutations
export const mutations = {
  SET_CURRENCY (state, currency) {
    state.currency = currency
    let conversion_rate = state.currencies.filter(c => c.code.toUpperCase() == currency.toUpperCase())[0].conversion_rate
    state.conversion_rate = conversion_rate
    Cookies.set('currency', currency, { expires: 365 })
    Cookies.set('conversion_rate', conversion_rate, { expires: 365 })
  },
  
  SET_CURRENCIES (state, currencies) {
    state.currencies = currencies
  }
}

// actions
export const actions = {
  async fetchCurrencies ({ commit }) {
    try {
      const response = await axios.get('/api/currencies')
      commit('SET_CURRENCIES', response.data.data)
    } catch (e) {
      console.log("currency: failed")
    }
  }
}
