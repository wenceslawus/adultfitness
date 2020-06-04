<template>
  <q-page class="flex flex-start">
    <div class="container overflow-hidden">
      <q-card class="text-primary black-shadow q-ma-sm">
        <q-card-main>
          <q-table
            dark
            color="secondary"
            title="List of users"
            :columns="columns"
            :data="selectedUsers()"
          >
            <q-td slot="body-cell-name" slot-scope="props" :props="props">
              <q-btn-group>
                <q-btn
                  type="a"
                  :label="props.row.name"
                  :to="{name:'profile.profile', params: {id: props.row.id}}"
                />
              </q-btn-group>
            </q-td>
            <q-td slot="body-cell-send" slot-scope="props" :props="props">
              <q-btn-group>
                <q-btn
									type="a"
                  v-if="props.row.role != 'admin'"
                  label="Send"
                  @click="toUser = props; sendMessageDialog = true"
                />
              </q-btn-group>
            </q-td>
            <q-td slot="body-cell-edit" slot-scope="props" :props="props">
              <q-btn-group>
                <q-btn
									type="a"
                  v-if="props.row.role == 'user' || props.row.role == 'trainer'"
                  :label="btnCaption(props.row)"
                  @click="changeRole(props)"
                />
              </q-btn-group>
            </q-td>
          </q-table>
        </q-card-main>
        <q-card-actions class="block text-right">
          <q-select
						dark
						v-model="filter"
						float-label="Select user group"
						radio
						:options="userGroups"
					/>
        </q-card-actions>
      </q-card>
    </div>
    <q-dialog
      class="message_dialog"
      v-model="sendMessageDialog"
      @cancel="sendMessageDialog = false"
      @hide="sendMessageDialog = false"
    >

      <!-- This or use "title" prop on <q-dialog> -->
      <span slot="title">Write message</span>

      <div slot="body">
        <q-field

        >
          <q-input
            v-model="messageText"
            type="textarea"
            float-label="E-Mail content"
            :max-height="100"
            rows="7"
          />
        </q-field>
      </div>

      <template slot="buttons" slot-scope="props">
        <q-btn type="a" color="primary" label="Ok" @click="sendMessage" />
        <q-btn type="a" color="negative" label="Cancel" @click="sendMessageDialog = false" />
      </template>
    </q-dialog>
  </q-page>
</template>
<style>
  .message_dialog .modal-content{
    max-width: 800px;
    width: 100%;
  }
</style>
<script>
import { mapGetters, mapActions } from "vuex"

export default {
  computed: {
    ...mapGetters({
			locale: 'general/locale'

    })
	},
	mounted() {
		this.getUsers()
			.then(data => {
				this.users = data.users
			})
	},
  methods: {
		...mapActions({
			getUsers: 'auth/getUserList',
      setUserRole: 'auth/setUserRole',
      sendEmail: 'auth/sendEmail',
    }),
 		changeRole(param){
			let newRole = (param.row.role == 'user')?'trainer':'user'

			this.setUserRole({
				id: param.row.id,
				role: newRole
			}).then(data => {
				let index = this.users.findIndex(item => item.id == param.row.id)
				let item = param.row
				item.role = newRole

				//Vue.set(this.users, index, false)
			})
		},
		btnCaption(row) {
			if(row.role == 'user')
				return 'Make a trainer'
			else
				return 'Make user'
    },
    sendMessage(){
      this.sendEmail({
        userId: this.toUser.row.id,
        message: this.messageText
      }).then(() => {
        this.$q.notify('Email sended')
        this.sendMessageDialog = false
        this.messageText = ''
      })

      /*this.$q.dialog({
        title: 'Write message',
        message: 'E-Mail content',
        color: 'primary',
        prompt: {
          model: '',
          type: 'text'
        },
        ok: true,
        cancel: true,
        preventClose: true
      }).then(data => {

      }).catch(() => {})//*/
    },
    selectedUsers () {
			return this.users.filter(
				item => item.role == this.filter || this.filter == 'all'
			)
      /*return this.users.map(item => {
        let v = {
          name: item.locales[this.locale].title,
          description: item.locales[this.locale].description,
          id: item.id
        }

        return v
			})//*/
		}
  },
  data () {
    return {
      sendMessageDialog: false,
      toUser: null,
      messageText: '',

      filter: 'all',
			userGroups: [
				{ label: 'All', value: 'all' },
				{ label: 'Admin', value: 'admin' },
				{ label: 'Trainer', value: 'trainer' },
				{ label: 'User', value: 'user' },
			],
			users: [],
			columns: [
				{
          align: "left",
          name: "name",
          label: "Name of User",
          field: "name",
				},
				{
          align: "left",
          name: "email",
          label: "E-mail",
          field: "email",
				},
				{
          align: "left",
          name: "role",
          label: "Role of User",
          field: "role",
        },
        {
          name: "send",
          label: "E-Mail",
          field: "id",
        },
				{
          name: "edit",
          label: "Edit",
          field: "id",
        }
			],
			d:[
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
          name: "send",
          label: "E-Mail",
          field: "id",
        },
        {
          name: "edit",
          label: "Edit",
          field: "id",
        },
      ]
    }
  }
}
</script>
