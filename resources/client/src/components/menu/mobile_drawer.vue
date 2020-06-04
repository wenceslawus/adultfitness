<template>
  <q-layout-drawer
    v-model="showDrawer"
    overlay
    side="left"
    class="black"
    :width="350"
    :content-class="$q.theme === 'mat' ? 'bg-grey-2' : null"
  >

    <img itemprop="image"
         v-if="user"
         class="avatar"
         :src="avatar"
         alt="Nude Fitness is a new Modern Trend"
    >
    <h3 v-if="user">{{ user.name }}</h3>
    <q-btn
      v-if="user"
      type="a"
      label="View Profile"
      class="view-profile"
      flat
      :to="{name:'profile.settings'}"
    />
    <q-list link v-if="!user">
      <q-item class="menu-item" to="/login">
        <q-item-main>
          <q-item-tile label v-text="$t('auth.login')"/>
        </q-item-main>
      </q-item>
      <q-item class="menu-item" to="/register">
        <q-item-main>
          <q-item-tile label v-text="$t('auth.register')"/>
        </q-item-main>
      </q-item>
    </q-list>

    <q-item class="menu-item" v-if="user && notifies && notifies.length">
      <q-item-side image="/statics/icons/notify.jpg"/>
      <q-item-main>
        <!--q-btn-dropdown flat label="Notifications" @click="dropNotify" class="q-pr-sm full-width notify">

          <q-list link>
            <q-item
              v-close-overlay
              v-for="(item, index) in notifies"
              :key="index"
              @click.native="readMessage(item)"
              style="align-items: flex-start;" >

              <q-item-main>
                <q-item-tile label >{{ item.text }}</q-item-tile>
              </q-item-main>
              <q-item-side>
                <q-item-tile label >{{ item.dt }}</q-item-tile>
              </q-item-side>
            </q-item>
          </q-list>
        </q-btn-dropdown-->
        <q-btn
          flat
          type="a"
          label="Notifications"
          style="padding: 0;text-transform: none;"
          @click="toggleNotify"
        />

      </q-item-main>
      <q-item-side right v-if="unreadCount">
        <q-chip color="red" class="shadow-2">{{ unreadCount }}</q-chip>
      </q-item-side>
    </q-item>

    <q-list link v-if="user">
      <q-item
        v-for="(item, index) in menuItems"
        :key="index"
        :class="{active: item.active}"
        class="menu-item"
        @click.native="tryRedirect(item.route)"
      >
        <q-item-side
          v-if="item.image"
          :image="'/statics/icons/' + item.image + '.jpg'"
        />
        <q-item-main>
          <q-item-tile label>{{ $t(item.label) }}</q-item-tile>
        </q-item-main>
      </q-item>

    </q-list>
    <q-btn
      v-if="user"
      type="a"
      class="view-profile"
      @click.native="logout"
      style="color: white;font-size: 1.5em;"
      :label="$t('auth.logout')"
    />
  </q-layout-drawer>
</template>

<script>
  import {mapGetters, mapActions} from 'vuex'

  export default {
    data() {
      return {
        mItems: [
          /*{
            label: 'general.home',
            route: '/',
          },//*/
          {
            label: 'general.library',
            image: 'muscules',
            route: {name: 'group', params: {id: '0'}},
          },
          /*
          {
            label: 'auth.profile',
            route: {name:'profile.settings'},
          },//*/
          {
            label: 'general.workout',
            image: 'programs',
            route: {name: 'training.list'},
          },
          {
            label: 'general.blogs',
            image: 'blog',
            route: {name: 'blogs'},
          },
          {
            label: 'video.edit_videos',
            route: {name: 'profile.videos'},
            permit: 'upload',
          },
          {
            label: 'general.contacts',
            image: 'contact',
            route: {name: 'contact'},
          },
        ]
      }
    },
    methods: {
      ...mapActions({
        markRead: 'notify/markRread',
        toggleDrawer: "general/toggleDrawer",
        toggleNotify: "general/toggleNotify",
        nread: 'notify/read',
        nremove: 'notify/remove',
        _logout: 'auth/logout'
      }),
      logout() {
        this._logout()
          .then(() => {
            this.$router.push("/")
          })
      },
      tryOpenPrograms() {
        if (this.user && this.user.subscribed) {
          this.$router.push({name: 'training.list'})
        } else {
          this.subscribe(true)
        }
      },
      tryRedirect(route) {
        let name = route.name
        let needSubscribe = name == 'training.list'

        if (!this.user) {
          this.setEntry(this.$router.currentRoute.path)
            .then(() => this.$router.push({name: 'login'}))

        } else {
          if (this.user.subscribed || !needSubscribe) {
            this.$router.push(route)
          } else {
            this.subscribe(true)
          }
        }
      },
    },
    computed: {
      ...mapGetters({
        //musculeGroup: 'video/groups',
        user: 'auth/me',
        avatar: 'auth/avatar',
        notifies: 'notify/list',
        _showDrawer: 'general/showDrawer',
        _showNotify: 'general/showNotify',
      }),
      showDrawer: {
        get: function () {
          return this._showDrawer
        },
        set: function (newValue) {
          this.toggleDrawer(newValue)
        }
      },
      unreadCount() {
        return this.notifies.filter(item => item.state).length;
      },
      menuItems() {
        const rt = this.mItems.filter(item => {
          if (!item.permit) return true
          if (!this.user) return false;

          switch (item.permit) {
            case 'upload':
              return this.user.role == 'admin' || this.user.role == 'trainer'
              break;
          }

          return true;
        })

        return rt
      },
    },
  }
</script>
