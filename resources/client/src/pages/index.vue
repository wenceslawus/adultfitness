
<template>
  <q-page class="flex ">
    <div class="container overflow-hidden">
      <a-video-group
        class="no-top-padding"
        v-if="recentVideos"
        :title="$t('general.latest')"
        :items="recentVideos"
        :linkToAll="{name: 'group', params:{id:'recent'}}"
        customIcon="sent-mail"
      />
      <a-video-group
        v-if="topVideos"
        :title="$t('general.popular')"
        :items="topVideos"
        icon="star"
        :linkToAll="{name: 'group', params:{id:'popular'}}"
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
  mounted () {
    this.init()

  },
  methods: {
    ...mapActions({
      init: 'video/index'
    }),
  },
  computed: {
    ...mapGetters({
      topVideos: "video/top",
      recentVideos: "video/recent",
    })
  },
  components: {
    'a-video-group': videoGroups,
  },
  data() {
    return {
      
    }
  },
}
</script>
<style>
  .no-top-padding .block-divider {
    margin-top: 0px;
  }
</style>
