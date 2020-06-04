<template>
  <q-page class="row justify-center">
    <q-card inline class="text-primary black-shadow col-xs-12 col-sm-8 col-md-6 q-ma-sm">
      <q-card-title class="">{{ $t('auth.restorePass') }}</q-card-title>
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
          :label="$t('auth.send')"
        />
      </q-card-actions>
    </q-card>
  </q-page>
</template>

<script>
import { mapActions } from 'vuex'
import { required, email } from 'vuelidate/lib/validators'

export default {
  validations: {
    form: {
      email: { 
        required, 
        email, 
      },
    }
  },
  methods: {
    ...mapActions({
      restore: 'auth/forgot',
    }),
    submit () {
      this.$v.form.$touch()

      if (this.$v.form.$error) {
        this.$q.notify('Please review fields again.')
      } else {
        this.restore(this.form.email)
          .then(() => {
            this.state = 'info'
            this.message = this.$t('auth.restoreSended')
          })
          .catch( error => {
            this.state = 'negative'
            this.message = this.$t('error.emailNoExist')
          })
      }
    },
    getError (field) {
      const item = this.$v.form[field]
      switch (field) {
        case 'email':
          if (!item.required) return this.$t('error.require', {field: field})
          if (!item.email) return this.$t('error.email', {field: field})
          break;
      }
    }
  },
  mounted() {
    this.message = null;
  },
  data(){
    return {
      state: null,
      message: null,
      form: {
        email: '',
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
