import axios from 'axios';
import auth from './auth'
import {Loading, QSpinnerPuff} from 'quasar';

const serverHost  = "http://fitness.loc/api";
// const serverHost  = "http://localhost:8000/api";
//const serverHost = "http://adultfitness.test/api";

const http = axios.create({
  baseURL: serverHost,
  responseType: 'json',
})

http.request = function (method, url, data, showLoader = true) {
  if (showLoader) {
    Loading.show({
      spinner: QSpinnerPuff,
      spinnerSize: 250,
      spinnerColor: 'white',
    })
  }

  return new Promise((resolve, reject) => {
    http({
      method,
      url,
      data,
    })
      .then(result => {
        Loading.hide();
        resolve(result.data)
      })
      .catch(error => {
        Loading.hide();

        if (error.response && error.response.data.error == "AuthenticationException") {
          if (url != '/notify' && url != '/video/playlists') {
            auth.setToken(null)
            window.location.href = "/login"
          }
        }

        if (error.response) {
          reject({
            data: error.response.data,
            status: error.response.status,
            headers: error.response.headers,
          })
        } else if (error.request) {
          reject({
            request: error.request
          })
        } else {
          reject({
            message: error.message
          })
        }
      })
  })
}

//axios.baseURLO = serverHost;

export default http;
