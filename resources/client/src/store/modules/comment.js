import api from '../api/comment'
import Vue from 'vue'

const state = {
  comments: [],
  count: 0,
}

const getters = {
  count: state => state.count,
  comments: state => state.comments,
}

const mutations = {
  addComment(state, data){
    const current = state.comments.find((each)=> {
      return data.id == each.id
    })

    const index = state.comments.indexOf(current)
    current.childs = data.childs

    Vue.set(state.comments, current, index)
    state.count++
  },

  setComments(state, data) {
    state.comments = data.comments
    state.count = data.count
  },

  setCurrent(state, item) {
    let index = state.comments.findIndex(each => each.id == item.id)

    if(index === -1) {
      state.comments.forEach(each => {
        let index = each.childs.findIndex(each => each.id == item.id)
        if(index !== -1){
          Vue.set(each.childs, index, item)
        }
      })
    } else {
      item.childs = state.comments[index].childs
      Vue.set(state.comments, index, item)
    }

  },
  pushComment(state, data) {
    const current = state.comments.find((each)=> {
      return data.parent == each.id
    })

    if(current) {
      current.childs.unshift(data.item)
    } else
      state.comments.unshift(data.item)
  },
  removeComment(state, id) {

    state.comments.forEach((el, ind) => {
      if(el.id == id){
        state.comments.splice(ind, 1)
      } else {
        if (el.childs.length) {
          el.childs.forEach((elc, indc) => {
            if(elc.id == id){
              el.childs.splice(indc, 1)

              Vue.set(state.comments, ind, el)
            }
          })
        }
      }
    })
  }
}

const actions = {
  child({commit}, parent) {
    return api.child(parent)
      .then(response => {
        commit('addComment', {
          id: parent,
          childs: response.childs
        })
      });
  },

  setComments({commit}, data) {
    commit('setComments', data)
  },

  addComent({commit}, data){
    return api.addComment(data)
      .then(response => {
        commit('pushComment', {
          parent: data.parent_id,
          item: response.comment
        })
      })
  },
  vote ({commit}, data) {
    return api.vote(data).then((data) => {
      commit('setCurrent', data.item)
    })
  },
  update ({commit}, data) {
    return api.update(data)
      .then((data) => {
        commit('setCurrent', data.item)
      })
  },
  del({commit}, id) {
    return api.del(id).then((data) => {
      commit('removeComment', id.id)
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
