import http from "./http";

export default {
  loadItems() {
    return http.request('get', `/programs`)
  },
  editItem(id) {
    return http.request('get', `/programs/${id}/edit`)
  },
  deleteItem(id) {
    return http.request('delete', `/programs/${id}`)
  },
  getItem(id) {
    return http.request('get', `/programs/${id}`)
  },
  saveItem(data) {
    return http.request('put', `/programs/${data.id}`, data)
  },
  getTrainer(id) {
    return http.request('get', `/trainer/${id}`)
  },
  follow(data) {
    return http.request('post', `/follow-trainer/${data.id}`, data)
  },
}
