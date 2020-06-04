import http from "./http";

export default {
    create (card) {
        return http.post(`/subscribe/`, {cardId: card})
    },
    getPayLink() {
        return http.request('post', `/subscribe/link`)
    },
}