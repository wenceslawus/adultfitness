import http from "./http";

export default {
  search (text) {
    return http.get(`/search?text=${text}`)
  },
}