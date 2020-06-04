<template>
  <q-page class="flex flex-start">
    <div class="container overflow-hidden">
      <q-card class="text-primary black-shadow q-ma-sm">
        <q-toolbar color="secondary">
          <q-toolbar-title>
              <q-btn
                type="a"
                class="float-right"
                label="Upload"
                color="primary"
                @click="opened = true"
              />
          </q-toolbar-title>
        </q-toolbar>

        <q-card-actions>
          <q-field
            color="secondary"
            icon="video_library"
            class="full-width"
          >
            <q-input
              dark
              v-model="filter"
              :float-label="$t('video.filter')"
            />
          </q-field>
          <q-field
            v-if="isAdmin"
            color="secondary"
            icon="folder_shared"
            class="full-width"
          >
            <q-select
              dark
              v-model="author"
              :float-label="$t('video.author')"
              :options="authors"
            />
          </q-field>
        </q-card-actions>
        <q-card-main>
          <div class="row">
            <a-video-compact
              class="col-12 col-sm-6 col-md-3"
              v-for="video in filteredData"
              :key="video.id"
              :video="video"
              style="cursor: pointer;"
              @click.native="clickByVideo(video)"
            />
          </div>
        </q-card-main>
        <!--q-card-actions class="block text-right">
          <q-btn
            @click="sync"
            :label="$t('video.sync')"
          />
        </q-card-actions-->
      </q-card>
    </div>
    <a-upload
      :opened="opened"
      @close="opened=false"
    />
  </q-page>
</template>

<script>
  import {mapGetters, mapActions} from 'vuex'
  import compactVideo from 'components/video/compact'
  import upload from 'components/modals/admin/upload'
  export default {
    components: {
      'a-video-compact': compactVideo,
      'a-upload': upload,
    },
    data () {
      return {
        filter: null,
        author: null,
        opened: false,
      }
    },
    computed: {
      ...mapGetters({
        videos: 'video/videos',
        locale: 'general/locale',
        isAdmin: 'auth/isAdmin',
        me: 'auth/me',
      }),
      filteredData () {
        const filter = this.filter && this.filter.toLowerCase()
        const author = (this.isAdmin)?+this.author:this.me.id

        if (filter || author) {
          return this.videos.filter(item => {
            return item.author && (!filter || (item.title.toLowerCase().indexOf(filter) > -1)) &&
              (!author || item.author.id == author)
          })

        } else {
          return this.videos
        }
      },
      authors(){
        let res = this.videos.reduce((result, item) => {
          if(!result[item.id]){
            if(item.author){
              result[item.author.id] = {
                label: item.author.name,
                value: item.author.id
              }
            }
          }

          return result
        }, [])

        return res.filter(item => item)
      }
    },
    mounted () {
      if(!this.me || this.me.role == 'user')
        this.$router.back()
      else
        this.videoList()

    },
    methods: {
      ...mapActions({
        syncVideo: 'video/sync',
        videoList: 'video/videoListEdit',
        startEdit: 'video/startEdit',
      }),
      sync () {
        this.syncVideo ()
      },
      clickByVideo(video) {
        if(video.enabled) {
          this.$router.push({name: 'play', params:{ id: video.id }})
        } else {
          this.startEdit(video.id)
        }
      },
    }
  }
</script>
