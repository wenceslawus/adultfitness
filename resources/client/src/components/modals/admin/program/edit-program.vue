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
          type="a"
          dense
          v-close-overlay
          icon="keyboard_arrow_left"
          :label="$t('video.close')"
        />
        <q-toolbar-title v-text="'Edit training program'"/>
      </q-toolbar>

      <q-toolbar color="secondary" slot="footer">
        <q-toolbar-title>
            <q-btn
              type="a"
              class="float-right"
              label="Save"
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
            :error="$v.form.image.$error"
            :errorLabel="($v.form.image.$error)?'Field required':null"
          >
            <q-card color="black">
              <q-card-media>
                <img itemprop="image" :src="form.image" alt="nude training" style="max-width:200px" />
              </q-card-media>
              <q-card-actions>
                <q-btn
                  flat
                  type="a"
                  label="Load image"
                  @click="loadImage"
                  @input="$v.form.image.$touch()"
                  @blur="$v.form.image.$touch()"
                />
              </q-card-actions>
            </q-card>
          </q-field>

          <q-field
            class="q-mb-sm"
            icon="attach_file"
            :error="$v.form.file.$error"
            :errorLabel="($v.form.file.$error)?'Field required':null"
          >
            <q-card color="black">
              <q-card-actions>
                <q-btn
                  flat
                  type="a"
                  label="Load program"
                  @click="loadFile"
                  @input="$v.form.file.$touch()"
                  @blur="$v.form.file.$touch()"
                />
              </q-card-actions>
            </q-card>
          </q-field>

          <q-field
            class="q-mb-sm"
            icon="title"
            :error="$v.form.title.$error"
            :errorLabel="($v.form.title.$error)?'Field required':null"
          >
            <q-input
              dark
              v-model="form.title"
              float-label="Title"
              @input="$v.form.title.$touch()"
              @blur="$v.form.title.$touch()"
            />
          </q-field>



          <q-field
            class="q-mb-sm"
            icon="reorder"
            :error="$v.form.description.$error"
            :errorLabel="($v.form.description.$error)?'Field required':null"
          >
            <q-editor
              v-model="form.description"
              @input="$v.form.description.$touch()"
              @blur="$v.form.description.$touch()"
            />
          </q-field>

          <q-field
            class="q-mb-sm"
            icon="reorder"
          >
            <q-select
              multiple
              toggle
              chips
              float-label="Type"
              chips-color="black"
              dark
              v-model="form.types"
              :options="typesList"
            />
          </q-field>

          <q-field
            class="q-mb-sm"
            icon="reorder"
          >
            <q-select
              multiple
              toggle
              chips
              float-label="Body part"
              chips-color="black"
              dark
              v-model="form.bodies"
              :options="bodiesList"
            />
          </q-field>
        </div>

      </div>
    </q-modal-layout>
  </q-modal>
</template>

<script>
import { required } from 'vuelidate/lib/validators'
import { mapGetters, mapActions } from 'vuex'
import Vue from 'vue'

export default {
  validations: {
    form: {
      title: { required },
      description: { required },
      image: { required },
      file: { required },
    }
  },
  methods: {
    ...mapActions({
      load: 'training/loadItems',
      save: 'training/saveItem',
      cancel: 'training/cancel',
      selectImage: 'upload/selectImage',
      selectFile: 'upload/selectFile',
    }),
    loadImage() {
      this.selectImage(path => {
        this.form.image = path
      })
    },
    loadFile() {
      this.selectFile(path => {
        this.form.file = path
      })
    },
    submit () {
      this.messate = null
      this.$v.form.$touch()

      if(this.$v.form.$error) {
        this.$q.notify('Please review fields again')
      } else {
        this.save(this.form)
      }
    },
  },
  watch: {
    editedRecord (newValue) {
      if (newValue) {
        this.form = newValue
        this.form.description = (newValue.description)?newValue.description:''
        this.form.bodies = newValue.bodies.map(item => {
          return item.toString()
        })

        this.form.types = newValue.types.map(item => {
          return item.toString()
        })
      }
    }

  },
  computed: {
    ...mapGetters({
      editedRecord: 'training/item',
      typesList: 'training/typesList',
      bodiesList: 'training/bodiesList',
    }),
    visibility:{
      get () {
        return !!this.editedRecord
      },
      set (newValue) {
        if(!newValue) {
          this.cancel()
        }
      }
    },
  },

  data () {
    return {
      form: {
        id: 'new22',
        types: [],
        bodies: [],
        description: '',
        image: '',
        file: '',
      },
    }
  },
}
</script>
