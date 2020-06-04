<template>
  <div class="comment">
    <img itemprop="image" :src="comment.author.avatar" alt="nude training" class="avatar">
    <div class="item">
      <div class="head" v-if="comment && comment.author">
        <h4>{{ comment.author.name }}</h4>
        <p>{{ comment.time }}</p>
      </div>
      <div class="message">{{ comment.message }}</div>
      <div class="btns">
        <q-btn
          icon="reply"
          type="a"
          v-if="!parent"
          :label="$t('comment.reply')"
          class="q-mr-md white"
          flat
          @click="(showEdit)?showEdit = false:false; reply = !reply"
          :disabled="!me"
        />


        <q-btn
          type="a"
          v-if="me && comment.author.id == me.id"
          @click="(reply)?reply = false:false; showEdit = !showEdit"
          :class="{lighted: comment.ilike}"

          icon="edit"
          class="q-ml-md"
          flat
          :disabled="!me"
        />
        <q-btn
          type="a"
          v-if="me && comment.author.id == me.id"
          :loading="deleting"
          @click="deleteComment()"
          :class="{lighted: comment.ilike}"

          icon="delete"
          class="q-ml-md"
          flat
          :disabled="!me"
        />


        <q-btn
          type="a"
          :label="comment.like"
          :loading="sendLike"
          @click="vote('like', comment.id)"
          :class="{lighted: comment.ilike}"

          icon="thumb_up"
          class="q-ml-md"
          flat
          :disabled="!me"
        />
        <q-btn
          type="a"
          :label="comment.dislike"
          :loading="sendDislike"
          @click="vote('dislike', comment.id)"
          :class="{lighted: comment.idislike}"

          icon="thumb_down"
          flat
          :disabled="!me"
        />

        <q-btn
          type="a"
          class="link"
          v-if="!parent"
          :label="$t('comment.child')"
          :loading="getChilds"
          flat
          no-caps
          @click="viewComments"
        >
          <q-spinner-facebook slot="loading" size="20px"/>
        </q-btn>
      </div>
      <a-comment-add
        v-if="reply"
        :item="item"
        :parentId="comment.id"
        @close="reply = false"
      />
      <a-comment-edit
        v-if="showEdit"
        :message="comment.message"
        :sending="savingComment"
        @close="showEdit=false"
        @save="editComment"
      />
      <div class="comments" v-if="comment.childs">
        <tree-comment
          class="comment child"
          v-for="(comment, chi) in comment.childs"
          :key="chi"
          :item="item"
          :parent="comment.id"
          :comment="comment"
        />
      </div>
    </div>
  </div>
</template>

<script>
  import commentMake from './../user/comment-make'
  import commentEdit from './../user/comment-edit'
  import {mapGetters, mapActions} from 'vuex'

  export default {
    name: 'tree-comment',
    components: {
      'a-comment-add': commentMake,
      'a-comment-edit': commentEdit
    },
    props: {
      comment: {},
      item: {},
      parent: {}
    },
    data() {
      return {
        sendLike: false,
        edit: false,
        deleting: false,
        sendDislike: false,
        getChilds: false,
        reply: false,
        savingComment: false,
        showEdit: false,
      }
    },
    computed: {
      ...mapGetters({
        me: 'auth/me',
      })
    },
    methods: {
      ...mapActions({
        loadChild: 'comment/child',
        sendVote: 'comment/vote',
        subscribe: 'subscribe/showDialog',
        sendDelete: 'comment/del',
        sendEdit: 'comment/update',
      }),
      viewComments() {
        this.getChilds = true;

        this.loadChild(this.comment.id)
          .then(data => {
            this.getChilds = false;
          })
          .catch(() => {
            this.getChilds = false;
          })
      },
      editComment(message) {
        if (this.me && this.me.subscribed) {
          if (message) {
            this.savingComment = true;

            this.sendEdit({
              id: this.comment.id,
              message: message,
            }).then(response => {
              this.showEdit = false
              this.savingComment = false
            }).catch((err) => {
              this.savingComment = false
            })//*/
          }
        } else {
          this.subscribe(true)
        }
      },
      vote(mode, id) {
        if (this.me && this.me.subscribed) {
          if (mode == 'like') {
            this.sendLike = true
          } else {
            this.sendDislike = true
          }

          this.sendVote({
            id,
            type: mode,
            item: this.item.item_type
          })
            .then(() => {
              this.sendLike = false;
              this.sendDislike = false;
            })
            .catch(() => {
              this.sendDislike = false;
              this.sendLike = false
            })
        } else {
          this.subscribe(true)
        }
      },
      deleteComment() {
        if (this.me) {
          this.deleting = true

          this.sendDelete({
            id: this.comment.id
          })
            .then(() => {
              this.deleting = false;
            })
            .catch(() => {
              this.deleting = false;
            })
        } else {
          this.subscribe(true)
        }
      }
    }
  }
</script>
<style lang="scss">
  .comments {
    .comment {
      display: flex;

      img {
        min-width: 42px;
        width: 42px;
        height: 42px;
        margin: 5px 0 0 0;
      }

      &.child img {
        min-width: 30px;
        width: 30px;
        height: 30px;
      }

      .item {
        padding-left: 20px;
        flex-grow: 2;

        .message {
          color: #919191;
          font-size: 13px;
          white-space: pre-line;
        }

        .head {
          display: flex;
          align-items: center;

          h4 {
            color: white;
            font-size: 16px;
            margin: 0;
          }

          p {
            margin: 0 0 0 10px;
            color: #ff5600;
            font-size: 12px;
          }
        }

        .btns {
          color: #707070;
          margin: 20px 0;

          .white:hover {
            color: white;

            i {
              color: #f95702;
            }
          }

          .link {
            color: white;
            text-decoration: underline;

            .q-focus-helper {
              display: none;
            }
          }

          .lighted .q-icon {
            color: #ff5600;
          }
        }
      }
    }
  }
</style>
