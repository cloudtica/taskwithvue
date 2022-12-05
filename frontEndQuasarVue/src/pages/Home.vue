<template>
        <div class="row full-width">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 padding-0 margin-0 hero-div">
               <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center heropaddingtop">
                    <h1 class="bigheading text-white margin-0"><b>{{heroheading1}}</b></h1>
                    <p class="heroslidersubheading text-white">{{heroheading2}}</p>
               </div>

               <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center margin-herobtn">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 text-center padding-0 margin-0">
                   <q-btn to="/getinvolved" class="herobtn1 right" label="Get Involved"/>
                   </div>
                   <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 text-center padding-0 margin-0 margin-top-30-small">
                    <q-btn to="/getinvolved" class="herobtn2 left" label="Donate Now" />
                   </div>
                </div>
               </div>

               <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center bg-gradient" >
                  <!-- <h2 class="sectionheading text-white margin-0">{{heroheading3}}</h2> --> 
                   <p class="text-white opacityfull couterpara" v-html="heropara"></p>
                
                   <div class="row">
                        
                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 text-center">
                        <h2 class="herocounter text-white margin-0">{{counter1}}</h2>
                        <p class="herosubcounter text-white">{{counter1heading}}</p>
                    </div>
                    
                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 text-center">
                        <h2 class="herocounter text-white margin-0">{{counter2}}</h2>
                        <p class="herosubcounter text-white">{{counter2heading}}</p>
                    </div>

                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 text-center">
                        <h2 class="herocounter text-white margin-0">{{counter3}}</h2>
                        <p class="herosubcounter text-white">{{counter3heading}}</p>
                    </div>

                   </div>
                </div>


            </div>


      
            
             



            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
                <h2 class="sectionheading greytext" v-html="mapheading1"></h2>
            </div>
            <a href="https://map.fossilfreezones.org/global" target="_blank">
            <img  src="map.png" class="full-width" style="height:100%; padding:0px 40px;"/>
            </a>
           


            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 registerbtndiv text-center">
                <q-btn to="" class="registeration" label="Register Your Fossil Free Zone" />
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 padding-0 margin-0 full-width text-center">

                <h2 class="sectionheading greytext" v-html="sliderheading"></h2>

                <q-carousel
                    v-model="slide"
                    transition-prev="slide-right"
                    transition-next="slide-left"
                    swipeable
                    animated
                    control-color="#5a5a5a"
                    navigation
                    arrows
                    :autoplay="autoplay"
                    @mouseenter="autoplay = false"
                    @mouseleave="autoplay = true"
                    height="auto"
                    class="text-white padding-0 margin-0 full-width"
                >
                    <q-carousel-slide v-for="slider in slides" v-bind:key="slider.id" :name="slider.image" class="column no-wrap flex-center padding-0">
                    <div class="q-mt-md text-center full-width padding-0">
                        <img :src="imagePath + slider.image"  class="full-width"/>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 white-bg sliderdiv">
                            <p class="blue-text margin-0 sliderdetailsfont"><b>{{slider.status}}</b></p>
                            <p class="greytext margin-0 sliderdetailsfont">{{slider.name}}</p>
                            <p class="greytext margin-0 sliderdetailsfont">{{slider.location}}</p>
                        </div>
                    </div>
                    </q-carousel-slide>
                   
                    
                </q-carousel>

            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 registerbtndiv2 text-center">
                <q-btn to="" class="registeration" label="Learn More About Fossil Free Zones" />
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center partners-padding">
                <h3 class="sectionheading greytext margin-0">Our Partners</h3>
                <div class="row vpadding100">
                 
                    <div v-for="logo in clients" v-bind:key="logo.id" class="col-xs-6 col-sm-6 col-md-4 col-lg-4 text-center">
                        <img :src="imagePath + logo.image" class="partnerlogo"/>
                        <p class="greytext" style="font-size:18px;"><b>{{logo.name}}</b></p>
                    </div>
                    
                   
                </div>
            </div>


        </div>

        
    
        <Loader />          
           
        
</template>

<script lang="ts">
import axios from 'axios';
import { useQuasar } from 'quasar';
import toasts from 'src/mixins/toasts';
import { defineComponent, ref} from 'vue';
import constants from 'src/contants/constants';
import Loader from 'src/components/Loader.vue';
import helperMixin from 'src/mixins/helperMixin.js';
import { api, API_BASE_URL, getAuthorizationToken } from 'src/utils/APIs';


export default defineComponent({
name: 'HomeFossilFreeZones',
mixins: [toasts, helperMixin],
components: { Loader },


data() {
      return {
        heroheading1: ref(''),
        heroheading2: ref(''),
        heroheading3: ref(''),
        heropara: ref(''),
        mapheading1: ref(''),
        mapheading2: ref(''),
        sliderheading: ref(''),
        counter1: ref(''),
        counter2: ref(''),
        counter3: ref(''),
        counter1heading: ref(''),
        counter2heading: ref(''),
        counter3heading: ref(''),
        clients:ref([] as any),
        slides:ref([] as any),
        imagePath:ref(''),
     
      };
    },
    mounted: function() {
      this.init();
    },

    methods: {
      async init() {
        await this.loadData();
        
      },
      async loadData() {
        this.showLoading();
        let response: any;
            try {
               // let token: string = getAuthorizationToken();
                response = await axios.get(api.get_home_data
                //, {
                 //   headers: {
                    //    Authorization: token,
                //    },
               // }
                );
            } catch (err) {
                this.showErrorToast(constants.ERROR_INTERNAL_OCCUR);
                console.error(err);
            } finally {
                this.hideLoading();
            }

            console.log(response);

            if (response && response.data.error === false) {
                if(response.data.data.length > 0) {
                  let homeData = response.data.data[0];
                  
                  this.heroheading1 = homeData.heroheading1;
                  this.heroheading2 = homeData.heroheading2;
                  this.heroheading3 = homeData.heroheading3;
                  this.heropara = homeData.heropara;
                  this.mapheading1 = homeData.mapheading1;
                  this.mapheading2 = homeData.mapheading2;
                  this.sliderheading = homeData.sliderheading;
                  this.counter1 = homeData.counter1;
                  this.counter2 = homeData.counter2;
                  this.counter3 = homeData.counter3;
                  this.counter1heading = homeData.counter1heading;
                  this.counter2heading = homeData.counter2heading;
                  this.counter3heading = homeData.counter3heading;
                  this.slides = response.data.data_slides;
                  this.slide = this.slides[0].image;
                  this.clients = response.data.data_images;
                  this.imagePath = API_BASE_URL + response.data.image_path;

                } else {
                  
                }
            }
      },



      


    },


setup () {
    const $q = useQuasar()
  
   

  return {

   
      slide: ref(),
      autoplay: ref(true),
  }
    
  }
});
</script>


