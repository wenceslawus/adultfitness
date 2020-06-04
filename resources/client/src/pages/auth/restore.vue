<template>
  <q-page class="row justify-center">
    <q-card inline class="text-primary black-shadow col-xs-12 col-sm-8 col-md-6 q-ma-sm">
      <q-card-title class="">Input new password</q-card-title>
      <q-card-main>
        <q-alert
          :type="state"
          icon="email"
          class="q-mb-lg"
          v-if="message"
        >
          {{ message }}
        </q-alert>

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
      </q-card-main>
      <q-card-actions class="block text-right">
        <q-btn class="q-mt-md"
          type="a"
          to="/login"
          :label="$t('auth.iremember')"
        />
        <q-btn
          type="a"
          class="q-mt-md q-ml-md"
          @click="submit"
          :label="$t('auth.restore')"
        />
      </q-card-actions>
    </q-card>
  </q-page>
</template>

<script>
import { required, minLength, sameAs } from 'vuelidate/lib/validators'
import { mapActions, mapGetters } from 'vuex'

export default {
  validations: {
    form: {
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
  computed: {
    ...mapGetters({
      entryFrom: 'auth/entryFrom',
    })
  },
  mounted() {
    const token = this.$router.currentRoute.params.token
    if (token) {
      this.form.token = token
    } else {
      this.$router.push('/login')
    }
  },
  methods: {
    ...mapActions({
      reset: 'auth/restore'
    }),
    getError (field) {
      const item = this.$v.form[field]
      switch (field) {
        case 'password':
          if (!item.required) return this.$t('error.require', {field: field})
          if (!item.minLength) return this.$t('error.minLength', {minLength: 6})
          break;
        case 'password_confirmation':
          if (!item.required) return this.$t('error.require', {field: 'confirm'})
          if (!item.same) return this.$t('error.sameAs', {field: 'password'})
          break;
      }
      return null;
    },
    submit () {
      this.$v.form.$touch()

      if (this.$v.form.$error) {
        this.$q.notify('Please review fields again.')
      } else {
        this.reset(this.form)
          .then(data => {
            this.$router.push(this.entryFrom)
          })
          .catch(error => {
            const res = error.data
            this.state = 'negative'
            if (res.error == 'Token broken') {
              this.message = this.$t('error.token')
            }
          })
      }
    }
  },
  data(){
    return {
      state: '',
      message: '',
      form: {
        token: '',
        password: '',
        password_confirmation: '',
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
