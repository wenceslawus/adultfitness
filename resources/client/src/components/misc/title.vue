<template>
  <div class="block-divider">
    <a-custom-icon 
      v-if="customIcon"
      :icon="customIcon"
      class="q-mx-sm"
      color="#ff5600"
      size="25px"
    />
    <q-icon 
      v-else
      class="q-mx-sm"
      :name="icon"
      color="primary"
      size="25px"
    />
    <h3 v-text="title" />
    <p
      v-if="description"
      v-text="description"
    />
  </div>
</template>

<script>
import cIcon from "./../misc/customIcon"
export default {
  components: {
    'a-custom-icon': cIcon,
  },
  props: {
    title: {},
    customIcon: {},
    icon: {},
    description: {}
  }
}
</script>

<style lang="scss">
  .block-divider {
    padding: 14px 10px;
    background-color: #151515;
    border-radius: 4px;
    margin: 10px;
    display: flex;
    align-items: center;
    i {
      font-size: 25px;
    }
    h3 {
      color: white;
      font-size: 15pt;
      font-weight: bold;
      text-transform: uppercase;
      margin: 0 0 0 10px;
      line-height: 24px;
    }
    p {
      color: #626262;
      margin: 0 0 0 20px;
      font-size: 25px;
    }
  }
</style>
