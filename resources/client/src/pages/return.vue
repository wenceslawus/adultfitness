<template>
  <q-page class="flex ">
  </q-page>
</template>

<script>
import { mapGetters } from 'vuex'
export default {
	computed:{
		...mapGetters({
			payFrom: 'subscribe/payFrom'
		}),
	},
	mounted() {
		this.$router.push(this.payFrom)
	}
}
</script>
