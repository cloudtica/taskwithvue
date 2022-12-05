<template>
    
    <div class="row full-width">

      <div class="col-xs-12 xol-sm-12 col-md-12 col-lg-12 adminheadingpadding">
        <h5 class="text-white text-center margin-0 "> Update Home Page Content </h5>
      </div>
        
     <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 paddinglargeform">
      <q-input
        type="textarea"
        filled
        v-model="heroheading1"
        label="Hero Heading 1"
        lazy-rules
        :rules="[ val => val && val.length > 0 || 'Please type something']"
      />
     </div>
      

      <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 paddinglargeform">
        <q-input
        type="textarea"
        filled
        v-model="heroheading2"
        label="Hero Heading 2"
        lazy-rules
        :rules="[ val => val && val.length > 0 || 'Please type something']"
      />
      </div>

     
      <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 paddinglargeform">
      <q-input
      type="textarea"
        filled
        v-model="heroheading3"
        label="Hero Heading 3"
        lazy-rules
        :rules="[ val => val && val.length > 0 || 'Please type something']"
      />
      </div>

      <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 paddinglargeform">
      <q-input
      type="textarea"
        filled
        v-model="heropara"
        label="Hero para"
        lazy-rules
        :rules="[ val => val && val.length > 0 || 'Please type something']"
      />
        </div>

        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 paddinglargeform">
      <q-input
      type="textarea"
        filled
        v-model="mapheading1"
        label="Map heading 1"
        lazy-rules
        :rules="[ val => val && val.length > 0 || 'Please type something']"
      />
      </div>

      <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 paddinglargeform">
      <q-input
      type="textarea"
        filled
        v-model="mapheading2"
        label="Map heading 2"
        lazy-rules
        :rules="[ val => val && val.length > 0 || 'Please type something']"
      />
      </div>
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 paddinglargeform">
      <q-input
      type="textarea"
        filled
        v-model="sliderheading"
        label="Slider Heading"
        lazy-rules
        :rules="[ val => val && val.length > 0 || 'Please type something']"
      />
      </div>
      <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 paddinglargeform">
      <q-input
        filled
        v-model="counter1"
        label="Counter 1"
        lazy-rules
        :rules="[ val => val && val.length > 0 || 'Please type something']"
      />
      </div>
      <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 paddinglargeform">
      <q-input
        filled
        v-model="counter2"
        label="Counter 2"
        lazy-rules
        :rules="[ val => val && val.length > 0 || 'Please type something']"
      />
      </div>
      <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 paddinglargeform">
      <q-input
        filled
        v-model="counter3"
        label="Counter 3"
        lazy-rules
        :rules="[ val => val && val.length > 0 || 'Please type something']"
      />
      </div>
      <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 paddinglargeform">
      <q-input
        filled
        v-model="counter1heading"
        label="Counter 1 Heading"
        lazy-rules
        :rules="[ val => val && val.length > 0 || 'Please type something']"
      />
      </div>
      <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 paddinglargeform">
      <q-input
        filled
        v-model="counter2heading"
        label="Counter 2 Heading"
        lazy-rules
        :rules="[ val => val && val.length > 0 || 'Please type something']"
      />
      </div>
      <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 paddinglargeform">
      <q-input
        filled
        v-model="counter3heading"
        label="Counter 3 Heading"
        lazy-rules
        :rules="[ val => val && val.length > 0 || 'Please type something']"
      />
      </div>
      <div class="paddinglargeform">
        <q-btn label="Submit"   @click="updateHomeContent()" color="primary"/>
      
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
import { api, getAuthorizationToken } from 'src/utils/APIs';

export default defineComponent ({

    name: 'homepage',
    mixins: [toasts, helperUtil,stringUtil, helperMixin, storageManagement],
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
                response = await axios.get(api.get_home_data
                , {
                    headers: {
                        Authorization: token,
                    },
                }
                );
            }catch (err: any) {
                this.showErrorToast(constants.ERROR_INTERNAL_OCCUR);
                console.error(err);
                if (err.response && err.response.status === 401) {
                  this.logout();
                }

            }finally {
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
                  this.dataId=homeData.id;

                } else {
                  this.dataId = 1;
                }
            }
      },


      async updateHomeContent() {

            let formData = new FormData();
            formData.append('dataId', this.dataId.toString());
            formData.append('heroheading1', this.heroheading1);
            formData.append('heroheading2', this.heroheading2);
            formData.append('heroheading3', this.heroheading3);
            formData.append('heropara', this.heropara);
            formData.append('mapheading1', this.mapheading1);
            formData.append('mapheading2', this.mapheading2);
            formData.append('sliderheading', this.sliderheading);
            formData.append('counter1', this.counter1);
            formData.append('counter2', this.counter2);
            formData.append('counter3', this.counter3);
            formData.append('counter1heading', this.counter1heading);
            formData.append('counter2heading', this.counter2heading);
            formData.append('counter3heading', this.counter3heading);

            this.showLoading();

            let response: any;
            try {
                 let token: string = getAuthorizationToken();
                response = await axios.post(api.update_home_content, formData
                 , {
                     headers: {
                         Authorization: token,
                     },
                 }
                );
            }catch (err: any) {
                this.showErrorToast(constants.ERROR_INTERNAL_OCCUR);
                console.error(err);
                if (err.response && err.response.status === 401) {
                  this.logout();
                }

            } finally {
                this.hideLoading();
            }

            if (response && response.data.error === true && response.data.message_key === 'validation_failed') {
                this.showErrorToast(constants.required_fields);
                return;
            } else if(response && response.data.error === false) {
                this.showSuccessToast('Changes Sucessfully Saved');
                this.$router.push('/home/edit');
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


