import api from '../api/upload'
const state = {
  locales:[
    {
      label: 'English',
      value: 'en'
    },
    {
      label: 'Русский',
      value: 'ru'
    },
  ],
  isShare: false,
  showDrawer: false,
  showNotify: false,
  ssr: false,
}


const getters = {
  locales: state => state.locales,
  locale: state => {
    return 'en';
  },
  isShare: state => state.isShare,
  showDrawer: state => state.showDrawer,
  showNotify: state => state.showNotify,
  ssr: state => state.ssr,
}
const mutations = {
  setSSRState (state, value) {
    state.ssr = value
  },
}
const actions = {
  search({commit}, data) {
    alert(data)
  },
  toggleDrawer({state}, data){
    if(data && typeof data == "object"){
      state.showDrawer = !state.showDrawer
    } else if( data === false ) {
      state.showDrawer = false
    }

    if(!state.showDrawer) {
      state.showNotify = false
    }
  },
  toggleNotify({state}, data){
    if(data && typeof data == "object"){
      state.showNotify = !state.showNotify
    } else if( data === false ) {
      state.showNotify = false
    }
  },
  share({state}) { state.isShare = true},
  cancelShare({state}) { state.isShare = false},
  setSSR({commit},state){
    commit('setSSRState', state)
  },
  pushNSSR({}, link){
    const app = document.getElementById('q-app')
    return api.NSSR({
      link,
      content: app.innerHTML
    }).then(() => {
      //commit('setSSRState', false)
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
