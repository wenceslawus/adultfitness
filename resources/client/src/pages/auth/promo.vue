<template>
  <q-page class="flex promo">
    <div class="container overflow-hidden">
      <div class="row gutter-sm first-part">
        <div class="col">
          <h3 class="text-center">Choose Your Adult Fitness Experience</h3>
          <div class="text-center">
            <q-btn
              type="a"
              v-if="!me"
              class="q-mb-md"
              color="secondary"
              :to="{name:'register.sign', params:{param:'free'}}"
              label="Create Free Account" />
          </div>
          <div class="text-center">
            <q-btn
              type="a"
              color="primary"
              :to="{name:'register.sign', params:{param:'premium'}}"
              label="Premium Subscription" />
          </div>
          <div class="text-center">
            <q-btn
              type="a"
              class="url"
              size="md"
              :to="{name:'register.sign', params:{param:'premium'}}"
              label="7 Day FREE Trial" />
          </div>
        </div>
        <div class="col">
          <img 
            itemprop="image"
            src="https://i.vimeocdn.com/filter/overlay?src0=https%3A%2F%2Fi.vimeocdn.com%2Fvideo%2F778909013_640x360.jpg&amp;src1=http%3A%2F%2Ff.vimeocdn.com%2Fp%2Fimages%2Fcrawler_play.png" 
            class="vi"
            alt="adult fitness"
          >
        </div>
      </div>
    </div>

    <div class="container overflow-hidden table">
      <div class="row">
        <div class="col">
          <p>What You Get:</p>
        </div>
        <div class="col">
          <p class="text-center">FREE ACCOUNT</p>
        </div>
        <div class="col">
          <p class="text-center">PREMIUM</p>
        </div>
      </div>
    </div>
    <span></span>
    <div class="container overflow-hidden table-2">
      <div 
        class="row"
        v-for="(row, index) in promoData" 
        :key="index">
        <div class="col">
          <p 
            class="text-left"
            :class="{orange: !(row.free && row.premium)}">{{ row.name }}</p>
        </div>
        <div class="col">
          <p class="text-center">
            <q-icon 
              :color="!(row.free && row.premium)?'amber-10':'green-13'"
              :name="!(row.free && row.premium)?'clear':'done'" />
          </p>
        </div>
        <div class="col">
          <p class="text-center">
            <q-icon 
              color="green-13"
              name="done" />
          </p>
        </div>
      </div>
    </div>

    <div class="container overflow-hidden">
      <div class="row gutter-xs last-part">
        <div class="col space" />
        <div class="col text-center">
          <q-btn
            type="a"
            v-if="!me"
            class="full-width q-mb-md"
            color="secondary"
            :to="{name:'register.sign', params:{param:'free'}}"
            label="Create Free Account" />
        </div>
        <div 
          :class="{shorter: me}"
          class="col text-center">
          <q-btn
            type="a"
            class="full-width"
            color="primary"
            :to="{name:'register.sign', params:{param:'premium'}}"
            label="Premium Subscription" />
          <q-btn
            type="a"
            class="url"
            size="md"
            :to="{name:'register.sign', params:{param:'premium'}}"
            label="7 Day FREE Trial" />
        </div>
      </div>
    </div>
      <!--q-table
        dark
        :data="promoData"
        :columns="columns"
        row-key="name"
      /-->
  </q-page>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  data() {
    return {
      columns: [
        {
          name: 'name',
          label: 'What You Get:',
          align: 'left',
          field: 'name',
        },
        {
          name: 'free',
          label: 'FREE ACCOUNT',
          align: 'center',
          field: 'free',
        },
        {
          name: 'premium',
          label: 'FREE ACCOUNT',
          align: 'center',
          field: 'premium',
        },
      ],
      promoData: [
        { free: 1, premium: 1, name: 'Fully Nude Workout Videos' }, 
        { free: 1, premium: 1, name: 'Naked Trainers/Models' },
        { free: 1, premium: 1, name: 'User Engagement' },
        { free: 1, premium: 1, name: 'Post Comments' },
        { free: 1, premium: 1, name: 'Like/Dislike' },
        { free: 1, premium: 1, name: 'Create PLaylists' },
        { free: 1, premium: 1, name: 'Add Favorites' },
        { free: 1, premium: 1, name: 'Follow Adult Fitness NUDE Trainers/Models' },

        { free: 0, premium: 1, name: '200+ Videos' },
        { free: 0, premium: 1, name: 'Unlimited Access' },
        { free: 0, premium: 1, name: 'Adult Fitness HD Videos' },
        { free: 0, premium: 1, name: 'Downloadable Workouts' },
        { free: 0, premium: 1, name: 'No Ads' },
        { free: 0, premium: 1, name: 'New Video Update' },
        { free: 0, premium: 1, name: 'Exclusive Content' },
        { free: 0, premium: 1, name: 'Online Support' },
      ], 
    }
  },
  components: {
  },
  computed: {
    ...mapGetters({
      me: 'auth/me'
    }),
  },
}
</script>
<style lang="stylus">
.promo{
  .text-center {
    width: 100%;
    .q-btn {
      width: 60%;
      @media(max-width: 425px){
        width: 100%;
      }
    }
    .url {
      font-size: 10px;
      margin: 0;
      padding: 0;
      .q-btn-inner div {
        color: #ff5600;
        text-decoration: underline;
        text-transform: none;
      }
    }
  }
  flex-direction: column;
  padding: 0;
  .first-part .col{
    @media (max-width: 425px) {
      flex-basis: 100%;
    }
  }
  .first-part, .last-part {
    max-width: 95%;
    margin: 80px auto 0;
  }
  .last-part {
    margin: 10px auto;
    @media(max-width: 425px) {
      .space {
        flex-basis: 60px;
        flex-grow: 0;
      }
    }
    .q-btn {
      @media(max-width: 425px) {
        /*width: 80% !important;*/
        text-align: center;
      }
    }
  }
  h3 {
    color: white;
    font-size: 24px;
    line-height: 31px;
  }
  img {
    width: 100%
  }
  .table {
    margin-top:20px;
    p{
      padding-left: 10px;
      color:white;
      text-decoration: none;
    }
  }
  .table-2 {
    p {
      padding-left: 10px;
      color: white;
      text-decoration: none;
      font-size: 14px;
      margin:2px;
    }
    .orange {
      color: #ff5600;
    }
  }
  .shorter{
    max-width: 320px;
    a{
      max-width: 200px
    }
  }
}
</style>
