<template>
  <q-btn-dropdown
    round
    type="a"
    aria-label="Menu"
    size="md"
    class="profile-menu"
    wait-for-ripple
    :style="{backgroundImage:dropImage}"
  >
    <q-list link v-if="!user">
      <q-item to="/login">
        <q-item-tile label v-text="$t('auth.login')" />
      </q-item>
      <q-item to="/register">
        <q-item-tile label v-text="$t('auth.register')" />
      </q-item>
    </q-list>

    <q-list link>
      <q-item  to="/profile">
        <q-item-side left :avatar="avatar" />
        <q-item-main>
          <q-item-tile label v-text="$t('auth.profile')" />
          <q-item-tile sublabel v-text="$t('auth.view')" />
        </q-item-main>
      </q-item>

      <q-item-separator class="lt-lg"/>

      <q-item 
        class="lt-md"
        to="/program"
      >
        <q-item-tile label  v-text="$t('program.programs')" />
      </q-item>
      <a-groups class="lt-md" />
      <q-item class="lt-lg">
        <a-search-text />
      </q-item>
      
      <q-item-separator/>
      <q-item to="/bookmark">
        <q-item-tile label v-text="$t('video.videos')" />
      </q-item>
      <q-item to="/liked">
        <q-item-tile label v-text="$t('likes.likes')" />
      </q-item>
      <q-item to="/settings">
        <q-item-tile label v-text="$t('settings.settings')" />
      </q-item>
      
      <q-item-separator v-if="isAdmin" />

      <q-item to="/admin/client" v-if="isAdmin">
        <q-item-tile label v-text="$t('auth.users')" />
      </q-item>      
      <q-item to="/admin/category" v-if="isAdmin">
        <q-item-tile label v-text="$t('cat.categories')" />
      </q-item>
      <q-item to="/admin/video" v-if="isAdmin">
        <q-item-tile label v-text="$t('video.videos')" />
      </q-item>
      <q-item to="/admin/payment" v-if="isAdmin">
        <q-item-tile label v-text="$t('payment.payments')" />
      </q-item>
      
      

      <q-item-separator/>
      
      <q-item
        v-close-overlay
        @click.native="logout"
      >
        <q-item-tile label v-text="$t('auth.logout')" />
      </q-item>
    </q-list>
  </q-btn-dropdown>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'
import groupsComponent from 'components/menu/groups'
import searchComponent from 'components/input/search'

export default {
  data () {
    return {
      me: null
    }
  },
  components: {
    'a-search-text': searchComponent,
    'a-groups': groupsComponent,
  },
  computed: {
    ...mapGetters({
      avatar:'auth/avatar',
      user:'auth/me',
      isAdmin: 'auth/isAdmin',
    }),
    dropImage () {
      return `url("${this.avatar}")`;
    }
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
    }
  }
}
</script>

<style lang="scss">
  .profile-menu {
    background-size: cover;  
    .q-popover .q-btn {
      width: 100%;
      box-shadow: none;
      text-align: left;
    }
    .q-popover .q-btn .q-btn-inner {
      font-weight: normal;
      text-transform: none;
      font-size: 16px;
      justify-content: start;
    }
  }
    .q-popover {
      min-width: 180px !important;
    }
</style>


