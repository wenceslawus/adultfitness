<template>
  <div class="container muscules">
    <div class="row">
      <div class="col-xs-5 muscule-map">
        <muscule-map
          :front="showFront"
          :groups="groups"
        />
      </div>
      <div class="col-xs-7 q-pa-sm">
        <p class="title">{{ $t('video.muscules') }}</p>
        <p
          v-for="(muscule, index) in musculeGroups"
          :key="index"
          v-text="muscule.label"
          :style="{ color: muscule.color}"
        />
      </div>
    </div>
    <div class="row">
      <q-btn 
        color="primary"
        type="a"
        class="full-width"
        :label="$t('video.reverseMap')"
        @click="showFront = !showFront"
      />
    </div>
  </div>
</template>

<script>
const muscule_colors = [
  '#fe1200',
  '#fd6303',
  '#facb02'
];
import muscules from './muscules'
import { mapGetters, mapActions } from 'vuex'

export default {
  components: {
    musculeMap: muscules,
  },
  computed: {
    ...mapGetters({
      allGroups: 'video/groups',
    }),
    musculeGroups () {
      if (!this.groups){
        return [];
      } else {
        return this.groups.
          sort((a,b) => a.weight - b.weight).
          map(item => {
            return {
              color: muscule_colors[item.weight - 1],
              label: this.allGroups.find(gr => item.id == gr.id).title
            }
          })
      }
    },
  },
  props: {
    groups: {}
  },
  methods: {
    
  },
  data() {
    return {
      showFront: false,
      videoGroup: [],
    }
  },
  watch: {
    groups(newGroup) {
      this.videoGroup = newGroup
    }
  }
}
</script>

<style lang="scss">
.muscules {
  img {
    width:100%
  }
  background-color:#111;
  p {
    font-size: 12px;
    &.title { 
      font-weight:bold;
      color:#323232; 
    }
  }
  .muscule-map svg{
    width: 100%;
    height: auto;
  }
}
</style>
