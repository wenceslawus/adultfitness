import Vue from 'vue'
import VueRouter from 'vue-router'

import routes from './routes'
import storeFactory from './../store'
import ga from 'src/plugins/analytics.js'

const sessionId = 'UA-127244060-2'

Vue.use(VueRouter)

/*
 * If not building with SSR mode, you can
 * directly export the Router instantiation
 */

export default function (/* { store, ssrContext } */) {
  const Router = new VueRouter({
    scrollBehavior: () => ({ y: 0 }),
    routes,

    // Leave these as is and change from quasar.conf.js instead!
    // quasar.conf.js -> build -> vueRouterMode
    mode: process.env.VUE_ROUTER_MODE,
    base: process.env.VUE_ROUTER_BASE
  })

  Router.afterEach((to, from) => {
    ga.logPage(to.path, to.name, sessionId)
  })

  Router.beforeEach((to, from, next) => {
    const store = storeFactory();
    if(to.path != "/login") {
      store.dispatch('auth/entryFrom', to.path)
    }

    var needAccess = !to.matched.some(record => record.meta.freeAccess)
    var authorised = store.state.auth.me

    if(!needAccess){ // Auth not required
      next()
    }else{
      if(authorised){
        next()
      }else{
        // not authorised. push to login screen
        next('/login')
      }
    }
  })

  return Router
}
