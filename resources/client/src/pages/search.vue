<template>
  <q-page class="flex ">
    <div class="container overflow-hidden">
      <a-video-group
        class="no-top-padding"
        :title="search"
        :items="list"
        customIcon="sent-mail"
      />
    </div>
  </q-page>
</template>

<script>
import vgroup from 'components/video/group';
import { mapGetters } from 'vuex'
export default {
  components: {
    'a-video-group': vgroup,
  },
  computed: {
    ...mapGetters({
      list: 'search/items',
      phrase: 'search/searchPhrase'
    }),
    search() {
      if(this.list.length){
        return `Video with phrase "${this.phrase}"`
      } else {
        return 'Video not found'
      }
    }
  },
}
</script>
