import api from '../api/playlist'
import Vue from 'vue'

const state = {
  list: [],
}
const getters = {
  list: state => state.list,
}
const mutations = {
  setItems (state, playlists) {
    state.list = playlists
  },
  addToList (state, plist) {
    state.list.push(plist)
  },
  updateList (state, item) {
    const index = state.list.findIndex(current => {
      if(current.id == item.id) {
        return current
      }
    })

    Vue.set(state.list, index, item)
  },
  deleteList (state, id) {
    const index = state.list.findIndex(current => {
      if(current.id == id) {
        return current
      }
    })

    if(index > -1) {
      state.list.splice(index, 1)
    }
  }
}

const actions = {
  getList({commit}) {
    return api.getList()
      .then(result => commit('setItems', result.playlists))
  },
  createList({commit}, data) {
    return api.createList(data)
      .then(response => {
        commit('addToList', response.playlist)
      })
  },
  updateList({commit}, data) {
    return api.updateList(data)
    .then(response => {
      commit('updateList', response.playlist)
    })
  },
  deleteList({commit}, id) {
    return api.deleteList(id)
      .then(() => {
        commit('deleteList', id)
      })
  },

  attach({commit}, data){
    return api.attach(data)
      .then(response => {
        commit('updateList', response.playlist)
      })
  },
  detach({commit}, data){
    return api.detach(data)
      .then(response => {
        commit('updateList', response.playlist)
      })
  },
}

export default {
  namespaced: true,
  state,
  getters,
  mutations,
  actions
}
