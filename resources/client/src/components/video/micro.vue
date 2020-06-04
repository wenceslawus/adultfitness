<template>
  <q-card
    @click.native="$emit('click')"
    class="player-preview black-shadow"
  >
    <q-card-media style="minHeight: 145px">
      <div
        class="video-pic"
        :class="{activated: this.video.enabled, noselected}"
        :style="{backgroundImage: `url('${video.link_preview}')`}"
      />
      <div class="shadow"></div>

      <div class="duration" v-text="miniOverlay(video.duration)" />
    </q-card-media>

    <q-card-title>
      <span class="text-overflow">{{ video.title }}</span>
    </q-card-title>
  </q-card>
</template>

<style lang="stylus">
@import '~variables'

.player-preview {
  color: white;
  .q-card-container {
    padding: 16px 5px;
    .q-card-title {
      font-size: 15px;
      line-height: 1.7rem;
      .video-desc {
        display: flex;
        width:100%;
        color:#969696;
            justify-content: space-between;
        div {
          display: flex;
        }
        span {
          padding-left: 10px;
          color: $primary;
          line-height: 23px;
          &.gray {
            color: #515151;
          }
        }
      }
    }
  }
}
.noselected {
    filter: grayscale(0);
}
</style>

<script>
import { openURL } from 'quasar'
import {mapGetters} from 'vuex'

export default {
  props:{
    video: { },
  },
  computed:{
		...mapGetters({
      currentvideo: 'video/current',
		}),
		noselected(){
      if(!this.currentvideo) return

      return !this.currentvideo.linked.find(item => {
				return item.id == this.video.id
			})

      /*return this.video.allVideos.find((item) => {
        return this.currentvideo.id == video.id
      })//*/
    }
  },
  mounted() {
      console
  },
  methods: {
    goTo (id) {
      //openURL();
    },
    miniOverlay (seconds) {
        let secs = seconds % 60;
        let min = (seconds - secs) / 60;

        if (min < 10) min = '0' + min
        if (secs < 10) secs = '0' + secs

        return `HD ${min}:${secs}`
    }
  }
}
</script>
