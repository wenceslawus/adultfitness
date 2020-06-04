<template>
  <q-modal
    class="secondary"
    v-model="visibility"
    maximized
  >
    <q-modal-layout style="background-color:#111">
      <q-toolbar color="secondary" slot="header">
        <q-btn
          flat
          dense
          type="a"
          v-close-overlay
          icon="keyboard_arrow_left"
          :label="$t('video.close')"
        />
        <q-toolbar-title v-text="component.title"/>
      </q-toolbar>

      <q-toolbar color="secondary" slot="footer">
        <q-toolbar-title>
            <q-btn
              type="a"
              class="float-right"
              :label="component.button.save"
              color="primary"
              @click="submit"
            />
        </q-toolbar-title>
      </q-toolbar>

      <div class="layout-padding" style="background-color:#111">
        <div class="container">
              <q-field
                class="q-mb-sm"
                icon="image"
              >
                <q-card color="black">
                  <q-card-media>
                    <img itemprop="image" :src="image" alt="nude training" style="max-width:200px"/>
                  </q-card-media>
                  <q-card-actions>
                    <q-btn
                      flat
                      type="a"
                      label="Load image"
                      @click="loadImage"
                    />
                  </q-card-actions>
                </q-card>
              </q-field>
              <q-field
                class="q-mb-sm"
                icon="title"
                :error="$v.title.$error"
                :errorLabel="($v.title.$error)?'Field required':null"
              >
                <q-input
                  dark
                  v-model="title"
                  float-label="Title"
                  @input="$v.title.$touch()"
                  @blur="$v.title.$touch()"
                />
              </q-field>
              <q-field
                class="q-mb-sm"
                icon="reorder"
                :error="$v.body.$error"
                :errorLabel="($v.body.$error)?'Field required':null"
              >
                <q-editor
                  v-model="body"
                  @input="$v.body.$touch()"
                  @blur="$v.body.$touch()"
                />
              </q-field>
        </div>
      </div>
    </q-modal-layout>
  </q-modal>
</template>

<script>
import { required, email } from 'vuelidate/lib/validators'
import { mapGetters, mapActions } from 'vuex'

export default {
  validations: {
      title: { required },
      body: { required },
  },
  props: {
    mode: {}
  },
  data () {
    return {
      id: null,
      image: '',
      title: '',
      body: '',
      program: null,
      component:{
        title: null,
        button:{
          save: null
        }
      }
    }
  },
  methods: {
    ...mapActions({
      store: 'slider/storeSlider',
      update: 'slider/updateSlider',
      cancel: 'slider/cancelSlider',
      selectImage: 'upload/selectImage',
      selectFile: 'upload/selectFile',
    }),
    applyMode(){
      switch (this.mode) {
        case 'new':
          this.component.title = 'Create new slide'
          this.component.button.save = 'Create'
          break;
        case 'edit':
          this.component.title = 'Edit slide'
          this.component.button.save = 'Save'
          break;
        // default:
      }

    },
    loadImage() {
      this.selectImage(path => {
        this.image = path
      })
    },
    loadProgram(){
      this.selectFile(path => {
        this.program = path
      })
    },
    submit () {
      this.$v.$touch()
      if(this.$v.$error) {
        this.$q.notify('Please review fields again')
      } else {

        if(this.mode=='new'){
          this.store({
            image: this.image,
            program: this.program,
            title: this.title,
            body: this.body,
          })
        }else if(this.mode=='edit'){
          this.update({
            id: this.id,
            image: this.image,
            program: this.program,
            title: this.title,
            body: this.body,
          })
        }
      }
    },
  },
  watch: {
    mode(){
      this.applyMode()
    },
    slider(newValue){
        if (newValue) {
          this.id = newValue.id
          this.image = newValue.image
          this.program = newValue.program
          this.title = newValue.title
          this.body = (newValue.body)?newValue.body:''
        }
    }

  },
  computed: {
    ...mapGetters({
      slider: 'slider/slider',
      editedSlider: 'slider/editedSlider',
    }),
    visibility:{
      get () {
        return !!this.editedSlider
      },
      set (newValue) {
        if(!newValue) {
          this.cancel()
        }
      }
    },

    categoryList() {
      return this.categories.map(item => {
        return {
          label: item.name,
          value: item.id
        }
      })
    }
  },

}
</script>
