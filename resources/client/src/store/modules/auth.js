import api from '../api/auth'
import Vue from 'vue'
import {Quasar} from 'quasar'

const state = {
  me: null,
  stored: null,
  //token: null,
  entryFrom: '/',
  key: null,
}

const getters = {
  me: state => state.me,
  key: state => state.key,
  rights: state => state.me && state.me.role,
  entryFrom: state => state.entryFrom,
  isAdmin: state => (state.me)?state.me.role=='admin':false,
  avatar: state => {
    const avatar = (state.me && state.me.avatar)?state.me.avatar:'/statics/profile.png'

    return (avatar)?avatar:'/statics/profile.png'
  },

  locale: state => (state.me)?state.me.locale:'en',
}

const mutations = {
  setMe (state, data) {
    state.me = (data)?data.user:null
    state.key = api.getToken()
  },
  storeMe(state){
    state.stored = state.me
  },
  restoreMe(state){
    state.me = state.stored
  },
  entryFrom (state, path) {
    state.entryFrom = path
  },
  logout (state) {
    state.me = null
    api.setToken(null)
  },
  updateLocale (state) {
    if (state.me) {
      Quasar.i18n.set()
    }
  },
  addBookmark (state, video) {
    if (video) {
      state.me.bookmarks.push(video)
    }
  },
  addFavorite (state, video) {
    if (video) {
      state.me.favorites.push(video)
    }
  },
}

const actions = {
  entryFrom ({ commit }, path) {
    commit('entryFrom', path)
  },
  becomeTrainer({commit}, data) {
    return api.becomeTrainer(data)
      .then(data => {
        api.setToken (data.access_token)
        commit ("setMe", data)
      })
  },
  login ({ commit }, data) {
    return api.login (data)
      .then(data => {
        api.setToken (data.access_token)
        commit ("setMe", data)
        commit ("notify/setItems", (data.notifies)?data.notifies:[], {root:true})
      })
  },
  logout ({commit}) {
    return api.logout()
      .then(() => {
        commit('logout')
      })
      //dispatch('notify/getList')
  },
  register ({commit}, data) {
    return api.register(data)
      .then(data => {
        api.setToken (data.access_token)
        commit ("setMe", data)
      })
  },
  saveMe({commit}, data){
    return api.saveMe(data)
      .then(data => commit('setMe', data))
  },
  avatar({state}, path) {
    Vue.set(state.me, 'avatar', path)
  },
  wallpaper({state}, path) {
    Vue.set(state.me, 'wallpaper', path)
  },
  profile ({ commit, dispatch}) {
    return api.profile()
      .then( data => {
        commit("setMe", data)
        commit ("notify/setItems", (data.notifies)?data.notifies:[], {root:true})
      })
  },
  forgot ({ commit }, email) {
    return api.forgot({email})
  },
  restore({commit}, data) {
    return api.restore(data)
      .then( data => {
        api.setToken (data.access_token)
        commit ("setMe", data)
      })
  },
  updateLocale ({ commit }) {
    commit('updateLocale');
  },

  addFavorite ({commit}, data) {
    return api.addFavorite(data)
      .then((data) => {
        commit('addFavorite', data.video)
      })
  },
  addBookmark ({commit}, data) {
    return api.addBookmark(data)
      .then((data) => {
        commit('addBookmark', data.video)
      })
  },
  contactus({}, data) {
    return api.contactUs(data)
  },
  feedback({}, data) {
    return api.feedback(data)
  },
  getUserList({}, ) {
    return api.userList()
  },
  setUserRole({}, data) {
    return api.setUserRole(data)
  },
  sendEmail(commit, data) {
    return api.sendEmail(data)
  },
  setGuest({commit}){
    commit('storeMe')
    commit('logout')
    /*
    commit('setMe', {
      id: 0,
      followers: 0,
      role: 'user',
      email: 'guest@guest.com',
      avatar: '',
      locale: 'en',
      name: 'guest',

    })//*/
  },
  restoreMe({commit}){
    commit('restoreMe')
  }
}

export default {
  namespaced: true,
  state,
  getters,
  mutations,
  actions
}
