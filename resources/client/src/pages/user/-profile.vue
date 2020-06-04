<template>
  <q-page class="container">
    <q-card 
      style="margin:auto;background-color: #141414;"
      class="profile-sub-card"
    >
      <q-card-main>
        <div class="row gutter-lg">
          <div class="col-xs-12 col-md-6">
            <div class="row justify-between q-mb-lg">
              <div class="title" v-text="$t('auth.about')" />
              <q-btn
                type="a"
                flat
                color="primary"
                no-caps
                size="sm"
                class="underline"
                :label="$t('auth.tellabout')"
              />
            </div>
            <div class="desc">The default font embedded in Quasar App when built with Material Design Theme is Roboto. But it is not required. You can use whatever font(s) you like.
              
              Roboto comes with 5 different font weights you can use: 100, 300, 400, 500, 700. Below is an image from Google’s Roboto Specimen document displaying the different font weights:
            </div>
          </div>
          <div class="col-xs-12 col-md-6">
            <div class="row justify-between q-mb-lg">
              <div class="title" v-text="$t('auth.info')" />
              <q-btn
                type="a"
                flat
                color="primary"
                no-caps
                size="sm"
                class="underline"
                :label="$t('auth.settings')"
                :to="{name: 'profile.settings'}"
              />
            </div>
            <div 
              class="row user-props"
              v-for="(item, index) in userParams"
              :key="index"
            >
              <div class="col" v-text="$t(`auth.${item.name}`)" />
              <div class="col" v-text="item.value" />
            </div>
          </div>
        </div>
      </q-card-main>
    </q-card>

  </q-page>
</template>


<script>
  import { required, minLength, sameAs} from 'vuelidate/lib/validators'
  import videoGroups from 'components/video/group'
  import { mapGetters, mapActions } from 'vuex'

  export default {
    validations: {
      user: {
        name: { required },
        password: { 
          minLength: minLength(5)
        },
        passrequired: {
          sameAs: sameAs('password')
        }
      }
    },
    components: {
      'a-video-group': videoGroups,
    },
    computed: {
      ...mapGetters({
        avatar: 'auth/avatar',
        me: 'auth/me',
        languages: 'general/locales',
      }),
      userParams() {
        return [
          { name: 'gender', value: 'Male' },
          { name: 'lastin', value: '1 seconds ago' },
          { name: 'interes', value: 'Girls' },
          { name: 'city', value: 'Lipetsk' },
          { name: 'country', value: 'Russian Federation' },
          { name: 'profileview', value: '0' },
          { name: 'watched', value: '8' },
          { name: 'joined', value: '12 hours ago' },
        ]
      }
    },
    methods: {
      save () {

      }
    }
  }
</script>

<style lang="scss">
.profile-sub-card {
  .desc {
    color: #a2a2a2;
    font-size: 12px;
    line-height: 30px;
    white-space: pre-line;
  }
  .user-props {
    color: #a2a2a2;
    line-height: 30px;
  }
}
</style>
