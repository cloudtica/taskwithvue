<template>
    
    <div class="row full-width">

      <div class="col-xs-12 xol-sm-12 col-md-12 col-lg-12 adminheadingpadding">
        <h5 class="text-white text-center margin-0 "> Add Case Studies </h5>
      </div>
      
        
     <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 paddinglargeform">
      <q-input
        
        filled
        v-model="name"
        label="Book Name"
        lazy-rules
        :rules="[ val => val && val.length > 0 || 'Please type something']"
      />
     </div>
      
     
      <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 paddinglargeform">
      <q-input
     
        filled
        v-model="authorname"
        label="Author Name"
        lazy-rules
        :rules="[ val => val && val.length > 0 || 'Please type something']"
      />
      </div>

      <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 paddinglargeform">
      <q-input
     
        filled
        v-model="publishedin"
        label="Published In"
        lazy-rules
        :rules="[ val => val && val.length > 0 || 'Please type something']"
      />
      </div>

      <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 paddinglargeform">
      <q-input
     
        filled
        v-model="rating"
        label="Rating"
        lazy-rules
        :rules="[ val => val && val.length > 0 || 'Please type something']"
      />
      </div>

      <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 paddinglargeform">
        <p>Book Cover</p>
        <q-input
        type="file"
        filled
        v-model="image"
        lazy-rules
        :rules="[ val => val && val.length > 0 || 'Please choose file']"
      />
      </div>

      <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 paddinglargeform">
        <p>Pdf File</p>
        <q-input
        type="file"
        filled
        v-model="pdf"
        lazy-rules
        :rules="[ val => val && val.length > 0 || 'Please choose file']"
      />
      </div>


      <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 paddinglargeform">
        <q-input
        type="textarea"
        filled
        v-model="description"
        label="Description"
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

    name: 'Casespage',
    mixins: [toasts, helperUtil,stringUtil, helperMixin, storageManagement],
    components: { Loader },

    data() {
      return {
        name: ref(''),
        description: ref(''),
        authorname: ref(''),
        publishedin: ref(''),
        rating: ref(''),
        image: ref(''),
        pdf: ref(''),
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
            formData.append('name', this.name);
            formData.append('description', this.description);
            formData.append('authorname', this.authorname);
            formData.append('publishedin', this.publishedin);
            formData.append('rating', this.rating);
            formData.append('image', this.image[0]);
            formData.append('pdf', this.pdf[0]);
           

            this.showLoading();

            let response: any;
            try {
                 let token: string = getAuthorizationToken();
                response = await axios.post(api.add_case_studies, formData
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
                this.$router.push('/cases');
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


