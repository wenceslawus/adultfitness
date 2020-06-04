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
        <q-toolbar-title v-text="'Edit blog record'"/>
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
          <q-tabs>
            <!-- Tabs - notice slot="title" -->
            <q-tab default slot="title" name="tab-1" label="Blog category" />

            <!-- Targets -->
            <q-tab-pane name="tab-1">
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
                :error="$v.blog_category_id.$error"
                :errorLabel="($v.blog_category_id.$error)?'Field required':null"
              >
                <q-select
                  dark
                  v-model="blog_category_id"
                  float-label="Blog category"
                  :options="categoryList"
                  @input="$v.blog_category_id.$touch()"
                  @blur="$v.blog_category_id.$touch()"
                />
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
                icon="visibility"
              >
                <q-toggle
                  style="color:gray"
                  dark
                  v-model="enable"
                  label="Visible"
                />
              </q-field>

              <q-field
                class="q-mb-sm"
                icon="reorder"
                :error="$v.text.$error"
                :errorLabel="($v.text.$error)?'Field required':null"
              >
                <q-editor
                  v-model="text"
                  @input="$v.text.$touch()"
                  @blur="$v.text.$touch()"
                />
              </q-field>
              <q-field
                class="q-mb-sm"
                icon="date_range"
                :error="$v.dt.$error"
                :errorLabel="($v.dt.$error)?'Field required':null"
              >
                <q-datetime
                  v-model="dt"
                  dark type="date"
                  @input="$v.dt.$touch()"
                  @blur="$v.dt.$touch()"
                />
              </q-field>
            </q-tab-pane>
          </q-tabs>
        </div>

      </div>
    </q-modal-layout>
  </q-modal>
</template>

<script>
import muscule from 'src/components/misc/muscule-map'
import { required, email } from 'vuelidate/lib/validators'
import { mapGetters, mapActions } from 'vuex'
import Vue from 'vue'

export default {
  validations: {
      title: { required },
      text: { required },
      blog_category_id: { required },
      dt: { required },
  },
  props: {
    opened: {}
  },
  mounted () {
  },
  methods: {
    ...mapActions({
      save: 'blog/saveRecord',
      new: 'blog/newRecord',
      cancel: 'blog/cancelRecord',
      selectImage: 'upload/selectImage',
    }),
    loadImage() {
      this.selectImage(path => {
        this.image = path
      })
    },
    submit () {
      this.messate = null
      this.$v.$touch()

      if(this.$v.$error) {
        this.$q.notify('Please review fields again')
      } else {
        this.save({
          id: this.id,
          image: this.image,
          title: this.title,
          text: this.text,
          blog_category_id: this.blog_category_id,
          visible: this.enable,
          dt: this.created_at,
        })
      }
    },
  },
  watch: {
    editedRecord (newValue) {
      if (newValue) {
        this.id = newValue.id
        this.image = newValue.image
        this.title = newValue.title
        this.text = (newValue.text)?newValue.text:''
        this.blog_category_id = newValue.blog_category_id
        this.dt = newValue.created_at
        this.enable = !!newValue.visible
      }
    }
  },//*/
  computed: {
    ...mapGetters({
      editedRecord: 'blog/editedRecord',
      categories: 'blog/categories',
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
    categoryList() {
      return this.categories.map(item => {
        return {
          label: item.name,
          value: item.id
        }
      })
    }
  },

  data () {
    return {
      id: null,
      image: '',
      title: '',
      text: '',
      blog_category_id: null,
      dt: null,
      enable: false,
    }
  },
}
</script>
