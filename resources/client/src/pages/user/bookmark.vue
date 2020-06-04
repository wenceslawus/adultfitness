
<template>
  <q-page class="black flex">
    <div class="container overflow-hidden" v-if="user">
      <a-video-group
        icon="star"
        :title="$t('video.bookmark')"
        :items="playlist.videos"
        :canRemove="true"
        @remove="remove"
      />
    </div>
  </q-page>
</template>

<style>
</style>

<script>
import videoGroups from 'components/video/group'
import {mapGetters, mapActions} from 'vuex'
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
    playlist() {
      let list = this.playlists.filter(item => item.default == 1)

      return (list.length)?list[0]:{videos: []}
    }
  },
  methods:{
    ...mapActions({
      getList: 'playlist/getList',
      detach: 'playlist/detach',
    }),
    remove(video_id){
      this.detach({video_id, playlist_id:-1})
    }
  },
  data() {
    return {
    }
  },
  mounted() {
    this.getList()
  }
}
</script>
