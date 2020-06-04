<template>
	<q-layout-drawer
		v-model="showNotify"
		overlay
		side="left"
		class="black mobile"
		:width="350"
		:content-class="$q.theme === 'mat' ? 'bg-grey-2' : null"
	>
		<q-list
			separator
			link
			class="notify_list"
			v-if="user"
		>
			<!-- notice `v-close-overlay` which closes popover -->
			<q-list-header v-if="hasNew">New</q-list-header>

			<q-item v-if="!notifies.length" >
				<q-item-main>
					<q-item-tile label lines="1">No messages</q-item-tile>
				</q-item-main>
			</q-item>

			<q-item
				v-close-overlay
				v-for="(item) in unreadedMessages"
				:key="item.id"
				@click.native="readMessage(item)"
				class="is-new"
			>
				<q-item-side>
					<img itemprop="image" alt="nude fitness online" :src="item.source.avatar" />
				</q-item-side>

				<q-item-main>
					<q-item-tile label >
						<b>{{ item.source.name }}</b> {{ item.text }}<p>{{ item.dt }}</p>
						<!--b>Alex Pro Trainer</b> has 2 new clicks on Visit Group and 2 new post likes<p>1h</p-->
					</q-item-tile>
				</q-item-main>

			</q-item>

			<q-list-header v-if="readedMessages.length">Earlier</q-list-header>

			<q-item
				v-close-overlay
				v-for="(item) in readedMessages"
				:key="item.id"
				@click.native="readMessage(item)"
			>
				<q-item-side>
					<img itemprop="image" :src="item.source.avatar" alt="Nude Fitness is a new Modern Trend"/>
				</q-item-side>

				<q-item-main>
					<q-item-tile label >
						<b>{{ item.source.name }}</b> {{ item.text }}<p>{{ item.dt }}</p>
						<!--b>Alex Pro Trainer</b> has 2 new clicks on Visit Group and 2 new post likes<p>1h</p-->
					</q-item-tile>
				</q-item-main>

			</q-item>
		</q-list>
		<q-btn
			color="primary"
			type="a"
			style="width:100%"
			label="See All"
			:to="{name: 'notify.list'}"
		/>
	</q-layout-drawer>
</template>

<script>
import {mapGetters, mapActions} from 'vuex'

export default {
	watch: {
    showNotify(newValue, oldValue) {
      if(!newValue && oldValue) {
        this.markRead()
      }
    }
	},
	methods: {
		...mapActions({
      markRead: 'notify/markRread',
      toggleNotify: "general/toggleNotify",
      nread: 'notify/read',
      nremove: 'notify/remove',
		}),
		dropNotify(){
      this.markRead()
    },
		readMessage(item) {
      this.nread(item.id)
        .then(() => {
          if(item.route){
            this.$router.push({
              name: item.route,
              params: item.param
            })
          }

          /*this.$q.dialog({
            title: 'Notify',
            message: item.text,
            ok: {
              push: true,
              label: 'Delete',
              color: 'negative'
            },
            cancel: 'Ok'
          }).then(() => {
            this.nremove(item.id)
          }).catch(() => {

          })*/
        })
    },
	},
	computed: {
		...mapGetters({
      //musculeGroup: 'video/groups',
      user: 'auth/me',
      //avatar: 'auth/avatar',
      notifies: 'notify/list',
      _showDrawer: 'general/showDrawer',
      _showNotify: 'general/showNotify',
		}),
		showNotify: {
      get: function(){
        //this.notifyMenu = !this.notifyMenu
        return this._showNotify && this._showDrawer
      },
      set: function(newValue, oldValue) {
        this.toggleNotify(newValue)
        if(oldValue) {
          this.markAsRead()
        }
      }

		},
		unreadedMessages(){
      let news = this.notifies.filter(item => (item.state & 1) == 0);
      if(news && news.length > 7){
        let b = news.splice(0, 7)
        return b
      }

      return news;
    },
    hasNew(){
      return this.unreadedMessages && this.unreadedMessages.length;
    },

		readedMessages(){
      let count = 10

      if(this.unreadedMessages && this.unreadedMessages.length){
        count -= this.unreadedMessages.length
      }

      return this.notifies.filter(item => (item.state & 1) == 1).splice(0, count);
		},
	},
}
</script>
