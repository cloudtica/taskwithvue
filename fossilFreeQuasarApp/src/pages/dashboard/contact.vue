<template>
    
    <div class="row full-width">

      <div class="col-xs-12 xol-sm-12 col-md-12 col-lg-12 adminheadingpadding">
        <h5 class="text-white text-center margin-0 "> Update Contact Us Page Content </h5>
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
        v-model="heading4"
        label="Heading 4"
        lazy-rules
        :rules="[ val => val && val.length > 0 || 'Please type something']"
      />
      </div>


      <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 paddinglargeform">
      <q-input
      type="textarea"
        filled
        v-model="para1"
        label="Para 1"
        lazy-rules
        :rules="[ val => val && val.length > 0 || 'Please type something']"
      />
      </div>

      <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 paddinglargeform">
      <q-input
      type="textarea"
        filled
        v-model="para2"
        label="Para 2"
        lazy-rules
        :rules="[ val => val && val.length > 0 || 'Please type something']"
      />
      </div>
      <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 paddinglargeform">
      <q-input
      type="textarea"
        filled
        v-model="para3"
        label="Para 3"
        lazy-rules
        :rules="[ val => val && val.length > 0 || 'Please type something']"
      />
      </div>
      <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 paddinglargeform">
      <q-input
      type="textarea"
        filled
        v-model="para4"
        label="Para 4"
        lazy-rules
        :rules="[ val => val && val.length > 0 || 'Please type something']"
      />
      </div>


      <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 paddinglargeform">
      <q-input
      type="textarea"
        filled
        v-model="number"
        label="Number"
        lazy-rules
        :rules="[ val => val && val.length > 0 || 'Please type something']"
      />
      </div>


      <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 paddinglargeform">
      <q-input
      type="textarea"
        filled
        v-model="email"
        label="Email"
        lazy-rules
        :rules="[ val => val && val.length > 0 || 'Please type something']"
      />
      </div>

      <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 paddinglargeform">
      <q-input
      type="textarea"
        filled
        v-model="address"
        label="Address"
        lazy-rules
        :rules="[ val => val && val.length > 0 || 'Please type something']"
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

    name: 'contact',
    mixins: [toasts, helperUtil,stringUtil, helperMixin, storageManagement],
    components: { Loader },

    data() {
      return {
        heading1: ref(''),
        heading2: ref(''),
        heading3: ref(''),
        heading4: ref(''),
        para1: ref(''),
        para2: ref(''),
        para3: ref(''),
        para4: ref(''),
        number: ref(''),
        email: ref(''),
        address: ref(''),
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
                response = await axios.get(api.get_contact_data
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
                  let contact = response.data.data[0];

                    this.heading1 = contact.heading1;
                    this.heading2= contact.heading2;
                    this.heading3= contact.heading3;
                    this.heading4= contact.heading4;
                    this.para1= contact.para1;
                    this.para2= contact.para2;
                    this.para3= contact.para3;
                    this.para4= contact.para4;
                    this.number= contact.number;
                    this.email= contact.email;
                    this.address= contact.address;
                    
                    this.dataId= contact.id;

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
            formData.append('heading4', this.heading4);
            formData.append('para1', this.para1);
            formData.append('para2', this.para2);
            formData.append('para3', this.para3);
            formData.append('para4', this.para4);
            formData.append('number', this.number);
            formData.append('email', this.email);
            formData.append('address', this.address);
           

            this.showLoading();

            let response: any;
            try {
                 let token: string = getAuthorizationToken();
                response = await axios.post(api.update_contact_content, formData
                 , {
                     headers: {
                         Authorization: token,
                         'Content-Type': 'multipart/form-data',
                     },
                 }
                );
            } catch (err: any) {
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
              this.$router.push('/contact/edit');
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


