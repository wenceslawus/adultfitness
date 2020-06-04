<template>
  <q-list
    no-border
    link
    inset-delimiter
  >
    <q-list-header>Essential Links 2</q-list-header>
    <a-general-menu 
      class="lt-md"
      :horizontal="false"
    />
  </q-list>
</template>

<script>
import gMenu from 'components/generalMenu'

export default {
  components: {
    'a-general-menu': gMenu,
  },
  methods:{
    openURL(){

    }
  }
}
</script>
