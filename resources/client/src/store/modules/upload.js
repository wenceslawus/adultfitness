import api from '../api/upload'
import exif from 'exif-js'

const state = {
  fileInput: null,
  func: null,
  callback: null,
}


const getters = {
  input: state => state.fileInput,
}

const mutations = {}

const actions = {
  uploadForm({commit}){
    return api.uploadForm()
  },
  setInputElement({state}, element) {
    state.fileInput = element
  },
  selectFile({state}, callback) {
    state.callback = callback
    state.func = 'uploadFile'
    state.fileInput.click()
  },
  selectAvatar({state}, callback) {
    state.callback = callback
    state.func = 'uploadAvatar'
    state.fileInput.click()
  },
  selectWallpaper({state}, callback) {
    state.callback = callback
    state.func = 'uploadWallpaper'
    state.fileInput.click()
  },
  selectImage({state}, callback) {
    state.callback = callback
    state.func = 'uploadImage'
    state.fileInput.click()
  },

  uploadCropImage({dispatch}, file){
    return new Promise((resolve, reject) => {
      if (!file.type.includes('image/')) {
        reject('err_file_type');
      }

      if (typeof FileReader === 'function') {
        const reader = new FileReader();

        reader.onloadend = () => {
          if(state.func == "uploadFile") {
            api.uploadFile(reader.result)
              .then(data => {
                if (typeof state.callback === 'function') {
                  state.callback(data.path)
                  state.callback = null
                }

                resolve();
              })
          } else if (state.func == 'uploadWallpaper') {
            api.uploadWallpaper(reader.result)
              .then(data => {
                if (typeof state.callback === 'function') {
                  state.callback(data.path)
                  state.callback = null
                }

                resolve();
              })
          } else {
            const img = new Image();
            img.onload = () =>{
              exif.getData(img, function(){
                let orientation = exif.getTag(this, 'Orientation')

                if(!orientation)orientation = 1;

                const dimension = {}
                let tempW = img.width
                let tempH = img.height

                if(file.maxSize) {
                  const w = (orientation < 5)?img.width:img.height;
                  const h = (orientation >= 5)?img.width:img.height;

                  tempW = 0
                  tempH = dimension.height / dimension.width * w;

                  if(tempH > h){
                    tempH = dimension.height
                    tempW = tempH / h * w
                  }else{
                    tempW = dimension.width
                    tempH = tempW / w * h
                  }
                } else {
                  dimension.width = img.width
                  dimension.height = img.height
                }

                if(!state.canvas)
                  state.canvas = document.createElement('canvas');

                state.canvas.width = dimension.width
                state.canvas.height = dimension.height

                tempW = Math.round(tempW);
                tempH = Math.round(tempH);


                var offsetW = Math.round((dimension.width-tempW)/2);
                var offsetH = Math.round((dimension.height-tempH)/2);

                var context = state.canvas.getContext("2d")

                switch(orientation){
                  case 1:
                    context.drawImage(img, offsetW, offsetH, tempW, tempH)
                    break;
                  case 2:
                    context.translate(tempW, 0);
                    context.scale(-1, 1);
                    context.drawImage(img, -offsetW, offsetH, tempW, tempH)
                    break;
                  case 3:
                    context.translate(tempW, tempH);
                    context.rotate(180 / 180 * Math.PI);
                    context.drawImage(img, -offsetW, offsetH, tempW, tempH)
                    break;
                  case 4:
                    context.translate(0, tempH);
                    context.scale(1, -1);

                    context.drawImage(img, offsetW, offsetH, tempW, tempH)
                    break;
                  case 5:
                    context.rotate(90 / 180 * Math.PI);
                    context.scale(1, -1);

                    context.drawImage(img, offsetH, offsetW, tempH, tempW)
                    break;
                  case 6:
                    context.rotate(90 / 180 * Math.PI);
                    context.translate(0, -tempW);

                    context.drawImage(img, offsetH, -offsetW, tempH, tempW)
                    break;
                  case 7:
                    context.rotate(270 / 180 * Math.PI);
                    context.translate(-tempH, tempW);
                    context.scale(1, -1);
                    context.drawImage(img, offsetH, -offsetW, tempH, tempW)
                    break;
                  case 8:
                    context.translate(0, tempH);
                    context.rotate(270 / 180 * Math.PI);
                    context.drawImage(img, offsetH, offsetW, tempH, tempW)
                    break;
                }

                if(state.func == "uploadImage") {
                  api.uploadImage(state.canvas.toDataURL("image/jpeg"))
                    .then(data => {
                      if (typeof state.callback === 'function') {
                        state.callback(data.path)
                        state.callback = null
                      }

                      resolve();
                    })
                } else {
                  api.uploadAvatar(state.canvas.toDataURL("image/jpeg"))
                    .then(data => {
                      if (typeof state.callback === 'function') {
                        state.callback(data.path)
                        state.callback = null
                      }

                      resolve();
                    })
                }
              })
            }

            img.src = reader.result;
          }
        }

        reader.readAsDataURL(file);
      } else {
        reject('err_no_support')
      }
    })
  }
}

export default {
  namespaced: true,
  state,
  getters,
  mutations,
  actions
}
