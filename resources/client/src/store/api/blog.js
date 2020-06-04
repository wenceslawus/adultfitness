import http from "./http";

export default {
  loadCategories() {
    return http.request('get', `/blogs/category`)
  },
  getList(filter) {
    return http.request('post', `/blogs/filter`, {
      categories: filter.categories,
      times: filter.times
    }, true)
  },
  editCategory(id) {
    return http.request('get', `/blogs/category/${id}/edit`)
  },
  saveCategory(data) {
    let id = (data.id)?data.id:'new'
    return http.request('put', `/blogs/category/${id}`, data)
  },
  getRecord(id) {
    return http.request('get', `/blogs/record/${id}`)
  },
  editRecord(id) {
    return http.request('get', `/blogs/record/${id}/edit`)
  },
  saveRecord(data) {
    let id = (data.id)?data.id:'new'
    return http.request('put', `/blogs/record/${id}`, data)
  }
}