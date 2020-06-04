import http from './http'

export default {
  uploadAvatar (data) {
    return http.request('post', '/upload/avatar', {data})
  },
  uploadImage (data) {
    return http.request('post', '/upload/image', {data})
  },
  uploadWallpaper (data) {
    return http.request('post', '/upload/wallpaper', {data})
  },
  uploadFile (data) {
    return http.request('post', '/upload/file', {data})
  },
  uploadForm () {
    return http.request('post', '/upload/form')
  },
  NSSR(data) {
    return http.request('post', '/ssr', {data})
  }
}
