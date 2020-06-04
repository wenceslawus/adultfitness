<template>
  <q-layout class="black" view="lHh Lpr lFf">
    <q-layout-header>
      <q-toolbar color="secondary" >
        <div class="container justify">
          <q-btn
            to="/"
            type="a"
            class="logo"
            flat
          >
            <img
              itemprop="image"
              src="~assets/logo.png"
              alt="Nude Fitness - AdultFitness"
            >
          </q-btn>

          <q-btn 
            type="a"
            class="gt-sm" 
            :class="{active: this.pageName == 'index' }"
            :label="$t('general.home')" to="/" 
          />
          <a-group 
            class="gt-sm"
            :label = "$t('general.select')"
            :items = "musculeGroup"
          />
          <q-btn 
            type="a"
            class="q-mr-sm gt-sm" 
            :class="{active: this.pageName == 'blog' }"
            :label="$t('general.programs')" 
            to="/blogs" 
          />
          
          <a-search 
            class="gt-md"
            style="flex-grow: 2"
          />

          <a-profile-menu
            class="gt-sm"
            label = "Alexander Gudrin"
            :items = "musculeGroup"
            image="/statics/profile_test.png"
          />

          <q-btn
            class="notifications"
            type="a"
            icon="notifications"
          >
            <span class="hasnew" />
            <!-- Direct child of target -->
            <q-popover>
              <!--
                The DOM element(s) that make up the popup,
                in this case a list:
              -->
              <q-list separator link>
                <!-- notice `v-close-overlay` which closes popover -->
                <q-item v-close-overlay @click.native="doSomething">
                  ...
                </q-item>
              </q-list>
            </q-popover>
          </q-btn>

          <q-btn
            class="lt-md show_menu"
            type="a"
            icon="menu"
          />
        </div>
      </q-toolbar>
    </q-layout-header>

    <a-mobile-drawer />
    <a-mobile-notify />

    <q-page-container>
      <router-view />
    </q-page-container>

    <footer>
    </footer>
  </q-layout>
</template>

<script>
import { openURL } from 'quasar'
import { mapGetters } from 'vuex'
//import sidebar from 'components/sidebar'

import searchComponent from 'components/input/search'
import topMenu from 'components/menu/top'
import dropMenu from 'components/menu/drop'

import groupsComponent from 'components/menu/groups'
import profileMenu from 'components/menu/profile-menu'

import mobileDrawer from 'components/menu/mobile_drawer.vue'
import mobileNotify from 'components/menu/mobile_notify.vue'

export default {
  components:{
    //'a-sidebar': sidebar,
    'a-top-menu': topMenu,
    'a-drop-menu': dropMenu,
    'a-search': searchComponent,
    'a-group': groupsComponent,
    'a-profile-menu': profileMenu,
    'a-mobile-drawer': mobileDrawer,
    'a-mobile-notify': mobileNotify,
  },
  computed: {
    ...mapGetters({
      musculeGroup: 'video/groups',
    }),
    bannerSrc () {
      if (this.pageName == "index") {
        return '/statics/banner.jpg'
      } else {
        return '/statics/banner2.png'
      }
    }
  },
  watch: {
    '$route' (to, from) {
      this.updatePageName(to)
    }
  },
  name: 'layout',
  data () {
    return {
      pageName: '',
      searchText: '',
      rightDrawerOpen: false,
      footer_menu: [
        {
          title: 'Information',
          items: [
            'Terms & Condition',
            'Privacy Policy',
            'DMCA',
            'Contacts'
          ]
        },
        {
          title: 'Support and Help',
          items: [
            'Contact Support',
            'Feedback Forum'
          ]
        }
      ]
    }
  },
  mounted () {
    this.updatePageName(this.$router.history.current)
  },
  methods: {
    updatePageName (route) {
      const name = route.name
      switch (name) {
        case 'blogs': this.pageName = 'blog'; break;
        default:
          this.pageName = name
          break;
      }
    },
    openURL,
    clichH() {}
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
.q-toolbar {
  padding:0px;
  @media screen and (max-width: 768px) {
    .logo {
      flex-grow: 2;
    }
  }
  .q-btn {
    text-transform: initial;
    .q-icon {
      color: $primary;
      margin-left: 5px;
    }
  }
  .q-btn.notifications {
    i {
      color:white;
    }
    .hasnew {
      background-color: $primary;
      width: 4px;
      height: 4px;
      top: 21px;
      right: 16px;
      position: absolute;
      border-radius: 50%;
    }
  }
  .show_menu i{
    font-size: 35px;
  }
}
  .top-banner{
    width:100%;
    padding-top:64px;
  }
  .q-layout-page-container {
    
  }
  footer {
    background-color: #141414;
    color:#8b8b8b;
    .lighter {
      background-color: #1a1a1a;
      padding: 45px 0 40px;
    }
    h3 {
      color: white;
      font-size: 16px;
      font-weight: bold;
      margin-bottom: 0;
      padding:0 10px;
    }
    p {
      padding:0 10px;
    }
    .imaged {
      background-image: url(/statics/logo_gray.png);
      background-repeat: no-repeat;
      background-position: center;
      display: flex;
      align-items: flex-end;
      p {
        font-size: 12px;
        text-align: center;
        width:100%;
        padding: 0 20px; 
      }
      @media screen and (max-width: 575px) {
        background-position: top;
        min-height: 120px;
      }
    }
    .soc_list {
      display: flex;
      align-items: center;
      justify-content: center;
      flex-wrap: wrap;
      .q-btn {
        margin: 0 7px;
        background-color: #484848;
      }
    }
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
  .profile-menu .q-btn-dropdown-arrow{ display: none}
    .text-overflow {
    text-overflow: ellipsis;
    white-space: nowrap;
    overflow: hidden;
    display: block;
  }
</style>
