<template>
  <div class="imaged-combo">
    <img 
      class="q-ml-sm"
      v-if="image"
      :src="image" 
      alt="Nude Fitness is a new Modern Trend" 
    />
  
    <q-btn-dropdown
      class="group"
      type="a"
      label=""
    >
      <q-list link>
        <q-item 
          :to="getLink(item)"
          v-for="(item, index) in items" 
          :key="index" 
          v-close-overlay
        >
          <q-item-main>
            <q-item-tile label v-text="item.title" />
          </q-item-main>
        </q-item>
      </q-list>
    </q-btn-dropdown>
  </div>
</template>

<style lang="scss">
.imaged-combo {
  .group {
    padding-left: 0 !important;
    height: 60px !important;
    i {
      margin-left: 0px !important;
    }
  }
}
</style>

<script>
import { mapGetters } from 'vuex'
export default {
  computed: {
    ...mapGetters({
      locale: 'general/locale',
    }),
  },
  props: {
    label: {},
    items: {},
    image: {},
  },
  data() {
    return {

    }
  },
  methods:{
    getLink(item){
      if(item.slug){
        return { path: '/'+item.slug}
      }else
        return { name: 'group', params: { id: item.id }}
    }
  },  
}
</script>
