import api from '../api/page'

const state = {
  page: null,
}
const getters = {
  page: state => state.page,
}
const mutations = {
  setPage (state, response) {
    const page = response.page
    state.page = {
        description: page.content,
        image: page.image,
        link: page.link,
        meta_desc: page.desc,
        meta_keyword: page.meta_desc,
        title: page.title,
    }
  }
}

const actions = {
  loadPage({commit}, link) {
    return api.getPage(link)
      .then(result => commit('setPage', result.data))
  }
}

export default {
  namespaced: true,
  state,
  getters,
  mutations,
  actions
}