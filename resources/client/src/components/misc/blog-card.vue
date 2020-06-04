<template>
  <div
    v-if="blog"
    class="item full"
  >
    <q-card>
      <q-card-title>
        {{ title }}
      </q-card-title>
      <q-card-media v-if="blog.image">
        <img itemprop="image" :src="blog.image" :alt="alt">
      </q-card-media>
      <br v-else />
      <q-card-main v-html="blog.description" />
      <q-card-actions v-if="!isFull">
        <q-btn
          type="a"
          dense
          size="lg"
          class="next"
          color="primary"
          label="SHOW MORE"
          text-color="black"
          :to="{name: 'blog', params:{id: blog.id}}"
        />
        <span class="time" v-text="blog.updated_at" />
      </q-card-actions>
    </q-card>
  </div>
</template>

<script>
export default {
  props: {
    blog: {},
    isFull: {},
    title: {},
  },
  computed:{
    alt(){
      switch(this.blog.link){
        case 'about-us':
          return 'About AdultFitness Company'
        case 'terms':
          return 'Terms of Use the website- AdultFitness'
      }

      return 'nude video training program'
    }
  },
  mounted(){
  }
}
</script>

<style lang="scss">
.blogs {
  .q-card {
    background-color: #141414;
  }
  .q-card-title {
    color: white;
    text-overflow: ellipsis;
    white-space: nowrap;
    overflow: hidden;
    font-size: 26px;
  }
  .q-card-main {
    p {
      color: #ccc;
      font-size: 14px;
      line-height: 23px;
    }
    h5 {
      color: #ccc;
    }
  }

  .full .q-card-primary {
    background-color: #000;
    padding: 30px 20px;
  }
  &-popular {
    .q-card {
        background-color: #141414;
    }
  }
  .q-card-actions {
    display: flex;
    align-items: center;
    padding: 20px;
    border: none;
    button {
      font-size: 15px !important;
      padding: 0 20px;
    }
    span.time {
      color: #4d4d4d;
      margin-left: 30px;
      font-size: 12px;
    }
  }
  .noPadding {
    .q-card {
      .q-card-container {
        padding-left: 0;
        padding-right: 0;
      }
      margin: 45px 0;
    }
  }
  @media screen and(min-width: 768px) {
    padding: 0 5px;
  }
}
</style>
