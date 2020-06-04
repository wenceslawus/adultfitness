<template>
	<q-page class="container">
    <q-card 
      style="margin:auto;background-color: #141414;"
      class="profile-sub-card"
    >
      <q-card-main>
        <div class="row gutter-sm profile-card">
			<div class="col-12"
				v-for="(field, index) in trainerData"
				:key="index">
				<h5 v-text="$t('profile.' + field)" />
				<p>{{ userData.trainer[field] }}</p>
			</div>
        </div>
      </q-card-main>
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
			trainerData(){
				if(!this.userData || !this.userData.trainer)
					return [];
					
				return ['description', 'specs', 'exp', 'hobby'].filter(item => this.userData.trainer && this.userData.trainer[item])
			}
		},
		methods: {
			...mapActions({
				getTrainer: 'training/getTrainer',
			}),
		},
		data() {
			return {
			}
		},
		mounted() {
			const route = this.$router.currentRoute
		}
  }
</script>
