import http from "./http";

export default {
  list () {
    return http.request('get', `/notify`, {}, false)
  },
  read(id) {
    return http.request('post', `/notify`, {id, state:1})
  },
  kill(id) {
    return http.request('post', `/notify`, {id, state:2})
  },
  markRread(){
    return http.request('put', `/notify`)
  }
}
