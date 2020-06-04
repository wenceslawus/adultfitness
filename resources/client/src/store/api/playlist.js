import http from "./http";

export default {
  getList () {
    return http.request('get', `/video/playlists`)
  },
  createList(data) {
    return http.request('post', `/video/playlists/new`, data)
  },
  updateList(data) {
    return http.request('post', `/video/playlists/edit`, data)
  },
  deleteList(id) {
    return http.request('post', `/video/playlists/${id}/delete`)
  },

  attach(data) {
    return http.request('post', `/video/playlists/attach`, data, false)
  },
  detach(data) {
    return http.request('post', `/video/playlists/detach`, data, false)
  },
}
