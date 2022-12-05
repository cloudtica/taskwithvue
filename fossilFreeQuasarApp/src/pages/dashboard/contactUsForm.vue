<template>
    
    <div class="row full-width">

      <div class="col-xs-12 xol-sm-12 col-md-12 col-lg-12 adminheadingpadding">
        <h5 class="text-white text-center margin-0 "> Contact Us Form Records </h5>
      </div>
        
    <div class="q-pa-md full-width text-center">

    

    <q-markup-table dark class="bg-indigo-8">
      <thead>
        <tr>
          <th class="text-left">ID</th>
          <th class="text-left">Name</th>
          <th class="text-left">Email</th>
          <th class="text-left">Message</th>
          <th class="text-left">Action</th>
         
        </tr>
      </thead>
      <tbody>
        <tr v-for="from in forms" v-bind:key="from.id">
          <td class="text-left">{{from.id}}</td>
          <td class="text-left">{{from.name}}</td>
          <td class="text-left">{{from.email}}</td>
          <td class="text-left">{{from.message}}</td>
          <td class="text-left"><q-btn icon="fas fa-trash"  @click="deleteRecord(from.id)" color="warning" style="margin:0px 10px;"></q-btn>
            
        </td>
        </tr>
      </tbody>
    </q-markup-table>

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

    name: 'ContactUsForms',
    mixins: [toasts, helperUtil,stringUtil, helperMixin, storageManagement],
    components: { Loader },

    data() {
      return {
        forms: ref([] as any),
      
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
                response = await axios.get(api.get_contactform_data
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
                 
                  this.forms = response.data.data;
                 

                } else {
                   
                  
                }
            }
      },

        async deleteRecord(formId: number) {

                    let formData = new FormData();
                    formData.append('formId', formId.toString());
                    this.showLoading();

                    let response: any;
                    try {
                        let token: string = getAuthorizationToken();
                        response = await axios.post(api.delete_cform, formData
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
                        this.showSuccessToast('Record Deleted Successfully');
                        this.$router.push('/cform');
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


