<template>

<div class="row">
<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4"></div>
<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 logincard">

  <div class="col-sm-12 col-md-12 col-lg-12 text-center">
  <img  src="logo.png" class="logomain"/>
  <h5 class="blue-text margin-0 padding-top-30">Admin Login</h5>
  </div>  
  <div class="col-sm-12 col-md-12 col-lg-12 padding-top-30" id="email">
  <q-input dense
                    v-model="email"
                    placeholder="max.musterman@example.com"
                    outlined
                    class="full-width"
                    label="Email"
                  />
  </div>
                <div
                class="
                  col-sm-12 col-md-12 col-lg-12
                  text-red-5
                  height-20
                  q-pl-md
                "
              >
                {{ emailError }}
              </div>

<div
                  class="col-sm-12 col-md-12 col-lg-13 padding-top-30"
                  id="password"
                >
<q-input dense
                    type="password"
                    v-model="password"
                    outlined
                    class="full-width"
                    label="Password"
                    
                  />
</div>

                  <div
                class="
                  col-sm-12 col-md-12 col-lg-12
                  text-red-5
                  height-20
                  q-pl-md
                "
              >
                {{ passwordError }}
              </div>



              <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="row q-pt-md">
                  <div class="col-sm-4 q-pr-sm">
                    <q-btn
                      label="Login"
                      class="btn btn-primary"
                      @click="onSubmit()"
                    />
                  </div>
                </div>
              </div>
            </div> 
          <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4"></div>
      </div>
              <Loader />

   
</template>

<script lang="ts">

import axios from 'axios';
import { defineComponent} from 'vue';
import toasts from '../mixins/toasts';
import { $ } from 'src/utils/assets';
import stringUtil from 'src/utils/string';
import helperUtil from 'src/utils/helperUtil';
import Loader from '../components/Loader.vue';
import constants from 'src/contants/constants';
import helperMixin from 'src/mixins/helperMixin.js';
import storageManagement from 'src/utils/storageManagement';
import { api, getAuthorizationToken } from 'src/utils/APIs';


export default defineComponent({
    name: 'Login',
    mixins: [toasts, helperUtil,stringUtil, helperMixin, storageManagement],
    components: { Loader },

    data() {
        return {
            email: '',
            password: '',
            emailError: '',
            passwordError: '',
        };
    },

    methods: {
        onSubmit() {
        this.email = this.removeSpaces(this.email)
        let isEmailValid = this.validateEmail(this.email);
        if (!isEmailValid) {
            this.removeClass(
            $('#email')!.querySelector('label')!,
            'success-border-left'
            );
            this.addClass(
            $('#email')!.querySelector('label')!,
            'error-border-left'
            );

            this.emailError = constants.INVALID_EMAIL;
        } else {
            this.removeClass(
            $('#email')!.querySelector('label')!,
            'error-border-left'
            );
            this.addClass(
            $('#email')!.querySelector('label')!,
            'success-border-left'
            );

            this.emailError = '';
        }

        if (!this.password || this.password == '') {
            this.removeClass(
            $('#password')!.querySelector('label')!,
            'success-border-left'
            );
            this.addClass(
            $('#password')!.querySelector('label')!,
            'error-border-left'
            );

            this.passwordError = constants.PASSWORD_MANDATORY;
        } else {
            this.removeClass(
            $('#password')!.querySelector('label')!,
            'error-border-left'
            );
            this.addClass(
            $('#password')!.querySelector('label')!,
            'success-border-left'
            );

            this.passwordError = '';
        }

        if (!this.emailError && !this.passwordError) {
            this.authenticateUser();
        }
        },
        async authenticateUser() {

            let formData = new FormData();
            formData.append('email', this.email);
            formData.append('password', this.password);

            this.showLoading();

            let response: any;
            try {
                // let token: string = await getAuthorizationToken();
                response = await axios.post(api.login_api, formData
                // , {
                //     headers: {
                //         Authorization: token,
                //     },
                // }
                );
            } catch (err) {
                this.showErrorToast(constants.ERROR_INTERNAL_OCCUR);
                console.error(err);
            } finally {
                this.hideLoading();
            }

            if (response && response.data.error === true && response.data.message_key === 'invalid_credentials') {
                this.showErrorToast(constants.invalid_credentials);
                return;
            } else if(response && response.data.error === false) {
                this.setDataToLocalStorage('country', response.data.user_data.country);
                this.setDataToLocalStorage('is_supper_admin', response.data.user_data.isSuper);
                this.setDataToLocalStorage('token', response.data.token);
                this.$router.push('/dashboard');
            }
            
        },

    },
    setup () {

    return {
    }
  }


});
</script>
