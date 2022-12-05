<template>
    
    <div class="row full-width">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 padding-0 margin-0 hero-div text-center ">
           <h1 class="sectionheading text-white margin-0 vpadding150"><b>FAQ</b></h1>
        </div>

    </div>


    <div class="row full-width">
        <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10" style="padding-bottom:100px;">
            <h3 class="internh margin-0">{{heading5}} </h3>
            <p class="aboutt3 padding-top-30" v-html="para4" style="padding-bottom:0px;">
             
            </p>
            <div class="q-pa-md" >
    <q-list  class="aboutt3 padding-top-30" style="padding-bottom:0px;">
      <q-expansion-item v-for="faq in faqs" v-bind:key="faq.id" style="border-bottom:1px solid grey;"
        group="somegroup"
        :label="faq.title"
        default-opened
        header-class="text-primary"
      >
        <q-card>
          <q-card-section>
           <p v-html="faq.details"></p>
          </q-card-section>
        </q-card>
      </q-expansion-item>
     
      

    </q-list>
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

    name: 'Faqs',
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
        oimage:ref(''),
        limage:ref(''),
        clients:ref([] as any),
        imagePath:ref(''),
        faqs:ref([] as any),
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
                response = await axios.get(api.get_fossilfreezones_data
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
                  let zones = response.data.data[0];

                    this.heading1 = zones.heading1;
                    this.heading2= zones.heading2;
                    this.para1= zones.para1;
                    this.para2= zones.para2;
                    this.heading3= zones.heading3;
                    this.para3= zones.para3;
                    this.heading4= zones.heading4;
                    this.heading5= zones.heading5;
                    this.para4= zones.para4;
                    this.oimage= zones.oimage;
                    this.limage= zones.limage;
                    this.clients = response.data.data_images;
                    this.faqs = response.data.data_faqs;
                    this.imagePath = API_BASE_URL + response.data.image_path;
                    this.dataId= zones.id;

                } else {
                  this.dataId = 1;
                }
            }
      },

    },
  setup () {
    const $q = useQuasar()
    const locations = {
          label: 'Pakistan',
          value: 'Pakistan',
        };
   

    return {
        locationList: ref(locations),
      options: [
        'Pakistan', 'UK', 'UAE', 'USA', 'Afghanistan'
      ],
    }
  }
});

</script>


