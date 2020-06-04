<template>
  <q-card class="q-pa-sm compact">
    <q-card-media>
      <div
        class="video-pic"
        :class="{activated: this.video.enabled}"
        :style="{backgroundImage: `url('${video.link_preview}')`}"
      />
      <q-btn
        v-if="isAdmin || me.id == video.author.id"
        type="a"
        class="visibility"
        :icon="(video.enabled)?'visibility':'visibility_off'"
        round
        dense
        @click.stop.prevent='switchVisible'
      />

      <q-btn
        class="visibility payed"
        type="a"
        icon="attach_money"
        round
        dense
        :visible="video.payed"
      />
      <q-btn
        v-if="isAdmin || me.id == video.author.id"
        type="a"
        class="visibility edit"
        icon="edit"
        round
        dense
        @click.stop.prevent='clickByVideo'
      />
    </q-card-media>
    <q-card-title class="q-py-none q-px-sm">
      <span class="text-overflow" v-text="video.title" />
    </q-card-title>
  </q-card>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'

export default {
  data () {
    return {
      locale: 'ru',
      video_id: '',
    }
  },
  computed:{
    ...mapGetters({
      isAdmin: 'auth/isAdmin',
      me: 'auth/me',
    })
  },
  methods: {
    ...mapActions({
      setVisible: 'video/setVisible',
      startEdit: 'video/startEdit',
    }),
    switchVisible(){
      this.setVisible({
        id: this.video.id,
        visible: !this.video.enabled,
      })
    },
    clickByVideo() {
      this.startEdit(this.video.id)
    },
  },
  props: {
    video: {}
  },
  mounted () {
  }
}
</script>

<style>
  .compact .q-card-title{
    width: 100%;
  }
  .compact .q-card-media {
    border:1px solid #353535;
    min-height: 145px;
  }
  .compact .q-card-media .q-btn{
    position: absolute;
    top: 5px;
    left: 5px;
  }
  .compact .q-card-media .q-btn.payed{
    left: unset;
    right: 5px;
  }
  .compact .q-card-media .q-btn.edit{
    top: 50px
  }
  
</style>
