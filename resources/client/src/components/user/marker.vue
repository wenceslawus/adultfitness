<template>
  <div class="marker" @click="goToTrainer">
    <img 
      itemprop="image"
      v-if="author"
      :src="avatar" alt="nude training">
    <div 
      v-if="author"
      class="texts">
      <p class="name" v-text="name" />
      <p class="description" v-text="created_at" />
    </div>
    <q-btn
      v-if="canEdit"
      type="a"
      color="primary"
      label="Edit"
      @click.prevent.stop="$emit('editVideo')"
    />
  </div>
</template>
<script>

import { mapGetters } from 'vuex'
export default {
  props: {
    author: {},
    created_at: {},
    rights: {}
  },
  computed: {
    ...mapGetters({
      me: 'auth/me'
    }),
    avatar() {
      return (this.author && this.author.avatar)?this.author.avatar:'/statics/profile_test.png'
    },
    name() {
      return (this.author && this.author.name)?this.author.name:'Admin'
    },
    canEdit() {
      return (this.rights =='admin') || (this.rights =='trainer' && this.me.id == this.author.id)
    }
  },
  methods: {
    goToTrainer() {
      this.$router.push({name: 'trainer.home', params: {id: this.author.id}})
    }
  },
}
</script>
<style lang="scss">
  .marker {
    display: flex;
    cursor: pointer;
    align-items: center;
    img {
      margin-right: 5px;
      border-radius: 50%;
      border: 2px solid #444;
      height: 42px;
      width: 42px;
      margin-right: 10px;
    }
    .texts {
      flex-grow: 1;
      .name {
        color:white;
        margin:0;
      }
      .description {
        color: #444;
        margin:0;
        font-size: 13px;
      }
    }
  }
</style>
