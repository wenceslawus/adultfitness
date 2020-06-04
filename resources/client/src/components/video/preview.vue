<template>
  <q-card class="player-preview relative-position" >
    <q-btn
      v-if="canRemove"
      type="a"
      @click="$emit('remove')"
      class="absolute-top-left"
      icon="delete"
      color="red"
      round
      style="z-index:99;top:5px;left:5px"
    />
    <q-card-media
      @click.native="$router.push({ name: 'play', params: {id: video.id}})"
      :style="{backgroundImage:`url(${video.link_preview})`}"
    >
      <img itemprop="image" class="vi" alt="Nude Fitness - AdultFitness" src="https://adultfitness.com/img/no_foto.jpg">
      <div class="shadow"></div>

      <div class="overlay" />
      <div class="overlay transparent">
        <muscule-map
          style="width: auto; height: 82%;padding: 0 22px;"
          :front="isfront"
          :groups="video.groups"
        />
        <span>{{ baseGroup }}</span>
      </div>
      <div class="duration" v-text="miniOverlay(video.duration)" />
    </q-card-media>

    <q-card-title>
      <span class="text-overflow">{{ video.title }}</span>
      <div class="video-desc">
        <div>
          <q-icon name="visibility" />
          <span v-text="$tc('video.view', video.views, {n: video.views})" />
        </div>
        <span class="gray" v-text="video.created_at" />
      </div>

    </q-card-title>
    <q-card-actions v-if="video.groupName">
      <q-btn
        flat
        type="a"
        color="primary"
        :label="video.groupName"
        @click="goTo(video.groupId)"
      />
    </q-card-actions>
  </q-card>
</template>

<style lang="stylus">
@import '~variables'

.player-preview {
  color: white;
  box-shadow: 0px 0px 5px 1px #ffffff70;
  .q-card-container {
    padding: 16px 5px;
    .q-card-title {
      font-size: 15px;
      line-height: 1.7rem;
      width: 100%;
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

  .q-card-media {
    &:hover .shadow {
        opacity: 0;
    }
    cursor: pointer;
    background-size: 132%;
    background-position: center;
    img.vi {
        /*margin-top: -12%;*/
        opacity:0;
    }
    .overlay, .shadow {
      background: black;
      position: absolute;
      top: 0;
      bottom: 0;
      right: 0;
      left: 100%;
      opacity: 0.65;
      text-align: center;
      transition: all 0.5s;
      .q-btn-inner {
        flex-wrap: nowrap;
      }
      img {
        height: 60%;
      }
      span {
        color: $primary;
        font-size: 12px;
        width: 100%;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        font-weight: bold;
        /* padding: 0 10px; */
        display: block;
      }
      &.transparent {
        opacity: 1;
        background: none;
      }
      .q-btn .q-icon {
        margin-right: 5px;
      }
    }
    &:hover {
      .overlay {
        left:60%;
      }
    }

    .shadow {
      left:0px;
      background-image: linear-gradient(white , gray, black, black);
      transition: all 1s;
      bottom: 12%;
      opacity: 0;
    }
    .duration {
      color:white;
      font-weight: bold;
      padding: 7px;
      background-color: black;
      border-radius: 3px;
      position: absolute;
      left: 20px;
      bottom: 10px;
      opacity: 0.6;
    }
  }
}
</style>

<script>
import { openURL } from 'quasar'
import { mapGetters } from 'vuex'
import musculemap from '../misc/muscules'

const front = {
  2: -1,
  3: 1,
  4: 1,
  5: -1,
  6: -1,
  7: -1,
  8: 0,
  9: 1,
  10: -1,
  11: 1,
  12: -1,
  13: 1,
  14: 1,
  15: -1,
}

export default {
  props:{
    video: { },
    canRemove: {
    },
  },
  components:{
    'muscule-map': musculemap
  },
  computed:{
    ...mapGetters({
      allGroups: 'video/groups',
    }),
    musculeDirection () {
      let result = 0
      if (this.video.groups){
        this.video.groups.forEach(group => {
          result += (4 - group.weight) * front[group.id] * 2
        });
      }
      return result

      /*else {
        return .
          sort((a,b) => a.weight - b.weight).
          map(item => {
            return {
              //color: muscule_colors[item.weight - 1],
              label: this.allGroups.find(gr => item.id == gr.id).title
            }
          })
      }//*/
    },
    isfront(){
      return this.musculeDirection < 0
    },
    baseGroup(){
      if (this.video.groups){
        let item = this.video.groups
          .filter(group => {
            if(!this.isfront)
              return (front[group.id] >= 0)
            else
              return (front[group.id] < 0)
          })
          .sort((a,b) => b.weight - a.weight)
          .pop()

        if(item) {
          let list = this.allGroups.filter(group => group.id == item.id)
          return (list[0])?list[0].title:'No group'
        }
      }
      return 'No group'
    }
  },
  mounted() {
  },
  methods: {
    goTo (id) {
      this.$router.push(`/group/${id}`)
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
