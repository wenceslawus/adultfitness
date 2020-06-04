<template>
  <div class="q-drawer-container top-banner">
    <div class="container container-wrapper-carousel-alpha" v-if="page=='index'">
      <div class="container-wrapper-carousel">
        <div class="carousel-controls carousel-controls-next" @click="next()">
          <svg width="38" height="159" viewBox="0 0 38 159" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M1.08337 158L36.6527 76.2396L1.08337 1L1.08337 158Z" stroke="#8A8A8A" stroke-width="2"/>
          </svg>
        </div>
        <div class="carousel-controls carousel-controls-prev" @click="prev()">
          <svg width="39" height="159" viewBox="0 0 39 159" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M37.6445 1L2.0752 82.7604L37.6445 158V1Z" stroke="#8A8A8A" stroke-width="2"/>
          </svg>
        </div>
        <q-carousel
          transition-prev="jump-right"
          transition-next="jump-left"
          animated
          control-color="white"
          navigation
          padding
          quick-nav
          dots
          infinite
          height="440px"
          class="carousel-mainframe bg-black text-white shadow-1 rounded-borders"
          ref="carousel"
        >
          <q-carousel-slide
            name="style"
            class="column wrapper-box-q-slide no-wrap flex-center"
            v-for="(slider, index) in sliders"
            :key="index"
          >
            <div class="text-box-q-slide text-left">
              <p class="title-carousel text-primary">
                {{slider.title}}
              </p>
              <p class="subtitle-carousel">
                {{slider.body}}
              </p>
              <div style="text-align: center">
                <q-btn
                  type="a"
                  label="Sign Up"
                  color="white"
                  style="margin-top:41px"
                /></div>

            </div>
            <div class="img-box-q-slide">
              <div class="img-wpapper-box-q-slide" :style="{backgroundImage:`url(${slider.image})`}">
                <p class="visible subtitle-carousel">{{slider.title}}</p>
                <br>
                <div style="display: flex; margin-top:29px; justify-content: center;">
                  <q-btn
                    type="a"
                    label="Sign Up"
                    color="white"
                    class="visible"
                  />
                </div>
              </div>
            </div>
          </q-carousel-slide>
        </q-carousel>
      </div>

    </div>
    <div class="container">
      <div>
        <q-btn
          v-if="me && me.role == 'admin'"
          type="a"
          :label="editSliderLabel"
          color="primary"
          class="edit-slider"
          @click="setEditMode()"
        />
      </div>
    </div>
    <div class="container">
      <slider-edit-list v-if="me && me.role=='admin'"></slider-edit-list>
    </div>
  </div>
</template>

<script>
  import sliderEditList from './slider/slider-edit-list.component'
  import {mapActions, mapGetters} from "vuex";

  export default {
    components: {
      'slider-edit-list': sliderEditList
    },
    props: {
      page: {},
    },
    data() {
      return {
        arrow_left: 'test',
        arrow_right: 'rest2',
        editSliderLabel: 'Edit Slider'
      }
    },

    methods: {
      next() {
        this.$refs.carousel.next()
      },
      prev() {
        this.$refs.carousel.previous()
      },
      ...mapActions({
        setEditListSlider: 'slider/setEditListSlider',
        cancel: 'slider/cancelEditListSlider',
        loadSliders: 'slider/getSliders'
      }),
      setEditMode() {
        this.setEditListSlider()
        if (this.editedListSlider) {
          this.editSliderLabel = 'End Edit'
        } else {
          this.editSliderLabel = 'Edit Slider'
        }
      }
    },
    created() {
      this.loadSliders();
    },
    mounted() {
      //
    },
    computed: {
      ...mapGetters({
        me: 'auth/me',
        sliders: 'slider/sliders',
        editedListSlider: 'slider/editedListSlider',
      }),
    },
  }
</script>

<style lang="scss">

  .img-wpapper-box-q-slide {
    text-align: center;
    padding: 76px 0 0 0;
  }

  .container-wrapper-carousel {
    position: relative;
  }

  .carousel-mainframe {
    max-width: 1151px;
    margin: 0 auto;
  }

  .carousel-controls {
    position: absolute;
    top: 50%;
    transform: translate(0, -50%);
    height: 157px;
  }

  .carousel-controls-prev {
    left: 0
  }

  .carousel-controls-next {
    right: 0;
  }

  .wrapper-box-q-slide {
    display: flex;
    flex-wrap: nowrap;
    width: 100%;
    flex-direction: row;
    padding: 40px 35px 0 35px;
  }

  .img-box-q-slide,
  .text-box-q-slide {
    height: 100%;
  }

  .img-box-q-slide {
    width: 40%;
  }

  .text-box-q-slide {
    width: 60%;
    padding-right: 23px;
  }

  .img-wpapper-box-q-slide {
    max-width: 489px;
    max-height: 337px;
    height: 100%;
    background-size: cover;
    background-position: 50% 50%;
    margin: 0 auto;
  }

  .img-q-slide {
    height: 100%;
    width: auto;
  }

  .title-carousel {
    font-weight: 500;
    font-size: 34px;
    line-height: 60px;

  }

  .subtitle-carousel {
    font-style: normal;
    font-weight: normal;
    font-size: 30px;
    line-height: 35px;
  }

  .top-banner {
    width: 100%;
    margin-top: 64px;
    position: relative;
    background: url("/statics/banner.jpg");
    background-size: cover;
    background-position: center top;
    background-size: auto 440px;
    background-repeat: no-repeat;

    img {
      width: 100%;
    }

    .texts {
      position: absolute;
      left: 0;
      right: 0;
      bottom: 15%;

      h2, h1 {
        color: white;

        text-align: center;
        font-size: 1rem;
        margin-bottom: 0.1rem;
        margin-top: 0;

        &.header {
          text-transform: uppercase;
          font-weight: bold;
        }
      }
    }

    .edit-slider {
      margin: .5em;
    }

    .inactive {
      .material-icons:before {
        background-color: black;
      }


    }

    .material-icons {
      /*visibility: hidden;*/
      /*display: none;*/
    }

    .material-icons:before {
      content: '';
      height: 16px;
      width: 16px;
      background-color: white;
      border: 1px solid #F6580B;
      border-radius: 50%;
      display: inline-block;
      /*left:7px;*/
      /*margin-left: 10px;*/
      position: absolute;
      left: 50%;
      top: 50%;
      transform: translate(-50%, -50%);
    }


    .container-wrapper-carousel-alpha {

    }

    @media screen and (max-width: 768px) {
      .texts {
        h1, h2 {
          font-size: 0.9rem;
        }
      }
    }
    @media screen and (max-width: 425px) {
      .texts {
        h1, h2 {
          font-size: 0.7rem;
        }
      }
    }

    .visible {
      display: none;

    }

    .bg-white {
      background-color: transparent !important;
      border: 1px solid white;
      padding: 8px 29px 7px 29px;
      border-radius: 10px;
    }

    @media screen and (max-width: 1024px) {
      .visible {
        display: initial;
      }
      .img-box-q-slide {
        width: 100%;
      }

      .carousel-controls-next,
      .carousel-controls-prev,
      .text-box-q-slide {
        display: none;
      }

      .wrapper-box-q-slide {
        padding: 0;
      }
      .q-carousel-quick-nav{
        bottom:60px;
      }

      .img-wpapper-box-q-slide{
        .subtitle-carousel{
          font-style: normal;
          font-weight: 500;
          font-size: 20px;
          line-height: 23px;
          text-align: center;
        }
      }
      /*  span{*/
      /*    font-size: 0.8rem;*/
      /*    top:74%;*/
      /*    &.header {*/
      /*      top:64%;*/
      /*      &.index {*/
      /*        top:67%;*/
      /*        font-size: 1.3rem;*/
      /*      }*/
      /*    }*/
      /*  }*/
    }
    @media screen and (max-width: 425px) {
      span {
        display: none;
      }
    }
    //*/
  }

</style>
