<template>
  <div id="q-app">
    <router-view />
    <d-subscribe />
    <d-video-share />
    <d-upload-input />
    <d-edit-video />
  </div>
</template>

<script>
import { mapGetters } from 'vuex'
//import warningMessage from 'src/components/modals/informer'
import subscribeDialog from 'src/components/modals/subscribe'
import uploadInput from 'src/components/modals/upload'
import editVideo from 'src/components/modals/admin/editVideo'
import shareVideo from 'src/components/modals/share'

export default {
  name: 'App',
  components: {
    'd-subscribe': subscribeDialog,
    'd-upload-input': uploadInput,
    'd-edit-video': editVideo,
    'd-video-share': shareVideo,
    //'d-warning-message': warningMessage,
  },
  computed: {
    ...mapGetters({
      lastPath: 'auth/entryFrom'
    }),
  },
  methods: {
    accept() {
      localStorage.setItem('agree', true)
      this.agree = true;
    },
    decline() {
      window.location = 'https://google.com'
    }
  },
  mounted() {
    this.agree = localStorage.getItem('agree')

    this.$store.dispatch('init')
      .then(() => {
        this.$router.push(this.lastPath)
      })
      .catch( e => {
      })
  },
  data() {
    return {
      agree: false
    }
  }
}
</script>

<style lang="scss">
.profile-card {
	h5 {
		margin: 0px 0 12px;
		color: #ff5600;
	}
	p {
		color:white;
    white-space: pre-line;
	}
  .profile-sub-card {
    .desc {
      color: #a2a2a2;
      font-size: 12px;
      line-height: 30px;
      white-space: pre-line;
    }
    .user-props {
      color: #a2a2a2;
      line-height: 30px;
    }
  }
}
</style>
