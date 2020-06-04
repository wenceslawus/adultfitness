import api from '../api/notify'
import Vue from 'vue'

const state = {
  list: [],
}
const getters = {
  list: state => state.list,
}
const mutations = {
  setItems (state, list) {
    state.list = list
  },
  setReaded (state){
    let items = []

    state.list.forEach(item => {
      items.push.state = items.push.state | 1
      items.push(item)
    })
    state.list = items
  },
}

const actions = {
  getList({commit}) {
    return api.list()
      .then(result => {
        commit('setItems', result.notifies)
      })
  },
  read({commit}, id) {
    return api.read(id)
      .then(response => {
        commit('setItems', response.notifies)
      })
  },
  remove({commit}, id){
    return api.kill(id)
      .then(response => {
        commit('setItems', response.notifies)
      })
  },
  markRread({commit}){
    return api.markRread()
      .then(response => {
        commit('setItems', response.notifies)
      })
  },
  setReaded({commit}){
    commit('setReaded')
  },
}

export default {
  namespaced: true,
  state,
  getters,
  mutations,
  actions
}
