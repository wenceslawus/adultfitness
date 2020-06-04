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
        <q-toolbar-title v-text="'Edit category'"/>
      </q-toolbar>

      <q-toolbar color="secondary" slot="footer">
        <q-toolbar-title>
            <q-btn 
              class="float-right"
              label="Save"
              color="primary"
              type="a"
              @click="saveCategory"
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
                icon="title"
              >
                <q-input
                  dark
                  v-model="name"
                  float-label="Name"
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
            </q-tab-pane>
          </q-tabs>
        </div>
        
      </div>
    </q-modal-layout>
  </q-modal>
</template>

<script>
import muscule from 'src/components/misc/muscule-map'
import {mapGetters, mapActions} from 'vuex'
import Vue from 'vue'

export default {
  props: {
    opened: {}
  },
  mounted () {
  },
  methods: {
    ...mapActions({
      save: 'blog/saveCategory',
      new: 'blog/newCategory',
      cancel: 'blog/cancelCategory',
    }),
    saveCategory() {
      this.save({
        id: this.id,
        name: this.name,
        visible: this.enable,
      })
    }
  },
  watch: {
    editedCategory (newValue) {
      if (newValue) {
        this.id = newValue.id
        this.name = newValue.name
        this.enable = !!newValue.visible
      }
    }
  },//*/
  computed: {
    ...mapGetters({
      editedCategory: 'blog/editedCategory',
    }),
    visibility:{
      get () {
        return !!this.editedCategory
      },
      set (newValue) {
        if(!newValue) {
          this.cancel()
        }
      }
    }
  },

  data () {
    return {
      id: null,
      name: '',
      enable: false,
    }
  },
}
</script>