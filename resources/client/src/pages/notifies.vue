<template>
  <q-page class="black flex flex-center">
    <div class="container notifies">
      <h3>Your Notifications</h3>

      <q-list separator link>
        <!-- notice `v-close-overlay` which closes popover -->

        <q-item v-if="!notifies.length">
          <q-item-main>
            <q-item-tile label lines="1">No messages</q-item-tile>
          </q-item-main>
        </q-item>


        <q-item
          v-close-overlay
          v-for="(item) in notifies"
          :key="item.id"
          @click.native="readMessage(item)"
        >
          <q-item-side>
            <img itemprop="image" :src="item.source.avatar" alt="adult fitness"/>
          </q-item-side>

          <q-item-main>
            <q-item-tile label>
              <b>{{ item.source.name }}</b> {{ item.text }}<p>{{ item.dt }}</p>
              <!--b>Alex Pro Trainer</b> has 2 new clicks on Visit Group and 2 new post likes<p>1h</p-->
            </q-item-tile>
          </q-item-main>

        </q-item>
      </q-list>
    </div>
  </q-page>
</template>

<script>
  import {mapGetters, mapActions} from 'vuex'

  export default {
    methods: {
      ...mapActions({
        nread: 'notify/read',
        nremove: 'notify/remove',
      }),
      readMessage(item) {
        this.nread(item.id)
          .then(() => {
            if (item.route) {
              this.$router.push({
                name: item.route,
                params: item.param
              })
            }

            /*this.$q.dialog({
              title: 'Notify',
              message: item.text,
              ok: {
                push: true,
                label: 'Delete',
                color: 'negative'
              },
              cancel: 'Ok'
            }).then(() => {
              this.nremove(item.id)
            }).catch(() => {

            })//*/
          })
      },
    },

    computed: {
      ...mapGetters({
        notifies: 'notify/list',
      }),
    },

    data() {
      return {}
    }
  }
</script>
<style lang="scss">
  .notifies {
    background: white;

    h3 {
      color: #242831;
      padding: 10px;
      margin: 0;
      font-size: 1.3rem;
      font-weight: bold;
    }

    .q-item {
      align-items: flex-start;
      background-color: #edeffb;
      width: 100%;

      img {
        width: 48px;
        height: 48px;
        border-radius: 50%;
      }

      .q-item-label {
        font-size: 13px;

        p {
          color: gray;
        }
      }
    }
  }
</style>
