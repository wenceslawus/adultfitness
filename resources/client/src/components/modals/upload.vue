<template>
  <input
    type="file"
    ref="photoLoader"
    style="display:none"
    @change.prevent="imageSelected"
  />
</template>
<script>
import { mapGetters, mapActions } from'vuex'

export default {
  computed: {
    ...mapGetters({
      input: 'upload/input'
    })
  },

  mounted () {
    this.setInputElement(this.$refs.photoLoader)
  },

  methods: {
    ...mapActions({
      uploadCropImage: 'upload/uploadCropImage',
      setInputElement: 'upload/setInputElement',
    }),

    imageSelected(e, type){
      const file = e.target.files[0]

      this.uploadCropImage(file).then(() => {
        this.$refs.photoLoader.value = ''
      })
    },
  }
}
</script>
