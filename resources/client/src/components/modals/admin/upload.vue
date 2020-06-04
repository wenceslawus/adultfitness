<template>
	<q-modal
    class="secondary"
    v-model="visibility"
    maximized
  >
    <q-modal-layout style="background-color:#111">
      <q-toolbar color="secondary" slot="header">
        <q-btn
          flat
          dense
		  type="a"
          v-close-overlay
          icon="keyboard_arrow_left"
          :label="$t('video.close')"
        />
        <q-toolbar-title v-text="$t('video.uploadVideo')"/>
      </q-toolbar>

      <!--q-toolbar color="secondary" slot="footer">
        <q-toolbar-title>
            <q-btn
              class="float-right"
              label="Save"
              color="primary"
              @click="saveVideo"
            />
        </q-toolbar-title>
      </q-toolbar-->

      <div class="layout-padding" style="background-color:#111">
        <div class="container">
          <div class="row">
						<div class="col-12">
							<div
								id="drop_zone"
								ref="dropZone"
								v-if="!loading && !doneUpload"
								@click="selectFile()"
								v-text="`Drop Files Here`"
								@drop="onDrop"
								@dragover="allowDrop"
							/>
							<q-progress
								v-else
								:percentage="doneUpload? 100: progress"
								:color="doneUpload?'green':'primary'"
								stripe
								animate
								height="45px"
							/>
							<!--q-btn class="full-width" color="primary" label="Browse..." /-->
							<input
								ref="browse"
								type="file"
								style="display: none;"
								@change="changed"
							/>
							<p v-if="!doneUpload" style="color:white">By submitting your videos to Adult Fitness, you acknowledge that you agree to our <q-btn type="a" flat class="q-px-sm" :to="{name: 'page.terms'}" color="primary" label="Terms of Service" />. Please be sure not to violate other`s copyright or privacy rights.</p>
							<p v-if="!doneUpload" style="color:white">Please allow up to 48 hours for your video to process. We will review it to ensure it does not violate our <q-btn type="a" flat class="q-px-sm" :to="{name: 'page.terms'}" color="primary" label="Terms of Service" />. Once the videos reviewed and processed you will be notified your video hes been published and available for viewing.</p>

							<p v-if="doneUpload" style="color:white;padding-top:10px;font-size: 20px;"><b style="color:green">Uploaded successfully.</b> Select continue to fill out video information</p>
							<p v-if="doneUpload" style="color:white; text-align:center"><q-btn type="a" class="q-px-sm" @click="$emit('close');doneUpload=false;startEdit(videoId)" color="primary" label="Continue" /></p>
						</div>
					</div>
        </div>

      </div>
    </q-modal-layout>
  </q-modal>
</template>

<script>
import {mapGetters, mapActions} from 'vuex'
import Vue from 'vue'
import vue2Dropzone from 'vue2-dropzone'
import 'vue2-dropzone/dist/vue2Dropzone.min.css'
import dropboxApi from 'dropbox'

//const accessToken = 'O5Z3svfWKxAAAAAAAAAAEFQ44Hwp7v_Q8ZHqvdKRH3mYKT_L8sfz8BEKnime3UTT'
const accessToken = 'xFf2iXpm-RAAAAAAAAABWWpO-Kycovxf3Wm5s7amXEj0bvG2cEdOf0SSW2NZXKDE'

function handleFileSelect(evt) {
	evt.stopPropagation()
	evt.preventDefault()
	let files = evt.dataTransfer ? evt.dataTransfer.files : evt.target.files
	let results = document.getElementById('results')
}

export default {
  props: {
    opened: {}
  },
  methods: {
    ...mapActions({
      save: 'video/save',
      cancel: 'video/cancel',
			getForm: 'upload/uploadForm',
			setVideo: 'video/makeVideo',
			startEdit: 'video/startEdit',
		}),
		selectFile(){
			this.$refs.browse.click()
    },

    shareFile(filename, size) {
      let xhr = new XMLHttpRequest();
      xhr.onerror = (e) => {
				this.loading = false
      }

      xhr.onload = (e) => {
        let response = JSON.parse(xhr.response)
        this.setVideo({
          filename,
          size,
          url: response.url
        })
      };

      xhr.open("POST", "https://api.dropboxapi.com/2/sharing/create_shared_link_with_settings", true);
			xhr.setRequestHeader('Authorization', 'Bearer ' + accessToken)
			xhr.setRequestHeader('Content-Type', 'application/json');
      xhr.send(`{"path":"${filename}","settings":{"access":{".tag":"viewer"}}}`)

    },

		sendfile(file) {
			if(!file) return

			this.loading = true
			let parts = file.name.split('.')
			let filename = '/f' + new Date().getTime() + '.' + parts[parts.length - 1]

			let xhr = new XMLHttpRequest();
			xhr.upload.onprogress = (event) => {
				this.progress = Math.round(event.loaded / event.total * 100);
			}

			xhr.onerror = (e) => {
				this.loading = false
			}
			xhr.onload = (e) => {
				this.loading = false
				this.doneUpload = true
        let response = JSON.parse(xhr.response)

        this.shareFile(filename, response.size)
			};

			xhr.open("POST", "https://content.dropboxapi.com/2/files/upload", true);
			xhr.setRequestHeader('Authorization', 'Bearer ' + accessToken)
			xhr.setRequestHeader('Content-Type', 'application/octet-stream');
			xhr.setRequestHeader('Dropbox-API-Arg', `{"path":"${filename}"}`)

			xhr.send(file);

			/*
			this.getForm()
				.then(form => {
					this.loading = true

					let formData = new FormData();
					formData.append('file_data', file);
					formData.append('submit', 'Submit');

					const params = form.upload.params

					var xhr = new XMLHttpRequest();
					xhr.open("POST", form.upload.link, true);

					xhr.upload.onload = () => {
						this.setVideo(form.upload.id)
							.then(() => {
								this.loading = false
								this.uploaded = true
							})
					}

					xhr.upload.onprogress = event => {
						this.progress = Math.round(event.loaded / event.total * 100);
					}

					xhr.upload.onerror = () => {
						this.loading = false
					}

					this.progress = 0
					xhr.send(formData);
				})//*/
		},
		changed(evt) {
			evt.stopPropagation()
			evt.preventDefault()
			let files = evt.dataTransfer ? evt.dataTransfer.files : evt.target.files

			if (files && files[0]) {
				this.sendfile(files[0])
			}
		},
		allowDrop(event){
			event.preventDefault()
		},
		onDrop(event){
			event.preventDefault();
			var files = event.dataTransfer.files

			if (files && files[0]) {
				this.sendfile(files[0])
			}
		},
  },
  computed: {
    ...mapGetters({
      locs: 'general/locales',
      editedVideo: 'video/editedVideo',
			groups: 'video/groups',
			videos: 'video/videos'
		}),
		videoId(){
			const ind = this.videos.length;
			const video = this.videos[ind-1]

			return video.id
		},
    visibility:{
      get () {
        return this.opened
      },
      set (newValue) {
        if(!newValue) {
          this.$emit('close')
        }
      }
    }
	},
  data () {
    return {
			loading: false,
			doneUpload: false,
			progress: 0,
    }
  },
}
</script>
<style>
#drop_zone{
	border: 2px dashed #bbb;
	-moz-border-radius: 5px;
	-webkit-border-radius: 5px;
	border-radius: 5px;
	padding-top: 60px;
	text-align: center;
	font: 20pt bold 'Helvetica';
	color: #bbb;
	height: 140px;
	margin-bottom: 10px;
}
</style>
