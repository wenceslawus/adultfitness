<template>
  <q-layout class="site black" view="lHh Lpr lFf">
    <q-layout-header>
      <a-general-toolbar
        :page="pageName"
      />
    </q-layout-header>

    <a-mobile-drawer />
    <a-mobile-notify />

    <q-page-container style="padding-top: 64px !important;">
      <div class="container" v-if="userData">
        <q-card class="profile_card">
          <q-card-media class="relative-position">
            <q-btn
              fab flat
              type="a"
              icon="photo_camera"
              class="absolute"
              color="white"
              style="top: 5px; right: 5px;"
              @click="changeWallpaper"
            />
            <img itemprop="image" :src="wallpaper" alt="nude training">
          </q-card-media>
          <q-card-title class="relative-position" style="padding-top: 2px">
            <img
              itemprop="image"
              :src="avatar"
              alt="adult fitness"
              class="photo_profile absolute"
              @click="changePhoto"
            />
            <span class="proSheeld" v-if="sheeld" v-text="sheeld"/>
            <div class="controls row justify-between items-start">
              <div class="userProps relative-position">
                <div class="data" v-if="userData">
                  <div class="userName">{{ userData.name }}</div>
                  <div class="followers" style="font-size: 12px; line-height: 12px;"  v-if="userData.followers">{{userData.followers}} followers</div>
                </div>

              </div>
              <div class="btns row justify-end">
                <q-btn
                  type="a"
                  size="md"
                  glossy
                  v-for="(item, index) in auth_btns"
                  :key="index"
                  :class="{active: pageName==item.route}"
                  :label="item.label"
                  @click="goTo(item)" />
              </div>
            </div>

          </q-card-title>
        </q-card>
      </div>
      <router-view
        class="justify-start"
      />
    </q-page-container>
    <a-footer />
  </q-layout>
</template>

<script>
import gToolbar from 'src/components/menu/toolbar'
import myBanner from 'src/components/misc/banner'
import myFooter from 'src/components/misc/footer'
import { mapGetters, mapActions } from 'vuex'

import mobileDrawer from 'components/menu/mobile_drawer.vue'
import mobileNotify from 'components/menu/mobile_notify.vue'

export default {
  components:{
    'a-general-toolbar': gToolbar,
    'a-footer': myFooter,
    'a-banner': myBanner,
    'a-mobile-drawer': mobileDrawer,
    'a-mobile-notify': mobileNotify,
  },
  computed: {
    ...mapGetters({
      meAvatar: 'auth/avatar',
      userData: 'auth/me',
      //userData: 'training/trainer',
      musculeGroup: 'video/groups',
      user: 'auth/me',
      avatar: 'auth/avatar',
      notifies: 'notify/list',
      _showDrawer: 'general/showDrawer',
    }),
    showDrawer:{
      get: function(){ return this._showDrawer },
      set: function(newValue) {
        this.toggleDrawer(newValue)
      }
    },
    sheeld(){
      let role = 'user'
      if(this.userData && this.userData.role) {
        role = this.userData.role
      }


      if(role == 'trainer' || role == 'admin')
        return 'Trainer'
      else
        return null
    },
    wallpaper() {
      if(this.userData && this.userData.wallpaper) {
        return this.userData.wallpaper
      } else {
        return '/statics/profile_top.png'
      }
    },
    avatar() {
      if(this.userData && this.userData.avatar) {
        return this.userData.avatar
      } else {
        return '/statics/profile.png'
      }
    },
    auth_btns() {
      if(this.trainer_id == 'me') {
        return this.btns.filter(item => {
          if(!item.permit) return true
          //if(!this.me) return false

          const role = this.userData.role
          switch(item.permit){
            case 'upload':
              return role == 'admin' || role == 'trainer'
            case 'trainer':
              return role == 'admin' || role == 'trainer'
          }

          return true;

        })

      } else{
        return this.btns_public.filter(item => !item.permit || item.permit == 'training')
      }
    },
    menuItems(){
      return this.mItems.filter(item => {
        if(!item.permit) return true
        if(!this.user) return false;

        switch(item.permit){
          case 'upload':
            return this.user.role == 'admin' || this.user.role == 'trainer'
            break;
        }

        return true;
      })
    },
    visible () {
      let rname = this.pageName

      return !(rname == 'register' || rname == 'register.update' || rname == 'training.list')
    },
    unreadCount(){
      return this.notifies.reduce((summ, item) => {
        let counter = 0

        if(typeof summ == 'object'){
          if((summ.state & 1) == 0) {
            counter = 1
          }
        }else{
          counter = summ
        }

        if ((item.state & 1) == 0){
          counter++
        }

        return counter
      });
    }
  },
  watch: {
    '$route' (to, from) {
      //this.updatePageName(to)
    }
  },
  name: 'layout',
  data () {
    return {
      pageName: '',
      searchText: '',
      rightDrawerOpen: false,
      trainer_id: 'me',
      btns: [
        {
          label: 'Home',
          route: 'profile.home',
          permit: "trainer",
        },
        {
          label: 'Saved videos',
          route: 'profile.saved',
        },
        {
          label: 'My PlayList',
          route: 'profile.list',
        },
        {
          label: 'Settings',
          route: 'profile.settings',
        },
        {
          label: 'Uploads',
          route: 'profile.videos',
          permit: "upload"
        },
        {
          label: 'About',
          route: 'profile.me',
          permit: "trainer",
        }
      ],
    }
  },
  mounted () {
    this.updatePageName(this.$router.history.current)
  },
  methods: {
    ...mapActions({
      showSubscribe: 'subscribe/showDialog',
      selectFile: 'upload/selectAvatar',
      selectWallpaper: 'upload/selectWallpaper',
      setAvatar: 'auth/avatar',
      setWallpapers: 'auth/wallpaper',
      sendFollow: 'training/follow',
      getTrainer: 'training/getTrainer',
      setTrainer: 'training/setTrainer',
      clearTrainer: 'training/clearTrainer',
      markRead: 'notify/markRread',
      toggleDrawer: "general/toggleDrawer",
      subscribe: 'subscribe/showDialog',
      nread: 'notify/read',
      nremove: 'notify/remove',
      _logout: 'auth/logout',
    }),
    logout () {
      this._logout()
        .then(() => {
          this.$router.push("/")
        })
    },
    dropNotify(){
      this.markRead()
    },
    changePhoto() {
      this.selectFile(path => {
        this.setAvatar(path)
      })
    },
    changeWallpaper() {
      this.selectWallpaper(path => {
        this.setWallpapers(path)
      })
    },
    updatePageName (route) {
      const name = route.name
      switch (name) {
        case 'blogs': this.pageName = 'blog'; break;
        default:
          this.pageName = name
          break;
      }

      this.$router.history.push(route)
      //this.trainer_id = 'me'
      //this.router.push(route)

      /*if(route.params && route.params.id){
        this.trainer_id = route.params.id
        if(this.trainer_id != 'me') {

        }
      }

      this.setTrainer(this.me)
      if(route.params && route.params.id) {
				if(route.params.id == 'me') {
				} else {
          this.getTrainer(route.params.id)
            .then(() => {
              this.router.push(route)
            })
				}
			} else {

      }//*/
    },

    follow(){
      if(this.userData){
        this.sendFollow({
          id: this.trainer_id,
          state: (this.userData.followed)?'unfollow':''
        })
        .then(res => {
          this.$q.notify({
            message: (this.userData.followed)?'You subscribe':'You are unsubscribed',
            color:'positive'
          })
        })
      }
    },
    tryOpenPrograms(){
      if(this.user && this.user.subscribed){
        this.$router.push({name:'training.list'})
      } else {
        this.subscribe(true)
      }
    },
    tryRedirect(route){
      let name = route.name
      let needSubscribe = name == 'training.list'

      if(!this.user) {
        this.setEntry(this.$router.currentRoute.path)
          .then(() => this.$router.push({name:'login'}) )

      }else {
        if(this.user.subscribed || !needSubscribe){
          this.$router.push(route)
        } else {
          this.subscribe(true)
        }
      }
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

          this.$q.dialog({
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

          })
        })

    },
    goTo(item){
      this.updatePageName({
        name: item.route,
        params: item.params
      })
      //*/
      //:to=""
    }
  }
}
</script>

<style lang="stylus">
@import '~variables'

.container.justify {
  display: flex;
  justify-content:space-between;
  align-items: center;
  & > .q-btn {
    height: 64px;
    border-radius: 0;
    border-bottom: 2px solid #1e1e1e;
    &.active {
      border-color: $primary;
    }
  }
}
.site .q-layout-page-container {
  padding-top: 0px !important;
}

.logo img{
  height:55px;
}
.black-shadow {
  box-shadow: 0 0 5px #000;
}
.no-shadow {
  box-shadow: none;
}
.container {
  margin-left: auto;
  margin-right: auto;
  width: 100%;
  max-width:1286px;
}
.black {background-color: #000;}

.q-layout-page {
  padding: 0 20px 20px;
  @media screen and (max-width: 425px){
    padding: 0 0px 20px;
  }
}

.profile_card {
  margin: 0 30px 20px;
  @media screen and (max-width: 425px){
    margin: 0 0px 20px;
  }
  background-color:#141414;
  .photo_profile {
    top: 0;
    left: 40px;
    height: 164px;
    width: 164px;
    border-radius: 50%;
    cursor: pointer;
    transform: translateY(-50%);
  }
  .proSheeld {
    position: absolute;
    background: white;
    padding: 0 10px;
    top: 40px;
    left: 145px;
    font-weight: bold;

    background-color: $primary;
    border-radius: 3px;
    background-image: linear-gradient(to bottom, rgba(255,255,255,0.3), rgba(255,255,255,0) 50%, rgba(0,0,0,0.12) 51%, rgba(0,0,0,0.04)) !important;
  }
  .controls {
    color: #4c4c4c;
    .userProps {
      margin-left: 215px;
      min-width: 230px
      flex-wrap: wrap;
      .data {
        top: -75px;
        div {
          color: white;
          font-size: 22px;
          white-space: nowrap;
          text-overflow: ellipsis;
          overflow: hidden;
        }
      }
      .account {
        font-size: 24px;
        .q-btn {
          padding: 5px;
          font-size: 22px;
          min-height: unset;
        }
      }
    }
    .btns {
      .q-btn {
        margin: 5px 2px;
        /*padding: 5px;*/
        min-height: unset;
        height: 38px;
        line-height: 14px;
        /*font-size: 12px !important;*/
        color: black;
        background: #424242;

        @media screen and (max-width: 424px) {
          & {
            padding: 5px 3px;
            /*font-size: 9px !important;*/
          }
        }
      }
      .active {
        background-color: $primary;
      }

      flex-grow: 1;
      flex-wrap: wrap;
      @media screen and (max-width: 820px) {
        & {
          margin-top: 50px;
        }
      }
      @media screen and (max-width: 540px) {
        & {
          margin-top: 0px;
        }
      }
    }
  }
  @media screen and (max-width: 540px) {
    .q-card-media img {
      min-height: 70px;
    }
    .q-card-title {
      .photo_profile {
        left: 10px;
        width: 64px;
        height: 64px;
      }
      .proSheeld {
        padding: 0 5px;
        top: 15px;
        left: 45px;
        font-size: 10px;
        line-height: 13px;
      }
      .userProps {
        margin-left: 70px;
      }
    }
  }
}
.profile-sub-card {
  margin: 10px !important;
  .title {
    color: #4c4c4c !important;
    font-weight: bold;
    line-height: 26px;
    font-size: 15px;
  }
  .underline {
    text-decoration: underline;
  }
}
@media screen and (max-width: 576px){
  .profile_card .controls .btns .q-btn div {
    font-size: 10px !important;
  }
}
@media screen and (max-width: 425px){
  .profile-sub-card {
    margin: 0 0px 20px;
    background-color: #141414;
    color: #a2a2a2;
  }
}
</style>
