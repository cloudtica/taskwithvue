<template>
    
    <div class="row full-width">

      <div class="col-xs-12 xol-sm-12 col-md-12 col-lg-12 adminheadingpadding">
        <h5 class="text-white text-center margin-0 "> Fossil Free Zones Rules Records </h5>
      </div>
        
    <div class="q-pa-md full-width text-center">

    

    <q-markup-table dark class="bg-indigo-8">
      <thead>
        <tr>
          <th class="text-left">ID</th>
          <th class="text-left">Title Achieved</th>
          <th class="text-left">Title In Transition</th>
          <th class="text-left">Description</th>
          <th class="text-left">Rules Achieved</th>
          <th class="text-left">Rules In Transition</th>
          <th class="text-left">Image</th>
          <th class="text-left">Action</th>
         
        </tr>
      </thead>
      <tbody>
        <tr v-for="rule in rules" v-bind:key="rule.id">
          <td class="text-left">{{rule.id}}</td>
          <td class="text-left"><img :src="imagePath + rule.title1" style="height:150px; width:150px" /></td>
          <td class="text-left"><img :src="imagePath + rule.title2" style="height:150px; width:150px" /></td>
          <td class="text-left" v-html="rule.description"></td>
          <td class="text-left" v-html="rule.rules1"></td>
          <td class="text-left" v-html="rule.rules2"></td>
          <td class="text-left"><img :src="imagePath + rule.image" style="height:150px; width:150px" /></td>
          <td class="text-left"><q-btn icon="fas fa-trash"  @click="deleteRules(rule.id)" color="warning" style="margin:0px 10px;"></q-btn>
            <q-btn icon="fas fa-edit"  @click="prepareUpdateForm(rule)" color="orange" style="margin:0px 10px;"></q-btn>
        </td>
        </tr>
      </tbody>
    </q-markup-table>

  </div>
   


    </div>

  <q-dialog class="full-width" v-model="showUpdateForm" persistent>
    <q-card>
      <q-card-section class="row" style="justify-content: center; display: flex; background-color:#1976d2;">
        <h6 class="text-white margin-0">Edit Rules Details</h6>
      </q-card-section>

      <q-card-section class="row full-width items-center">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <p>Achieved Icon</p>
        <q-input style="width:400px; margin:0px auto;"
        filled
        type="file"
        v-model="dataModel.title1"
        lazy-rules
        :rules="[ val => val && val.length > 0 || 'Please choose file']"
      />
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <p>In Transition Icon</p>
        <q-input style="width:400px;  margin:0px auto;"
        filled
        type="file"
        v-model="dataModel.title2"
        lazy-rules
        :rules="[ val => val && val.length > 0 || 'Please choose file']"
      />
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <q-input style="width:400px;  margin:0px auto;"
        filled
        type="textarea"
        v-model="dataModel.description"
        label="Rule Short Description"
        lazy-rules
        :rules="[ val => val && val.length > 0 || 'Please type something']"
      />
        </div>
   
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <q-input style="width:400px;  margin:0px auto;"
        filled
        type="textarea"
        v-model="dataModel.rules1"
        label="Achieved Rules"
        lazy-rules
        :rules="[ val => val && val.length > 0 || 'Please type something']"
      />
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <q-input style="width:400px;  margin:0px auto;"
        filled
        type="textarea"
        v-model="dataModel.rules2"
        label="In Transition Rules"
        lazy-rules
        :rules="[ val => val && val.length > 0 || 'Please type something']"
      />
        </div>
        
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <q-input style="width:400px;  margin:0px auto;"
        type="file"
        filled
        v-model="dataModel.image"
        lazy-rules
        :rules="[ val => val && val.length > 0 || 'Please choose file']"
      /></div>
      </q-card-section>

      <q-card-actions align="right">
        <q-btn flat label="cancel" color="primary" v-close-popup />
        <q-btn
          flat
          label="Save"
          color="primary"
          v-close-popup
          @click="updateRules(dataModel.id,dataModel.title1,dataModel.title2,dataModel.rules1,dataModel.rules2,dataModel.description,dataModel.image)"
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

    name: 'ImagesRecords',
    mixins: [toasts, helperUtil,stringUtil, helperMixin, storageManagement],
    components: { Loader },

    data() {
      return {
        rules: ref([] as any),
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
                response = await axios.get(api.get_rules
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
                  let teamsData = response.data.data[0];
                 
                  this.rules = response.data.data;
                  this.imagePath = API_BASE_URL + response.data.image_path; 

                } else {
                   
                  
                }
            }
      },

        async deleteRules(rulesId: number) {

                    let formData = new FormData();
                    formData.append('rulesId', rulesId.toString());
                    this.showLoading();

                    let response: any;
                    try {
                        let token: string = getAuthorizationToken();
                        response = await axios.post(api.delete_rules, formData
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
                        this.showSuccessToast('Rule Deleted Successfully');
                        this.$router.push('/rules/records');
                    }

        },

        prepareUpdateForm(rulesObj: any) {
          this.dataModel = JSON.parse(JSON.stringify(rulesObj));
          this.showUpdateForm = true;
                },
        
        
        async updateRules(dataId: number, title1: string, title2: string, rules1: string, rules2: string, description: string, image: string) {

                    let formData = new FormData();
                    formData.append('dataId', dataId.toString());
                    formData.append('title1', title1[0]);
                    formData.append('title2', title2[0]);
                    formData.append('rules1', rules1);
                    formData.append('rules2', rules2);
                    formData.append('description', description);
                    formData.append('image', image[0]);

                    this.showLoading();

                    let response: any;
                    try {
                        let token: string = getAuthorizationToken();
                        response = await axios.post(api.update_rules, formData
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
                    this.$router.push('/rules/records');
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


