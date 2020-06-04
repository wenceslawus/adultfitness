<template>
  <q-page class="container">
    <q-card
      style="margin:auto;background-color: #141414"
      class="profile-sub-card"
    >
      <q-card-main>
        <div class="row gutter-lg">
          <q-card class="text-primary no-shadow col-xs-12 col-sm-12">
            <q-card-main class="q-pt-none">
              <q-tabs
                v-model="current_tab"
                color="secondary" >
                <q-tab
                  slot="title"
                  name="account"
                  :label="$t('auth.account')" />
                <q-tab
                  slot="title"
                  style="display:none"
                  name="billing"
                  :label="$t('auth.billing')"
                />
                <q-tab
                  slot="title"
                  name="trainer"
                  v-if="canEditProfile"
                  :label="$t('profile.trainer')"
                />

                <q-tab-pane name="account">
                  <q-field
                    class="q-mb-sm"
                    icon="assignment_ind"
                  >
                    <q-input
                      dark
                      v-model="user.name"
                      :float-label="$t('auth.name')"
                    />
                  </q-field>

                  <q-field
                    class="q-mb-sm"
                    icon="email"
                  >
                    <q-input
                      dark
                      v-model="user.email"
                      :float-label="$t('auth.email')"
                    />
                  </q-field>

                  <!--q-field
                    color="secondary"
                    icon="language"
                  >
                    <q-select
                      dark
                      v-model="user.locale"
                      :float-label="$t('auth.langs')"
                      :options="languages"
                    />
                  </q-field-->

                  <h5 style="margin: 20px 0 0;">Change password</h5>
                  <q-field
                    class="q-mb-sm"
                    icon="lock"
                    :error="$v.password.old.$error"
                  >
                    <q-input
                      dark
                      type="password"
                      v-model="password.old"
                      :float-label="$t('auth.passcurrent')"
                    />
                  </q-field>
                  <q-field
                    class="q-mb-sm"
                    icon="lock"
                    :error="$v.password.password.$error"
                  >
                    <q-input
                      dark
                      type="password"
                      v-model="password.password"
                      :float-label="$t('auth.password')"
                    />
                  </q-field>
                  <q-field
                    class="q-mb-sm"
                    icon="lock"
                    :error="$v.password.confirm.$error"
                  >
                    <q-input
                      dark
                      type="password"
                      v-model="password.confirm"
                      :float-label="$t('auth.passconfirm')"
                    />
                  </q-field>
                </q-tab-pane>
                <q-tab-pane name="billing">
                  <h5 style="margin: 20px 0 10px;">Membership</h5>
                  <div style="padding-left:30px" class="row">
                    <div class="col-12 col-sm-6">
                      <p style="color: rgb(162, 162, 162);margin: 0;padding: 10px 0 9px;">Auto Pay - Rebilled automaticaly every month of $4.99</p>
                    </div>
                    <div class="col-12 col-sm-6">
                      <q-btn
                        type="a"
                        flat
                        color="red"
                        label="Cancel my Subscription"
                      />
                    </div>
                  </div>

                  <h5 style="margin: 20px 0 10px;">My Payment Method</h5>
                  <div style="padding-left: 30px">
                    <div class="row">
                      <div class="col-7 col-sm-4">
                        <p style="color: #fff;margin: 0;padding: 8px 0;font-weight: bold;">Visa **** 25558</p>
                      </div>
                      <div class="col-5 col-sm-4">
                        <q-btn
                          type="a"
                          flat
                          color="primary"
                          label="Edit"
                        />
                      </div>
                    </div>

                    <q-field
                      class="q-mb-sm"
                      icon="assignment_ind"
                    >
                      <q-input
                        dark
                        disabled
                        v-model="subscribe.name"
                        float-label="Card holder"
                      />
                    </q-field>

                    <q-field
                      class="q-mb-sm"
                      icon="assignment_ind"
                    >
                      <q-input
                        dark
                        disabled
                        v-model="subscribe.expiry"
                        float-label="Expires"
                      />
                    </q-field>

                    <q-field
                      class="q-mb-sm"
                      icon="assignment_ind"
                    >
                      <q-input
                        dark
                        disabled
                        v-model="subscribe.address"
                        float-label="Billing Address"
                      />
                    </q-field>
                  </div>

                </q-tab-pane>
                <q-tab-pane name="trainer" v-if="canEditProfile && user.trainer">
                  <!--h5 style="margin: 20px 0 0;">Change password</h5-->
                  <q-field
                    class="q-mb-sm"
                    icon="assignment_ind"
                  >
                    <q-input
                      dark
                      type="textarea"
                      :max-height="100"
                      rows="4"
                      v-model="user.trainer.bio"
                      :float-label="$t('profile.bio')"
                    />
                  </q-field>
                  <q-field
                    class="q-mb-sm"
                    icon="assignment_ind"
                  >
                    <q-input
                      dark
                      type="textarea"
                      :max-height="100"
                      rows="4"
                      v-model="user.trainer.description"
                      :float-label="$t('profile.description')"
                    />
                  </q-field>
                  <q-field
                    class="q-mb-sm"
                    icon="assignment_ind"
                  >
                    <q-input
                      dark
                      type="textarea"
                      :max-height="100"
                      rows="4"
                      v-model="user.trainer.specs"
                      :float-label="$t('profile.specs')"
                    />
                  </q-field>

                  <q-field
                    class="q-mb-sm"
                    icon="assignment_ind"
                  >
                    <q-input
                      dark
                      type="textarea"
                      :max-height="100"
                      rows="4"
                      v-model="user.trainer.exp"
                      :float-label="$t('profile.exp')"
                    />
                  </q-field>

                  <q-field
                    class="q-mb-sm"
                    icon="assignment_ind"
                  >
                    <q-input
                      dark
                      type="textarea"
                      :max-height="100"
                      rows="4"
                      v-model="user.trainer.hobby"
                      :float-label="$t('profile.hobby')"
                    />
                  </q-field>
                </q-tab-pane>
              </q-tabs>
            </q-card-main>
            <q-card-actions align="end">
              <q-btn
                type="a"
                label="Save"
                @click="trySave" />
            </q-card-actions>
          </q-card>
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
    data () {
      return {
        current_tab: 'account',
        visible: true,
        subtype: 'gold',

        password: {
          old: '',
          password: '',
          confirm: '',
        },

        sub_types: [
          {
            label: 'Basic',
            value: 'basic',
          },
          {
            label: 'Gold',
            value: 'gold',
          },
        ],
        user: {

        },
        trainer: {

        },
        subscribe: {
          name: 'Tomas Kohler',
          expiry: '02/23',
          address: '6805 Louise Ave, 502 Van Niuys, CA 91406',
        }
      }
    },
    mounted(){
      this.user = this.me
      this.user.trainer = Object.assign({}, this.me.trainer)
    },
    validations: {
      user: {
        name: { required },
        email: { required },
        //passwordConfirm: sameAs('passwordConfirm')
      },
      password: {
        old: { required },
        password: { required },
        confirm: { samePassword: sameAs('password') },
      },
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
      getCaption() {
        return (this.subtype == 'gold')?'Gold':'Basic'
      },
      canEditProfile() {
        return this.me.role == 'trainer' || this.me.role == 'admin'
      }
    },
    methods: {
      ...mapActions({
        'saveMe': 'auth/saveMe',
      }),
      changeSubscription() {

      },
      trySave(){
        this.$v.user.$touch()

        let check = this.$v.user.$error
        if(this.password.password) {
          this.$v.password.$touch()
          check = check && this.$v.password.$error
        }

        if (check) {
          this.$q.notify('Please review fields again.')
        } else {
          this.saveMe(this.user)
            .then(() => this.$q.notify({
              message: 'Your profile saved',
              type: 'positive',
              color: 'positive',
            }))

        }
        //*/
      },
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
