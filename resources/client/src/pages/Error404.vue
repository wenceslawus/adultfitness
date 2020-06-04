<template>
  <div class="fixed-center text-center">
    <p>
      <img
        itemprop="image"
        src="~assets/sad.svg"
        alt="adult fitness"
        style="width:30vw;max-width:150px;"
      >
    </p>
    <p class="text-faded">Sorry, nothing here...<strong>(404)</strong></p>
    <q-btn
      type="a"
      color="secondary"
      style="width:200px;"
      @click="$router.push('/')"
    >Go back</q-btn>
  </div>
</template>

<script>
export default {
  name: 'Error404'
}
</script>
