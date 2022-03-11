import * as Cookies from 'js-cookie'

export const state = () => ({
  user: null,
  token: null,
})

export const mutations = {
  setUser (state, value) {
    state.user = value
  },

  setToken (state, value) {
    state.token = value
  },
}

export const actions = {
  setUser ({ commit }, params) {
    commit('setUser', params)
  },

  setToken ({ commit }, params) {
    commit('setToken', params)
  },

  logout ({ commit }, params = false) {
    if (params) {
      commit('setUser', null)
      commit('setToken', null)
      Cookies.remove('vuex')
      return true
    }
  },
}

export const getters = {
  user: state => state.user,
  token: state => state.token,
}