<template>
  <q-page class="flex flex-start">
    <div class="container overflow-hidden">
      <q-card class="text-primary black-shadow q-ma-sm">
        <q-card-title
          class=""
          v-text="formTitle"
        />
        <q-card-main>
          <q-tabs
            color="secpndary"
            v-model="g_tab"
          >
            <q-tab
              name="general"
              slot="title"
              :label="$t('cat.info')" />
            <q-tab
              v-if="category.id"
              name="videos"
              slot="title"
              :label="$t('cat.videos')" />

            <q-tab-pane name="general" >
              <q-field class="q-mb-sm" icon="reorder">
                <q-input
                  dark
                  v-model="category.position"
                  :float-label="$t('cat.weight')"
                />
              </q-field>
              <q-field class="q-mb-sm" icon="link">
                <q-input
                  dark
                  v-model="category.slug"
                  :float-label="$t('cat.slug')"
                />
              </q-field>

              <q-tabs
                color="secondary"
                v-model="current_locale"
              >
                <q-tab
                  v-for="locale in locales"
                  :key="locale.value"
                  :name="locale.value"
                  slot="title"
                  :label="locale.label"
                />

                <q-tab-pane
                  v-for="locale in locales"
                  :key="locale.value"
                  dark
                  :name="locale.value" >
                  <q-field
                    class="q-mb-sm"
                    icon="title"
                  >
                    <q-input
                      dark
                      v-model="category.locales[locale.value].title"
                      :float-label="$t('cat.title')"
                    />
                  </q-field>
                  <q-field
                    class="q-mb-sm"
                    icon="info"
                  >
                    <q-input
                      dark
                      v-model="category.locales[locale.value].description"
                      :float-label="$t('cat.description')"
                    />
                  </q-field>
                  <q-field
                    class="q-mb-sm"
                    icon="label"
                  >
                    <q-input
                      dark
                      v-model="category.locales[locale.value].meta_desc"
                      :float-label="$t('cat.meta')"
                    />
                  </q-field>
                  <q-field
                    class="q-mb-sm"
                    icon="vpn_key"
                  >
                    <q-input
                      dark
                      v-model="category.locales[locale.value].meta_keyword"
                      :float-label="$t('cat.keyword')"
                    />
                  </q-field>
                </q-tab-pane>
              </q-tabs>
            </q-tab-pane>
            <q-tab-pane name="videos" >
              <q-card>
                <q-card-actions>
                  <q-field
                    color="secondary"
                    icon="video_library"
                    class="full-width"
                  >
                    <q-select
                      dark
                      filter
                      @input="attachVideo"
                      v-model="video_id"
                      :float-label="$t('cat.addVideo')"
                      :options="allVideos"
                    />
                  </q-field>

                </q-card-actions>
                <q-card-media>
                  <a-video-compact
                    v-for="video in category.videos"
                    :key="video.id"
                    :video="video"
                  />
                </q-card-media>
              </q-card>
            </q-tab-pane>
          </q-tabs>
        </q-card-main>
        <q-card-actions class="block text-right">
          <q-btn
            type="a"
            @click="save"
            label="Save"
          />
        </q-card-actions>
      </q-card>
    </div>
  </q-page>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'
import compactVideo from 'components/video/compact'

export default {
  computed: {
    ...mapGetters({
      locales: 'general/locales',
      me: 'auth/me',
      sourceVideos: 'source/videos',
    }),
    formTitle () {
      const action = (this.category.id)?'edit':'create';
      return this.$t(`cat.${action}`)
    },
    allVideos () {
      return this.sourceVideos.map( video => {
        return {
          label: video.locales.en.title,
          value: video
        }
      })
    }
  },
  components: {
    'a-video-compact': compactVideo,
  },
  methods: {
    ...mapActions({
      getCategory: 'video/getCategory',
      //attachVideo: 'video/attachCategory',
      updateCategory: 'video/updateCategory',
      getVideoFromSource: 'source/getVideos',
    }),
    filter (item) {
    },
    save () {
      this.updateCategory(this.category)
    },
    attachVideo (video) {
      if (video) {
        this.category.videos.push(video)

        this.video_id = null
      }
    }
  },
  mounted () {
    this.current_locale = this.locales[0].value;
    const cat_id = this.$route.params.id;
    this.getCategory(cat_id)
      .then(data => {
        this.category = data.category
        this.getVideoFromSource()
      })
  },
  data () {
    return {
      current_locale: '',
      g_tab: 'general',
      category: {
        id: null,
        position: "0",
        locales: {
          en: {},
          ru: {}
        },
        videos: [ ]
      },
      video_id: '',
    }
  }
}
</script>
