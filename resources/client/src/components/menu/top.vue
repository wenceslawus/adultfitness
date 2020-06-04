<template>
  <q-btn-group 
    class="general-menu: no-shadow" 
  >
    <q-btn type="a" :label="$t('general.home')" to="/" />
    <a-groups />
    <q-btn type="a" class="q-mr-sm" :label="$t('general.programs')" to="/program" />
    
    <a-search-text class="gt-md"/>

    <q-btn 
      type="a" round 
      class="my_profile"
    >
      <img itemprop="image" src="/statics/profile_test.png" alt="nude video training program">

      <q-popover>
        <q-list link separator class="scroll" style="min-width: 100px">
          <q-item
            v-for="n in 20"
            :key="`a-${n}`"
            v-close-overlay
            @click.native="notify"
          >
            <q-item-main label="Label" sublabel="Click me" />
          </q-item>
        </q-list>
      </q-popover>
    </q-btn>
  </q-btn-group>
</template>

<script>
import searchComponent from 'components/input/search'
import groupsComponent from 'components/menu/groups'

export default {
  components: {
    'a-search-text': searchComponent,
    'a-groups': groupsComponent,
  },

  data () {
    return {
    }
  },
}
</script>

<style lang="scss">
  .q-toolbar {
    .my_profile {
      border-radius: 50%;
      border: 2px gray solid;
    }
    .q-btn-group {
      align-items: center;
    }
  }

.isVertical {
  justify-content: center;
  padding: 10px 5px;
  flex-wrap: wrap;
}
.isVertical button, .isVertical .search-input {
  width: 100%;
}
.no-decorate{
  color: #121212;
  text-decoration: none;
}
</style>
