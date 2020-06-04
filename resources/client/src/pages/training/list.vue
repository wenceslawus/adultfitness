<template>
  <q-page class="black flex flex-center" style="min-height:unset !important">
    <div class="container program_list">
      <a-divider
        title="Training programs"
        style="margin: 10px 0"
        customIcon="sent-mail"
      />
      <div class="row gutter-sm">
        <div class="col-12 col-sm-4 offset-sm-4">
          <q-select
            float-label="Type"
            dark
            v-model="filtertype"
            clearable
            :options="typesList"
          />
        </div>
        <div class="col-12 col-sm-4">
          <q-select
            float-label="Body part"
            dark
            v-model="filterbody"
            clearable
            :options="bodiesList"
          />
        </div>
      </div>
      <q-list>
        <q-item
          v-for="(item, index) in filtered"
          :key="index"
        >
          <q-item-side>
            <q-item-tile
              avatar
              :style="{backgroundImage: `url(${item.image})`}"
            />
          </q-item-side>
          <q-item-main>
            <q-item-tile label>
              <b>{{ item.title }}</b>
            </q-item-tile>
            <q-item-tile
              sublabel
              lines="4"
              v-html="item.description"
            />
            <q-item-tile>
              <q-btn
                type="a"
                dense
                size="md"
                color="primary"
                class="q-ma-sm q-mt-md float-right"
                label="Download program"
                text-color="black"
                @click="open(item.file)"
              />
            </q-item-tile>
          </q-item-main>
          <q-item-side
            v-if="me && me.role == 'admin'"
            right
            class="stack-btn"
          >
            <q-btn
              type="a"
              dense
              label="Edit"
              @click="editProgramm(item.id)"
            />
            <q-btn
              type="a"
              dense
              label="Delete"
              @click="tryDeleteProgramm(item.id)"
            />
          </q-item-side>
        </q-item>
      </q-list>
      <q-btn
        type="a"
        dense
        v-if="me && me.role == 'admin'"
        size="md"
        color="primary"
        label="Create new"
        @click="createProgramm()"
      />
    </div>
    <edit-program />
  </q-page>
</template>

<script>
import { openURL } from 'quasar'
import divider from './../../components/misc/title'
import blogCard from './../../components/misc/blog-card'
import modalProrgam from 'components/modals/admin/program/edit-program'
import { mapGetters, mapActions } from 'vuex'

export default {
  components: {
    'a-divider': divider,
    'a-blog-card': blogCard,
    'edit-program': modalProrgam
  },
  mounted() {
    this.loadItems()
  },
  computed: {
    ...mapGetters({
      items: 'training/list',
      me: 'auth/me',
      bodiesList: 'training/bodiesList',
      typesList: 'training/typesList'
    }),
    groupName() {
      return "Popular";
    },
    filtered(){
      let array = this.items.filter((item, index) => {
        return (!this.filtertype || (item.types.indexOf(+this.filtertype) != -1)) &&
          (!this.filterbody || (item.bodies.indexOf(+this.filterbody) != -1))
      });

      return array;
    }
  },
  data() {
    return {
      filterbody: null,
      filtertype: null,
    }
  },
  methods: {
    ...mapActions({
      loadItems: 'training/loadItems',
      editProgramm: 'training/editItem',
      deleteProgramm: 'training/deleteItem',
      createProgramm: 'training/createItem',
    }),
    open(url) {
      openURL(url)
    },
    tryDeleteProgramm(id){
      this.$q.dialog({
        title: 'Confirm',
        message: 'You reali want remove programm?',
        ok: 'Yes',
        cancel: 'Disagree'
      }).then(() => {
        this.deleteProgramm(id)
      }).catch(() => {
        //this.$q.notify('Disagreed...')
      })
    }
  },
}
</script>

<style lang="scss">
.program_list {
  .q-list {
    border: none;
    .q-item {
      padding: 10px;
      border-color: gray;
      background-color: #0c0c0c;
      margin: 10px 0;
      border-radius: 4px;
      .stack-btn{
        flex-wrap: wrap;
        button {
          display: block;
          width: 100%;
        }
      }
    }
    .q-item-label {
      color: #c1c1c1;
      font-size: 18px;
      padding-bottom: 6px;
    }
    .q-item-avatar {
      width: 115px;
      height: 115px;
      background-size: cover;
      background-position: center;
      border-radius: 0;
    }
    .q-item-label a {
      text-decoration: none;
      color: white;
    }
    .q-item-sublabel {
      line-height: 22px;
    }
    @media screen and (max-width: 425px) {
      .q-btn{
        font-size: 12px !important;
      }
    }
  }
}
</style>
