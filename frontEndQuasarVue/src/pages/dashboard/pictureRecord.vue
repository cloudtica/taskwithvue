<template>
    
    <div class="row full-width">

      <div class="col-xs-12 xol-sm-12 col-md-12 col-lg-12 adminheadingpadding">
        <h5 class="text-white text-center margin-0 "> All Images Records </h5>
      </div>
        
    <div class="q-pa-md full-width text-center">

        <h5 class="greytext"> Homepage Slider Images Record </h5>

    <q-markup-table dark class="bg-indigo-8">
      <thead>
        <tr>
          <th class="text-left">ID</th>
          <th class="text-left">Name</th>
          <th class="text-left">Status</th>
          <th class="text-left">Location</th>
          <th class="text-left">Image Name</th>
          <th class="text-left">Image For Refference</th>
          <th class="text-left">Action</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="slide in slides" v-bind:key="slide.id">
          <td class="text-left">{{slide.id}}</td>
          <td class="text-left">{{slide.name}}</td>
          <td class="text-left">{{slide.status}}</td>
          <td class="text-left">{{slide.location}}</td>
          <td class="text-left">{{slide.image}}</td>
          <td class="text-left"><img :src="imagePath + slide.image" style="height:150px; width:300px" /></td>
          <td class="text-left"><q-btn icon="fas fa-trash"  @click="deleteSlide(slide.id)" color="warning"></q-btn></td>
        </tr>
      </tbody>
    </q-markup-table>

    <h5 class="greytext"> Clients Logos Images Record </h5>

    <q-markup-table dark class="bg-indigo-8">
      <thead>
        <tr>
          <th class="text-left">ID</th>
          <th class="text-left">Company Name</th>
          <th class="text-left">Image Name</th>
          <th class="text-left">Image For Refference</th>
          <th class="text-left">Action</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="logo in logos" v-bind:key="logo.id">
          <td class="text-left">{{logo.id}}</td>
          <td class="text-left">{{logo.name}}</td>
          <td class="text-left">{{logo.image}}</td>
          <td class="text-left"><img :src="imagePath + logo.image" style="height:150px; width:150px" /></td>
          <td class="text-left"><q-btn icon="fas fa-trash"  @click="deleteLogo(logo.id)" color="warning"></q-btn></td>
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

    name: 'ImagesRecords',
    mixins: [toasts, helperUtil,stringUtil, helperMixin, storageManagement],
    components: { Loader },

    data() {
      return {
        logos: ref([] as any),
        slides: ref([] as any),
        slidesId:ref(0),
        imagePath:ref(''),
      
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
                response = await axios.get(api.get_all_images
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
                  let slidesData = response.data.data[0];
                  
                  this.slides = response.data.data;
                  this.logos = response.data.data_logos;
                  this.imagePath = API_BASE_URL + response.data.image_path; 

                } else {
                   
                  
                }
            }
      },

        async deleteSlide(slidesId: number) {

                    let formData = new FormData();
                    formData.append('slidesId', slidesId.toString());
                    this.showLoading();

                    let response: any;
                    try {
                        let token: string = getAuthorizationToken();
                        response = await axios.post(api.delete_slider, formData
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
                        this.showSuccessToast('Home Slider Deleted Successfully');
                        this.$router.push('/pics/records');
                    }

        },

        async deleteLogo(logosId: number) {

            let formData = new FormData();
            formData.append('logosId', logosId.toString());
            this.showLoading();

            let response: any;
            try {
                let token: string = getAuthorizationToken();
                response = await axios.post(api.delete_logo, formData
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
                this.showSuccessToast('Logo Deleted Successfully');
                this.$router.push('/pics/records');
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


