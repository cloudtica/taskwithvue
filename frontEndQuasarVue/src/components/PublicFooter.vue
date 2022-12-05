<template>
        
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center lastbarbg">
                <div class="row">
                   
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 text-center padding-0 margin-0">
                        <q-btn to="/getinvolved" class="herobtn3 right" label="Get Involved" />
                   </div>
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 text-center padding-0 margin-0 margin-top-30-small">
                        <q-btn to="/getinvolved" class="herobtn4 left" label="Donate Now" />
                   </div>
                   
                </div>
            </div>

            <div class="row full-width footer-bg footer-padding">
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <h6 class="footer-title-font margin-0">Quick Links</h6>
                    <div class="footer-list-size">
                        <q-btn flat to="/" class="footer-link-color">Home</q-btn><br/><br/>
                        <q-btn flat to="/about" class="footer-link-color">About Us</q-btn><br/><br/>
                        <q-btn flat to="/fossilfreezones" class="footer-link-color">Fossil Free Zones</q-btn><br/><br/>
                        <q-btn flat to="/getinvolved" class="footer-link-color">Global Map</q-btn><br/><br/>
                        <q-btn flat to="/contact" class="footer-link-color">Contact Us</q-btn>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <h6 class="footer-title-font margin-0">Contact</h6>
                    <div class="footer-list-size">
                        <a :href="'tel:' + number" class="footer-link-color"><i class="fa fa-mobile footer-icon-color"></i>{{number}}</a><br/><br/>
                        <a :href="'mailto:' + footermail" class="footer-link-color"><i class="fa fa-envelope footer-icon-color"></i>{{footermail}}</a>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <p class="footer-last-col">{{message}}</p>
                    <a href="" class="footer-last-col-link">www-leave-it-in-the-ground.org</a><br/><br/>
                    <h6 class="footer-title-font margin-0">Connect With Us</h6>
                    <div class="footer-list-size">
                        <a :href=linkedin><i :class=linkicon></i></a>
                        <a :href=facebook><i :class=face></i></a>
                        <a :href=twitter><i :class=twit></i></a>
                        <a :href=instagram><i :class=insta></i></a>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 copyright-padding">
                    <p>© Copyright LINGO 2022 | <span class="blue-text">Privacy Policy</span></p>
                </div>

            </div>

            <Loader/>
        
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
name: 'Footercontent',
mixins: [toasts, helperMixin],
components: { Loader },


data() {
      return {
        number: ref(''),
        footermail: ref(''),
        message: ref(''),
        facebook: ref(''),
        instagram: ref(''),
        linkedin: ref(''),
        twitter: ref(''),
        face: ref(''),
        twit:ref(''),
        insta:ref(''),
        linkicon:ref(''),
     
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
                response = await axios.get(api.get_footer_data
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
                  let data = response.data.data[0];
                  
                  this.number = data.number;
                    this.footermail = data.footermail;
                    this.message = data.message;
                    this.facebook = data.facebook;
                    this.face = data.face;
                    this.instagram = data.instagram;
                    this.insta = data.insta;
                    this.twitter = data.twitter;
                    this.twit = data.twit;
                    this.linkedin = data.linkedin;
                    this.linkicon = data.linkicon;
                    

                } else {
                  
                }
            }
      },



      


    },


setup () {
    const $q = useQuasar()
  
   

  return {

   
      slide: ref(),
  }
    
  }
});
</script>

