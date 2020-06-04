<template>
  <div class="full-width q-mt-md">
    <a-block-divider
      :title="$t('comment.comments')"
      customIcon="sent-mail"
      :description="count"
    />
    <div class="comments">
      <a-comment-child
        v-for="(comment, index) in comments"
        :key="index"
        :item="item"
        :comment="comment"
        @childes="setChilds"
      />
    </div>
  </div>
</template>
<script>
import Vue from 'vue'
import blockDivider from "./../misc/title"
import commentChild from './../user/comment-child'
import {mapGetters} from 'vuex'

export default {
  components: {
    'a-block-divider': blockDivider,
    'a-comment-child': commentChild,
  },
  computed: {
    ...mapGetters({
      comments: 'comment/comments'
    }),
  },
  props: {
    item:{},
    count: {},
  },
  methods: {
    setChilds(childs) {
      this.$emit('childes', childs)
    }
  },
}
</script>
