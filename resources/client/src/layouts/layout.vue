<template>
  <q-layout class="site black column" view="lHh Lpr lff">
    <q-layout-header>
      <a-general-toolbar
        :page="pageName"
      />
    </q-layout-header>

    <a-mobile-drawer />
    <a-mobile-notify />

    <a-banner
      :page="pageName"
      v-if="visible"
    />

    <q-page-container style="flex-grow:2; max-width:100;width: 100%;justify-content: center;">
      <router-view
        class="justify-start"
        style="min-height:unset !important"
      />
    </q-page-container>

    <q-btn
      round
      v-if="user && user.role == 'admin' && user.email == 'smorkva@gmail.com'"
      type="a"
      color="primary"
      @click="nssr"
      class="fixed"
      icon="input"
      style="right: 18px; bottom: 18px;z-index:999"
    />
    <a-footer />
  </q-layout>
</template>

<script>
import gToolbar from 'components/menu/toolbar'
import myFooter from 'components/misc/footer'
import myBanner from 'components/misc/banner'
//import subscribeDialog from 'components/modals/subscribe'
import {mapGetters, mapActions} from 'vuex'
import { openURL } from 'quasar'
import Vue from 'vue'

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
  watch: {
    '$route' (to, from) {
      this.updatePageName(to)
    },
  },
  name: 'layout',
  data () {
    return {
      pageName: '',
      searchText: '',
      rightDrawerOpen: true,
      menuShowed: false,
      pageIndex: 0,
      pages: [],
    }
  },
  mounted () {
    let rname = this.$router.currentRoute.name

    this.updatePageName(this.$router.history.current)
  },
  methods: {
    ...mapActions({
      subscribe: 'subscribe/showDialog',
      _logout: 'auth/logout',

      setGuest: 'auth/setGuest',
      restoreMe: 'auth/restoreMe',
      setSSR: 'general/setSSR',
      pushNSSR: 'general/pushNSSR',
      openURL,
    }),
    logout () {
      this._logout()
        .then(() => {
          this.$router.push("/")
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
    getPage(){
      let url = this.pages[this.pageIndex]

      this.$router.push(url)//, () => {
        setTimeout(() => {
          this.pushNSSR(this.$router.currentRoute.path)
          //openURL(this.$router.currentRoute.path)
          this.pageIndex++

          if(this.pages[this.pageIndex]){
            this.getPage()
          }
        }, 2000);
      //})
      //this.pushNSSR(this.$router.currentRoute.path)
      /*.then(() => {
        //this.restoreMe()
      })//*/
    },
    nssr({}, link){
      this.setGuest()
        .then(() => {
          this.setSSR(true)
        })
        .then(() => {
          setTimeout(() => {
            this.pages = ['/','/group/5','/group/6','/group/7','/group/8','/group/9','/group/10','/group/11','/group/12','/group/13','/group/14','/group/15','/play/212','/play/211','/play/191','/play/190','/play/189','/play/188','/play/187','/play/183','/play/174','/play/149','/play/148','/play/136','/play/2','/play/19','/play/30','/play/31','/play/32','/play/33','/play/34','/play/35','/play/36','/play/37','/play/38','/play/39','/play/40','/play/41','/play/42','/play/43','/play/44','/play/45','/play/46','/play/47','/play/48','/play/49','/play/50','/play/51','/play/52','/play/53','/play/54','/play/55','/play/56','/play/57','/play/59','/play/60','/play/61','/play/62','/play/63','/play/64','/play/66','/play/67','/play/69','/play/72','/play/77','/play/80','/play/82','/play/83','/play/85','/play/86','/play/87','/play/88','/play/89','/play/90','/play/91','/play/92','/play/93','/play/94','/play/95','/play/96','/play/97','/play/98','/play/99','/play/100','/play/101','/play/102','/play/103','/play/104','/play/105','/play/106','/play/107','/play/111','/play/113','/play/114','/terms','/privacy','/blogs','/about-us','/2257','/feedback','/contact','/training/','/blog/11','/blog/10','/blog/8','/blog/7','/group/2','/group/3','/group/4']
            //this.pages = ['/terms', '/feedback']

            this.getPage()
            //this.pushNSSR(this.$router.currentRoute.path)
            /*.then(() => {
              //this.restoreMe()
            })
            .catch(() => {
              //this.restoreMe()
            })//*/

            //this.restoreMe()
          }, 1000)
        })
    },
  },
  computed: {
    ...mapGetters({
      musculeGroup: 'video/groups',
      user: 'auth/me',
    }),


    visible () {
      let rname = this.pageName

      return !(rname == 'register' || rname == 'register.update' || rname == 'training.list')
    },
  }
}
</script>

<style lang="stylus">
@import '~variables'

aside{
  top: 0px !important;
  &.full-width {
    /*width: 100% !important;*/
  }
}
.mobile aside{
  .q-list.notify_list{
    max-height: unset;
    height: calc(100% - 36px);
    .q-item {
      width: 100%;
    }
    .q-list-header{
      text-align: left;
      color: black;
      font-weight: normal;
      padding: 10px 16px;
      background: white;
    }
  }
}

.q-layout-drawer {
  background: black !important;
  text-align: center;

  .q-list{
    padding: 0;
    border: none;
    .q-item:last-child{
      border: none;
    }
  }
  img.avatar{
    width: 150px;
    height: 150px;
    border-radius: 50%;
    margin-top: 26px;
  }
  h3 {
    color: white;
    font-size: 1.7em;
    text-align: center;
    font-weight: 300;
    margin: 5px 0 0;
    line-height: 1em;
  }
  .view-profile{
    color: gray;
    text-decoration: none;
    text-transform: none;
    font-weight: 300;
    font-size: 1em;
    margin: 0 auto;
    min-height: 2em;
    margin-bottom: 10px;
  }
  .q-item.menu-item {
    background: #141414 !important;
    border-bottom: 1px solid #646464;
    color: #9c9c9c;
    height: 57px;
    .q-btn.notify {
      padding-left: 5px;
      margin-left: -5px;
    }
    .q-item-label{
      font-size: 1.4em;
    }
    .q-btn-inner {
      i.q-icon {
        display: none;
      }
      div {
        font-size: 1.4em;
      }
    }
    img {
      min-width: unset;
      min-height: unset;
      width: 42px;
      height: 44px;
    }
  }
}
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
.mobile_notify {
    z-index: 99999;
    position: absolute;
    width: 350px;
    top: 0;
    bottom: 0;
    left: 0;
    background: white;
}
</style>
