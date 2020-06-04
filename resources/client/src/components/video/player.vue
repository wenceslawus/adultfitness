<template>
  <q-card class="shadow-black my-player">
    <q-card-media>
      <div class='embed-container'>
        <img
          itemprop="image"
          v-if="!video || !video.link || !me || (me && me.role == 'guest')"
          @click="clickPay"
          alt="nude training"
          :src="video && video.link_preview"
          style="cursor:pointer"
        />
        <!--player
          v-else
          ref="player"
          v-show="autoplay"
          class="my-video"
          :video-id="link"
          player-width="100%"
          :options="options"
          playerReady="true"
          :autoplay="autoplay"
        /-->
        <iframeContainer
          v-if="link && me && me.role != 'guest'"
          :src="link"
          allowtransparency="true"
          frameborder="0"
          scrolling="no"
          allow="true"
          allowfullscreen="true"
        />
      </div>
    </q-card-media>
    <q-card-actions>
      <div class="container">
        <div class="row" v-if="video">
          <div class="col-xs-12 col-sm-12 col-lg-4">
            <h4>{{ video.title }}</h4>
            <p v-text="$tc('video.view', video.views, {n: video.views} )" />
          </div>

          <div class="col-xs-12 col-sm-12 col-lg-8 smaller-btn">
            <div
              style="flex: 1 1 33.332%; display: flex; position:relative;"
            >
              <q-btn
                type="a"
                style="width: 50%"
                icon="thumb_up"
                :label="$tc('video.like', video.likes, {n: formatNumber(video.likes)})"
                :loading="sendLike"
                :class="{lighted: video.iLike}"
                text-color="grey-8"
                @click="vote('like')"
                :disable="!me"
                flat
              >
                <q-spinner-facebook slot="loading" size="20px" />
              </q-btn>
              <q-btn
                type="a"
                style="width:50%"
                icon="thumb_down"
                :label="$tc('video.dislike', video.dislikes, {n: formatNumber(video.dislikes)})"
                :loading="sendDislike"
                :class="{lighted: video.iDislike}"
                text-color="grey-8"
                @click="vote('dislike')"
                :disable="!me"
                flat
              >
                <q-spinner-facebook slot="loading" size="20px" />
              </q-btn>
              <q-progress
                style="position:absolute;bottom: -8px; width: 100%"
                :color="(video.likes > video.dislikes)?'primary':'negative'"
                :percentage="rate"
              />
            </div>
            <q-btn
              icon="save"
              type="a"
              :label="$t('video.save')"
              :loading="sendBookmark"
              color="#313131"
              text-color="grey-8"
              @click="saveTo('save')"
              :disable="!me"
              flat
            >
              <q-spinner-facebook slot="loading" size="20px" />
            </q-btn>

            <q-btn
              icon="send"
              type="a"
              :label="$t('video.share')"
              color="#313131"
              text-color="grey-8"
              @click="share"
              flat
            />

            <q-btn
              icon="star"
              type="a"
              :label="$t('video.addToFav')"
              :loading="sendFavorite"
              color="#313131"
              text-color="grey-8"
              @click="plist = true"
              :disable="!me"
              flat
            >
              <q-spinner-facebook slot="loading" size="20px" />
            </q-btn>

            <q-btn
              type="a"
              icon="file_copy"
              :label="$t('video.copy')"
              color="#313131"
              text-color="grey-8"
              @click="copyLink"
              :disable="!me"
              flat
            />
          </div>
          <div class="col-xs-12">

          </div>
        </div>
      </div>
    </q-card-actions>
    <m-playlist
      v-if="video"
      :opened="plist"
      :video_id="video.id"
      @close="plist = false"
    />
  </q-card>
</template>

<style lang="stylus">
  .my-player {
    .vtop {
      padding-bottom: 56.25%;
      height: 0;
      overflow: hidden;
      position: relative;

      .my-video {
        position: relative;
        padding-bottom: 200%;
        transform: translateY(-35.95%);

        iframe {
          position: absolute;
          top: 0;
          left: 0;
          width: 100%;
          height: 100%;
        }
      }
    }
    .q-card-actions {
      background-color: #111;
      h4 {
        color: #fff;
        margin: 10px;
        font-size: 18px;
        text-transform: uppercase;
        line-height: 28px;
        /*
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;*/
      }
      p {
        color:#727272;
        margin: 10px
      }
      .likes{
        button {
          width: 100%;
        }
        margin: 20px 0;
      }
      .q-progress {
        margin: 10px 0;
      }
      .other-btns {
        margin: 20px 10px;
        button {
          width:100%;
          margin: 0 0 5px 0;
        }
        @media screen and (min-width: 992px) {
          &.to-right {
            margin-top: 0;
            display: flex;
            float: right;
            button {
              margin-left: 20px;
              width: 140px;
            }
          }
        }
      }
      .description {
        background: #000;}
    }
  }

  .btn-nowrap {
    .q-btn-inner {
      flex-wrap: nowrap;
    }
  }

  .smaller-btn {
    display: flex;
    .q-btn {
      margin-left: 0 !important;
      font-size: 12px;
      margin-top: 10px;
      margin-bottom: 10px;
      width: 72px;
      flex-grow: 1;
      @media screen and (max-width:425px) {
        width: 16.6666%;
        .q-btn-inner div{
          font-size: 8px;
        }
      }
      .q-icon {
        margin: 5px 0;
        width: 100%;
      }
      .q-btn-inner div{
        white-space: nowrap;
      }
      &.lighted .q-icon {
        color: #ff5600;
      }
    }
  }
  .embed-container {
    position: relative;
    padding-bottom: 56.25%;
    height: 0;
    overflow: hidden;
    max-width: 100%;
    height: auto;
    iframe, object, embed, img {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
    }
  }
</style>


<script>
//import { vueVimeoPlayer } from 'vue-vimeo-player'
import iframeContainer from 'vue-friendly-iframe'
import playlist from '../modals/list'
import {mapGetters, mapActions} from 'vuex'

export default {
  components: {
    'iframeContainer': iframeContainer,
    //'player': vueVimeoPlayer,
    'm-playlist': playlist
  },
  computed:{
    ...mapGetters({
      video: 'video/current',
      me: 'auth/me',
    }),
    rate () {
      const summ = this.video.likes + this.video.dislikes
      if (summ == 0) {
        return 0
      } else {
        const actual = (this.video.likes > this.video.dislikes)?this.video.likes:this.video.dislikes

        return actual / summ * 100;
      }
    },
    link() {
      if(this.video)
        return this.video.link
    },
    options() {
      const param = (this.video)?this.video.link:'305861226/9c8ef570db'
      return {
        color: 'ff5600',
        url: `https://vimeo.com/${param}`
      }
    },
  },
  mounted(){
    //this.options.url = `https://vimeo.com/${this.video.link}`
  },
  watch: {
    video (newValue) {
      //this.options.url = `https://vimeo.com/${this.video.link}`
    }
  },
  methods: {
    ...mapActions({
      sendVote: 'video/vote',
      attach: 'playlist/attach',
      share: 'general/share',
      play: 'video/play',
      _copyLink: 'video/copyLink',
      showPay: 'subscribe/showDialog',
      entryFrom: 'auth/entryFrom',
    }),
    formatNumber (num) {
      if (num) {
        return num > 999 ? (num/1000).toFixed(1) + 'k' : num
      } else {
        return '0';
      }
    },
    copyLink () {
      this._copyLink( window.location.href )
        .then(() => {
          this.$q.notify({
            type: 'positive',
            message: this.$t('video.link_copied')
          })
        })
    },
    saveTo (type) {
      if (type == 'save') {
        this.sendBookmark = true

        this.attach({
          video_id: this.video.id,
          playlist_id: -1
        })
        .then(() => {
          this.sendBookmark = false
        })
        .catch(() => {
          this.sendBookmark = false
        })

      } else {
        /*this.sendFavorite = true
        this.attach({
          id: this.video.id
        })
        .then(() => {
          this.sendFavorite = false
        })
        .catch(() => {
          this.sendFavorite = false
        })//*/
      }

    },
    vote (mode) {
      if (mode == 'like') {
        this.sendLike = true
      } else {
        this.sendDislike = true
      }

      this.sendVote({
        id: this.video.id,
        type: mode,
        item: 'vi'
      })
      .then(() => {
        this.sendLike = false;
        this.sendDislike = false;
      })
      .catch(() => {
        this.sendDislike = false;
        this.sendLike = false
      })
    },
    clickPay(){
      this.showPay(true)

      /*if(this.me && !this.me.subscribe){
        this.showPay()
      } else {
        this.entryFrom(this.$router.history.current.path)
        this.$router.push({name: 'register'})
      }//*/
    }
  },
  data () {
    return {
      playing: true,
      autoplay: true,
      sendLike: false,
      sendDislike: false,
      sendFavorite: false,
      sendBookmark: false,
      plist: false,
      videoSrc: '//iplayerhd.com/player/video/3c7a2829-f062-4548-aa02-ea5983b855b0',
      //framecode: false,
    }
  }
}
</script>
