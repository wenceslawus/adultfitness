import http from './http'
import Axios from 'axios';

export default {
  setToken (token) {
    if (token) {
      localStorage.setItem('access_token', token)
      http.defaults.headers.common['Authorization'] = `Bearer ${token}`
    } else {
      localStorage.removeItem('access_token')
      http.defaults.headers.common['Authorization'] = null
    }
  },
  getToken(){
    return localStorage.getItem('access_token')
  },
  register (data) {
    return http.request('post', '/register', data)
  },
  login (data) {
    return http.request('post', '/login', data);
  },
  forgot (data) {
    return http.request('post', '/forgot', data);
  },
  restore (data) {
    return http.request('post', '/restore', data);
  },
  logout () {
    return http.request('post', '/logout')
      .then(() => {
        localStorage.removeItem('access_token')
      })
  },
  profile () {
    const accessToken = localStorage.getItem('access_token')
    this.setToken(accessToken)

    if (accessToken) {
      return http.request('get', `/user`) //?api_token=${accessToken}
    } else {
      return Promise.reject({errors:['no access token']})
    }
  },

  saveMe(data) {
    return http.request('post', `/saveMe`, data)
  },

  addBookmark (data) {
    return http.request('post', `/video/addBookmark`, data, false)
  },
  addFavorite (data) {
    return http.request('post', `/video/addFavorite`, data, false)
  },
  contactUs(data){
    return http.request('post', '/email/contactus', data)
  },
  feedback(data){
    return http.request('post', '/email/feedback', data)
  },
  becomeTrainer(data) {
    return http.request('post', '/become-trainer', data)
  },
  userList(){
    return http.request('post', '/user/list')
  },
  setUserRole(data){
    return http.request('post', '/user/setRole', data, false)
  },
  sendEmail(data) {
    return http.request('post', '/user/sendMail', data)
  }
}
