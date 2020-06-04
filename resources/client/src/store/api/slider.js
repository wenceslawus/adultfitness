import http from "./http";

export default {

  get() {
    return http.request('get', `/all-sliders`) //endpoint should be not under autorization
  },
  show(id) {
    return http.request('get', `/sliders/${id}`)
  },
  store(data) {
    return http.request('post', `/sliders`,
      {
        title: data.title,
        body: data.body,
        image: data.image,
        program: data.program,
      }
    )
  },
  remove(id){
    return http.request('delete', `/sliders/${id}`)
  },
  update(data){
    return http.request('put', `/sliders/${data.id}`, data)
  }

}
