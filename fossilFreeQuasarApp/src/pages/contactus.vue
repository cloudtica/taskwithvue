<template>
    
    <div class="row full-width casestudy">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 padding-0 margin-0 aboutsechead hero-div text-center">
           <h1 class="sectionheading text-white margin-0 vpadding150"><b>{{heading1}}</b></h1>
        </div>
        
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 contactpaddingleft">
            <p>{{para1}}</p>

            <div class="row full-width">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 contactfieldspaddingleft">
                    <q-input class="zonesfields" square v-model="formName" label="Your Name Here" 
                    :rules="[ val => val && val.length > 0 || 'Please type something']"
                    />
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 contactfieldspaddingright">
                    <q-input class="zonesfields" square v-model="formEmail" label="Your Email Here" 
                    :rules="[ val => val && val.length > 0 || 'Please type something']"
                    />
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 contactfieldspaddingmid">
                    <q-input type="textarea" class="zonesfields" square v-model="formMessage" label="Your Message Here" 
                    :rules="[ val => val && val.length > 0 || 'Please type something']"
                    />
                </div>

               
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 contactfieldspaddingmid" style="margin-top:30px; margin-bottom:30px;">
                    <q-btn color="primary" text-color="white"  @click="addContent()" class="submitbtn2 "> Submit</q-btn> 
                </div>

            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 contactpaddingright">
            <h6 class="margin-0 blue-text">{{heading2}}</h6>
            <p>{{para2}}</p>
            <i class="fas fa-phone blue-text" style="font-size:25px;"><span style="font-size:18px; padding-left:20px;">{{number}}</span></i> 
        
            <br/><br/><br/>

            <h6 class="margin-0 blue-text">{{heading3}}</h6>
            <p>{{para3}}</p>
            <i class="fas fa-envelope blue-text" style="font-size:25px;"><span style="font-size:18px; padding-left:20px;">{{email}}</span></i> 
        
            <br/><br/><br/>

            <h6 class="margin-0 blue-text">{{heading4}}</h6>
            <p>{{para4}}</p>
            <i class="fas fa-location-arrow blue-text" style="font-size:25px;"><span style="font-size:18px; padding-left:20px;">{{address}}</span></i> 
        
        
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

    name: 'examplespage',
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
        formName:ref(''),
        formEmail:ref(''),
        formMessage:ref(''),
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
               // let token: string = getAuthorizationToken();
                response = await axios.get(api.get_contact_data
                //, {
                 //   headers: {
                  //      Authorization: token,
                  //  },
              //  }
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
                  let contactData = response.data.data[0];
                  
                  this.heading1 = contactData.heading1;
                  this.heading2 = contactData.heading2;
                  this.heading3 = contactData.heading3
                  this.heading4 = contactData.heading4;
                  this.para1 = contactData.para1;
                  this.para2 = contactData.para2;
                  this.para3 = contactData.para3;
                  this.para4 = contactData.para4;
                  this.number = contactData.number;
                  this.email = contactData.email;
                  this.address = contactData.address;
                
                  this.dataId=contactData.id;

                } else {
                  this.dataId = 1;
                }
            }
      },

      async addContent() {

          let formData = new FormData();
          formData.append('formName', this.formName);
          formData.append('formEmail', this.formEmail);
          formData.append('formMessage', this.formMessage);
          


          this.showLoading();

          let response: any;
          try {
              //let token: string = getAuthorizationToken();
              response = await axios.post(api.contact_form, formData
             // , {
                 // headers: {
                 //     Authorization: token,
                  //    'Content-Type': 'multipart/form-data',
               //   },
             // }
              );
          } catch (err) {
              this.showErrorToast(constants.ERROR_INTERNAL_OCCUR);
              console.error(err);
          } finally {
              this.hideLoading();
          }

          if (response && response.data.error === true && response.data.message_key === 'validation_failed') {
              this.showErrorToast(constants.required_fields);
              return;
          } else if(response && response.data.error === false) {
              this.showSuccessToast('Form Sucessfully Submitted');
              this.$router.push('/contact');
          }

          },

    },
  setup () {
    const $q = useQuasar()
  
   

    return {
      ratingModel: ref()
    }
  }
});

</script>


