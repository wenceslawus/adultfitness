import apiSlider from '../api/slider'

const state = {
  sliders: [],
  slider: [],
  editedSlider: false,
  editedListSlider: false
}

const getters = {
  sliders: state => state.sliders,
  slider: state => state.slider,
  editedSlider: state => state.editedSlider,
  editedListSlider: state => state.editedListSlider
}

const mutations = {
  setSliders(state, data) {
    state.sliders = data
  },

  setSlider(state, data) {
    state.slider = data
  },

  setEditSlider(state, record) {
    state.editedSlider = record
  },

  setEditListSlider(state, record) {
    state.editedListSlider = record
  },

  setNewSlide(state, record) {
    state.sliders.push(record)
  }
}

const actions = {

  newSlider({commit}) {
    commit('setSlider', {})
  },
  storeSlider({commit, dispatch}, data) {
    return apiSlider.store(data)
      .then(response => {
        commit('setNewSlide', data)
        commit('setEditSlider', false)
        dispatch('getSliders')
      })

  },
  updateSlider({commit, dispatch}, id) {
    return apiSlider.update(id)
      .then(res => {
        dispatch('getSliders')
        commit('setEditSlider', false)
      })
  },
  removeSlider({dispatch}, id) {
    return apiSlider.remove(id)
      .then(res => {
        dispatch('getSliders')
      })
  },
  getSliders({commit}) {
    return apiSlider.get()
      .then(res => {
          if (res.sliders) {
            commit('setSliders', res.sliders)
          }
        }
      )
  },
  setEditSlider({commit, state}) {
    commit('setEditSlider', !state.setEditSlider)
  },
  setEditListSlider({commit, state}) {
    commit('setEditListSlider', !state.editedListSlider)
  },
  cancelSlider({commit}) {
    commit('setEditSlider', false)
  },
  cancelEditListSlider({commit}) {
    commit('setEditSlider', false)
    commit('setEditListSlider', false)
  },
  showSlider({commit}, id) {
    return apiSlider.show(id)
      .then(response => {
        if (response.slider) {
          commit('setSlider', response.slider)
        }

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
