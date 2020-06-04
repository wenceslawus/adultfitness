import api from '../api/search'

const state = {
  items: [],
  searchPhrase: '',
}
const getters = {
  items: state => state.items,
  searchPhrase: state => state.searchPhrase,
}
const mutations = {
  setItems (state, response) {
    state.items = response.data.items
    state.searchPhrase = response.data.text
  }
}

const actions = {
  search({commit}, text) {
    return api.search(text)
      .then(result => commit('setItems', result))
  }
}

export default {
  namespaced: true,
  state,
  getters,
  mutations,
  actions
}