<template>
  <q-modal
    class="black-message"
    no-backdrop-dismiss
    no-route-dismiss
    no-esc-dismiss
    v-model="opened"
    content-classes="q-pa-md"
  >
    <h4 v-text="$t('general.warning')" />
    <p v-text="$t('general.warning_info')" />

    <!--div class="container" style="max-width: 450px">
      <div class="row">
        <div class="col-6"
          v-for="index in 4"
          :key="index"
        >
          <q-btn
            icon="done"
            class="items"
            flat
            :label="$t(`general.w${index}`)"
          />
        </div>
      </div>
    </div-->

    <!--p class="muted q-pa-md" v-text="$t('general.warning_small')" /-->

    <q-btn
      class="full-width"
      color="red"
      type="a"
      style="height: 50px;margin: 20px 0 40px;"
      :label="$t('general.enter')"
      @click="$emit('accept')"
    />
    <q-btn
      type="a"
      class="full-width"
      no-caps
      flat
      :label="$t('general.leave')"
      @click="$emit('decline')"
    />
  </q-modal>
</template>
<script>
import socialSharing from 'vue-social-sharing'
import { mapGetters, mapActions } from "vuex";
export default {
  components: {
    'socialSharing': socialSharing,
  },
  methods:{
    ...mapActions({
      cancelShare: 'general/cancelShare',
    })
  },
  props:{
    visible: {},
  },
  computed: {
    opened: {
      get() { 
        return this.visible
      },
      set(state) {
        
      }
    }
  },
}
</script>
<style lang="scss">
.black-message {
  .modal-content {
    background:black;
    max-width:600px;
    border: 1px solid #2f2f2f;
    border-radius: 19px;
    box-shadow: 0 0 40px black;

    h4 {
      text-align: center;
      color: #ff5600 !important;
      font-weight: bold;
      text-transform: uppercase;
      padding: 0;
      font-size: 65px;
      margin: 16px;
    }
    p {
      color: #d8e0df;
      font-size: 18px;
      text-align: center;
      &.muted {
        font-size: 14px;
        color:#464949;
      }
    }
    .q-btn{
      &.bg-red {
        background-color: #ff5600 !important;
      }
      &.q-btn-flat {
        color:#dad5c9;
        text-decoration: underline;
      }
      &.items {
        text-decoration: none;
        text-transform: none;
        .q-icon {
          color: #ff5600;
        }
      }
    }
  }
}
</style>
