<template>
  <div v-if="visibility"
       class="wrapper-sliders">
    <div v-for="(slider, index) in sliders"
         class="slider-list-items">
      <div class="slider-list-item wrapper-slider-img">
        <img
          itemprop="image"
          :src="slider.image"
          alt="Nude Fitness Online"
        >
      </div>
      <div class="slider-list-item wrapper-slider-body">
        <h5>{{slider.title}}</h5>
        <p>{{slider.body}}</p>
      </div>
      <div class="slider-list-item wrapper-slider-attach">
        <q-btn
          type="a"
          label="Download program"
          color="primary"
          class="delete-slider"
          :href="slider.program" click
          download
        />
        click
      </div>
      <div class="slider-list-item wrapper-slider-control">
        <q-item-side
          left
        >
          <q-btn
            type="a"
            label="Edit"
            @click="edit(slider.id)"
          />
        </q-item-side>
        <q-item-side
          right
        >
          <q-btn
            type="a"
            flat
            label="Delete"
            @click="remove(slider.id)"
          />
        </q-item-side>
      </div>
    </div>
    <div class="wrapper-create-new">
      <q-btn
        type="a"
        label="New"
        color="primary"
        class="create-slider"
        @click="create()"
      />
    </div>
    <div>
      <slider-editing :mode="mode" v-if="me && me.role=='admin'"/>
    </div>
  </div>
</template>

<script>
  import {mapActions, mapGetters} from "vuex";
  import sliderEditing from '../../modals/admin/slider/edit-slider'

  export default {
    name: "sliderEditList",
    components: {
      'slider-editing': sliderEditing
    },
    data() {
      return {
        mode: null,
      }
    },
    methods: {
      ...mapActions({
        newSlider: 'slider/newSlider',
        removeSlider: 'slider/removeSlider',
        loadSliders: 'slider/getSliders',
        cancel: 'slider/cancelEditListSlider',
        editSlider: 'slider/setEditSlider',
        showSlider: 'slider/showSlider'
      }),
      create() {
        this.mode = 'new'
        this.newSlider().then(() => {
          this.editSlider()
        });

      },
      edit(id) {
        this.mode = 'edit'
        this.editSlider().then(() => {
          this.showSlider(id)
        });
      },
      remove(id) {
        this.removeSlider(id)

      },
    },

    computed: {
      ...mapGetters({
        me: 'auth/me',
        sliders: 'slider/sliders',
        editedListSlider: 'slider/editedListSlider',
      }),

      visibility: {
        get() {
          return !!this.editedListSlider
        },
        set(newValue) {
          if (!newValue) {
            this.cancel()
          }
        }
      },
    },
    created() {
      this.loadSliders();
    },
  }
</script>

<style lang="scss" scoped>
  .wrapper-sliders {
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    padding: 1em;

    h5 {
      color: #d8d8d8;
      font-weight: bold;
      font-size: 18px;
      line-height: 35px;
      margin: 0;
    }

    p {
      color: #757575;
      font-size: 90%;
    }

    .wrapper-slider-img img {
      height: 100%;
      width: auto;
    }

    .slider-list-item {
      padding: .5em;
    }

    .slider-list-items {
      display: flex;
      flex-direction: row;
      flex-wrap: nowrap;
      width: 100%
    }

    .wrapper-slider-img {
      width: 150px;
      height: 150px;
      overflow: hidden;
      text-align: center;
    }

    .wrapper-slider-body {
      flex: 1;
    }

    .wrapper-slider-control{
      display: flex;
    }
  }


</style>
