<template>
  <q-page class="row justify-center login">
    <q-card inline class="text-primary black-shadow col-xs-12 col-sm-8 col-md-6 q-ma-sm">
      <q-card-title class="">Login</q-card-title>
      <q-card-main>
        <q-alert
          type="negative"
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
        >
          <q-input
            v-model="form.email"
            float-label="EmailAdress"
            @input="$v.form.email.$touch()"
            @blur="$v.form.email.$touch()"
          />
        </q-field>

        <q-field
          class="q-mb-sm"
          icon="lock"
          :error="$v.form.password.$error"
        >
          <q-input
            type="password"
            v-model="form.password"
            float-label="Password"
          />
        </q-field>

        <q-btn
          type="a"
          class="q-mt-md q-ml-md full-width"
          color="primary"
          @click="submit"
          label="Login"
        />
      </q-card-main>
      <q-card-actions class="block text-center">
        <q-btn class="q-mt-md"
          type="a"
          to="/forgot"
          style="color: gray !important;"
          label="Forgot password"/>

        <span style="color: white;margin-top: 15px;display: inline-block;height: 36px;line-height: 36px;vertical-align: middle;">&nbsp;|&nbsp;New to AdultFittness?</span>
        <q-btn
          type="a"
          class="q-mt-md q-ml-md"
          :to="{name: 'register'}"
          label="SIGN UP Now"
        />
      </q-card-actions>
    </q-card>
  </q-page>
</template>

<script>
import { required, email } from 'vuelidate/lib/validators'
import { mapGetters, mapActions } from 'vuex'

export default {
  validations: {
    form: {
      email: { required, email },
      password: { required },
    }
  },
  computed: {
    ...mapGetters({
      lastPath: 'auth/entryFrom'
    })
  },
  methods: {
    ...mapActions({
      login: 'auth/login'
    }),
    submit () {
      this.message = null;
      this.$v.form.$touch()

      if (this.$v.form.$error) {
        this.$q.notify('Please review fields again.')
      } else {
        this.login(this.form)
          .then(() => {
            this.$router.push(this.lastPath)
          })
          .catch(e => {
            this.message = e.data.errors.email[0]
          })
      }
    }
  },
  data(){
    return {
      form: {
        email: '',
        password: '',
      },
      message: null,
    }
  },
}
</script>

<style>
  .login .text-primary input {
    color: white;
  }
</style>
