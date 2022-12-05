<template>
    
    <div class="row full-width">

      <div class="col-xs-12 xol-sm-12 col-md-12 col-lg-12 adminheadingpadding">
        <h5 class="text-white text-center margin-0 "> Add FAQ's</h5>
      </div>
      
        
     <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 paddinglargeform">
      <q-input
        type="textarea"
        filled
        v-model="title"
        label="Question"
        lazy-rules
        :rules="[ val => val && val.length > 0 || 'Please type something']"
      />
     </div>
      
     
      <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 paddinglargeform">
      <q-input
        type="textarea"
        filled
        v-model="details"
        label="Details of Question"
        lazy-rules
        :rules="[ val => val && val.length > 0 || 'Please type something']"
      />
      </div>



      

      

     
      <div class="paddinglargeform">
        <q-btn label="Submit"   @click="addContent()" color="primary"/>
      
      </div>
   


    </div>


    
    <Loader />
       
    
</template>

<script lang="ts">
import axios from 'axios';
import { useQuasar } from 'quasar';
import toasts from 'src/mixins/toasts';
import { defineComponent, ref} from 'vue';
import stringUtil from 'src/utils/string';
import helperUtil from 'src/utils/helperUtil';
import constants from 'src/contants/constants';
import Loader from 'src/components/Loader.vue';
import helperMixin from 'src/mixins/helperMixin.js';
import storageManagement from 'src/utils/storageManagement';
import { api, getAuthorizationToken } from 'src/utils/APIs';

export default defineComponent ({

    name: 'FAQS',
    mixins: [toasts, helperUtil,stringUtil, helperMixin, storageManagement],
    components: { Loader },

    data() {
      return {
        title: ref(''),
        details: ref(''),
      };
    },
    mounted: function() {
      this.init();
    },
    methods: {
      async init() {
        //await this.loadData();
        //await this.updateHomeContent();
      },

      async addContent() {

            let formData = new FormData();
            formData.append('title', this.title);
            formData.append('details', this.details);
           

            this.showLoading();

            let response: any;
            try {
                 let token: string = getAuthorizationToken();
                response = await axios.post(api.add_faqs, formData
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
                this.$router.push('/addfaqs');
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


