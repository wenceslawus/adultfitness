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
        <q-toolbar-title v-text="$t('video.editVideo')"/>
      </q-toolbar>

      <q-toolbar color="secondary" slot="footer">
        <q-toolbar-title>
            <q-btn
              type="a"
              class="float-right"
              label="Save"
              color="primary"
              @click="saveVideo"
            />
        </q-toolbar-title>
      </q-toolbar>

      <div class="layout-padding" style="background-color:#111">
        <div class="container">
            <q-field
              v-if="me && me.role == 'admin'"
              class="q-mb-sm"
              icon="attach_money" >

              <q-checkbox
                dark
                class="payed"
                v-model="payed"
                label="It is payed video" />
            </q-field>

            <q-tabs>
            <br/>
            <!-- Tabs - notice slot="title" -->
            <q-tab default slot="title" name="tab-1" :label="$t('video.setGroup')" />
            <q-tab slot="title" name="tab-2" :label="$t('video.description')" />
            <q-tab slot="title" name="tab-3" v-if="me && me.role == 'admin'" :label="$t('video.parameters')" />

            <!-- Targets -->
            <q-tab-pane name="tab-1">
              <div class="row">
                <div class="col-xs-12 col-sm-6">
                  <a-muscule-map
                    :groups="musculeGroups"
                  />
                </div>
                <div class="col-xs-12 col-sm-6 q-pa-xs">
                  <q-list style="border:none">
                    <q-item
                      v-for="(group) in groups"
                      :key="group.id"
                    >
                      <q-item-main>
                        <q-item-tile
                          text-color="white"
                          label
                        >{{ `${group.id} - ${group.title}` }}</q-item-tile>
                      </q-item-main>
                      <q-item-side>
                        <q-select
                          class="full-width"
                          dark
                          v-model="selects[group.id]"
                          :options="weights"
                        />
                      </q-item-side>
                    </q-item>
                  </q-list>
                </div>
              </div>
            </q-tab-pane>
            <q-tab-pane name="tab-2" v-if="locales">
              <q-field
                class="q-mb-sm"
                icon="title"
              >
                <q-input
                  dark
                  v-model="locales.en.title"
                  :float-label="$t('cat.title')"
                />
              </q-field>
              <q-field
                class="q-mb-sm"
                icon="info"
              >
                <q-input
                  dark
                  v-model="locales.en.content"
                  type="textarea"
                  rows="3"
                  :float-label="$t('cat.description')"
                />
              </q-field>
              <q-field
                class="q-mb-sm"
                icon="label"
              >
                <q-input
                  dark
                  v-model="locales.en.meta_desc"
                  :float-label="$t('cat.meta')"
                />
              </q-field>
              <q-field
                class="q-mb-sm"
                icon="vpn_key"
              >
                <q-input
                  dark
                  v-model="locales.en.meta_keyword"
                  :float-label="$t('cat.keyword')"
                />
              </q-field>
            </q-tab-pane>

            <q-tab-pane
              v-if="me && me.role == 'admin'"
              name="tab-3"
            >
              <q-field
                class="q-mb-sm"
                icon="title"
              >
                <q-input
                  dark
                  v-model="link"
                  :float-label="$t('cat.link')"
                />
              </q-field>
              <q-field
                class="q-mb-sm"
                icon="title"
              >
                <q-input
                  dark
                  v-model="link_preview"
                  :float-label="$t('cat.link_preview')"
                />
              </q-field>

              <q-field
                class="q-mb-sm"
                icon="title"
              >
                <q-input
                  dark
                  v-model="duration"
                  :float-label="$t('cat.duration')"
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
      save: 'video/save',
      cancel: 'video/cancel',
    }),
    calcLink(link){
      if(link.indexOf('<a ') !== 0){
        return link
      }

      let parts = link.split('<')
      let result = ''

      parts.forEach(item => {
        let text = item.trim()
        const video_shift = text.indexOf('href=')

        if(video_shift !== -1) {
          text = text.substr(video_shift+6)
          result = text.substr(0,text.indexOf('"'))
        } else {
          const img_shift = text.indexOf('src=')
          if(img_shift !== -1) {
            text = text.substr(img_shift+5)
            this.link_preview = text.substr(0, text.indexOf('"') - 3) + "640"
          }
        }
      });

      return result;
    },
    saveVideo() {
      const params = {
        payed: this.payed,
        link: this.calcLink(this.link),
        link_preview: this.link_preview,
        duration: this.duration,
        locales: this.locales,
        groups: this.musculeGroups
      }

      this.save({
        id: this.id,
        params
      })
    }
  },
  components: {
    'a-muscule-map': muscule
  },
  watch: {
    editedVideo (newValue) {
      if (newValue) {
        this.id = newValue.id
        this.payed = !!newValue.payed
        this.link = newValue.link
        this.link_preview = newValue.link_preview
        this.duration = newValue.duration

        if(this.editedVideo.locales){
          const locales = this.editedVideo.locales
          this.locs.forEach((l) => {
            if (!locales[l.value]) {
              locales[l.value] = {}
            }
          })
          this.locales = locales
        } else {
          this.locales = {
            en:{
              meta_desc: null,
              meta_keyword: null,
              title: null,
              content: null,
            },
            ru:{
              meta_desc: null,
              meta_keyword: null,
              title: null,
              content: null,
            },
          }
        }

        this.selects = []
        if (this.editedVideo.groups) {
          this.editedVideo.groups.forEach(group => {
            Vue.set(this.selects, group.id, group.weight);
          });
        }
      }
    }
  },
  computed: {
    ...mapGetters({
      me: 'auth/me',
      locs: 'general/locales',
      editedVideo: 'video/editedVideo',
      groups: 'video/groups',
    }),
    musculeGroups () {
      const arr = this.selects
        .map((weight, id) => {
        return {
          id, weight
        }
      }).filter(item => item && item.weight)

      return arr
    },
    visibility:{
      get () {
        return !!this.editedVideo
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
      id: 0,
      locales: null,
      filter: '',
      payed: false,
      link: '',
      link_preview: '',
      duration: 0,
      weights: [
        {
          label: '',
          value: 0
        },
        {
          label: 'Red',
          value: 1
        },
        {
          label: 'Orange',
          value: 2
        },
        {
            label: 'Yellow',
          value: 3
        }
      ],
      selects: [],
      param: 1,
    }
  },
}
</script>
<style>
.q-checkbox.payed{
  color: white;
}
</style>
