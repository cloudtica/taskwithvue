<template>
    
    <div class="row full-width">

      <div class="col-xs-12 xol-sm-12 col-md-12 col-lg-12 adminheadingpadding">
        <h5 class="text-white text-center margin-0 "> Update Get Involved Page Content </h5>
      </div>
        
     <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 paddinglargeform">
      <q-input
        type="textarea"
        filled
        v-model="heading1"
        label="Heading 1"
        lazy-rules
        :rules="[ val => val && val.length > 0 || 'Please type something']"
      />
     </div>
      

      <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 paddinglargeform">
        <q-input
        type="textarea"
        filled
        v-model="heading2"
        label="Heading 2"
        lazy-rules
        :rules="[ val => val && val.length > 0 || 'Please type something']"
      />
      </div>

      <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 paddinglargeform">
        <q-input
        type="textarea"
        filled
        v-model="heading3"
        label="Heading 3"
        lazy-rules
        :rules="[ val => val && val.length > 0 || 'Please type something']"
      />
      </div>


      <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 paddinglargeform">
      <q-input
      type="textarea"
        filled
        v-model="heading6"
        label="Heading 6"
        lazy-rules
        :rules="[ val => val && val.length > 0 || 'Please type something']"
      />
      </div>

      
      <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 paddinglargeform">
      <q-input
      type="textarea"
        filled
        v-model="heading7"
        label="Heading 7"
        lazy-rules
        :rules="[ val => val && val.length > 0 || 'Please type something']"
      />
      </div>

      <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 paddinglargeform">
      <q-input
      type="textarea"
        filled
        v-model="para5"
        label="Para 5"
        lazy-rules
        :rules="[ val => val && val.length > 0 || 'Please type something']"
      />
      </div>


      <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 paddinglargeform">
      <q-input
      type="textarea"
        filled
        v-model="heading8"
        label="Heading 8"
        lazy-rules
        :rules="[ val => val && val.length > 0 || 'Please type something']"
      />
      </div>


      <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 paddinglargeform">
      <q-input
      type="textarea"
        filled
        v-model="heading9"
        label="Heading 9"
        lazy-rules
        :rules="[ val => val && val.length > 0 || 'Please type something']"
      />
      </div>

      <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 paddinglargeform">
        <p>Donation Image</p>
        <q-input
        type="file"
        filled
        v-model="image"
        lazy-rules
        :rules="[ val => val && val.length > 0 || 'Please choose file']"
      />
      </div>

      <div class="paddinglargeform">
        <q-btn label="Submit"   @click="updateContent()" color="primary"/>
      
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

    name: 'aboutpage',
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
                response = await axios.get(api.get_involved_data
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

                } else {
                  this.dataId = 1;
                }
            }
      },


      async updateContent() {

            let formData = new FormData();
            formData.append('dataId', this.dataId.toString());
            formData.append('heading1', this.heading1);
            formData.append('heading2', this.heading2);
            formData.append('heading3', this.heading3);
            formData.append('heading6', this.heading6);
            formData.append('para5', this.para5);
            formData.append('heading7', this.heading7);
            formData.append('heading8', this.heading8);
            formData.append('heading9', this.heading9);
            formData.append('image', this.image[0]);

            this.showLoading();

            let response: any;
            try {
                 let token: string = getAuthorizationToken();
                response = await axios.post(api.update_involved_content, formData
                 , {
                     headers: {
                         Authorization: token,
                         'Content-Type': 'multipart/form-data',
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
              this.$router.push('/involved');
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


