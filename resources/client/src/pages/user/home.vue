<template>
  <q-page class="container" v-if="userData && userData.trainer">
    <q-card
      style="margin:auto;background-color: #141414;"
      class="profile-sub-card"
			v-if="userData.trainer['bio']"
    >
      <q-card-main>
        <div class="row gutter-sm profile-card">
				<div class="col-12">
					<h5>Bio</h5>
					<p>{{ userData.trainer['bio'] }}</p>
				</div>
			</div>
      </q-card-main>
		</q-card>
		<br />
		<q-card
      class="profile-sub-card" >
			<a-video-group
        class="no-top-padding"
        :items="videoItems"
				:compact="true"
        customIcon="sent-mail" />
    </q-card>
  </q-page>
</template>
<script>
import { required, minLength, sameAs} from 'vuelidate/lib/validators'
import videoGroups from 'components/video/group'
import { mapGetters, mapActions } from 'vuex'

export default {
	computed: {
		...mapGetters({
			avatar: 'auth/avatar',
			//me: 'auth/me',
			userData: 'auth/me',
		}),
		videoItems(){
			if(!this.userData || !this.userData.videos)
				return []

      let ind = this.userData.videos.length - 5

      if (ind > 0) {
        return this.userData.videos.slice(ind).reverse()
      } else {
        return this.userData.videos.reverse()
      }
		}
	},
	components: {
    'a-video-group': videoGroups,
  },
	methods: {
		...mapActions({
		}),
	},
	data() {
		return {
			//userData: {},
		}
	},
	mounted() {
		const route = this.$router.currentRoute
		/*
		if(route.params && route.params.id) {
			if(route.params.id == 'me') {
				//it is me
				this.userData = {
					trainer: this.me.trainer,
					videos: this.me.videos,
				}
			} else {
				this.getTrainer(route.params.id)
					.then(data => {
						this.userData =  data.trainer
					})
			}
		}//*/

	}
}
</script>
