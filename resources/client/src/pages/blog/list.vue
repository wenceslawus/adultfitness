<template>
  <q-page class="black flex flex-center">
    <div class="container blogs">
      <a-divider
        title="Blogs"
        style="margin: 10px 0"
        customIcon="sent-mail"
      />
      <div class="row gutter-lg">
        <div class="col-12 col-sm-4 col-lg-3 options">
          <h5>Categories</h5>
          <q-list>
            <q-item
              v-for="(item, index) in categories"
              :key="index"
            >
              <q-item-side>
                <q-checkbox
                  v-model="checked[index]"
                  @input="updateList"
                />
              </q-item-side>
              <q-item-main>
                <q-item-tile
                  label
                  :style="{color: (item.visible==1)?'#c1c1c1':'#313131'}"
                >{{item.name}}</q-item-tile>
              </q-item-main>
              <q-item-side
                v-if="me && me.role == 'admin'"
                right
              >
                <q-btn
                  type="a"
                  flat
                  label="Edit"
                  @click="editCategory(item.id)"
                />
              </q-item-side>
            </q-item>
            <q-item-separator />
          </q-list>
          <q-list>
            <q-item
              v-for="(item, index) in dt_vars"
              :key="index"
            >
              <q-item-side>
                <q-radio
                  v-model="dtchecked"
                  :val="item.id"
                  @input="updateList"
                />
              </q-item-side>
              <q-item-main>
                <q-item-tile label >{{item.label}}</q-item-tile>
              </q-item-main>
            </q-item>
            <q-item>
            </q-item>
          </q-list>
          <q-btn
            type="a"
            v-if="me && me.role == 'admin'"
            label="New category"
            color="primary"
            class="full-width"
            @click="newCategory()"
          />
        </div>
        <div class="col-12 col-sm-8 col-lg-9 list">
          <h5>{{ groupName }}</h5>
          <q-list>
            <q-item
              v-for="(item, index) in items"
              :key="index"
              separator
            >
              <q-item-side>
                <q-item-tile
                  avatar
                  :style="{backgroundImage: `url(${item.image})`}"
                />
              </q-item-side>
              <q-item-main>
                <q-item-tile label>
                  <router-link
                    :to="{name: 'blog', params:{id:item.id}}"
                  >{{ item.title }}</router-link>
                </q-item-tile>
                <q-item-tile
                  sublabel
                  lines="4"
                >{{ clear_tag(item.text) }}</q-item-tile>
              </q-item-main>
              <q-item-side
                v-if="me && me.role == 'admin'"
                right
              >
                <q-btn
                  type="a"
                  flat
                  v-if="me && me.role == 'admin'"
                  label="Edit1"
                  @click="editRecord(item.id)"
                />
              </q-item-side>
            </q-item>
          </q-list>
          <q-btn
            v-if="me && me.role == 'admin'"
            type="a"
            label="New record"
            color="primary"
            class="full-width"
            @click="newRecord()"
          />
        </div>
      </div>
    </div>
    <category-editing v-if="me && me.role=='admin'" />
    <record-editing v-if="me && me.role=='admin'" />
  </q-page>
</template>

<script>
import divider from './../../components/misc/title'
import blogCard from './../../components/misc/blog-card'
import categoryEditing from 'components/modals/admin/blog/edit-category'
import recordEditing from 'components/modals/admin/blog/edit-record'
import {mapGetters, mapActions} from 'vuex'
import Vue from 'vue'

export default {
  components: {
    'a-divider': divider,
    'a-blog-card': blogCard,
    'category-editing': categoryEditing,
    'record-editing': recordEditing,
  },
  data () {
    return {
      checked: [],
      dtchecked: [false,false,false],
      dt_vars: [
        {id: 'year_gt', label: '> 1 Year Ago'},
        {id: 'year', label: 'Last Year'},
        {id: 'year_lt', label: 'Last 6 Months'},
      ]
    }
  },
  computed: {
    groupName() {
      let state = this.checked.reduce((result, current, index) => {
        if(current) {
          return (result)? `${result}, ${this.categories[index].name}`: this.categories[index].name
        } else
          return result
      }, null)

      return (state)?state:"Popular";
    },
    ...mapGetters({
      categories:'blog/categories',
      selected:'blog/selected',
      times: 'blog/times',
      items: 'blog/records',
      me: 'auth/me'
    }),
  },
  mounted() {
    this.loadCategories()
      .then(() => {
        this.checked = this.selected
        this.dtchecked = this.times
      });
  },
  methods: {
    ...mapActions({
      loadCategories: 'blog/loadCategories',
      select: 'blog/updateList',

      editCategory: 'blog/editCategory',
      newCategory: 'blog/newCategory',

      editRecord: 'blog/editRecord',
      newRecord: 'blog/newRecord',
    }),
    clear_tag: function(txt){
       const cont = document.createElement('div')
       cont.innerHTML=txt;
       return cont.textContent || cont.innerText;
    },
    updateList() {
      let selected = this.checked.reduce((result, current, index) => {
        if(current) {
          result.push(this.categories[index].id)
        }

        return result;
      }, [])

      this.select({
        categories: selected,
        times: this.dtchecked
      })
    },
  }
}
</script>

<style lang="scss">
.blogs {
  .list {
    .q-item {
      padding: 20px 0;
      border-color:gray;
    }
  }
  .q-list {
    border: none;
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
      color: #d8d8d8;
      &:hover {
        color:white;
      }
    }
  }
  .options {
    .q-item {
      padding: 0px;
    }
    .q-item-label {
      padding: 0px;
    }
  }
  h5 {
    color: #565656;
    font-weight: bold;
    padding-left: 10px;
  }
  .time{
    padding: 0 10px 10px;
    display: block;
    text-align: right;
    color: #6b6b6b;
    font-size: 10px;
  }
  .q-card-main {
    padding-bottom: 0px;
  }
}
</style>
