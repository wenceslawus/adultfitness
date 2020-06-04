import Vue from 'vue'
import Vuex from 'vuex'

import general from './modules/general'
import auth from './modules/auth'
import video from './modules/video'
import search from './modules/search'
import source from './modules/video_source'
import groups from './modules/groups'
import subscribe from './modules/subscribe'
import upload from './modules/upload'
import comment from './modules/comment'
import blog from './modules/blog'
import slider from './modules/slider'
import training from './modules/training'
import page from './modules/page'
import playlist from './modules/playlist'
import notify from './modules/notify'

Vue.use(Vuex)

const actions = {
  init ({dispatch}) {
    setInterval(() => dispatch('notify/getList'), 1000 * 60 * 5);
    //setInterval(() => dispatch('notify/getList'), 1000 * 10);

    return dispatch('video/index')
      .then(() => dispatch('auth/profile'))
      //.then(() => dispatch('notify/getList'))

  },
}

/*
 * If not building with SSR mode, you can
 * directly export the Store instantiation
 */

export default function (/* { ssrContext } */) {
  const Store = new Vuex.Store({
    modules: {
      general,
      video,
      search,
      auth,
      source,
      groups,
      subscribe,
      upload,
      comment,
      blog,
      slider,
      training,
      page,
      playlist,
      notify,
    },

    actions
  })

  return Store
}
