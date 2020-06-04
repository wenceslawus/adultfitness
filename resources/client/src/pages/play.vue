<template>
  <q-page class="black flex" style="width:100%">
    <div class="container" v-if="video">
      <div class="row gutter-sm">
        <div class="col-xs-12 col-sm-9 play-page">
          <div class="container">
            <div class="row">
              <a-video-player
                style="width:100%"
                :video="video"
              />
            </div>
            <div class="row">
              <div class="col-xs-12 col-sm-4">
                <a-muscule-map
                  :groups="video.groups"
                />
              </div>
              <div class="col-xs-12 col-sm-8 video-desc">
                <a-user-marker
                  :rights="rights"
                  :author="video.author"
                  :created_at="video.created_at"
                  @editVideo="startEdit(video.id)"
                />
                <q-btn
                  type="a"
                  :label="$t(`video.${(showDescription)?'hideDesc':'showDesc'}`)"
                  @click="showDescription = !showDescription"
                  size="md"
                  class="full-width q-my-md"
                  color="color"
                  text-color="#494949"
                  :style="{ backgroundColor:'#1a1a1a', color:'#494949',  }"
                />
                <p
                  v-if="showDescription"
                  v-text="video.content"
                />
              </div>

            </div>

            <div class="row lt-sm">
              <a-video-preview
                v-for="(video, index) in video.linked"
                :key="index"
                :video="video"
              />
              <q-btn
                type="a"
                color="primary"
                v-if="me && me.role == 'admin'"
                class="full-width"
                :label="$t('video.addLinked')"
                @click="dialodAddLinked = true"
              />
            </div>

            <div class="row">
              <a-comment-make
                class="q-px-xs q-my-md"
                :needClose="false"
                :item="comment_params"
                avatar="/statics/profile_test.png"
              />
              <a-comments
                v-if="comments"
                class="q-pa-xs"
                :item="comment_params"
                :count="comment_count"
                :comments="comments"
              />
            </div>
          </div>
        </div>
        <div class="gt-xs col-sm-3" style="padding-top:30px">
          <p style="color:#7e7e7e">RELATED VIDEOS</p>
          <a-video-preview
            v-for="(video, index) in video.linked"
            :key="index"
            :video="video"
          />
          <q-btn
            type="a"
            color="primary"
            v-if="me && me.role == 'admin'"
            class="full-width"
            :label="$t('video.addLinked')"
            @click="dialodAddLinked = true"
          />
        </div>
      </div>
    </div>
    <d-add-linked
      :opened="dialodAddLinked"
      @close="dialodAddLinked = false"
    />
  </q-page>
</template>

<style lang="scss">
  .play-page {
    .video-desc {
      padding: 30px 0 30px 30px;
      p {
        color: #686868;
        font-size:13px;
        white-space: pre-wrap;
      }
    }
  }
</style>

<script>
import player from "components/video/player";
import preview from "components/video/preview";
import musculeMap from './../components/misc/muscule-map'
import userMarker from './../components/user/marker'
import commentMake from './../components/user/comment-make'
import comments from './../components/user/comment-list'
import dialogLinked from './../components/modals/linkVideo'

import {mapGetters, mapActions} from 'vuex'

export default {
  components: {
    'a-video-player': player,
    'a-video-preview': preview,
    'a-muscule-map': musculeMap,
    'a-user-marker': userMarker,
    'a-comment-make': commentMake,
    'a-comments': comments,
    'd-add-linked': dialogLinked,
  },
  mounted () {
    this.reloadPage(this.$router.currentRoute)
  },
  watch: {
    '$route' (to, from) {
      this.reloadPage(to)
    },
  },
  methods: {
    ...mapActions({
      showVideo: 'video/selectVideo',
      startEdit: 'video/startEdit',
      setComments: 'comment/setComments',
    }),
    reloadPage (route) {
      const v_id = route.params.id

      this.showVideo(v_id)
        .then(() => {
          this.video = this.currentVideo
          if (this.video) {
            this.setComments({
              comments: this.video.comments,
              count: this.video.comment_count,
            })
          } else {
            this.setComments({
              comments: null,
              count: null,
            })
          }
        }).catch((e) => {
          if(e.data.error == 'need_pay') {
          }
          //this.$router.push('/')
        })
    },
    addLinkeed() {

    },
    showEditDialog() {
    },
  },
  computed: {
    ...mapGetters({
      currentVideo: 'video/current',
      rights: 'auth/rights',
      comments: 'comment/comments',
      comment_count: 'comment/count',
      me: 'auth/me'
    }),
    comment_params() {
      return {
        item_id: this.video.id,
        item_type: 'video',
      }
    }
  },
  data() {
    return {
      dialodAddLinked: false,
      showDescription: false,
      video: '',
    }
  },

}
</script>
