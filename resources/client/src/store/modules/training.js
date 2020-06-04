import api from '../api/training'
import Vue from 'vue'

const state = {
  items: [],
  selectedType: [],
  bodyParts: [],
  editedItem: null,
  trainer: null,
  typesList: [
    { value: '1', label: 'Most popular', },
    { value: '2', label: 'Recently Added', },
    { value: '3', label: 'Beginner', },
    { value: '4', label: 'Intermediate', },
    { value: '5', label: 'Expert', },
    { value: '6', label: 'Body Weight', },
    { value: '7', label: 'At Home', },
  ],
  bodiesList: [
    { value: '1', label: 'Legs', },
    { value: '2', label: 'Abs', },
    { value: '3', label: 'Chest & Back', },
    { value: '4', label: 'Shoulders, Biceps & Triceps', },
    { value: '5', label: 'Full body', },
  ],
}

const getters = {
  list: state => state.items,
  types: state => state.selectedType,
  parts: state => state.bodyParts,
  item: state => state.editedItem,
  typesList: state => state.typesList,
  bodiesList: state => state.bodiesList,
  trainer: state => state.trainer,
}

const mutations = {
  setList(state, data) {
    state.items = data.list
  },
  setTypes(state, data) {
    state.types = data.types
  },
  setParts(state, data) {
    state.types = data.parts
  },
  editItem(state, item){
    state.editedItem = item
  },
  deleteItem(state, id){
    let index = state.items.findIndex(item => item.id == id)
    state.items.splice(index, 1)
  },
  updateItem(state, record) {
    let index = state.items.findIndex(item => item.id == state.editedItem.id)
    if(index > -1) {
      Vue.set(state.items, index, record)
    } else {
      state.items.push(record)
    }
  },
  setTrainerData(state, trainer) {
    state.trainer = trainer
  }
}

const actions = {
  getTrainer({commit}, id){
    return api.getTrainer(id)
      .then(data => commit('setTrainerData', data.trainer))
  },
  follow({commit}, data){
    return api.follow(data)
      .then(data => {
        commit('setTrainerData', data.trainer)
      })
  },
  setTrainer({commit}, trainer) {
    commit('setTrainerData', trainer)
  },
  clearTrainer({commit}){
    commit('setTrainerData', null)
  },
  loadItems({commit, state}) {
    return api.loadItems()
      .then(response => {
        commit('setList', response)
      });
  },

  getItem({}, id) {
    return api.getItem(id)
  },

  editItem({commit}, id) {
    return api.editItem(id)
      .then(response => {
        commit('editItem', response.item)
      })
  },
  deleteItem({commit}, id) {
    return api.deleteItem(id)
      .then(response => {
        commit('deleteItem', id)
      })
  },

  createItem({commit}){
    commit('editItem', {
      types: [],
      bodies: [],
      id: 'new',
      image: '',
      file: '',
    })
  },
  saveItem({commit}, data) {
    return api.saveItem(data)
      .then(response => {
        commit('updateItem', response.program)
        commit('editItem', null)
      })
  },

  cancel({commit}) {
    commit('editItem', null)
  },
}

export default {
  namespaced: true,
  state,
  getters,
  mutations,
  actions
}
