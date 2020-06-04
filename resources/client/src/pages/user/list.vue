
<template>
  <q-page class="black flex">
    <div class="container overflow-hidden">
      <div class="row q-pa-sm items-center ">
        <q-select
          v-if="list && list.length"
          style="flex-grow:2"
          float-label="Select playlist"
          dark
          v-model="selectedList"
          :options="list"
        />
      </div>
      <a-video-group
        v-if="selectedList && videos.length"
        :title="$t('video.playlists')"
        :items="videos"
        icon="star"
        canRemove="true"
        @remove="remove"
      />
    </div>
  </q-page>
</template>

<style>
</style>

<script>
import videoGroups from 'components/video/group'
import { mapGetters, mapActions } from 'vuex'
export default {
  name: 'index',
  components: {
    'a-video-group': videoGroups,
  },
  computed: {
    ...mapGetters({
      user: 'auth/me',
      playlists: 'playlist/list'
    }),
    list() {
      return this.playlists
        .filter(item => item.default != 1)
        .map(item => {
          return {
            value: item.id,
            label: item.name,
          }
      })
    },
    videos() {
      let item = this.playlists.find(item => item.id == this.selectedList)
      return item.videos
    },
  },
  methods: {
    ...mapActions({
      getList: 'playlist/getList',
      detach: 'playlist/detach',
    }),
    remove(video_id){
      this.detach({video_id, playlist_id: +this.selectedList})
    },
  },
  watch:{
  },
  mounted() {
    this.getList()
  },
  data() {
    return {
      selectedList: null,
    }
  },
}
</script>
