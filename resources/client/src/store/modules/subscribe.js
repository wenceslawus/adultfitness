import api from '../api/subscribe'

const state = {
  visible: false,
  payLink: null,
}
const getters = {
  dialog: state => state.visible,
  link: state => state.payLink,
  payFrom: () => localStorage.getItem('payFrom'),
}
const mutations = {
  visible (state, value) {
    if(value) {
      state.payLink = value
      state.visible = true
    } else
      state.visible = false
  },
  setPayFrom (state, value) {
    localStorage.setItem('payFrom', value)
  },
}

const actions = {
  showDialog({commit}, value) {
    commit('setPayFrom', this.$router.currentRoute.path)

    if(value || value == undefined){
      commit('visible', value)
      /*return api.getPayLink()
        .then(data => commit('visible', data.link))//*/
    } else {
      commit('visible', false)
    }
  },

  getPayLink({commit}, value) {
    commit('setPayFrom', this.$router.currentRoute.path)
    return api.getPayLink()
  },

  create({commit}, card) {
    return api.create(card)

  }
}

export default {
  namespaced: true,
  state,
  getters,
  mutations,
  actions
}
