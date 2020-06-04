<template>
	<q-modal v-model="visibility" >
    <q-modal-layout>
      <q-toolbar color="secondary" slot="header">
        <q-btn
          flat
		  type="a"
          dense
          v-close-overlay
          icon="keyboard_arrow_left"
          :label="$t('video.close')"
        />
        <q-toolbar-title v-text="$t('video.playlists')"/>
      </q-toolbar>

      <div class="layout-padding">
        <div class="container">
					<q-list v-if="list.length">
						<q-item
							v-for="(item, index) in list"
							:key="index"
						>
							<q-item-main>
								<q-btn
									class="full-width"
									type="a"
									:label="item.name"
									@click="_attach(item.id)"
								/>
							</q-item-main>
							<q-item-side right>
								<q-btn
									icon="edit"
									type="a"
									@click="_edit(item)"
								/>
								<q-btn
									icon="delete"
									type="a"
									@click="_delete(item.id)"
								/>
							</q-item-side>
						</q-item>
					</q-list>
					<p v-else>Create new playlist</p>
        </div>
      </div>

			<q-toolbar color="secondary" slot="footer">
				<q-toolbar-title>
					<q-btn
						color="primary"
						type="a"
						label="New playlist"
						@click="makeList()"
					/>
				</q-toolbar-title>
			</q-toolbar>
    </q-modal-layout>
  </q-modal>
</template>
<script>

import { mapGetters, mapActions } from "vuex";
export default {
  components: {
	},
	props: {
		opened: {},
		video_id: {},
	},
	mounted() {
		this.getList()
	},
  methods:{
    ...mapActions({
      getList: 'playlist/getList',
			createPlaylist: 'playlist/createList',
			attach: 'playlist/attach',
			updateList: 'playlist/updateList',
			deleteList: 'playlist/deleteList',
		}),
		makeList() {
			this.$q.dialog({
				title: 'Name',
				message: 'Name  of playlist',
				prompt: {
					model: '',
					type: 'text' // optional
				},
				cancel: true,
				color: 'secondary'
			}).then(data => {
				this.createPlaylist({name: data})
			}).catch(() => {
				//this.$emit('close')
			})
		},
		_attach(id){
			this.attach({
				video_id: this.video_id,
				playlist_id: id,
			})

			this.$emit('close')
		},
		_edit(item){
			this.$q.dialog({
				title: 'Name',
				message: 'Name  of playlist',
				prompt: {
					model: item.name,
					type: 'text' // optional
				},
				cancel: true,
				color: 'secondary'
			}).then(data => {
				this.updateList({
					id: item.id,
					name: data
				})
				//this.$emit('close')
			}).catch(() => {
			})
		},
		_delete(id){
			this.deleteList(id)
			this.$emit('close')
		}
  },
  computed: {
    ...mapGetters({
			playlists: 'playlist/list',
		}),
		list() {
      return this.playlists
				.filter(item => item.default != 1)
		},
    visibility:{
      get () {
        return this.opened
      },
      set (newValue) {
        if(!newValue) {
          this.$emit('close')
        }
      }
    }
  },
  data () {
    return {

    }
  }
}
</script>
<style lang="scss">
</style>
