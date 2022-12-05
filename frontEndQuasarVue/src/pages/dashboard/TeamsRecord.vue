<template>
    
    <div class="row full-width">

      <div class="col-xs-12 xol-sm-12 col-md-12 col-lg-12 adminheadingpadding">
        <h5 class="text-white text-center margin-0 "> All Team Members Records </h5>
      </div>
        
    <div class="q-pa-md full-width text-center">

    <h5 class="greytext"> Team Members Record </h5>

    <q-markup-table dark class="bg-indigo-8">
      <thead>
        <tr>
          <th class="text-left">ID</th>
          <th class="text-left">Name</th>
          <th class="text-left">Post</th>
          <th class="text-left">Sort Number</th>
          <th class="text-left">Image</th>
          <th class="text-left">Image For Refference</th>
          <th class="text-left">Action</th>
         
        </tr>
      </thead>
      <tbody>
        <tr v-for="team in teams" v-bind:key="team.id">
          <td class="text-left">{{team.id}}</td>
          <td class="text-left">{{team.name}}</td>
          <td class="text-left">{{team.post}}</td>
          <td class="text-left">{{team.sorting}}</td>
          <td class="text-left">{{team.image}}</td>
          <td class="text-left"><img :src="imagePath + team.image" style="height:150px; width:150px" /></td>
          <td class="text-left"><q-btn icon="fas fa-trash"  @click="deleteTeamMember(team.id)" color="warning" style="margin:0px 10px;"></q-btn>
            <q-btn icon="fas fa-edit"  @click="prepareUpdateForm(team)" color="orange" style="margin:0px 10px;"></q-btn>
        </td>
        </tr>
      </tbody>
    </q-markup-table>

  </div>
   


    </div>

  <q-dialog class="full-width" v-model="showUpdateForm" persistent>
    <q-card>
      <q-card-section class="row" style="justify-content: center; display: flex; background-color:#1976d2;">
        <h6 class="text-white margin-0">Edit Team Member Details</h6>
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
        v-model="dataModel.post"
        label="Post"
        lazy-rules
        :rules="[ val => val && val.length > 0 || 'Please type something']"
      />
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <q-input style="width:400px;  margin:0px auto;"
        filled
        v-model="dataModel.sorting"
        label="Sort Number"
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
          @click="updateMember(dataModel.id,dataModel.name,dataModel.post,dataModel.sorting,dataModel.image)"
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
        teams: ref([] as any),
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
                response = await axios.get(api.get_teams
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
                 
                  this.teams = response.data.data;
                  this.imagePath = API_BASE_URL + response.data.image_path; 

                } else {
                   
                  
                }
            }
      },

        async deleteTeamMember(teamsId: number) {

                    let formData = new FormData();
                    formData.append('teamsId', teamsId.toString());
                    this.showLoading();

                    let response: any;
                    try {
                        let token: string = getAuthorizationToken();
                        response = await axios.post(api.delete_member, formData
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
                        this.showSuccessToast('Team Member Deleted Successfully');
                        this.$router.push('/team/records');
                    }

        },

        prepareUpdateForm(teamsObj: any) {
          this.dataModel = JSON.parse(JSON.stringify(teamsObj));
          this.showUpdateForm = true;
                },
        
        
        async updateMember(dataId: number, name: string, post: string, sorting: string, image: string) {

                    let formData = new FormData();
                    formData.append('dataId', dataId.toString());
                    formData.append('name', name);
                    formData.append('post', post);
                    formData.append('sorting', sorting);
                    formData.append('image', image[0]);

                    this.showLoading();

                    let response: any;
                    try {
                        let token: string = getAuthorizationToken();
                        response = await axios.post(api.update_member, formData
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
                    this.$router.push('/team/records');
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


