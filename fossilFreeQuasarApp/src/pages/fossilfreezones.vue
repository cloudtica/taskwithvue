<template>
    
    <div class="row full-width">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 padding-0 margin-0 hero-div text-center ">
           <h1 class="sectionheading text-white margin-0 vpadding150"><b>{{heading1}}</b></h1>
        </div>


        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 campaign">
            <h3 class="campaignheading margin-0">{{heading2}}</h3>
            <p class="aboutt3" v-html="para1">
                
            </p>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 campaignimg text-center">
            <img :src="imagePath + oimage" class="full-width"/>
        </div>
    </div>


    <div class="row full-width">


        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center partners-padding">
                <h3 class="sectionheading greytext margin-0">{{heading3}}</h3>
                <p class="aboutt3 ourpartnert" v-html="para2"></p>
                <div class="row padding-bottom-100 aboutlogos categoriesdiv">
                    <div  v-for="rule in rules" v-bind:key="rule.id" class="col-xs-6 col-sm-6 col-md-3 col-lg-3 text-center">
                        <q-btn style="border-radius:10px; padding:0px;" flat @click="prepareDetails(rule)"><img :src="imagePath + rule.image" class="caticons"/></q-btn>
                    </div>
                </div>
           </div>


           <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7 campaign">
            <h3 class="internh margin-0">{{heading4}}</h3>
            <p class="aboutt3 padding-top-30" v-html="para3" style="padding-bottom:0px;">
                
            </p>
            <div class="row full-width">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 zonesfieldspaddingleft">
                    <q-input class="zonesfields" square v-model="formPlace" label="Name of place" />
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 zonesfieldspaddingright">
                    <q-input class="zonesfields" square v-model="formSite" label="Website" />
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 zonesfieldspaddingmid">
                    <q-select class="zonesfields" square v-model="formCountry" :options="options" emit-value map-options label="Select Country" />
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 zonesfieldspaddingmid" style="margin-top:30px;">
                <h6 class="greytext margin-0" >Contact Person Details <span style="font-weight:300; font-size:14px;">(If Available)</span> </h6>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 zonesfieldspaddingleft">
                    <q-input class="zonesfields" square v-model="formName" label="Full Name" />
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 zonesfieldspaddingright">
                    <q-input class="zonesfields" square v-model="formEmail" label="Email" />
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 zonesfieldspaddingmid" style="margin-top:30px; margin-bottom:30px;">
                    <q-btn color="primary" text-color="white" @click="addContent()" class="submitbtn2 left"> Submit Information </q-btn> 
                </div>

            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5 campaignimg text-center">
            <div class="full-width " ><img :src="imagePath + limage" class="full-width"/></div>  
        </div>       

    </div>

    <q-dialog class="full-width" v-model="showUpdateForm" >

    <q-card class="rulesdlg rulesdlgheight">
     
      <q-card-section class="row full-width items-center">

        <div class="col-xs-12 col-sm-8 col-md-7 col-lg-7 " style="border-bottom:3px solid #3b86eb;">
            <h6 class="margin-0 greytext"><b>How To Qualify</b></h6>
        </div>

        <div class="col-xs-12 col-sm-4 col-md-5 col-lg-5 padding40px" >
           
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <p class="greytext padding-top-30" v-html="dataModel.description"></p>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <q-tabs
          v-model="tab"
          dense
          class="text-grey"
          active-color="primary"
          indicator-color="primary"
          align="justify"
          narrow-indicator
       
        >
          <q-tab  :name=dataModel.title1 :icon="'img:' + imagePath + dataModel.title1"/>
          <q-tab  :name=dataModel.title2  :icon="'img:' + imagePath + dataModel.title2"/>
          
        </q-tabs>

        <q-separator />

        <q-tab-panels v-model="tab" animated style="background-color:#E3F0FF;">
          <q-tab-panel :name=dataModel.title1>
            <p class="greytext paddingrulesdetails" v-html="dataModel.rules1"></p>
          </q-tab-panel>

          <q-tab-panel :name=dataModel.title2>
            <p class="greytext paddingrulesdetails" v-html="dataModel.rules2"></p>
          </q-tab-panel>

        </q-tab-panels>
        </div>

       
      </q-card-section>

      <q-card-actions align="center" style="padding-bottom:20px;">
        <q-btn flat label="cancel" color="primary" v-close-popup />
        <q-btn
          
          label="Register Your Zone"
          color="primary"
          v-close-popup
        />
      </q-card-actions>
    </q-card>
  </q-dialog>
   

    
    <Loader /> 
    
    
</template>
<style>
    .categoriesdiv .q-hoverable{
      background-color:white !important;
      padding:0px;  
    }
    .q-tab__icon {
    width: 180px;
    height: 100px;
    }
</style>  
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

    name: 'FossilFreeZones',
    mixins: [toasts, helperUtil,stringUtil, helperMixin, storageManagement],
    components: { Loader },

    data() {
      return {
        heading1: ref(''),
        heading2: ref(''),
        para1: ref(''),
        para2: ref(''),
        heading3: ref(''),
        para3: ref(''),
        heading4: ref(''),
        heading5: ref(''),
        para4: ref(''),
        oimage:ref(''),
        limage:ref(''),
        formPlace:ref(''),
        formSite:ref(''),
        formCountry:ref('United States of America'),
        formName:ref(''),
        formEmail:ref(''),
        clients:ref([] as any),
        imagePath:ref(''),
        faqs:ref([] as any),
        rules:ref([] as any),
        dataId: ref(1),
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
                response = await axios.get(api.get_fossilfreezones_data
                , {
                    headers: {
                        Authorization: token,
                    },
                }
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
                  let zones = response.data.data[0];

                    this.heading1 = zones.heading1;
                    this.heading2= zones.heading2;
                    this.para1= zones.para1;
                    this.para2= zones.para2;
                    this.heading3= zones.heading3;
                    this.para3= zones.para3;
                    this.heading4= zones.heading4;
                    this.heading5= zones.heading5;
                    this.para4= zones.para4;
                    this.oimage= zones.oimage;
                    this.limage= zones.limage;
                    this.clients = response.data.data_images;
                    this.faqs = response.data.data_faqs;
                    this.rules = response.data.data_rules;
                    // this.location=this.formCountry;
                    
                    this.imagePath = API_BASE_URL + response.data.image_path;
                    this.dataId= zones.id;

                } else {
                  this.dataId = 1;
                }
            }
      },

      prepareDetails(rulesObj: any) {
          this.dataModel = JSON.parse(JSON.stringify(rulesObj));
          this.showUpdateForm = true;
          this.tab=this.dataModel.title1;
                },

      async addContent() {

            let formData = new FormData();
            formData.append('formName', this.formName);
            formData.append('formEmail', this.formEmail);
            formData.append('formPlace', this.formPlace);
            formData.append('formSite', this.formSite);
            formData.append('formCountry', this.formCountry);



            this.showLoading();

            let response: any;
            try {
                //let token: string = getAuthorizationToken();
                response = await axios.post(api.zones_form, formData
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
                this.showSuccessToast('Zone Sucessfully Submitted For Approval');
                this.$router.push('/fossilfreezones');
            }

            },

    },
  setup () {
    const $q = useQuasar()
    
   

    return {
            tab: ref(''),
            options: [
                { value: 'Afghanistan', label: 'Afghanistan' },
                { value: 'Albania', label: 'Albania' },
                { value: 'Algeria', label: 'Algeria' },
                { value: 'American Samoa	', label: 'American Samoa	' },
                { value: 'Andorra', label: 'Andorra' },
                { value: 'Angola', label: 'Angola' },
                { value: 'Anguilla', label: 'Anguilla' },
                { value: 'Antarctica', label: 'Antarctica' },
                { value: 'Antigua and Barbuda	', label: 'Antigua and Barbuda	' },
                { value: 'Argentina', label: 'Argentina' },
                { value: 'Armenia', label: 'Armenia' },
                { value: 'Aruba', label: 'Aruba' },
                { value: 'Australia', label: 'Australia' },
                { value: 'Austria	', label: 'Austria	' },
                { value: 'Azerbaijan', label: 'Azerbaijan' },
                { value: 'Bahamas ', label: 'Bahamas ' },
                { value: 'Bahrain', label: 'Bahrain' },
                { value: 'Bangladesh', label: 'Bangladesh' },
                { value: 'Barbados', label: 'Barbados' },
                { value: 'Belarus', label: 'Belarus' },
                { value: 'Belgium', label: 'Belgium' },
                { value: 'Belize', label: 'Belize' },
                { value: 'Benin', label: 'Benin' },
                { value: 'Bermuda', label: 'Bermuda' },
                { value: 'Bhutan', label: 'Bhutan' },
                { value: 'Bolivia ', label: 'Bolivia ' },
                { value: 'Bonaire', label: 'Bonaire' },
                { value: 'Bosnia and Herzegovina', label: 'Bosnia and Herzegovina	' },
                { value: 'Botswana', label: 'Botswana' },
                { value: 'Bouvet Island	', label: 'Bouvet Island	' },
                { value: 'Brazil', label: 'Brazil' },
                { value: 'Brunei Darussalam	', label: 'Brunei Darussalam	' },
                { value: 'Bulgaria', label: 'Bulgaria' },
                { value: 'Burkina Faso	', label: 'Burkina Faso	' },
                { value: 'Burundi', label: 'Burundi' },
                { value: 'Cabo Verde	', label: 'Cabo Verde	' },
                { value: 'Cambodia', label: 'Cambodia' },
                { value: 'Cameroon', label: 'Cameroon' },
                { value: 'Canada', label: 'Canada' },
                { value: 'Cayman Islands', label: 'Cayman Islands' },
                { value: 'Central African Republic', label: 'Central African Republic' },
                { value: 'Chad', label: 'Chad' },
                { value: 'Chile', label: 'Chile' },
                { value: 'China', label: 'China' },
                { value: 'Christmas Island	', label: 'Christmas Island	' },
                { value: 'Cocos ', label: 'Cocos ' },
                { value: 'Colombia', label: 'Colombia' },
                { value: 'Comoros ', label: 'Comoros ' },
                { value: 'Congo ', label: 'Congo ' },
                { value: 'Cook Islands ', label: 'Cook Islands ' },
                { value: 'Costa Rica	', label: 'Costa Rica	' },
                { value: 'Croatia', label: 'Croatia' },
                { value: 'Cuba', label: 'Cuba' },
                { value: 'Curaçao', label: 'Curaçao' },
                { value: 'Cyprus', label: 'Cyprus' },
                { value: 'Czechia', label: 'Czechia' },
                { value: 'Denmark', label: 'Denmark' },
                { value: 'Djibouti', label: 'Djibouti' },
                { value: 'Dominica', label: 'Dominica' },
                { value: 'Dominican Republic', label: 'Dominican Republic' },
                { value: 'Ecuador', label: 'Ecuador' },
                { value: 'Egypt', label: 'Egypt' },
                { value: 'El Salvador	', label: 'El Salvador	' },
                { value: 'Equatorial Guinea	', label: 'Equatorial Guinea	' },
                { value: 'Eritrea', label: 'Eritrea' },
                { value: 'Estonia', label: 'Estonia' },
                { value: 'Eswatini', label: 'Eswatini' },
                { value: 'Ethiopia', label: 'Ethiopia' },
                { value: 'Falkland Islands', label: 'Falkland Islands' },
                { value: 'Faroe Islands', label: 'Faroe Islands' },
                { value: 'Fiji	', label: 'Fiji	' },
                { value: 'Finland', label: 'Finland' },
                { value: 'France', label: 'France' },
                { value: 'French Guiana	', label: 'French Guiana	' },
                { value: 'French Polynesia	', label: 'French Polynesia	' },
                { value: 'French Southern Territories', label: 'French Southern Territories' },
                { value: 'Gabon', label: 'Gabon' },
                { value: 'Gambia ', label: 'Gambia ' },
                { value: 'Georgia', label: 'Georgia' },
                { value: 'Germany', label: 'Germany' },
                { value: 'Ghana', label: 'Ghana' },
                { value: 'Gibraltar', label: 'Gibraltar' },
                { value: 'Greece', label: 'Greece' },
                { value: 'Greenland', label: 'Greenland' },
                { value: 'Grenada', label: 'Grenada' },
                { value: 'Guadeloupe', label: 'Guadeloupe' },
                { value: 'Guam', label: 'Guam' },
                { value: 'Guatemala', label: 'Guatemala' },
                { value: 'Guernsey', label: 'Guernsey' },
                { value: 'Guinea', label: 'Guinea' },
                { value: 'Guinea-Bissau	', label: 'Guinea-Bissau	' },
                { value: 'Guyana', label: 'Guyana' },
                { value: 'Haiti', label: 'Haiti' },
                { value: 'Honduras', label: 'Honduras' },
                { value: 'Hong Kong	', label: 'Hong Kong	' },
                { value: 'Hungary', label: 'Hungary' },
                { value: 'Iceland', label: 'Iceland' },
                { value: 'India', label: 'India' },
                { value: 'Indonesia', label: 'Indonesia' },
                { value: 'Iran ', label: 'Iran ' },
                { value: 'Iraq', label: 'Iraq' },
                { value: 'Ireland', label: 'Ireland' },
                { value: 'Israel', label: 'Israel' },
                { value: 'Italy', label: 'Italy' },
                { value: 'Jamaica', label: 'Jamaica' },
                { value: 'Japan', label: 'Japan' },
                { value: 'Jersey', label: 'Jersey' },
                { value: 'Jordan', label: 'Jordan' },
                { value: 'Kazakhstan', label: 'Kazakhstan' },
                { value: 'Kenya', label: 'Kenya' },
                { value: 'Kiribati', label: 'Kiribati' },
                { value: 'Korea ', label: 'Korea ' },
                { value: 'Kuwait', label: 'Kuwait' },
                { value: 'Kyrgyzstan', label: 'Kyrgyzstan' },
                { value: 'Lebanon', label: 'Lebanon' },
                { value: 'Liberia', label: 'Liberia' },
                { value: 'Libya', label: 'Libya' },
                { value: 'Lithuania', label: 'Lithuania' },
                { value: 'Luxembourg', label: 'Luxembourg' },
                { value: 'Macao', label: 'Macao' },
                { value: 'Madagascar', label: 'Madagascar' },
                { value: 'Malawi', label: 'Malawi' },
                { value: 'Malaysia', label: 'Malaysia' },
                { value: 'Maldives', label: 'Maldives' },
                { value: 'Mali', label: 'Mali' },
                { value: 'Malta', label: 'Malta' },
                { value: 'Mauritius', label: 'Mauritius' },
                { value: 'Mauritania', label: 'Mauritania' },
                { value: 'Mayotte', label: 'Mayotte' },
                { value: 'Mexico', label: 'Mexico' },
                { value: 'Moldova ', label: 'Moldova ' },
                { value: 'Monaco', label: 'Monaco' },
                { value: 'Mongolia', label: 'Mongolia' },
                { value: 'Morocco', label: 'Morocco' },
                { value: 'Myanmar', label: 'Myanmar' },
                { value: 'Namibia', label: 'Namibia' },
                { value: 'Nauru', label: 'Nauru' },
                { value: 'Nepal', label: 'Nepal' },
                { value: 'Netherlands ', label: 'Netherlands ' },
                { value: 'New Caledonia', label: 'New Caledonia' },
                { value: 'New Zealand	', label: 'New Zealand	' },
                { value: 'Nigeria', label: 'Nigeria' },
                { value: 'Norway', label: 'Norway' },
                { value: 'Oman', label: 'Oman' },
                { value: 'Pakistan', label: 'Pakistan' },
                { value: 'Palau', label: 'Palau' },
                { value: 'Palestine', label: 'Palestine' },
                { value: 'Panama', label: 'Panama' },
                { value: 'Papua New Guinea	', label: 'Papua New Guinea	' },
                { value: 'Paraguay', label: 'Paraguay' },
                { value: 'Peru', label: 'Peru' },
                { value: 'Philippines ', label: 'Philippines ' },
                { value: 'Poland', label: 'Poland' },
                { value: 'Portugal', label: 'Portugal' },
                { value: 'Puerto Rico	', label: 'Puerto Rico	' },
                { value: 'Qatar', label: 'Qatar' },
                { value: 'Romania', label: 'Romania' },
                { value: 'Russia', label: 'Russia' },
                { value: 'Rwanda', label: 'Rwanda' },
                { value: 'Réunion', label: 'Réunion' },
                { value: 'Samoa', label: 'Samoa' },
                { value: 'San Marino	', label: 'San Marino	' },
                { value: 'Saudi Arabia	', label: 'Saudi Arabia	' },
                { value: 'Senegal', label: 'Senegal' },
                { value: 'Serbia', label: 'Serbia' },
                { value: 'Seychelles', label: 'Seychelles' },
                { value: 'Sierra Leone	', label: 'Sierra Leone	' },
                { value: 'Singapore', label: 'Singapore' },
                { value: 'Sint Maarten', label: 'Sint Maarten' },
                { value: 'Slovakia', label: 'Slovakia' },
                { value: 'Slovenia', label: 'Slovenia' },
                { value: 'Solomon Islands	', label: 'Solomon Islands	' },
                { value: 'Somalia', label: 'Somalia' },
                { value: 'South Africa	', label: 'South Africa	' },
                { value: 'Sudan	', label: 'Sudan	' },
                { value: 'Spain', label: 'Spain' },
                { value: 'Sri Lanka	', label: 'Sri Lanka	' },
                { value: 'Sweden', label: 'Sweden' },
                { value: 'Switzerland', label: 'Switzerland' },
                { value: 'Syria', label: 'Syria' },
                { value: 'Taiwan ', label: 'Taiwan ' },
                { value: 'Tajikistan', label: 'Tajikistan' },
                { value: 'Tanzania', label: 'Tanzania' },
                { value: 'Thailand', label: 'Thailand' },
                { value: 'Tunisia', label: 'Tunisia' },
                { value: 'Turkey', label: 'Turkey' },
                { value: 'Turkmenistan', label: 'Turkmenistan' },
                { value: 'Uganda', label: 'Uganda' },
                { value: 'Ukraine', label: 'Ukraine' },
                { value: 'United Arab Emirates', label: 'United Arab Emirates' },
                { value: 'United Kingdom', label: 'United Kingdom' },
                { value: 'United States of America', label: 'United States of America' },
                { value: 'Uruguay', label: 'Uruguay' },
                { value: 'Uzbekistan', label: 'Uzbekistan' },
                { value: 'Venezuela ', label: 'Venezuela ' },
                { value: 'Viet Nam	', label: 'Viet Nam	' },
                { value: 'Yemen', label: 'Yemen' },
                { value: 'Zambia', label: 'Zambia' },
                { value: 'Zimbabwe', label: 'Zimbabwe' },
               
            ],

            
    }
  }
});

</script>


