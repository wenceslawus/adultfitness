<template>
  <div class="imaged-combo profile">
    <img 
      itemprop="image"
      class="q-ml-sm"
      :src="avatar" 
      alt="nude video training program"
    />
  
    <q-btn-dropdown
      class="group"
      type="a"
      :label="label" >
      <q-list class="q-profile-cmd" link>
        <q-item 
          v-for="(item, index) in itemList" 
          :key="index" 
          :to="{name: item.route}"
          v-close-overlay
          @click.native="handler(item.method)" >
          <q-item-side avatar :icon="item.icon" />         
          <q-item-main  :label="$t(`auth.${item.name}`)" />
        </q-item>

        <q-item-separator 
          v-if="isAdmin" />

        <q-item 
          v-for="(item) in itemAdmin" 
          :key="item.name" 
          :to="{name: item.route}"
          v-close-overlay
          @click.native="handler(item.method)"
        >
          <q-item-side avatar :icon="item.icon" />         
          <q-item-main  :label="$t(`auth.${item.name}`)" />
        
        </q-item>
        
        <q-item-separator 
          v-if="isAdmin"
        />
        
        <q-item 
          v-close-overlay
          v-if="(user)"
          @click.native="handler('exit')"
        >
          <q-item-side avatar icon="logout" />         
          <q-item-main  :label="$t(`auth.logout`)" />
        </q-item>
      </q-list>
    </q-btn-dropdown>
  </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'

export default {
  computed: {
    ...mapGetters({
      locale: 'general/locale',
      avatar:'auth/avatar',
      user:'auth/me',
      isAdmin: 'auth/isAdmin',
    }),
    itemList(){
      return this.items.filter((item) => {
        return (this.user && item.loged) || (!this.user && !item.loged)
      })
    },
    itemAdmin(){
      return (this.isAdmin)?this.adminItems: []
    }
  },
  props: {
    label: {},
  },
  methods: {
    ...mapActions({
      _logout: 'auth/logout'
    }),
    logout () {

      this._logout()
        .then(() => {
          this.$router.push("/")
        })
    },
    handler(command) {
      switch (command) {
        case 'exit':
          this.logout();
          break;
      }
    }
  },
  data() {
    return {
      adminItems: [
        /*{
          name: 'blogs',
          route: 'admin.blogs',
          icon: 'library_books',
          loged: true,
        },
        {
          name: 'videos',
          route: 'admin.videos',
          icon: 'video_library',
          loged: true,
        },//*/
        {
          name: 'users',
          route: 'admin.users',
          icon: 'library_books',
          loged: true,
        },
      ],
      items: [
        {
          name: 'login',
          route: 'login',
          icon: 'vpn_key',
          loged: false,
        },
        {
          name: 'register',
          route: 'register',
          icon: 'vpn_key',
          loged: false,
        },
        
        {
          name: 'profile',
          //route: 'profile.me',
          route: 'profile.saved',
          icon: 'account_box',
          loged: true,
        },
        {
          name: 'saved',
          route: 'profile.saved',
          icon: 'star',
          loged: true,
        },
        {
          name: 'playlist',
          route: 'profile.list',
          icon: 'videocam',
          loged: true,
        },
        {
          name: 'settings',
          route: 'profile.settings',
          icon: 'settings',
          loged: true,
        },
      ]
    }
  }
}
</script>
<style lang="stylus">
@import '~variables'
  .imaged-combo{
    display:flex;
    height: 64px;
    align-items: center;
    .q-btn {
      height:43px;
      margin-right: 5px;
      padding-right: 0px;
      padding-left: 10px;
      box-shadow: none;
      .q-focus-helper {
        margin: 0;
      }
      .q-btn-inner {
        flex-wrap: nowrap;
      }
    }
    img {
      margin-right: 5px;
      border-radius: 50%;
      width: 43px;
      height: 43px;
      border: 2px solid #444;
    }
  }
  .q-profile-cmd {
      border-radius: 0px;
      padding: 0px;
      background-color: #1d1d1d;
      .q-item-separator-component {
        border-bottom: 1px solid #2b2b2b;
      }
      .q-item {
        padding: 0px 16px;
        min-height: 36px;
        color: #7b7b7b;
        background-color: #1d1d1d;
        border-bottom: 1px solid #2b2b2b;
        &:hover {
          background-color: black;
          .q-item-label {
            color: $primary;
          }
        }
      }
    }
</style>
