import http from "./http";

export default {
  child (parent) {
    return http.request('get', `/comment/child/${parent}`)
  },
  addComment(data) {
    return http.request('post', `/comment`, data, false)
  },
  update(data) {
    return http.request('put', `/comment/${data.id}`, data, false)
  },
  vote(data) {
    return http.request('post', `/comment/vote`, data, false)
  },
  del(data) {
    return http.request('delete', `/comment/${data.id}`, {}, false)
  },
}