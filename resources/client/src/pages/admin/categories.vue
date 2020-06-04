<template>
  <q-page class="flex flex-start">
    <div class="container overflow-hidden">
      <q-card class="text-primary black-shadow q-ma-sm">
        <q-card-main>
          <q-table
            dark
            color="secondary"
            title="List of caterogies"
            :columns="columns"
            :data="mappedGroups()"
          >
            <q-td slot="body-cell-edit" slot-scope="props" :props="props">
              <q-btn-group>
                <q-btn
                  type="a"
                  label="Edit"
                  :to="'/admin/category/' + props.value"
                  @click="edit(props)"
                />
                <q-btn
                  type="a"
                  label="Delete"
                  @click="kill(props)"
                />
              </q-btn-group>
            </q-td>
          </q-table>
        </q-card-main>
        <q-card-actions class="block text-right">
          <q-btn
            type="a"
            to="/admin/category/make"
            label="New category"
          />
        </q-card-actions>
      </q-card>
    </div>
  </q-page>
</template>

<script>
import { mapGetters } from "vuex"

export default {
  computed: {
    ...mapGetters({
      groups: 'video/groups',
      locale: 'general/locale'
    })
  },
  methods: {
    kill (p) {
    },
    edit (p) {
    },
    mappedGroups () {
      return this.groups.map(item => {
        let v = {
          name: item.locales[this.locale].title,
          description: item.locales[this.locale].description,
          id: item.id
        }

        return v
      })
    }
  },
  data () {
    return {
      columns: [
        {
          align: "left",
          name: "name",
          label: "Name of category",
          field: "name",
        },
        {
          name: "description",
          label: "Description",
          field: "content",
          align: 'left',
        },
        /*
        {
          name: "weight",
          label: "Weight",
          field: "weight",
          align: 'left',
        },/*/
        {
          name: "edit",
          label: "Edit",
          field: "id",
        }
      ]
    }
  }
}
</script>
