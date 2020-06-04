<template>
  <q-toolbar class="gtool" color="secondary">
    <div class="container justify">
      <q-btn
        class="lt-md search"
        type="a"
        icon="search"
        @click="searchin=!searchin"
      />

      <a-search
        v-if="searchin"
        style="flex-grow: 2"
        class="q-mr-sm"
        @close="searchin=false"
      />

      <q-btn
        type="a"
        v-if="!searchin"
        to="/"
        class="logo"
        flat
      >
        <img itemprop="image" alt="Nude Fitness - AdultFitness" src="~assets/logo.png">
      </q-btn>

      <q-btn
        type="a"
        class="gt-sm"
        :class="{active: this.page == 'index' }"
        :label="$t('general.home')" to="/"
      />
      <q-btn
        type="a"
        class="gt-sm"
        style="padding-right:3px !important"
        :class="{active: this.page == 'group' }"
        :label="$t('general.select')"
        :to="{name:'group', params:{id: 0}}"
      />
      <a-group
        class="gt-sm"
        :class="{active: this.page == 'group' }"
        :label="$t('general.select')"
        :items="musculeGroup"
      />
      <q-btn
        type="a"
        class="gt-sm"
        :class="{active: this.page == 'training.list' }"
        :label="$t('general.workout')"
        @click="tryRedirect('training.list')"
      />

      <!--q-btn
        class="q-mr-sm gt-sm"
        :class="{active: this.page == 'blog' }"
        :label="$t('general.programs')"
        to="/blogs"
      /-->

      <a-search
        class="gt-md"
        style="flex-grow: 2"
      />

      <q-btn
        type="a"
        v-if="user && !user.subscribed"
        class="q-ml-sm gt-sm"
        color="primary"
        style="height:unset;border-radius:3px;border-bottom:unset"
        @click="upgrade"
        label="Upgrade"/>

      <a-profile-menu
        v-if="user"
        class="gt-sm"
        :label="userName"/>

      <q-btn
        type="a"
        v-if="!user"
        class="gt-sm"
        :to="{name: 'login'}"
        label="LOG IN"/>
      <q-btn
        type="a"
        v-if="!user"
        class="gt-sm"
        color="primary"
        style="height:unset;border-radius:3px;border-bottom:unset"
        :to="{name: 'register'}"
        label="SIGN UP"/>

      <q-btn
        type="a"
        v-if="user"
        class="notifications gt-sm"
        icon="notifications"
      >

        <span class="hasnew" v-if="hasNew"/>

        <!-- Direct child of target -->
        <q-popover @hide="dropNotify">
          <!--
            The DOM element(s) that make up the popup,
            in this case a list:
          -->
          <div class="notify_list">
            <q-list separator link>
              <!-- notice `v-close-overlay` which closes popover -->
              <q-list-header v-if="hasNew">NEW</q-list-header>

              <q-item v-if="!notifies.length">
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
                  <img itemprop="image" :src="item.source.avatar" alt="nude video training program"/>
                </q-item-side>

                <q-item-main>
                  <q-item-tile label>
                    <b>{{ item.source.name }}</b> {{ item.text }}<p>{{ item.dt }}</p>
                    <!--b>Alex Pro Trainer</b> has 2 new clicks on Visit Group and 2 new post likes<p>1h</p-->
                  </q-item-tile>
                </q-item-main>

              </q-item>

              <q-list-header v-if="readedMessages.length">EARLIER</q-list-header>

              <q-item
                v-close-overlay
                v-for="(item) in readedMessages"
                :key="item.id"
                @click.native="readMessage(item)"
              >
                <q-item-side>
                  <img itemprop="image" :src="item.source.avatar" alt="nude video training program"/>
                </q-item-side>

                <q-item-main>
                  <q-item-tile label>
                    <b>{{ item.source.name }}</b> {{ item.text }}<p>{{ item.dt }}</p>
                    <!--b>Alex Pro Trainer</b> has 2 new clicks on Visit Group and 2 new post likes<p>1h</p-->
                  </q-item-tile>
                </q-item-main>

              </q-item>
            </q-list>
          </div>
          <q-btn
            type="a"
            color="primary"
            style="width:100%"
            label="See All"
            :to="{name: 'notify.list'}"
          />
        </q-popover>
      </q-btn>

      <q-btn
        v-if="!searchin"
        type="a"
        class="lt-md show_menu"
        icon="menu"
        @click="toggleDrawer"
        :class="{hasNewNotify: hasNew}">

        <!--q-list link v-if="!user">
          <q-item to="/login">
            <q-item-main>
              <q-item-tile label v-text="$t('auth.login')" />
            </q-item-main>
          </q-item>
          <q-item to="/register">
            <q-item-main>
              <q-item-tile label v-text="$t('auth.register')" />
            </q-item-main>
          </q-item>
        </q-list>
        <q-list link v-else>
          <q-item
            v-for="(item, index) in menuItems"
            :key="index"
            :class="{active: item.active}"
            @click.native="tryRedirect(item.route.name)"
            style="height:80px;"
          >
            <q-item-main>
              <q-item-tile label>{{ $t(item.label) }}</q-item-tile>
            </q-item-main>
          </q-item>

          <q-item v-if="notifies && notifies.length">
            <q-item-main>
              <q-btn-dropdown label="Notifies" @click="dropNotify" class="full-width notify">
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
              </q-btn-dropdown>
            </q-item-main>
          </q-item>

          <q-item
            style="height:80px;"
            @click.native="logout"
          >
            <q-item-main>
              <q-item-tile label>{{ $t('auth.logout') }}</q-item-tile>
            </q-item-main>
          </q-item>

        </q-list-->
      </q-btn>
    </div>
  </q-toolbar>
</template>

<script>
  import {mapGetters, mapActions} from 'vuex'

  import groupsComponent from './groups'
  import profileMenu from './profile-menu'
  import topMenu from './top'
  import dropMenu from './drop'
  import searchComponent from 'components/input/search'
  import Vue from 'vue'

  export default {
    components: {
      'a-top-menu': topMenu,
      'a-drop-menu': dropMenu,
      'a-group': groupsComponent,
      'a-search': searchComponent,
      'a-profile-menu': profileMenu,
    },
    data() {
      return {
        searchin: false,
        currentRoute: '/',
        mItems: [
          /*{
            label: 'general.home',
            route: '/',
          },//*/
          {
            label: 'auth.profile',
            route: {name: 'profile.settings'},
          },
          {
            label: 'general.library',
            route: {name: 'group', params: {id: 0}},
          },
          {
            label: 'general.workout',
            route: {name: 'training.list'},
          },
          {
            label: 'general.blogs',
            route: {name: 'blogs'},
          },
          {
            label: 'video.edit_videos',
            route: {name: 'profile.videos'},
            permit: 'upload',
          },
          {
            label: 'general.contacts',
            route: {name: 'contact'},
          },
        ]
      }
    },
    watch: {
      '$route'(to, from) {
        this.setActive(to)
      }
    },
    methods: {
      ...mapActions({
        _logout: 'auth/logout',
        nread: 'notify/read',
        nremove: 'notify/remove',
        subscribe: 'subscribe/showDialog',
        setEntry: 'auth/entryFrom',
        markAsRead: 'notify/markRread',
        markRead: 'notify/setReaded',
        getLink: 'subscribe/getPayLink',
        toggleDrawer: 'general/toggleDrawer',
      }),
      search() {
        this.searchin = false;
      },
      logout() {
        this._logout()
          .then(() => {
            this.$router.push("/")
          })
      },
      setActive(route) {
        let route_name = route.name

        if (route.name == "profile.list" || route.name == "profile.settings")
          route_name = "profile.saved"
        this.menuItems.forEach(item => {
          let active = false

          if (item.route == '/') {
            active = route.name == 'index'
          } else if (item.route.name == route_name) {
            if (route.name == 'page') {
              active = route.params.link == item.route.params.link
            } else {
              active = true
            }

          }

          Vue.set(item, 'active', active)
        });
      },

      upgrade() {
        if (this.user) {
          if (!this.user.subscribed) {
            this.getLink()
              .then(data => window.location.href = data.link)
          } else {
            this.$router.push({name: 'register'})
          }
        }
      },

      tryOpenPrograms() {
        if (this.user && this.user.subscribed) {
          this.$router.push({name: 'training.list'})
        } else {
          this.subscribe(true)
        }
      },
      tryRedirect(name) {
        let needSubscribe = name == 'training.list'

        if (!this.user) {
          this.setEntry(this.$router.currentRoute.path)
            .then(() => this.$router.push({name: 'login'}))

        } else {
          if (this.user.subscribed || !needSubscribe) {
            this.$router.push({name})
          } else {
            this.subscribe(true)
          }
        }
      },
      readMessage(item) {
        console.log('item', item)
        this.nread(item.id)
          .then(() => {
            if (item.route) {
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

            })//*/
          })

      },
      dropNotify() {
        this.markAsRead()
      }
    },
    computed: {
      ...mapGetters({
        musculeGroup: 'video/groups',
        user: 'auth/me',
        notifies: 'notify/list',
      }),
      userName() {
        if (this.user) {
          return this.user.name
        } else {
          return 'Guest'
        }
      },
      menuItems() {
        return this.mItems.filter(item => {
          if (!item.permit) return true
          if (!this.user) return false;

          switch (item.permit) {
            case 'upload':
              return this.user.role == 'admin' || this.user.role == 'trainer'
              break;
          }

          return true;
        })
      },
      unreadedMessages() {
        let news = this.notifies.filter(item => (item.state & 1) == 0);
        if (news && news.length > 7) {
          let b = news.splice(0, 7)
          return b
        }

        return news;
      },
      hasNew() {
        return this.unreadedMessages && this.unreadedMessages.length;
      },
      readedMessages() {
        let count = 10

        if (this.unreadedMessages && this.unreadedMessages.length) {
          count -= this.unreadedMessages.length
        }


        return this.notifies.filter(item => (item.state & 1) == 1).splice(0, count);
      },
    },
    mounted() {
      this.setActive(this.$router.currentRoute)
    },
    props: {
      page: {}
    }
  }
</script>

<style lang="stylus">
  @import '~variables'

  .notify_list {
    max-height: calc(65vh - 36px);
    overflow-y: scroll;
    overflow-x: hidden;

  .q-item {
    align-items: flex-start;
    background-color: #edeffb;
    width: 420px;

  img {
    width: 48px;
    height: 48px;
    max-width: 48px;
    max-height: 48px;
    overflow: hidden;
    border-radius: 50%;
  }

  .q-item-label {
    font-size: 13px;

  p {
    color: gray;
  }

  }
  &
  .is-new {
    background-color: #d2d4de;
    position: relative;

  .q-item-section:after {
    background-color: #f44336;
    width: 20px;
    height: 20px;
    top: 7px;
    left: 7px;
    position: absolute;
    border-radius: 50%;
    content: ' ';
  }

  }
  }

  .q-list-header {
    min-height: unset;
    padding: 4px 16px;
    color: gray;
  }

  }

  .q-toolbar.gtool {
    padding: 0px;

  @media screen and (max-width: 768px) {
    .logo {
      flex-grow: 2;
    }
  }

  .q-btn {
    text-transform: initial;

  .q-icon {
    color: $ primary;
    margin-left: 5px;
  }

  }
  .q-btn.notifications {

  i {
    color: white;
  }

  .hasnew {
    background-color: #f44336;
    width: 6px;
    height: 6px;
    top: 21px;
    right: 13px;
    position: absolute;
    border-radius: 50%;
  }

  }
  .show_menu, .search {

  i.q-icon {
    font-size: 35px;
    margin-left: 0px;
  }

  .q-btn-dropdown-arrow {
    display: none;
  }

  }
  }

  .dark-menu {
    max-width: unset !important;
    left: 0 !important;
    right: 0 !important;
    background: #000;

  .q-item {
    background-color: black !important;
    border-left: 4px solid black;
    padding: 0px 16px;
    align-items: normal;

  &
  .active {
    border-left-color: $ primary;
  }

  &
  :last-child .q-item-main {
    border-bottom-color: black;
  }

  }

  .q-item-main {
    display: flex;
    align-items: center;
    color: white
    border-bottom: 1px solid white;
  }

  }


  .profile-menu .q-btn-dropdown-arrow {
    display: none
  }

  .text-overflow {
    text-overflow: ellipsis;
    white-space: nowrap;
    overflow: hidden;
    display: block;
  }

  .hasNewNotify:after {
    content: ' ';
    background-color: $ primary;
    top: 13px;
    right: 12px;
    width: 8px;
    height: 8px;
    position: absolute;
    border-radius: 50%;
  }

  .byCenter {

  .q-item-side {
    display: flex;
    justify-content: center;
  }

  .q-item-main {
    border: none;
    padding: 5px 0;
  }

  }
  .q-btn.notify {
    padding: 4px 0;

  .q-btn-inner {
    justify-content: space-between;

  div {
    flex-grow: 1;
    text-align: left;
    text-transform: none;
  }

  }
  }
</style>
