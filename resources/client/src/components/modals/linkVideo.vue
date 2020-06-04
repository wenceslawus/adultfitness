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
          type="a"
          dense
          v-close-overlay
          icon="keyboard_arrow_left"
          :label="$t('video.close')"
        />
        <q-toolbar-title v-text="$t('video.linkNewFile')"/>
      </q-toolbar>

      <q-toolbar slot="header">
        <q-search 
          class="full-width"
          inverted 
          v-model="filter" 
          color="none"
        />
      </q-toolbar>

      <q-toolbar color="secondary" slot="footer">
        <q-toolbar-title>
          
        </q-toolbar-title>
      </q-toolbar>

      <div class="layout-padding" style="background-color:#111">
        <div class="container">
          <div class="row gutter-sm">
            <div 
              v-for="(video) in filteredVideo"
              :key="video.id"
              class="col-xs-6 col-sm-3 - col-lg-2"
            >
              <a-video-micro
                class=""
                :video="video"
                @click="link(video)"
              />
            </div>
          </div>
        </div>
        
      </div>
    </q-modal-layout>
  </q-modal>
</template>

<script>
import videoMicro from './../video/micro'
import {mapGetters, mapActions} from 'vuex'

export default {
  components: {
    'a-video-micro': videoMicro,
  },
  props: {
    opened: {}
  },
  mounted () {
    this.getVideos();
  },
  methods: {
    ...mapActions({
      getVideos: 'video/getVideos',
      addLinked: 'video/addLinked',
    }),
    link (video) {
      this.addLinked({
        id: this.video.id,
        linked: video.id
      })
    }
  },
  computed: {
    ...mapGetters({
      allVideos: 'video/videos',
      video: 'video/current',
    }),

    filteredVideo () {
      const filter = this.filter && this.filter.toLowerCase()

      if (filter) {
        let data = this.allVideos.filter(item => {
          //const locale = item.locales[this.locale]
          return Object.keys(item).some(function (key) {
            return String(item[key]).toLowerCase().indexOf(filter) > -1
          })
        })
        return data 
      } else {
        return this.allVideos
      }
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
      filter: '',
    }
  },
}
</script>

