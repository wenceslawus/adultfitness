import api from '../api/video'
import { Notify } from 'quasar'
import { app } from '../../plugins/i18n'
import Vue from 'vue'

const state = {
  videos: [],
  recent: [],
  top: [],
  groups: [],
  editedVideo: false,
  current: null,
}
const getters = {
  recent: store => store.recent,
  top: store => store.top,
  groups: store => store.groups,
  videos: store => store.videos,
  editedVideo: store => store.editedVideo,
  current: store => store.current,
}
const mutations = {
  setIndex (state, value) {
    state.top = value.popular
    state.recent = value.latest
    state.groups = value.categories
  },
  setVideos (state, value) {
    state.videos = value
  },
  updateVideo (state, video) {
    const index = state.videos.findIndex(item => item.id == video.id)

    Vue.set(state.videos, index, video)
  },
  setCurrent (state, video) {
    state.current = video
  },
  addVideo(state, video){
    state.videos.push(video)
  },
  pushLinked (state, video) {
    if (video.linked) {
      if(video.connected)
        state.current.linked.push(video.linked);
      else {
        const index = state.current.linked.findIndex(item => item.id == video.linked.id)
        state.current.linked.splice(index, 1)
      }
    }
  }
}

const actions = {
  setVideo({commit}, id){
    api.setVideo(id)
      .then(data => {
        commit('addVideo', data.video)
      })
  },
  makeVideo({commit}, values){
    api.makeVideo(values)
      .then(data => {
        commit('addVideo', data.video)
      })
  },
  index ({ commit }, value) {
    api.index()
      .then(value => {
        commit('setIndex', value)
      })
  },
  videoList({ state }) {
    api.getVideos()
      .then(data => {
        state.videos = data.videos
      })
  },
  videoListEdit({ state }) {
    api.getVideosEdit()
      .then(data => {
        state.videos = data.videos
      })
  },
  setVisible({ commit }, params) {
    return api.setVisible(params)
      .then(data => {
        commit('updateVideo', data.video)
      })
  },
  sync ({ commit }) {
    return api.sync()
      .then(data => commit('setVideos', data.videos))
  },

  selectVideo ({ commit, getters }, id) {
    const current_id = getters.current && getters.current.id;
    commit('setCurrent', null);
    //if ( current_id !== id ) {
      return api.showVideo({id})
        .then((value) => {
          commit('setCurrent', value.video);
        })
    //}
  },
  getVideos ({commit}) {
    return api.getVideos()
      .then(data => {
        commit('setVideos', data.videos)
      })
  },
  play ({}, id) {
    return api.playVideo(id)
  },
  cancel({state}) {
    state.editedVideo = false
  },
  startEdit({state}, id) {
    api.editVideo(id)
      .then(data => {
        state.editedVideo = data.video
      })
  },
  save({commit, state}, data) {
    api.saveVideo(data)
      .then((value) => {
        commit('updateVideo', value.video);
        state.editedVideo = false
      })
      /*.then(data => {
        core
        state.editedVideo = null
        if (data && data.video && state.current && state.current.id == data.video.id) {
          state.current = data.video
        }
      })//*/
  },


  vote ({commit}, data) {
    return api.vote(data).then((data) => {
      commit('setCurrent', data.item)
    })
  },
  addLinked ({commit}, data) {
    return api.addLinked(data)
      .then((data) => {
        commit('pushLinked', data)
      })
  },

  copyLink ({}, link) {
    const el = document.createElement('textarea')
    el.value = link
    el.setAttribute('readonly', '')
    el.style.position = 'absolute';
    el.style.left = '-9999px';
    document.body.appendChild(el);
    el.select()
    document.execCommand('copy')
    document.body.removeChild(el);


    return Promise.resolve()
  },
}

export default {
  namespaced: true,
  state,
  getters,
  mutations,
  actions
}
