<template>
  <q-page class="black flex flex-center">
    <div class="container blog">
      <a-divider
        :title="blog.title"
        style="margin: 10px 0"
        customIcon="sent-mail"
      />
      <div
        class="item full"
      >
        <q-card>
          <q-card-media>
            <img itemprop="image" :src="blog.image" alt="adult fitness">
          </q-card-media>
          <q-card-main v-html="blog.text" />
          <q-card-actions align="end">
            <span class="time" v-text="blog.updated_at" />
          </q-card-actions>
        </q-card>

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
  </q-page>
</template>
<script>
import divider from './../../components/misc/title'
import commentMake from 'components/user/comment-make'
import comments from 'components/user/comment-list'
import {mapActions, mapGetters} from 'vuex'

export default {
  components: {
    'a-divider': divider,
    'a-comment-make': commentMake,
    'a-comments': comments,
  },
  computed: {
    ...mapGetters({
      comments: 'comment/comments',
      comment_count: 'comment/count',
    }),
    comment_params() {
      return {
        item_id: this.blog.id,
        item_type: 'blog',
      }
    }
  },
  methods: {
    ...mapActions({
      getRecord: 'blog/getRecord',
      setComments: 'comment/setComments',
    })
  },
  mounted () {
    this.id = this.$router.history.current.params.id
    this.getRecord(this.id)
      .then(response => {
        this.blog = response.blog_record
        this.setComments({
          comments: response.comments,
          count: response.comment_count,
        })
      })
  },
  data () {
    return {
      id: '',
      blog: {}
    }
  }
}
</script>
<style lang="scss">
.blog {
  max-width: 800px;
  .q-card {
    background-color: #141414;
  }
  .q-card-main {
    line-height: 25px;
    font-size: 18px;
    padding: 30px 16px;
    color: #fff;
    b {
      color: #bfbfbf;
    }
  }

  h5 {
    color: #565656;
    font-weight: bold;
    padding-left: 10px;
  }
  .time{
    padding: 0 10px 10px;
    display: block;
    text-align: right;
    color: #ff5600;
    font-size: 14px;
  }
}
</style>
