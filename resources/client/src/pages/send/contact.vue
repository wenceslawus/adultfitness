<template>
  <q-page class="row justify-center">
    <q-card inline class="text-primary black-shadow col-xs-12 col-sm-8 col-md-6 q-ma-sm">
      <a-divider
        :title="$t('send.contact')"

        style="margin: 10px 0"
        customIcon="sent-mail"
      />
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
          icon="person"
          :error="$v.form.name.$error"
        >
          <q-input
            type="text"
            v-model="form.name"
            :float-label="$t('send.full')"
          />
        </q-field>

        <q-field
          class="q-mb-sm"
          icon="email"
          :error="$v.form.email.$error"
        >
          <q-input
            v-model="form.email"
            :float-label="$t('send.email')"
            @input="$v.form.email.$touch()"
            @blur="$v.form.email.$touch()"
          />
        </q-field>

        <q-field
          class="q-mb-sm"
          icon="subject"
          :error="$v.form.description.$error"
        >
          <q-input
            v-model="form.description"
            type="textarea"
            rows="7"
            :max-height="100"
            :float-label="$t('send.message')"
            @input="$v.form.description.$touch()"
            @blur="$v.form.description.$touch()"
          />
        </q-field>
      </q-card-main>
      <q-card-actions class="block text-right">
        <q-btn
          type="a"
          class="q-mt-md q-ml-md"
          @click="send"
          label="Send"
        />
      </q-card-actions>
    </q-card>
  </q-page>
</template>
<script>
import divider from 'components/misc/title'
import blogCard from 'components/misc/blog-card'
import { required, email } from 'vuelidate/lib/validators'
import { mapGetters, mapActions } from 'vuex'

export default {
  components: {
    'a-divider': divider,
    'a-blog-card': blogCard,
  },
  validations: {
    form: {
      email: { required, email },
      name: { required },
      description: { required },
    }
  },
  computed:{
    ...mapGetters({
      user: 'auth/me',
    })
  },
  methods: {
    ...mapActions({
      sendMessage: 'auth/contactus'
    }),
    send () {
      this.message = null;
      this.$v.form.$touch()

      if (this.$v.form.$error) {
        this.$q.notify('Please review fields again.')
      } else {
        this.sendMessage(this.form)
          .then(() => {
            this.$q.notify({
              type: 'positive',
              position: 'center',
              timeout: 0,
              closeBtn: true,
              message: this.$t('send.contact_response')
            })

            this.form.email = ''
            this.form.name = ''
            this.form.description = ''
            this.$v.form.$reset()
          })
          .catch(e => {
            this.message = e.data.errors.email[0]
          })
      }
    },
  },
  mounted() {
    if(this.user){
      this.form.name = this.user.name
      this.form.email = this.user.email
    }
  },
  data(){
    return {
      link: '',
      form: {
        email: '',
        name: '',
        description: '',
      },
      message: null,
    }
  },
}
</script>

<style>
  .text-primary input, .text-primary textarea {
    color: white;
  }
</style>
