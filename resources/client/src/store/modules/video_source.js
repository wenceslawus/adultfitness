import api from '../api/video'

const state = {
  videos: []
}

const getters = {
  videos: (store) => {
    return store.videos
  }
}

const mutations = {
  setVideos (state, value) {
    state.videos = value
  }
}

const actions = {
  getVideos ({commit, getters}) {
    if(!getters.videos.length) {
      return api.getVideoSource()
        .then(data => commit('setVideos', data.videos))
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
