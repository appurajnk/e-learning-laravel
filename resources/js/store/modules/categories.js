import axios from 'axios'

// state
export const state = () => {
    return {
        categories: [],
        category: {},
        loading: false
    }
}

// getters
export const getters = {
  categories: state => state.categories,
  category: state => state.category,
  loading: state => state.loading
}

// mutations
export const mutations = {
  SET_CATEGORIES (state, categories) {
    state.categories = categories
  },

  SET_CATEGORY (state, category) {
    state.category = category
  },
  
  SET_LOADING (state, payload) {
    state.loading = payload
  },
}

// actions
export const actions = {
  async fetchCategories ({ commit }) {
    try {
      const response = await axios.get('/api/categories')
      commit('SET_CATEGORIES', response.data.data)
    } catch (e) {
      console.log("categories: failed")
    }
  },

  async fetchCategory ({ commit }, slug) {
    await commit('SET_LOADING', true)
    const response = await axios.get(`/api/categories/findBySlug/${slug}`)
    const category = await response.data
    await commit('SET_CATEGORY', category)
    
    setTimeout(()=>{
      commit('SET_LOADING', false)
    }, 300)
    
  }
}
