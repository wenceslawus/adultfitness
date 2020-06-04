import api from '../api/blog'
import Vue from 'vue'
import { request } from 'http';

const state = {
  categories: [],
  records: [],
  selected: [], 
  times: null,
  editedCategory: null,
  editedRecord: null,
}

const getters = {
  categories: state => state.categories,
  records: state => state.records,
  selected: state => state.selected,
  times: state => state.times,
  editedCategory: state => state.editedCategory,
  editedRecord: state => state.editedRecord,
}

const mutations = {
  setCategories(state, data) {
    state.categories = data.blog_category
    if(data.popular) {
      state.records = data.popular
    }

    state.categories.forEach((element, index) => {
      Vue.set(state.selected, index, false)
    });
  },
  selChoise(state, data) {
    state.records = data.records
    state.times = data.times
    state.selected.forEach((item, index) => state.selected[index] = false)

    data.select.forEach((item) => {
      let index = state.categories.findIndex(cat => {
        return cat.id == item
      })
      
      state.selected[index] = true
    })
  },
  setEditCategory(state, item){
    state.editedCategory = item
  },
  setEditRecord(state, record) {
    state.editedRecord = record
  }, 
  updateRecord(state, record) {
    let index = state.records.findIndex(item => item.id == state.editedRecord.id)
    if(index > -1) {
      Vue.set(state.records, index, record)
    } else {
      state.records.push(record)
    }
  }
}

const actions = {
  loadCategories({commit, state}) {
    if (!state.categories.length) {
      return api.loadCategories()
        .then(response => {
          commit('setCategories', response)
        });
    } else {
      return Promise.resolve()
    }
  },
  getRecord({}, id) {
    return api.getRecord(id)
  },
  updateList({commit}, filter) {
    return api.getList(filter)
      .then(response => {
        commit('selChoise', {
          select: filter.categories,
          times: filter.times,
          records: response.blog_records
        })
      })
  },

  editCategory({commit}, id) {
    return api.editCategory(id)
      .then(response => {
        commit('setEditCategory', response.category)
      })
  },
  cancelCategory({commit}) {
    commit('setEditCategory', null)
  },
  newCategory({commit}) {
    commit('setEditCategory', {})
  },
  saveCategory({commit}, date) {
    return api.saveCategory(date)
      .then(response => {
        commit('setCategories', response)
        commit('setEditCategory', null)
      })
  },

  editRecord({commit}, id) {
    return api.editRecord(id)
      .then(response => {
        commit('setEditRecord', response.record)
      })
  },
  cancelRecord({commit}) {
    commit('setEditRecord', null)
  },
  newRecord({commit}) {
    commit('setEditRecord', {})
  },
  saveRecord({commit}, date) {
    return api.saveRecord(date)
      .then(response => {
        commit('updateRecord', response.record)
        commit('setEditRecord', null)
      })
  }  
}

export default {
  namespaced: true,
  state,
  getters,
  mutations,
  actions
}
