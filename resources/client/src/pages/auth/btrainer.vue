<template>
    <q-page class="row justify-center">
    <q-card inline class="text-primary black-shadow col-xs-12 col-sm-8 col-md-6 q-ma-sm">
      <q-card-title class="">
        <div class="row">
          <div class="col-4">Step {{step}}</div>
          <div class="col-8" style="color:White">CREATE TRAINER ACCOUNT</div>
        </div>

      </q-card-title>
      <q-card-main
        v-if="step==1"
      >
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
      <q-card-main v-else >
        <q-field
          class="q-mb-sm"
          :helper="$t('auth.experience_hind')"
          :error="$v.become.experience.$error"
          :error-label="getError('experience')" >
          <q-input
            dark
            v-model="become.experience"
            type="textarea"
            :max-height="100"
            :float-label="$t('auth.experience')"
            @input="$v.become.experience.$touch()"
            @blur="$v.become.experience.$touch()"
          />
        </q-field>
        <br/>

        <q-field
          class="q-mb-sm"
          :helper="$t('auth.education_hint')"
          :error="$v.become.education.$error"
          :error-label="getError('education')" >
          <q-input
            dark
            v-model="become.education"
            type="textarea"
            :max-height="100"
            :float-label="$t('auth.education')"
            @input="$v.become.education.$touch()"
            @blur="$v.become.education.$touch()"
          />
        </q-field>
        <br/>

        <q-field
          class="q-mb-sm"
          :helper="$t('auth.achievements_hint')"
          :error="$v.become.achievements.$error"
          :error-label="getError('achievements')" >
          <q-input
            dark
            v-model="become.achievements"
            type="textarea"
            :max-height="100"
            :float-label="$t('auth.achievements')"
            @input="$v.become.achievements.$touch()"
            @blur="$v.become.achievements.$touch()"
          />
        </q-field>
        <br/>

        <q-field
          class="q-mb-sm"
          :error="$v.become.regularly.$error"
          :error-label="getError('regularly')" >

          <div class="q-if-label">
            <div
              class="q-if-label-inner ellipsis"
              v-text="$t('auth.regularly')"
            />
          </div><br/>


          <q-radio v-model="become.regularly" :label="$t('auth.yes')" val="1" />
          <q-radio v-model="become.regularly" :label="$t('auth.no')" val="2" style="margin-left: 10px" />
          <q-radio v-model="become.regularly" :label="$t('auth.sometimes')" val="3" style="margin-left: 10px" />
        </q-field>
        <br/>

        <q-field
          class="q-mb-sm"
          :error="$v.become.skill.$error"
          :error-label="getError('skill')" >

          <div class="q-if-label">
            <div
              class="q-if-label-inner ellipsis"
              v-text="$t('auth.skill')"
            />
          </div><br/>

          <div style="color: gray;" v-text="$t('auth.skill_hint')"></div>
          <div style="color: gray;" v-text="$t('auth.skill_hint2')"></div>

          <div class="skill">
            <div
              v-for="n in 10"
              :key="n"
              v-text="n"
              class="item"
              :class="{active: n==become.skill}"
              :style="{background: colors[n-1]}"
              @click="become.skill = n"
            />
          </div>
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
          @click="goNext()"
          color="primary"
          label="Continue"
        />
      </q-card-actions>
      <q-card-main>
        <h5 class="q-ma-none" style="color:#999">Why become Adult Fitness TRAINER?</h5>
        <div class="row">
          <div
            class="col-12"
            v-for="(list, index) in benefits"
            :key="index" >
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
    },
    become: {
      experience: { required },
      education: { required },
      achievements: { required },
      regularly: { required },
      skill: { required },
    }
  },
  methods: {
    ...mapActions({
      register: 'auth/register',
      becomeTrainer: 'auth/becomeTrainer',
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
    goNext() {
      if(this.step == 1){
        this.$v.form.$touch()
        if (this.$v.form.$error) {
          this.$q.notify(this.$t('error.checkFields'))
        } else {
          this.step = 2;
        }
      } else {
        this.$v.become.$touch()
        if (this.$v.become.$error) {
          this.$q.notify(this.$t('error.checkFields'))
        } else {
          //this.$v.form.$touch()
          this.becomeTrainer(Object.assign(this.form, this.become))
            .then(() => {
              this.$router.push({name: 'profile.settings'})
              this.$q.notify({
                position: 'center',
                color: 'positive',
                message: this.$t('auth.becomeSended'),
              })
            })
            .catch(error => {
              if (error.status == 500) {
                if (error.data.errors.email) {
                  emailOnServer = this.form.email;
                  this.form.email = ''
                  this.form.email = emailOnServer
                  this.step = 1
                }
              }
            })
        }
      }
    }
  },
  computed: {
    ...mapGetters({
      lastPath: 'auth/entryFrom',
    }),
  },
  data(){
    return {
      benefits: [
        [
          'Inspire people all over the world to engage in physical activity',
          'Promote body emprowerment with fully NUDE training videos',
          'FREE marketing! We invest our own resources to help you get noticed',
          'Build a FANBASE you always wanted',
          'Link your social media accounts (Facebook, Instagram, YouTube)'
        ]
      ],
      step: 1,
      form: {
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
        checked: false,
      },
      colors: [
        '#9b0000',
        '#d20000',
        '#f80000',
        '#c9780d',
        '#fac231',
        '#feff00',
        '#68a94f',

        '#00bd00',
        '#01de00',
        '#0fff00',
      ],
      become: {
        experience: '',
        education: '',
        achievements: '',
        regularly: null,
        skill: null,
      }
    }
  },
}
</script>

<style>
  .text-primary input {
    color: white;
  }
  .skill {
    display:flex;
    margin-top: 15px;
    justify-content: space-between;
    background: url('/statics/skill.png');
  }
  .skill .item {
    width: 25px;
    height: 25px;
    color: black;
    text-align: center;
    padding: 4px 0;
    cursor: pointer;
    border:1px solid black;
  }
  .skill .item.active {
    border-color:white;
    box-shadow: 0 0 5px white;
  }
</style>
