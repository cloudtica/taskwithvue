<template>
    
    <div class="row full-width">

      <div class="col-xs-12 xol-sm-12 col-md-12 col-lg-12 adminheadingpadding">
        <h5 class="text-white text-center margin-0 "> News Case Studies Records </h5>
      </div>
        
    <div class="q-pa-md full-width text-center">

    

    <q-markup-table dark class="bg-indigo-8">
      <thead>
        <tr>
          <th class="text-left">ID</th>
          <th class="text-left">Name</th>
          <th class="text-left">Author Name</th>
          <th class="text-left">Description</th>
          <th class="text-left">Published In</th>
          <th class="text-left">Rating</th>
          <th class="text-left">PDF File</th>
          <th class="text-left">Image</th>
          <th class="text-left">Image For Refference</th>
          <th class="text-left">Action</th>
         
        </tr>
      </thead>
      <tbody>
        <tr v-for="book in cases" v-bind:key="book.id">
          <td class="text-left">{{book.id}}</td>
          <td class="text-left">{{book.name}}</td>
          <td class="text-left">{{book.authorname}}</td>
          <td class="text-left">{{book.description}}</td>
          <td class="text-left">{{book.publishedin}}</td>
          <td class="text-left">{{book.rating}}</td>
          <td class="text-left">{{book.pdf}}</td>
          <td class="text-left">{{book.image}}</td>
          <td class="text-left"><img :src="imagePath + book.image" style="height:150px; width:150px" /></td>
          <td class="text-left"><q-btn icon="fas fa-trash"  @click="deleteCases(book.id)" color="warning" style="margin:0px 10px;"></q-btn>
            <q-btn icon="fas fa-edit"  @click="prepareUpdateForm(book)" color="orange" style="margin:0px 10px;"></q-btn>
        </td>
        </tr>
      </tbody>
    </q-markup-table>

  </div>
   


    </div>

  <q-dialog class="full-width" v-model="showUpdateForm" persistent>
    <q-card>
      <q-card-section class="row" style="justify-content: center; display: flex; background-color:#1976d2;">
        <h6 class="text-white margin-0">Edit Case Study Details</h6>
      </q-card-section>

      <q-card-section class="row full-width items-center">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <q-input style="width:400px; margin:0px auto;"
        filled
        v-model="dataModel.name"
        label="Full Name"
        lazy-rules
        :rules="[ val => val && val.length > 0 || 'Please type something']"
      />
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <q-input style="width:400px;  margin:0px auto;"
        filled
        v-model="dataModel.authorname"
        label="Author Name"
        lazy-rules
        :rules="[ val => val && val.length > 0 || 'Please type something']"
      />
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <q-input style="width:400px;  margin:0px auto;"
        filled
        v-model="dataModel.publishedin"
        label="Published In"
        lazy-rules
        :rules="[ val => val && val.length > 0 || 'Please type something']"
      />
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <q-input style="width:400px;  margin:0px auto;"
        filled
        v-model="dataModel.rating"
        label="Rating"
        lazy-rules
        :rules="[ val => val && val.length > 0 || 'Please type something']"
      />
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <p>Book Cover</p>
        <q-input style="width:400px;  margin:0px auto;"
        type="file"
        filled
        v-model="dataModel.image"
        lazy-rules
        :rules="[ val => val && val.length > 0 || 'Please choose file']"
      /></div>
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <p>PDF File</p>
        <q-input style="width:400px;  margin:0px auto;"
        type="file"
        filled
        v-model="dataModel.pdf"
        lazy-rules
        :rules="[ val => val && val.length > 0 || 'Please choose file']"
      /></div>
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <q-input style="width:400px;  margin:0px auto;"
        filled
        type="textarea"
        v-model="dataModel.description"
        label="Description"
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
          @click="updateCases(dataModel.id,dataModel.name, dataModel.authorname, dataModel.description, dataModel.publishedin, dataModel.rating, dataModel.pdf, dataModel.image)"
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

    name: 'CaseStudiesRecords',
    mixins: [toasts, helperUtil,stringUtil, helperMixin, storageManagement],
    components: { Loader },

    data() {
      return {
        cases: ref([] as any),
        imagePath:ref(''),
      
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
                response = await axios.get(api.get_cases
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
                 
                  this.cases = response.data.data;
                  this.imagePath = API_BASE_URL + response.data.image_path; 

                } else {
                   
                  
                }
            }
      },

        async deleteCases(casesId: number) {

                    let formData = new FormData();
                    formData.append('casesId', casesId.toString());
                    this.showLoading();

                    let response: any;
                    try {
                        let token: string = getAuthorizationToken();
                        response = await axios.post(api.delete_cases, formData
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
                        this.showSuccessToast('Deleted Successfully');
                        this.$router.push('/cases/records');
                    }

        },

        prepareUpdateForm(casesObj: any) {
          this.dataModel = JSON.parse(JSON.stringify(casesObj));
          this.showUpdateForm = true;
                },
        
        
        async updateCases(dataId: number, name: string, authorname: string, description: string, publishedin: string, rating: string, pdf: string, image: string) {

                    let formData = new FormData();
                    formData.append('dataId', dataId.toString());
                    formData.append('name', name);
                    formData.append('authorname', authorname);
                    formData.append('description', description);
                    formData.append('publishedin', publishedin);
                    formData.append('rating', rating);
                    formData.append('image', image[0]);
                    formData.append('pdf', pdf[0]);

                    this.showLoading();

                    let response: any;
                    try {
                        let token: string = getAuthorizationToken();
                        response = await axios.post(api.update_cases, formData
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
                    this.$router.push('/cases/records');
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


