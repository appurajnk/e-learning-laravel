import axios from 'axios'

// state
export const state = () => {
    return {
        conversations: [],
        selected_conversation: {},
        messages: [],
        loading: false
    }
}
  
// getters
export const getters = {
    conversations: state => state.conversations,
    selected_conversation: state => state.selected_conversation,
    messages: state => state.messages,
    loading: state => state.loading
}
  
  // mutations
export const mutations = {
    SET_CONVERSATIONS (state, payload) {
        state.conversations = payload
    },

    SET_LOADING (state, payload) {
        state.loading = payload
    },

    SET_MESSAGES (state, payload) {
        state.messages = payload
    },

    SET_CONVERSATION (state, payload) {
        state.selected_conversation = payload
    }

}
  
  // actions
export const actions = {
    fetchUserConversations ({ commit }) {
        axios.get(`/api/conversations`)
            .then(response => {
                let conversations = response.data.data
                commit('SET_CONVERSATIONS', conversations)
                const first_conversation = conversations[0] || {}
                commit('SET_CONVERSATION', first_conversation)
                if(first_conversation !== undefined) commit('SET_MESSAGES', first_conversation.messages)
            })
    },

    sendMessage ({ dispatch }, form) {
        form.post(`/api/conversations/${form.conversation_id}/messages`)
            .then(response => {
                dispatch('fetchConversationMessages', form.conversation_id)
            })
    },
    
    fetchConversationMessages({ commit }, conversation){
        commit('SET_LOADING', true)
        axios.get(`/api/conversations/${conversation.id}/messages`)
            .then(response => {
                const messages = response.data.data
                commit('SET_CONVERSATION', conversation)
                commit('SET_MESSAGES', messages)
            }).finally( () => {
                commit('SET_LOADING', false)
            })
        
    }
}
  
  
  
  
  
  
  
  