<template>
  <div class="full-width" style="overflow:hidden">
    <div class="marker">
      
      <textarea
        name="msg"
        v-model="message"
        ref="make_comment"
        class="make_comment"
        placeholder="Enter your message..."
      />
    </div>
    <div class="q-pa-md float-right">
      <q-btn
        v-if="needClose"
        type="a"
        :label="$t('comment.close')"
        :style="{backgroundColor: '#4f4f4f'}"
        glossy
        text-color="black"
        @click="$emit('close')"
      />
      <q-btn
        type="a"
        class="q-ml-md"
        :label="$t('comment.send')"
        :style="{backgroundColor: '#4f4f4f', minWidth:'90px'}"
        :loading="sending"
        :disabled="!me"
        glossy
        text-color="black"
        @click="sendComment"
      >
        <q-spinner-facebook slot="loading" size="20px" />
      </q-btn>
    </div>
  </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'

export default {
  props: {
    avatar: {},
    item: {},
    parentId: {},
    needClose: {
      default: true
    }
  },
  data() {
    return {
      message:'',
      sending: false,
    }
  },
  computed: {
    ...mapGetters({
      me: 'auth/me'
    })
  },
  methods: {
    ...mapActions({
      addComent: 'comment/addComent',
      //getLink: 'subscribe/getPayLink',
      subscribe: 'subscribe/showDialog',
    }),
    sendComment() {
      //if(this.me && this.me.subscribed){
        if (this.message) {
          this.sending = true;

          this.addComent({
            ...this.item,
            parent_id: this.parentId,
            message: this.message,
          }).then( response => {
            this.message = ''
            this.sending = false
          }).catch(() => {
            this.sending = false
          })
        }
      /*} else {
        this.subscribe(true)
        //this.getLink().then(data => window.location.href = data.link)
      }//*/
    }
  }
}
</script>

<style lang="scss">
  .marker {
    display: flex;
    align-items: center;
    img {
      margin-right: 5px;
      border-radius: 50%;
      border: 2px solid #444;
      height: 42px;
      width: 42px;
      margin-right: 10px;
    }
    .make_comment {
      flex-grow: 2;
      background: #000;
      border:none;
      border-bottom: 1px solid #292929;
      color: #686868;
    }
  }
</style>
