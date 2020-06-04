<template>
  <div class="video-list">
    <a-block-divider
      :customIcon="customIcon"
      :icon="icon"
      :title="title"
      v-if="title"
    />
    <div class="video-container row gutter-sm" :class="{nospacing: compact}">
      <div
        class="col-xs-12 col-md-4"
        v-for="(video, index) in itemsPaged"
        :key="index"
      >
        <a-video-player
          :video="video"
          :canRemove="canRemove"
          @remove="$emit('remove', video.id)"
        />
      </div>
    </div>

    <q-btn
      v-if="linkToAll && !needpaginator"
      type="a"
      dense
      size="lg"
      class="next"
      color="primary"
      :label="$t('general.more')"
      text-color="black"
      :to="linkToAll"
    />
    <q-pagination
      v-if="needpaginator"
      class="q-mb-lg flex-center"
      v-model="page"
      :max="maxPages"
      :max-pages="6"/>
  </div>
</template>

<script>
import videoPlayer from "./preview"
import blockDivider from "./../misc/title"

export default {
  components: {
    'a-video-player': videoPlayer,
    'a-block-divider': blockDivider,
  },
  props:{
    items:{},
    title:{},
    icon:{},
    customIcon:{},
    linkToAll:{},
    canRemove:{},
    compact:{},
  },
  data() {
    return {
      page: 1
    }
  },
  computed: {
    needpaginator() {
      return this.items.length > 15
    },
    maxPages() {
      return Math.ceil(this.items.length / 15)
    },
    itemsPaged(){
      const start = (this.page-1)*15
      return this.items.slice(start, start + 15)
    }
  },
}
</script>
<style lang="scss">
  .video-list {
    .video-container {
      .q-btn {
        padding: 4px 10px;
      }
    }
    .q-btn.next {
      margin: 20px 28px 40px;
      font-weight: bold;
      .q-btn-inner div {
        padding: 0 15px;
        font-weight: bold;
      }
    }
    .video-container {
      display: flex;
      padding: 15px 28px;
      @media screen and (max-width: 425px) {
        padding: 15px 10px;
      }
      &.nospacing{
        padding: 0 !important;
      }
      .col-md-4 {
        @media screen and (min-width: 840px) {
          width: 33%;
        }
        @media screen and (min-width: 1335px) {
          width: 20%;
        }
      }
    }
  }
</style>
