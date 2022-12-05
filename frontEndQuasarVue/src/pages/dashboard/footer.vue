<template>
    
    <div class="row full-width">

      <div class="col-xs-12 xol-sm-12 col-md-12 col-lg-12 adminheadingpadding">
        <h5 class="text-white text-center margin-0 "> Update Footer Content </h5>
      </div>
      
        
     <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 paddinglargeform">
      <q-input
        
        filled
        v-model="number"
        label="Number"
        lazy-rules
        :rules="[ val => val && val.length > 0 || 'Please type something']"
      />
     </div>

     <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 paddinglargeform">
      <q-input
        
        filled
        v-model="footermail"
        label="Mail"
        lazy-rules
        :rules="[ val => val && val.length > 0 || 'Please type something']"
      />
     </div>
      
  

      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 paddinglargeform">
      <q-input
        type="textarea"
        filled
        v-model="message"
        label="Social Message"
        lazy-rules
        :rules="[ val => val && val.length > 0 || 'Please type something']"
      />
      </div>

      <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 paddinglargeform">
      <q-input
        filled
        v-model="facebook"
        label="Facebook"
        lazy-rules
        :rules="[ val => val && val.length > 0 || 'Please type something']"
      />
      </div>


      <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 paddinglargeform">
      <q-input
        filled
        v-model="face"
        label="Facebook Icon Class"
        lazy-rules
        :rules="[ val => val && val.length > 0 || 'Please type something']"
      />
      </div>

      <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 paddinglargeform">
      <q-input
        filled
        v-model="linkedin"
        label="Linkedin"
        lazy-rules
        :rules="[ val => val && val.length > 0 || 'Please type something']"
      />
      </div>


      <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 paddinglargeform">
      <q-input
        filled
        v-model="linkicon"
        label="Linkedin Icon Class"
        lazy-rules
        :rules="[ val => val && val.length > 0 || 'Please type something']"
      />
      </div>

      <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 paddinglargeform">
      <q-input
        filled
        v-model="instagram"
        label="Instagram"
        lazy-rules
        :rules="[ val => val && val.length > 0 || 'Please type something']"
      />
      </div>


      <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 paddinglargeform">
      <q-input
        filled
        v-model="insta"
        label="Instagram Icon Class"
        lazy-rules
        :rules="[ val => val && val.length > 0 || 'Please type something']"
      />
      </div>

      <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 paddinglargeform">
      <q-input
        filled
        v-model="twitter"
        label="Twitter Link"
        lazy-rules
        :rules="[ val => val && val.length > 0 || 'Please type something']"
      />
      </div>


      <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 paddinglargeform">
      <q-input
        filled
        v-model="twit"
        label="Twitter Icon Class"
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

    name: 'Footer',
    mixins: [toasts, helperUtil,stringUtil, helperMixin, storageManagement],
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
        dataId: ref(1),
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
                response = await axios.get(api.get_footer_data
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
                    this.dataId = data.id;

                } else {
                  this.dataId = 1;
                }
            }
      },


      async updateContent() {

            let formData = new FormData();
            formData.append('dataId', this.dataId.toString());
            formData.append('number', this.number);
            formData.append('footermail', this.footermail);
            formData.append('message', this.message);
            formData.append('facebook', this.facebook);
            formData.append('instagram', this.instagram);
            formData.append('linkedin', this.linkedin);
            formData.append('twitter', this.twitter);
            formData.append('face', this.face);
            formData.append('insta', this.insta);
            formData.append('linkicon', this.linkicon);
            formData.append('twit', this.twit);
            
            

            this.showLoading();

            let response: any;
            try {
                 let token: string = getAuthorizationToken();
                response = await axios.post(api.update_footer, formData
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
              this.$router.push('/footer');
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


