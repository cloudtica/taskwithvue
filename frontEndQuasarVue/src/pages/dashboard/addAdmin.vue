<template>
    
    <div class="row full-width">

      <div class="col-xs-12 xol-sm-12 col-md-12 col-lg-12 adminheadingpadding">
        <h5 class="text-white text-center margin-0 "> Add New Admin </h5>
      </div>
      
        
     <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 paddinglargeform">
      <q-input
        
        filled
        v-model="name"
        label="Full Name"
        lazy-rules
        :rules="[ val => val && val.length > 0 || 'Please type something']"
      />
     </div>
      
     
      <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 paddinglargeform">
      <q-input
     
        filled
        v-model="email"
        label="Email"
        lazy-rules
        :rules="[ val => val && val.length > 0 || 'Please type something']"
      />
      </div>

      <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 paddinglargeform">
      <q-input
        type="password"
        filled
        v-model="password"
        label="Password"
        lazy-rules
        :rules="[ val => val && val.length > 0 || 'Please type something']"
      />
      </div>


      <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 paddinglargeform">
        <q-input
        type="password"
        filled
        v-model="c_password"
        label="Confirm Password"
        lazy-rules
        :rules="[ val => val && val.length > 0 || 'Please type something']"
      />
      </div>

    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 paddinglargeform">
      <q-select  square v-model="formCountry" :options="options" emit-value map-options label="Select Country" />
    </div>

      

     
      <div class="paddinglargeform">
        <q-btn label="Submit"   @click="addAdmin()" color="primary"/>
      
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

    name: 'AddAdmin',
    mixins: [toasts, helperUtil,stringUtil, helperMixin, storageManagement],
    components: { Loader },

    data() {
      return {
        name: ref(''),
        email: ref(''),
        password: ref(''),
        c_password: ref(''),
        formCountry:ref('Afghanistan'),
        isSuper:ref('0'),
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

      async addAdmin() {
       
        if(this.c_password != this.password){
            this.showErrorToast(constants.password_missmatch);
            return;
        }

            let formData = new FormData();
            formData.append('name', this.name);
            formData.append('email', this.email);
            formData.append('password', this.password);
            formData.append('c_password', this.c_password);
            formData.append('formCountry', this.formCountry);
            formData.append('isSuper', this.isSuper);
           

            this.showLoading();

            let response: any;
            try {
                 let token: string = getAuthorizationToken();
                response = await axios.post(api.register_admin, formData
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
                this.showSuccessToast('User Created Successfully');
                this.$router.push('/admin/reg');
            }

            },

    },
  setup () {
    const $q = useQuasar()
  
   

    return {

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
                { value: 'Cura??ao', label: 'Cura??ao' },
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
                { value: 'R??union', label: 'R??union' },
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


