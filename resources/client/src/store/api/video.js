import http from "./http";

export default {
  sync () {
    return http.request('post', '/videos/sync')
  },
  getVideos () {
    return http.request('get', `/video`)
  },
  getVideosEdit () {
    return http.request('get', `/video/edit`)
  },
  setVisible(data) {
    return http.request('post', `/video/switch`, data)
  },
  playVideo (id) {
    return http.request('get', `/video/play/${id}`)
  },
  showVideo( data ) {
    return http.request('get', `/video/${data.id}`)
  },
  editVideo (id) {
    return http.request('get', `/video/${id}/edit`)
  },
  makeVideo(data) {
    return http.request('post', '/upload/setVideo', data)
  },
  setVideo(id) {
    return http.request('post', '/upload/setVideo', {upload_id: id})
  },
  saveVideo (data) {
    return http.request('put', `/video/${data.id}`, data.params)
  },
  showCategory (data) {
    return http.request('get', `/categories/${data.id}`)
  },
  getCategory (data) {
    return http.request('get', `/categories/${data.id}/edit`)
  },
  createCategory (category) {
    //return http
  },
  updateCategory (category) {
    return http.request('put', `/categories/${category.id}`, category);
  },

  vote (data) {
    return http.request('post', `/video/vote`, data, false)
  },
  addLinked (data) {
    return http.request('post', `/video/addLinked`, data)
  },

  index () {
    return http.request('get', '/index')
      /*.then(value => {
        let result = {}
        result.groups = value.groups

        result.top = makeGroup(4);
        result.recent = makeGroup(4);
      })//*/

  }
}
