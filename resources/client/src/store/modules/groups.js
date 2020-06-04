import api from '../api/video'

const state = {
  groups: [],
  current: null
}

const getters = {
  groups: store => store.groups,
  current: store => store.current,
}

const mutations = {
  setCurrent (state, value) {
    state.current = value.category
  },
}

const actions = {
  loadGroups ({getters}) {

  },
  selectCategory ({ commit, getters }, params) {
    var id = (params.id)?params.id:params.slug
    const current_id = getters.current && getters.current.id;

    if ( id && current_id !== id) {
      api.showCategory({id})
        .then((value) => {
          commit('setCurrent', value);
        })
    }
  }
}

export default {
  namespaced: true,
  state,
  getters,
  mutations,
  actions
}
