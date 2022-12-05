<template>
    
    <div class="row full-width">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 padding-0 margin-0 hero-div text-center ">
           <h1 class="sectionheading text-white margin-0 vpadding150"><b>{{heading1}}</b></h1>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 padding-0 margin-0 aboutsecwho text-center">
           <h3 class="sectionheading margin-0 greytext paddingtop60">{{heading2}}</h3>

           <p class="herosubtext greytext whopadding" v-html="para1"></p>
        
            <p class="herosubtext greytext whopadding parabottom"></p>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 campaign">
            <h3 class="campaignheading margin-0">{{heading3}}</h3>
            <p class="aboutt3" v-html="para3">
                
            </p>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 campaignimg text-center">
            <img :src="imagePath + cimage" class="full-width"/>
        </div>


    </div>

    <div class="row full-width teamsec">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
        <h3 class="ourteamh margin-0">{{heading8}}</h3>
        </div>
        <div class="row full-width">
           
        <div v-for="team in teams" v-bind:key="team.id" class="col-xs-12 col-sm-12 col-md-3 col-lg-2 text-center">
            <img :src="imagePath + team.image" class="teamimg" />
            <h5 class="teamh margin-0"><b>{{team.name}}</b></h5>
            <p class="teamt margin-0" style="font-weight:thin;">{{team.post}}</p>
        </div>


        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
        <h3 class="ourteamh margin-0 specialpadding" >Special Thanks To:</h3>
        </div>

        <div v-for="thank in thanks" v-bind:key="thank.id" class="col-xs-12 col-sm-12 col-md-3 col-lg-2 text-center">
            <img :src="imagePath + thank.image" class="teamimg" />
            <h5 class="teamh margin-0"><b>{{thank.name}}</b></h5>
            <p class="teamt margin-0" style="font-weight:thin;">{{thank.post}}</p>
        </div>
        </div>
      
    </div>

    <div class="row full-width">

        
    
        
        <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7 campaign">
            <h3 class="internh margin-0">{{heading9}}</h3>
            <img src="line.png" class="linestyle"/>
            <p class="aboutt3 padding-top-30">
                {{para7}}
            </p>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5 campaignimg text-center">
            <div class="full-width internimage" ><img :src="imagePath + iimage" class="full-width"/></div>
            <q-btn href="https://ideali.st/ssbEdd" class="registeration viewposition" label="View Open Positions" />
        </div>


        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center partners-padding">
                <h3 class="sectionheading greytext margin-0">{{heading10}}</h3>
                <p class="aboutt3 ourpartnert" v-html="para8"></p>
                <div class="row padding-bottom-100 aboutlogos">
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
import { $ } from 'src/utils/assets';
import stringUtil from 'src/utils/string';
import helperUtil from 'src/utils/helperUtil';
import toasts from 'src/mixins/toasts';
import { defineComponent, ref} from 'vue';
import constants from 'src/contants/constants';
import Loader from 'src/components/Loader.vue';
import helperMixin from 'src/mixins/helperMixin.js';
import storageManagement from 'src/utils/storageManagement';
import { api, API_BASE_URL, getAuthorizationToken } from 'src/utils/APIs';

export default defineComponent ({

    name: 'AboutFossilFreeZones',
    mixins: [toasts, helperUtil,stringUtil, helperMixin, storageManagement],
    components: { Loader },

    data() {
      return {
        heading1: ref(''),
        heading2: ref(''),
        para1: ref(''),
        para2: ref(''),
        heading3: ref(''),
        para3: ref(''),
        heading4: ref(''),
        heading5: ref(''),
        para4: ref(''),
        heading6: ref(''),
        para5: ref(''),
        heading7: ref(''),
        para6: ref(''),
        heading8: ref(''),
        heading9: ref(''),
        para7: ref(''),
        heading10: ref(''),
        para8: ref(''),
        cimage:ref(''),
        iimage:ref(''),
        clients:ref([] as any),
        teams:ref([] as any),
        thanks:ref([] as any),
        imagePath:ref(''),
        dataId: ref(1)
      };
    },
    mounted: function() {
      this.init();
    },
    methods: {
      async init() {
        await this.loadData();
        //await this.updateHomeContent();
      },

      
      async loadData() {
        this.showLoading();
        let response: any;
            try {
                let token: string = getAuthorizationToken();
                response = await axios.get(api.get_about_data
                , {
                    headers: {
                        Authorization: token,
                    },
                }
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
                  let aboutData = response.data.data[0];

                    this.heading1 = aboutData.heading1;
                    this.heading2= aboutData.heading2;
                    this.para1= aboutData.para1;
                    this.para2= aboutData.para2;
                    this.heading3= aboutData.heading3;
                    this.para3= aboutData.para3;
                    this.heading4= aboutData.heading4;
                    this.heading5= aboutData.heading5;
                    this.para4= aboutData.para4;
                    this.heading6= aboutData.heading6;
                    this.para5= aboutData.para5;
                    this.heading7= aboutData.heading7;
                    this.para6= aboutData.para6;
                    this.heading8= aboutData.heading8;
                    this.heading9= aboutData.heading9;
                    this.para7= aboutData.para7;
                    this.heading10= aboutData.heading10;
                    this.para8= aboutData.para8;
                    this.cimage= aboutData.cimage;
                    this.iimage= aboutData.iimage;
                    this.clients = response.data.data_images;
                    this.teams = response.data.data_teams;
                    this.thanks = response.data.data_thanks;
                    this.imagePath = API_BASE_URL + response.data.image_path;
                    this.dataId= aboutData.id;

                } else {
                  this.dataId = 1;
                }
            }
      },

    },
  setup () {
    const $q = useQuasar()
  
   

    return {
    }
  }
});

</script>


