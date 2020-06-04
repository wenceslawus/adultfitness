<template>
  <q-page class="row justify-center">
    <q-card inline class="text-primary black-shadow col-xs-12 col-sm-8 col-md-6 q-ma-sm">
      <a-divider
        :title="$t('send.feedback')"
        style="margin: 10px 0"
        customIcon="sent-mail"
      />
      <q-card-main class="text-center">
        <q-alert
          type="negative"
          icon="email"
          class="q-mb-lg"
          v-if="message"
        >
          {{ message }}
        </q-alert>

        <p class="text-white">{{ $t('send.feedi1') }}</p>
        <p class="text-white">{{ $t('send.feedi2') }}</p>

        <q-btn-group>
          <q-btn
            type="a"
            v-for="(item, index) of btns"
            :key="index"
            :icon="item"
            size="xl"
            :color="(form.rate == index+1)?'black':null"
            @click="form.rate = index+1"
          />
        </q-btn-group>

        <p class="text-white">{{ $t('send.feedi3') }}</p>
        <q-btn-group outline>
          <q-btn
            type="a"
            v-for="(item, index) of feedCategories"
            :key="index"
            :label="item"
            size="sm"
            outline

            :color="(form.feedCategory == index+1)?'white':null"
            @click="form.feedCategory = index+1"
          />
        </q-btn-group>

        <q-field
          class="q-mb-sm"
          icon="subject"
          style="max-width:400px;margin: 30px auto 0"
          :error="$v.form.description.$error"
        >
          <q-input
            v-model="form.description"
            type="textarea"
            rows="7"
            :max-height="100"
            float-label="Please leave your feedback below:"
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
          :disable="!form.feedCategory || !form.rate"
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
      description: { required },
    }
  },
  computed: {
    ...mapGetters({
      lastPath: 'auth/entryFrom',
      user: 'auth/me',
    })
  },
  mounted() {
    if(this.user){
      this.form.name = this.user.name
      this.form.email = this.user.email
    } else {
      this.form.name = ''
    this.form.email = ''
    }
  },
  methods: {
    ...mapActions({
      feedback: 'auth/feedback'
    }),
    send () {

      this.message = null;
      this.$v.form.$touch()

      if (this.$v.form.$error) {
        this.$q.notify('Please review fields again.')
      } else {
        this.feedback(this.form)
          .then(() => {
            this.$q.notify({
              type: 'positive',
              position: 'center',
              timeout: 0,
              closeBtn: true,
              message: this.$t('send.feedback_response')
            })

            this.form.rate = null
            this.form.feedCategory = null
            this.form.description = ''
            this.$v.form.$reset()
          })
          .catch(e => {
            //this.message = e.data.errors.email[0]
          })
      }
    }
  },
  data(){
    return {
      btns: [
        'sentiment_very_dissatisfied',
        'mood_bad',
        'sentiment_dissatisfied',
        'sentiment_satisfied',
        'mood',
      ],
      feedCategories: [
        'Suggestion',
        'Something is not quite right',
        'Compliment'
      ],
      form: {
        rate: null,
        feedCategory: null,
        description: '',
        name: '',
        email: '',
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
