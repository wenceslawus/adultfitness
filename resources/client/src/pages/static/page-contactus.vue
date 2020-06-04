<template>
  <q-page class="black flex flex-center">
    <div
      v-if="currentPage"
      class="container blogs"
    >
      <a-divider
        v-if="currentPage.title"
        :title="currentPage.title"
        style="margin: 10px 0"
        customIcon="sent-mail"
      />
      <a-blog-card
        class="full"
        :blog="currentPage"
        :isFull="true"
      />
    </div>
  </q-page>
</template>
<script>
import divider from './../../components/misc/title'
import blogCard from './../../components/misc/blog-card'
import {mapGetters, mapActions} from 'vuex'
export default {
  components: {
    'a-divider': divider,
    'a-blog-card': blogCard,
  },
  mounted() {
    this.reloadPage(this.$router.currentRoute)
  },
  watch: {
    '$route' (to, from) {
      this.reloadPage(to)
    }
  },
  methods: {
    ...mapActions({
      loadPage: 'page/loadPage'
    }),
    reloadPage (route) {
      this.loadPage('contact-us')
    },
  },
  computed: {
    ...mapGetters({
      currentPage: 'page/page'
    })
  },
  data () {
    return {
      pages: {
        default: {
          title: 'some page title',
          description: '',
          image: '/statics/blogs/4.png',
          updated_at: '',
        },
      }
    }
  }
}
</script>
<style>
.blogs li {
  color: #6b6b6b;
  font-size: 14px;
  line-height: 23px;
}
</style>
