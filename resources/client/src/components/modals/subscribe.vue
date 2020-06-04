<template>
  <q-dialog
    class="subscribe"
    v-model="show"
    style="transform: translate3d(0,0,0);"
  >

    <div slot="body">
      <h3>Unlimited Access</h3>
      <div class="banner">
        <p class="price">$4.99<span>/month</span></p>
        <p class="desc">FREE 7 DAY TRIAL</p>
      </div>
      <span
        class="pay_subscribe"
        style=""
        @click="startWeek"
      >START YOUR <span class="gray">FREE WEEK</span> NOW</span>

      <div class="block text-center">
        <span
          style="color: white;margin-top: 15px;display: inline-block;height: 36px;line-height: 36px;vertical-align: middle;">
          By signing up, you agree to our&nbsp;</span>

        <q-btn type="a" class="q-mt-md"
          :to="{name: 'page.terms'}"
          style="color: gray !important;"
          label="Terms of Service"/>

        <span
          style="color: white;margin-top: 15px;display: inline-block;height: 36px;line-height: 36px;vertical-align: middle;">
          &nbsp;and&nbsp;</span>

        <q-btn class="q-mt-md"
          type="a"
          :to="{name: 'page.privacy'}"
          style="color: gray !important;"
          label="Privacy Policy"/>

      </div>

      <q-btn
        type="a"
        round
        color="primary"
        @click="show=false"
        icon="close"
        style ="right: 18px;top: 18px;position: fixed;"
      />
    </div>
  </q-dialog>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'
const withZero = num => (num > 9)? num: '0' + num

export default {
  props: {
    days:{
      default: 30,
    },
  },
  data () {
    return {
      complete: false,
      body: null
    }
  },
  watch:{
    show(e){
      this.body.style.overflow = e?'hidden':''
    }
  },
  mounted() {
    this.body = document.getElementsByTagName('body')[0]
  },
  computed: {
    ...mapGetters({
      showDialog: 'subscribe/dialog',
      me: 'auth/me',
      link: 'subscribe/link',
    }),
    subscribe () {
      return (this.me)?this.me.subscribe: null
    },
    show:{
      get () { return this.showDialog },
      set (newValue) { this.dialog(newValue) }
    },
    dateTo () {
      if (this.me && this.me.subscribe) {
        return this.me.subscribe.expiry
      } else  {
        const now = new Date();
        now.setDate(now.getDate() + 30);
        return now.getFullYear() + '.' +
          withZero(now.getMonth() + 1) + '.' +
          withZero(now.getDate())

        //now;//'2018.12.24';
      }
    }
  },
  methods:{
    ...mapActions({
      dialog: 'subscribe/showDialog',
      makeSubscribe: 'subscribe/create',
      getLink: 'subscribe/getPayLink'
    }),
    change (params) {
      //complete = this.$event.complete
    },
    startWeek() {
      //:href="link"
      if(this.me) {
        this.getLink()
          .then(data => window.location.href = data.link)
      } else {
        this.$router.push({name: 'register'})
      }
    },
    pay () {
      this.makeSubscribe('tok_1DaUCmITiqBi6VlaWasGHPsa')
      // createToken returns a Promise which resolves in a result object with
      // either a token or an error key.
      // See https://stripe.com/docs/api#tokens for the token object.
      // See https://stripe.com/docs/api#errors for the error object.
      // More general https://stripe.com/docs/stripe.js#stripe-create-token.

      if(false)
      createToken()
        .then(data => {
        })

    },
    update () {

    },
  },
}
</script>

<style lang="stylus">
.subscribe {
  .modal-body {
    -webkit-overflow-scrolling: inherit !important;
  }
  .pay_subscribe {
    width: 100%;
    color: white;
    padding: 24px;
    display: block;
    text-align: center;
    background: #ff6f00;
    border-radius: 10px;
    border: 1px solid white;
    margin-top: 20px;
    font-weight: bold;
    font-size: 20px;
    text-decoration: none;
    cursor: pointer;
    span.gray {
      color: #08050c;
    }
  }
  .modal-backdrop {
    background: rgba(0,0,0,0.8);
  }
  .modal-buttons {
    display: none;
  }
  .modal-content {
    max-width: 700px !important;
    width: 90%;
    background: none;
    border: none;
    transform: none !important;
    h3 {
      color: white;
      text-align:center;
      margin: 9px 0;
      font-size: 32px;
    }
    .banner {
      background: #000;
      border: 1px solid #fff;
      padding: 20px 0 10px;
      color: #fff;
      .price {
        font-size: 38px;
        span {
          font-size: 15px;
        }
      }
      p {
        margin: 0;
        text-align: center;
        &.desc{
          color: #ff6f00;
          font-size: 19px;
          padding: 5px 0;
        }
      }
    }

    .modal-body {
      max-height: 400px
    }
    .modal-header {
      background-color: #141414;
      color: #fff;
      padding: 20px;
      text-transform: uppercase;
      font-size: 20px;
    }
    .ticket {
      max-width: 460px;
      margin: 30px auto;
      background-color: #c86801;
      color: #4f0101;
      div {
        flex-grow: 1;
        &.centered {
          display: flex;
          justify-content: center;
          align-items: center;
          padding: 4px;
        }
      }
      .left-side {
        padding: 16px;
        padding-right: 32px;
        border-right: 8px dotted black;
        position: relative;
        div {
          border: 1px solid #4f0101;
          &.props {
            border:none;
          }
        }
        .acc { font-size: 26px;}
        .premium { font-size: 48px;}
        .valid { font-size: 20px;}
        .name {
          font-size: 23px;
          padding: 0;
        }
        .date {
          font-size: 17px;
          padding: 0;
        }
        .cirlce {
          width: 52px;
          height: 52px;
          border-radius: 50%;
          position: absolute;
          right: -30px;
          top: -26px;
          background-color: #000;
          &.bottom {
            top: unset;
            bottom: -26px;
          }
        }
      }
      .number {
        padding: 16px;
        font-size: 22px;
        align-items: flex-end;
        display: flex;
        justify-content: center;
        font-weight: bold;
      }
      .vertical {
        writing-mode: vertical-rl;
        text-orientation: mixed;
        -webkit-transform: rotate(180deg);
        -moz-transform:    rotate(180deg);
        -ms-transform:     rotate(180deg);
        -o-transform:      rotate(180deg);
      }

      @media screen and (max-width: 530px) {
        zoom: 0.8;
      }
      @media screen and (max-width: 425px) {
        zoom: 0.7;
      }
      @media screen and (max-width: 375px) {
        zoom: 0.5;
      }
    }
    .card-holder {
      max-width: 460px;
      margin:auto;
      width: 90%;
    }
  }
}

.stripe-card {
  border-bottom: 2px solid #343434;
  padding-bottom: 6px;
}
.complete {
  border: 2px solid green;
}
</style>
