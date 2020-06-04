<template>
  <q-page class="row justify-center">
    <q-card inline class="text-primary black-shadow col-xs-12 col-sm-8 col-md-6 q-ma-sm">
      <q-card-title class="">
        <div class="row">
          <div class="col-4">Step 1</div>
          <div class="col-8" style="color:White">CREATE YOUR ACCOUNT</div>
        </div>

      </q-card-title>
      <q-card-main>
        <q-field
          class="q-mb-sm"
          icon="person"
          :error="$v.form.name.$error"
          :error-label="getError('name')"
        >
          <q-input
            v-model="form.name"
            :float-label="$t('auth.name')"
          />
        </q-field>

        <q-field
          class="q-mb-sm"
          icon="email"
          :error="$v.form.email.$error"
          :error-label="getError('email')"
        >
          <q-input
            v-model="form.email"
            :float-label="$t('auth.email')"
            @input="$v.form.email.$touch()"
            @blur="$v.form.email.$touch()"
          />
        </q-field>

        <q-field
          class="q-mb-sm"
          icon="lock"
          :error="$v.form.password.$error"
          :error-label="getError('password')"
        >
          <q-input
            type="password"
            v-model="form.password"
            :float-label="$t('auth.password')"
          />
        </q-field>

        <q-field
          class="q-mb-sm"
          icon="lock"
          :error="$v.form.password_confirmation.$error"
          :error-label="getError('password_confirmation')"
        >
          <q-input
            type="password"
            v-model="form.password_confirmation"
            :float-label="$t('auth.confirm')"
          />
        </q-field>

        <q-alert
          class="q-my-lg"
          style="position:relative;display:none"
          :actions="[{ label: '$4.99/month' }]"
        >
          <strong>Full Access for ONLY</strong>
          <span style="display: block;background: white;color: gray;font-size: 13px;padding: 5px;position: absolute;left: 0;bottom: -13px;">Rebiled automaticaly each month for $4.99</span>
        </q-alert>


        <q-field
          class="q-mb-sm"
          :error="$v.form.checked.$error"
          :error-label="getError('checked')"
        >
          <q-checkbox
            style="color: #979797;"
            v-model="form.checked"
            label="I have read and agree to the"
          />
          <q-btn
            type="a"
            class="q-px-xs q-ml-xs"
            color="white"
            flat
            :to="{name: 'page.terms'}"
            label="terms of conditions"
          />
        </q-field>


      </q-card-main>
      <q-card-actions class="block text-center">
        <!--q-btn class="q-mt-md d-none"
          to="/forgot"
          :label="$t('auth.forgot')"
        /-->
        <q-btn
          type="a"
          class="q-mt-md q-ml-md"
          @click="submit"
          color="primary"
          label="Continue"
        />
      </q-card-actions>
      <q-card-main>
        <h5 class="q-ma-none" style="color:#999">Member Benefits</h5>
        <div class="row">
          <div
            class="col-12 col-sm-6 col-md-4"
            v-for="(list, index) in benefits"
            :key="index"
          >
            <ul>
              <li
                style="color:#cbcbcb"
                v-for="(item, item_index) in list"
                :key="item_index"
                v-text="item"
              />
            </ul>
          </div>
        </div>
      </q-card-main>
    </q-card>
  </q-page>
</template>

<script>
import { required, email, sameAs, minLength, helpers } from 'vuelidate/lib/validators'
import { mapGetters, mapActions } from 'vuex'

let emailOnServer = null;
const checkMailOnServer = value => !helpers.req(value) || value != emailOnServer
const mustBeChecked = (value) => !helpers.req(value) || value == true

export default {
  validations: {
    form: {
      name: { required },
      email: {
        required,
        email,
        user: checkMailOnServer
      },
      checked: { mustBeChecked },
      password: {
        required,
        minLength: minLength(6)
      },
      password_confirmation: {
        required,
        same: sameAs('password')
      },
    }
  },
  mounted() {
      let param = (this.$router.currentRoute.params)?this.$router.currentRoute.params.param:''
      
      if(this.me && param == 'premium') {
        if(this.me.subscribed) {
          this.$router.push('/')
        }else {
          this.getPayLink()
            .then(data => window.location.href = data.link)
        }
      }//*/
  },
  methods: {
    ...mapActions({
      register: 'auth/register',
      getPayLink: 'subscribe/getPayLink'
    }),
    getError (field) {
      const item = this.$v.form[field]
      switch (field) {
        case 'name':
          if (!item.required) return this.$t('error.require', {field: field})
          break;
        case 'email':
          if (!item.required) return this.$t('error.require', {field: field})
          if (!item.email) return this.$t('error.email', {field: field})
          if (!item.user) return this.$t('error.emailUsed', {field: field})
          break;
        case 'password':
          if (!item.required) return this.$t('error.require', {field: field})
          if (!item.minLength) return this.$t('error.minLength', {minLength: 6})
          break;
        case 'password_confirmation':
          if (!item.required) return this.$t('error.require', {field: 'confirm'})
          if (!item.same) return this.$t('error.sameAs', {field: 'password'})
          break;
        case 'checked':
          if (!item.mustBeChecked) return 'You must accept term'
          break;
      }
      return null;
    },
    submit () {
      this.$v.form.$touch()
      if (this.$v.form.$error) {
        this.$q.notify(this.$t('error.checkFields'))
      } else {
        this.register(this.form)
          .then(() => {
            let param = (this.$router.currentRoute.params)?this.$router.currentRoute.params.param:''
            
            if(param == 'free') {
              this.$router.push('/')
            } else {
              this.getPayLink()
                .then(data => window.location.href = data.link)
            }

          })
          .catch(error => {
            if (error.status == 500) {
              if (error.data.errors.email) {
                emailOnServer = this.form.email;
                this.form.email = ''
                this.form.email = emailOnServer
              }
            }
          })
      }
    }
  },
  computed: {
    ...mapGetters({
      lastPath: 'auth/entryFrom',
      me: 'auth/me',
      link: 'subscribe/link',
    }),
  },
  data(){
    return {
      benefits: [
        [
          'HD Videos',
          'FULLY Nude',
          'Muscle Diagram'
        ],
        [
          'Online Support',
          'User engagement',
          'Downloadable workouts'
        ],
        [
          'No Advertisement',
          'Exercise Library',
          'New Video Update'
        ]
      ],

      form: {
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
        checked: false
      }
    }
  },
}
</script>

<style>
  .text-primary input {
    color: white;
  }
</style>
