import * as types from './mutation-types'
import axios from 'axios'

// state
export const state = () => {
    return {
        author_current_course: [],
        course: {},
        userCanAccess: false,
        loading: false
    }
}

// getters
export const getters = {
  author_current_course: state => state.author_current_course,
  course: state => state.course,
  userCanAccess: state => state.userCanAccess,
  loading: state => state.loading
}

// mutations
export const mutations = {
  [types.SET_CURRENT_AUTHOR_COURSE] (state, { data }) {
    state.author_current_course = data
  },
  
  [types.SET_COURSE] (state, { data }) {
    state.course = data
  },
  
  [types.SET_USER_CAN_ACCESS] (state, { data }) {
    state.userCanAccess = data
  },
  
  [types.SET_LOADING] (state, payload) {
    state.loading = payload
  },
}

// actions
export const actions = {
    findByUuid ({ commit }, uuid) {
        commit(types.SET_LOADING, true)
        axios.get(`/api/courses/findByUuid/${uuid}`)
          .then(response => {
            let data = response.data.data
            commit(types.SET_CURRENT_AUTHOR_COURSE, { data })
            commit(types.SET_COURSE, { data })

            setTimeout(()=>{
                commit(types.SET_LOADING, false)
            }, 2000)
          })
    },
  
    async findBySlug ({ commit }, slug){
        const response  = await axios.get(`/api/courses/findBySlug/${slug}`)
        let data = await response.data.data
        await commit(types.SET_COURSE, { data })
        
        setTimeout(()=>{
            commit(types.SET_LOADING, false)
        }, 2000)
        
    },
  
  async checkIfUserCanAccessCourse({ commit }, id){
      const response = await axios.get(`/api/courses/${id}/user-can-access`)
      let data = response.data.user_can_access
      commit(types.SET_USER_CAN_ACCESS, { data })
      
  }
  
}







