<template>
    
    <div class="row full-width">

      <div class="col-xs-12 xol-sm-12 col-md-12 col-lg-12 adminheadingpadding">
        <h5 class="text-white text-center margin-0 "> Update About Page Content </h5>
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
        v-model="heading5"
        label="Heading 5"
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
        v-model="para6"
        label="Para 6"
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
      <q-input
      type="textarea"
        filled
        v-model="para7"
        label="Para 7"
        lazy-rules
        :rules="[ val => val && val.length > 0 || 'Please type something']"
      />
      </div>

      <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 paddinglargeform">
      <q-input
      type="textarea"
        filled
        v-model="heading10"
        label="Heading10"
        lazy-rules
        :rules="[ val => val && val.length > 0 || 'Please type something']"
      />
      </div>

      <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 paddinglargeform">
      <q-input
      type="textarea"
        filled
        v-model="para8"
        label="Para 8"
        lazy-rules
        :rules="[ val => val && val.length > 0 || 'Please type something']"
      />
      </div>

      <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 paddinglargeform">
        <p>Campaign Image</p>
        <q-input
        type="file"
        filled
        v-model="cimage"
        lazy-rules
        :rules="[ val => val && val.length > 0 || 'Please choose file']"
      />
      </div>

      <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 paddinglargeform">
        <p>Intership Image</p>
        <q-input
       
        type="file"
        filled
        v-model="iimage"
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
                    this.dataId= aboutData.id;

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
            formData.append('para1', this.para1);
            formData.append('para2', this.para2);
            formData.append('heading3', this.heading3);
            formData.append('para3', this.para3);
            formData.append('heading4', this.heading4);
            formData.append('heading5', this.heading5);
            formData.append('para4', this.para4);
            formData.append('heading6', this.heading6);
            formData.append('para5', this.para5);
            formData.append('heading7', this.heading7);
            formData.append('para6', this.para6);
            formData.append('heading8', this.heading8);
            formData.append('heading9', this.heading9);
            formData.append('para7', this.para7);
            formData.append('heading10', this.heading10);
            formData.append('para8', this.para8);
            formData.append('cimage', this.cimage[0]);
            formData.append('iimage', this.iimage[0]);

            this.showLoading();

            let response: any;
            try {
                 let token: string = getAuthorizationToken();
                response = await axios.post(api.update_about_content, formData
                 , {
                     headers: {
                         Authorization: token,
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
              this.$router.push('/about/edit');
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


