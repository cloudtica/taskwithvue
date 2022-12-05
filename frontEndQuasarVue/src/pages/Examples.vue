<template>
    
    <div class="row full-width casestudy">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 padding-0 margin-0 aboutsechead hero-div text-center">
           <h1 class="sectionheading text-white margin-0 vpadding150"><b>{{heading1}}</b></h1>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 padding-0 margin-0  text-center">
           <h3 class="abouth2 margin-0">{{heading2}}</h3>

           <p class="aboutt" v-html="para"></p>  <br/><br/>
        </div>
      

        <div v-for="book in cases" v-bind:key="book.id" class="col-xs-12 col-sm-12 col-md-6 col-lg-6 caseboxleft">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 padding-0 margin-0 caseboxinner">
            <div class="row full-width padding-0 margin-0">
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                  <img :src="imagePath + book.image" class="full-width" />
                </div>
                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 padding-left-40">
                    <p class="caseh margin-0"><b>{{book.name}}</b></p>
                    <p class="caset margin-0" v-html="book.description"></p>
                    
                    <p class="casetb padding-top-30 margin-0">Author Name: <span class="caset"> {{book.authorname}}</span></p>
                    <p class="casetb margin-0">Published In: <span class="caset"> {{book.publishedin}}</span></p>
                    <p class="casetb margin-0">Reviews:  <q-rating
                                                            v-model="ratingModel"
                                                            size="1em"
                                                            :max="5"
                                                            color="yellow" />
                    </p>
                    <p class="padding-top-30">
                    <q-btn style="font-size:16px;" flat @click="downloadFile(book.pdf)" class="blue-text text-decoration-none casedownload">Download <i class="fas fa-arrow-down downloadicon"></i></q-btn>
                    <q-btn style="font-size:16px;" flat @click="openFileForRead(book.pdf)" class="blue-text text-decoration-none casedownload">Read More</q-btn> 
                  </p>
                </div>
            </div>
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

    name: 'examplespage',
    mixins: [toasts, helperUtil,stringUtil, helperMixin, storageManagement],
    components: { Loader },

    data() {
      return {
        heading1: ref(''),
        heading2: ref(''),
        para: ref(''),
        cases:ref([] as any),
        imagePath:ref(''),
        dataId: ref(1),
        dataModel: [] as any,
        downloadAbleFile: ref(''),
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
                response = await axios.get(api.get_examples_data
                //, {
                  //  headers: {
                     //   Authorization: token,
                  //  },
               // }
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
                  let homeData = response.data.data[0];
                  
                  this.heading1 = homeData.heading1;
                  this.heading2 = homeData.heading2;
                  this.para = homeData.para;
                  this.cases = response.data.data_cases;
                  this.ratingModel = this.cases[0].rating;
                  this.imagePath = API_BASE_URL + response.data.image_path;
                  this.dataId=homeData.id;

                } else {
                  this.dataId = 1;
                }
            }
      },

      async downloadFile1(fileName: string) {
          let filePath =  fileName;
          let formData = new FormData();
          formData.append('fileName', filePath);
          this.showLoading();

          let response: any;
          try {
              //let token: string = getAuthorizationToken();
              response = await axios.post(api.download_file_new, formData
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
              this.showSuccessToast('Your file is downloading');
              this.$router.push('/examples');
          }

          },



      downloadFile(fileName: string){
        let filePath = '/images/' + fileName;
          let link = document.createElement('a');
          link.href = API_BASE_URL + filePath;
          link.download = fileName;
          link.setAttribute('target', '_blank');
          // link['_target'] = 'blank'
          link.click();
      },

      openFileForRead(fileName: string){
          let filePath = '/images/' + fileName;
          let link = document.createElement('a');
          link.href = API_BASE_URL + filePath;
          //link.download = fileName;
          link.setAttribute('target', '_blank');
          // link['_target'] = 'blank'
          link.click();
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


