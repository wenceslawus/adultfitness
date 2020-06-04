import http from "./http";

export default {
  getPage (link) {
    return http.get(`/page/${link}`)
  },
}