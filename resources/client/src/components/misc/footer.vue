<template>
  <footer>
    <div
      v-if="currentRoute.name=='index'"
      class="lighter"
    >
      <div class="container" style="text-align:center">
        <img itemprop="image" class="greec" alt="Nude Fitness - AdultFitness" src="~assets/tiles.jpg">
        <h2>Naked Fitness is an Ancient Tradition</h2>
        <p class="text-center">The ancient <span class="italic bold">Greek Olympians</span> trained and competed naked as a way to show off their physiques and celebrate their fitness. Today, nude fitness is practiced by celebrities, athletes, and fitness experts as a way to maintain their overall physical health and mental well-being.</p>
        
      </div>

      <q-collapsible v-model="show_more" :duration="1000">
        <div class="container slide" :class="{slided: !show_more}">
          <h4>Experience the Benefits of a Fitness Nude Plan</h4>
          <p>Getting comfortable with your body is key to having a strong and healthy self-esteem. Many people have discovered that working out in the nude, in the privacy of their own home, has helped them accept their body and form a more positive self-image. This leads to a reduction in social anxiety as well as a commitment to long-term fitness.</p>
          
          <p>By embarking on a nude fitness program you’ll gain other natural benefits, including:</p>
          <ul>
            <li>A more comfortable workout without the restraint of clothing;</li>
            <li>The ability for your skin to breathe and use sweat for maximum cooling;</li>
            <li>The release of positive mood-enhancing endorphins;</li>
            <li>An increase in flexibility;</li>
            <li>A positive acceptance of your body.</li>
          </ul>

          <h4>Join Our <b>Fitness Nude</b> Community</h4>
          <p>By becoming a member of Adult Fitness you can plan your own <b>naked fitness</b> workout routine and create a circuit-training program targeting specific muscle groups as you follow along with our <b>fitness nude</b> models.</p>
          <p>Enjoy these perks when you become an Adult Fitness member:</p>
          <ul>
            <li>Saving videos;</li>
            <li>Creating playlists of <b>video</b> content for your personalized workout routines;</li>
            <li>Accessing a library of exercises for individual muscle groups along with muscle diagrams;</li>
            <li>Downloading pdf workout programs to save on your phone or print out to take to the gym.</li>
          </ul>

          <q-btn
            type="a"
            class="show-more"
            color="primary"
            @click="$router.push('/register')" 
            label="JOIN FREE NOW!"
          />

          <p>RIHANNA’s favourite CELEBRITY TRAINERS HANSON FITNESS – are going to be running naked fitness sessions to celebrate the New Year. These naked personal training sessions are all about creating a ‘new (‘nu-de’) you’, as guests burn the calories whilst nude.</p>
          <p>Working out without clothes provides a number of benefits to yur exercise including skin breathing, the release of endorphins due to Vitamin D from sunlight and complete body awareness so you can see if you're cheating on your exercise routines.</p>
          <p>The class is designed to be a total body workout that uses your body weight as resistant to work the glute, butt, legs, and core – making you look and feel good naked.</p>
          <p>Their TRAINERS have expertise in; weight loss, weight gain, total body conditioning, rehabilitation and much more. Whatever your goals may be for your fitness journey, they develop the exercise program for your short term and long term objectives. They will motivate and educate you based on your personal needs and goals.</p>

          <q-list class="border-none">
            <q-collapsible label="You’ll Be More Flexible During Your Workout">
              <div>
                <p>Working out naked allows you to be more flexible. No more “restrictive” clothes to keep you back.</p>
              </div>
            </q-collapsible>
            <q-collapsible label="You’ll Motivate Yourself">
              <div>
                <p>There is nothing like seeing yourself in your “Birthday Suit” to get you motivated. With the Adult Fitness comprehensive library of nude workout videos you’ll be able to choose the video that targets the problem muscle group you want to focus on.</p>
              </div>
            </q-collapsible>
          </q-list>
          <p>With our Adult Fitness Workout Videos, you can plan your own workout routine, creating a circuit training program to target the muscle groups you want to target as you follow along with our fitness models in the privacy of your own home.</p>
        </div>
      </q-collapsible>

      <div class="container">
        <q-btn
          type="a"
          class="limited"
          style="margin: 20px auto 0; display:block"
          color="primary"
          @click="show_more = !show_more" 
          :label="(show_more)?'SHOW LESS':'READ MORE'"
        />
      </div>

    </div>
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div style="padding: 0 10px;"  class="q-my-md down">All instructors/models, and other persons appearing in the video, exercise programs, images, were over the age of eighteen (18) years at the time the visual image and/or video was produced. Records required by Title 18 U.S.C. <a tabindex="0" href="/2257" class="q-btn inline relative-position q-btn-item non-selecta…e q-pa-xs q-btn-rectangle q-btn-flat q-focusable q-hoverable text-primary a-link" style="font-size: 14px;align-items:center">§2257</a> are on file with the appropriate Records Custodian. By entering this site you swear that you are of legal age in your area to view adult material and that you wish to view such material.</div>
        </div>
        <div
          class="col-xs-6 col-sm-2 footer-menu"
          v-for="(item, index) in footer_menu"
          :key="index"
        >
          <h3>{{ $t(`general.${item.title}`) }}</h3>
          <q-btn
            v-for="(route, caption) in item.items"
            type="a"
            :key="caption"
            flat no-caps
            class="full-width"
            align="left"
            :label="$t(`general.${caption}`)"
            :to="route"
          />
        </div>
        <div class="col-xs-12 col-sm-6 imaged" >
          
          <p v-text="$t('general.copyright')" />
        </div>
        <div class="col-xs-12 col-sm-2 q-py-md soc_list" >
          <q-btn
            v-for="(item, index) in socials"
            type="a"
            :key="index"
            @click="openURL(item.link)"
            round color="gray" size="sm"
          >
            <img itemprop="image" :src="`/statics/icons/${item.logo}.png`" alt="nude training">
          </q-btn>
        </div>
      </div>
    </div>
  </footer>
</template>
<script>
import { openURL } from 'quasar'

export default {
  methods: {
    openURL,
  },
  data() {
    return {
      show_more: false,
      socials: [
        {
          logo: 'social_fb',
          link: 'https://www.facebook.com/adultfitness2018/',
        },
        {
          logo: 'social_tw',
          link: 'https://twitter.com/FitnessAdult',
        },
        {
          logo: 'social_yt',
          link: 'https://www.youtube.com/channel/UCs-8qUPldH8UtLZe4Ja2Iiw/featured',
        },
        {
          logo: 'social_ig',
          link: 'https://www.instagram.com/adult_fitness/?hl=en',
        },
      ],
      footer_menu: [
        {
          title: 'info',
          items: {
            terms: {name: 'page.terms'},
            privacy: {name: 'page.privacy'},
            blogs: {name: 'blogs'},
            about: {name: 'page.about'},
          }
        },
        {
          title: 'support',
          items: {
            support_contact: {name: 'contactus'},
            feedback: {name: 'feedback'},
            i2257: {name: 'page.2257'},
          }
        }
      ],
      currentRoute: {}
    }
  },
  mounted() {
    this.currentRoute = this.$router.currentRoute;
  },
  watch:{
    $route(){
      this.currentRoute = this.$router.currentRoute;
    }
  }
}
</script>

<style lang="stylus">
@import '~variables'

footer {
  img.greec{
    opacity: 0.7;
    width: 80%; 
    max-width:800px;
  }
  .limited {max-width: 200px;}
  .q-item.q-item-division{
    display: none;
  }
    background-color: #141414;
    color: #ccc;
    font-size: 1.35em;
    line-height: 1.5em;
    
    .lighter {
      background-color: #1a1a1a;
      padding: 45px 0 40px;
    }
    .italic{
      font-style: italic;
      font-weight: bold;
    }
    h2{
      color: rgb(139, 139, 139);
      text-align:center;
    }
    h3 {
      color: white;
      font-size: 16px;
      font-weight: bold;
      margin-bottom: 0;
      padding:0 10px;
      white-space: nowrap;
    }
    @media(max-width: 425px){
      .footer-menu, .q-btn {
        font-size: 20px;
        &.show-more, &.limited{
          font-size: 16px;
        }
      }
      .footer-menu{
        margin-bottom: 40px;
      }
    }
    
    h4 {
      color: #ff5600;
      font-size: 1.4em;
      font-weight: bold;
      //margin-bottom: 0;
      padding:0 10px;
    }
    .show-more{
      display: block;
      margin: 40px auto;
      padding-left: 40px;
      position: relative;
      max-width: 200px;
      &:after{
        display:block;
        height: 60px;
        width: 60px;
        content: ' ';
        position: absolute;
        background: red;
        border-radius: 50%;
        background: #ff5600;
        top: -10px;
        left: -30px;
        border: 1px solid #fff;
      }
      .q-btn-inner:after{
        content: ' ';
      border: 19px solid transparent;
      border-left: 30px solid #000;
      display: block;
      width: 0;
      height: 0;
      position: absolute;
      left: -11px;
      z-index: 9;
      }
    }
    p {
      padding: 0 10px;
    }
    .down {
      font-size: 0.6em;
      line-height: 1.2em;
      text-align: center;
      .a-link{
        height: 19px;
        min-height: unset;
        padding-top: 0;
        padding-bottom: 0;
      }
    }
    ul li, p{
      font-size: 0.8em;
      line-height: 1.4em;
    }
    .imaged {
      background-image: url(/statics/logo_gray.png);
      background-repeat: no-repeat;
      background-position: center;
      display: flex;
      align-items: flex-end;
      p {
        font-size: 12px;
        text-align: center;
        width:100%;
        padding: 0 20px;
      }
      @media screen and (max-width: 575px) {
        background-position: top;
        min-height: 120px;
      }
    }
    .soc_list {
      display: flex;
      align-items: center;
      justify-content: center;
      flex-wrap: wrap;
      .q-btn {
        margin: 0 7px;
        background-color: #484848;
      }
    }
    .q-item-section {
      font-weight:bold;
      &:hover{
        transition: all 0.5s;
        color:white;
      }
    }
    .border-none {
      border: none;
    }
    .q-item-side {
      order: -1;
    }
  }
</style>
