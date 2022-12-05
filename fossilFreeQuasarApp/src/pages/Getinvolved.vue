<template>
    
    <div class="row full-width">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 padding-0 margin-0 aboutsechead hero-div text-center">
           <h1 class="sectionheading text-white margin-0 vpadding150 "><b>{{heading1}}</b></h1>
        </div>
       

        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center lastbarbg">
                <div class="row">
                   
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 text-center padding-0 margin-0">
                        <q-btn target="_blank" href="https://map.fossilfreezones.org/global" class="herobtn3 right" label="Find Fossil Free Zones" />
                   </div>
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 text-center padding-0 margin-0 margin-top-30-small">
                        <q-btn target="_blank" href="https://map.fossilfreezones.org/global" class="herobtn4 left" label="Add a Fossil Free Zones" />
                   </div>
                   
                </div>
            </div>

            
            <a href="https://map.fossilfreezones.org/global" target="_blank">
              <img  src="map.png" class="full-width" style="height:100%; padding:40px 40px 0px 40px;"/>
            </a>
        


     


        


       

    </div>

    <div class="row full-width teamsec" style="margin-top:40px;">

            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 padding-0 margin-0  text-center">
                <h4 class="donationheading greytext donationpaddingtop60 margin-0">{{heading6}}</h4>
                <h4 class="donationheading greytext margin-0">{{heading7}}</h4>
                <p class="movt margin-0" v-html="para5"></p>
             </div>

        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
        <h3 class="ourteamh margin-0"></h3>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 ">
            
            <h5 class="donateh margin-0 blue-text" v-html="heading8"></h5>
            <h5 class="movhh2 margin-0 blue-text padding-top-30">{{heading9}}</h5>
            <img src="light.png" class=" padding-top-30 full-width"  />
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 text-center donationslidersec">

                <iframe src="https://donorbox.org/embed/fossil-free-zones?default_interval=m" name="donorbox" allowpaymentrequest="allowpaymentrequest" seamless="seamless" frameborder="0" scrolling="no" height="600px" width="100%" style=" min-width: 250px; max-height:none!important"></iframe>

        </div>

    </div>


    
  <Loader/>      
       
    
</template>

<script lang="ts">
import axios from 'axios';
import { useQuasar } from 'quasar';
import { $ } from 'src/utils/assets';
import stringUtil from 'src/utils/string';
import helperUtil from 'src/utils/helperUtil';
import toasts from 'src/mixins/toasts';
import { defineComponent, ref, computed} from 'vue';
import constants from 'src/contants/constants';
import Loader from 'src/components/Loader.vue';
import helperMixin from 'src/mixins/helperMixin.js';
import storageManagement from 'src/utils/storageManagement';
import { api, API_BASE_URL, getAuthorizationToken } from 'src/utils/APIs';

export default defineComponent ({

    name: 'GetInvolvedFossilFreeZones',
    mixins: [toasts, helperUtil,stringUtil, helperMixin, storageManagement],
    components: { Loader },

    data() {
      return {
        heading1: ref(''),
        heading2: ref(''),
        heading3: ref(''),
        heading6: ref(''),
        para5: ref(''),
        heading7: ref(''),
        heading8: ref(''),
        heading9: ref(''),
        image:ref(''),
        imagePath:ref(''),
        dataId: ref(1)
      };
    },
    mounted: function() {
      this.init();
      let paymentScript = document.createElement('script')
      paymentScript.setAttribute('src', 'https://donorbox.org/widget.js')
      document.head.appendChild(paymentScript)
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
                response = await axios.get(api.get_involved_data
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
                  let involved = response.data.data[0];

                    this.heading1 = involved.heading1;
                    this.heading2= involved.heading2;
                    this.heading3= involved.heading3;
                    this.heading6= involved.heading6;
                    this.para5= involved.para5;
                    this.heading7= involved.heading7;
                    this.heading8= involved.heading8;
                    this.heading9= involved.heading9;
                    this.image= involved.image;
                    this.dataId= involved.id;
                    this.imagePath = API_BASE_URL + response.data.image_path;
                    this.dataId= involved.id;

                } else {
                  this.dataId = 1;
                }
            }
      },

    },
  setup () {
    const $q = useQuasar()
    const model = ref({
      min: 2,
      max: 4
    })
    const priceModel = ref({
      min: 4,
      max: 6
    })
    const frequency = {
          label: 'Monthly/Onetime',
          value: 'monthly/onetime',
        };

    const payment = {
          label: 'Card',
          value: 'card',
        };

    return {
        frequencyList: ref(frequency),
        paymentList: ref(payment),
      options: [
        'Google', 'Facebook', 'Twitter', 'Apple', 'Oracle'
      ],
      text:ref(),
      model,
      fnMarkerLabel: (val: number) => `${10 * val}%`,
      objMarkerLabel: { 0: '50$', 1: '200$', 2: '350$',  3: { label: '500$' }, 4: '650$', 5: '800$', 6: '1000$' },

      priceModel,
      minPriceLabel: computed(() => `$ ${priceModel.value.min}`),
      maxPriceLabel: computed(() => `$ ${priceModel.value.max}`),
      arrayMarkerLabel: [
        { value: 3, label: '$3' },
        { value: 4, label: '$4' },
        { value: 5, label: '$5' },
        { value: 6, label: '$6' }
      ]
    }
  }
});

</script>




