<template>
    
    <div class="row full-width">

      <div class="col-xs-12 xol-sm-12 col-md-12 col-lg-12 adminheadingpadding">
        <h5 class="text-white text-center margin-0 "> FAQS Records </h5>
      </div>
        
    <div class="q-pa-md full-width text-center">

    

    <q-markup-table dark class="bg-indigo-8">
      <thead>
        <tr>
          <th class="text-left">ID</th>
          <th class="text-left">Title</th>
          <th class="text-left">Description</th>
          <th class="text-left">Action</th>
         
        </tr>
      </thead>
      <tbody>
        <tr v-for="faq in faqs" v-bind:key="faq.id">
          <td class="text-left">{{faq.id}}</td>
          <td class="text-left">{{faq.title}}</td>
          <td class="text-left">{{faq.details}}</td>
          <td class="text-left"><q-btn icon="fas fa-trash"  @click="deleteFaqs(faq.id)" color="warning" style="margin:0px 10px;"></q-btn>
            <q-btn icon="fas fa-edit"  @click="prepareUpdateForm(faq)" color="orange" style="margin:0px 10px;"></q-btn>
        </td>
        </tr>
      </tbody>
    </q-markup-table>

  </div>
   


    </div>

  <q-dialog class="full-width" v-model="showUpdateForm" persistent>
    <q-card>
      <q-card-section class="row" style="justify-content: center; display: flex; background-color:#1976d2;">
        <h6 class="text-white margin-0">Edit Faqs Details</h6>
      </q-card-section>

      <q-card-section class="row full-width items-center">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <q-input style="width:400px; margin:0px auto;"
        filled
        type="textarea"
        v-model="dataModel.title"
        label="Title"
        lazy-rules
        :rules="[ val => val && val.length > 0 || 'Please type something']"
      />
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <q-input style="width:400px;  margin:0px auto;"
        filled
        type="textarea"
        v-model="dataModel.details"
        label="Details"
        lazy-rules
        :rules="[ val => val && val.length > 0 || 'Please type something']"
      />
        </div>
    
      </q-card-section>

      <q-card-actions align="right">
        <q-btn flat label="cancel" color="primary" v-close-popup />
        <q-btn
          flat
          label="Save"
          color="primary"
          v-close-popup
          @click="updateFaqs(dataModel.id,dataModel.title,dataModel.details)"
        />
      </q-card-actions>
    </q-card>
  </q-dialog>


    
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

    name: 'Faqsrecords',
    mixins: [toasts, helperUtil,stringUtil, helperMixin, storageManagement],
    components: { Loader },

    data() {
      return {
        faqs: ref([] as any),
        showUpdateForm:ref(false),
        dataModel: [] as any,
      
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
                response = await axios.get(api.get_faqs
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

            console.log(response);

            if (response && response.data.error === false) {
                if(response.data.data.length > 0) {
                  let teamsData = response.data.data[0];
                 
                  this.faqs = response.data.data;
                 

                } else {
                   
                  
                }
            }
      },

        async deleteFaqs(faqsId: number) {

                    let formData = new FormData();
                    formData.append('faqsId', faqsId.toString());
                    this.showLoading();

                    let response: any;
                    try {
                        let token: string = getAuthorizationToken();
                        response = await axios.post(api.delete_faqs, formData
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
                        this.showSuccessToast('FAQ Deleted Successfully');
                        this.$router.push('/faqs/records');
                    }

        },

        prepareUpdateForm(faqsObj: any) {
          this.dataModel = JSON.parse(JSON.stringify(faqsObj));
          this.showUpdateForm = true;
                },
        
        
        async updateFaqs(dataId: number, title: string, details: string) {

                    let formData = new FormData();
                    formData.append('dataId', dataId.toString());
                    formData.append('title', title);
                    formData.append('details', details);
                  

                    this.showLoading();

                    let response: any;
                    try {
                        let token: string = getAuthorizationToken();
                        response = await axios.post(api.update_faqs, formData
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
                    this.$router.push('/faqs/records');
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


