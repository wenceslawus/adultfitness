<template>
  <q-page class="container">
    <div class="container overflow-hidden">
      <a-video-group
        class="no-top-padding"
        v-if="videoItems"
        :title="$t('general.latest')"
        :items="videoItems"
        customIcon="sent-mail"
      />
    </div>
  </q-page>
</template>

<style>
</style>

<script>
import videoGroups from 'components/video/group'
import { mapGetters, mapActions } from 'vuex'

export default {
  name: 'index',
  mounted() {
		const route = this.$router.currentRoute		
	},
  methods: {
		...mapActions({
			getTrainer: 'training/getTrainer',
		}),
	},
  computed: {
		...mapGetters({
			avatar: 'auth/avatar',
			userData: 'training/trainer',
		}),
		videoItems(){
			return (this.userData)?this.userData.videos:[]
		}
	},
  components: {
    'a-video-group': videoGroups,
  },
  data() {
    return {
		}
  },
}
</script>
<style>
  .no-top-padding .block-divider {
    margin-top: 0px;
  }
</style>
