
// state
export const state = () => {
    return {
        courses: [],
        page: 1,
        loading: true
    }
}

// getters
export const getters = {
    courses: state => state.courses,
    page: state => state.page,
    loading: state => state.loading
}

// mutations
export const mutations = {
    SET_PAGE(state, page){
        state.page = page
    },

    SET_COURSES (state, data) {
        state.courses = data
    },
  
    SET_LOADING(state, data){
        state.loading = data
    }
}

// actions
export const actions = {
    async fetchCourses ({ commit }, form) {
        const { data } = await form.post('/api/search')
        //await commit('SET_COURSES', data.data)
        await commit('SET_COURSES', data)
        setTimeout(async () => {
            await commit('SET_LOADING', false)
        }, 2000);
        
    }
  
}
