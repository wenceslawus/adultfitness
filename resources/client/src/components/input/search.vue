<template>
  <div 
    class="search-input" 
  >
    <input 
      type="text" 
      autoComplete="off"
      v-model="searchText"
      v-on:keyup.enter="search()"
      :placeholder="placeholder" />
    <q-btn 
      type="a"
      icon="search"
      color="red"
      text-color="black"
      @click.native="search()"
    />
  </div>
</template>

<style lang="stylus">
@import '~variables'
  .search-input { 
    position: relative;
    input {
      padding: 7px 24px 7px 10px;
      border-radius: 3px;
      border:1px solid gray;
      background-color: #343434;
      border: none;
      width:100%;
      color: #bdbdbd;
    }
    .q-btn {
      position: absolute;
      right: 0px;
      top: 0px;
      cursor: pointer;
      height: 33px;
      width: 47px;
      font-size: 12px;
      border-radius: 4px;
      background-color: $primary !important;
      i.q-icon {
        color: black !important;
      }
    }
  }
</style>

<script>
import { mapActions } from 'vuex'
export default {
  data() {
    return {
      searchText: '',
      placeholder: 'Search ...'
    }
  },
  methods: {
    ...mapActions({
      searchResult: 'search/search'
    }),

    search  () {
      if (!this.searchText) {
        this.placeholder = 'Please write a request'
      } else {
        this.placeholder = 'Search ...'
        this.searchResult(this.searchText)
          .then(() => {
            this.searchText = ''
            this.$router.push('/search')
            this.$emit('close')
          })
      }  
    }
  }
}
</script>
