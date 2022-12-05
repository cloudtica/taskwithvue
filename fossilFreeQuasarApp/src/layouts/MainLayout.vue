<template>
  <q-layout view="lHh Lpr lFf">
    <q-header elevated>
      <q-toolbar>
        <q-btn
          flat
          dense
          round
          icon="menu"
          aria-label="Menu"
          @click="toggleLeftDrawer"
        />

        <q-toolbar-title>Administrator Dashboard</q-toolbar-title>

       
      </q-toolbar>
    </q-header>

    <q-drawer class="adminsidebarbg" v-model="leftDrawerOpen" show-if-above bordered>

      <div class="full-width text-center">
            <img  src="logoadmin.png"  />
        </div>

      <template v-if="isSuperAdmin">
        
        
      <q-btn color="primary" class="full-width border0 adminbtnpadding" label="Textual Content" style="margin-top:10px;">
        <q-menu class="border0">
         <q-list class="border0" style="min-width: 300px;">
        <q-item clickable to="/home/edit">
          <q-item-section class="greytext navbarlinks">Home Page</q-item-section>
        </q-item>
        <hr/>
        <q-item clickable to="/about/edit">
          <q-item-section class="greytext navbarlinks">About Page</q-item-section>
        </q-item>
        <hr/>
        <q-item clickable to="/examples/edit">
          <q-item-section class="greytext navbarlinks">News Page</q-item-section>
        </q-item>
        <hr/>
        <q-item clickable to="/contact/edit">
          <q-item-section class="greytext navbarlinks">Contact Us Page</q-item-section>
        </q-item>
        <hr/>
        <q-item clickable to="/involved">
          <q-item-section class="greytext navbarlinks">Get Involved</q-item-section>
        </q-item>
        <hr/>
        <q-item clickable to="/zonesedit">
          <q-item-section class="greytext navbarlinks">Fossil Free Zones Page</q-item-section>
        </q-item>
        <hr/>
        <q-item clickable to="/footer">
          <q-item-section class="greytext navbarlinks">Footer Content</q-item-section>
        </q-item>
        
      </q-list>
      </q-menu>
    </q-btn>

    <q-btn color="white" text-color="black" class="borderblack full-width border0 adminbtnpadding" label="Pictorial Content" >
        <q-menu class="border0">
         <q-list class="border0" style="min-width: 300px;">
          <q-item clickable to="/logos">
          <q-item-section class="greytext navbarlinks">Client Logos</q-item-section>
        </q-item>
        <hr/>
        <q-item clickable to="/slides">
          <q-item-section class="greytext navbarlinks">Slider Images</q-item-section>
        </q-item>
        <hr/>
        <q-item clickable to="/pics/records">
          <q-item-section class="greytext navbarlinks">All Images Records</q-item-section>
        </q-item>
      </q-list>
      </q-menu>
    </q-btn>

    <q-btn color="white" text-color="black" class="borderblack full-width border0 adminbtnpadding" label="FAQ's Management">
        <q-menu class="border0">
         <q-list class="border0" style="min-width: 300px;">
        <q-item clickable to="/addfaqs">
          <q-item-section class="greytext navbarlinks">Add FAQ's</q-item-section>
        </q-item>
        <hr/>
        <q-item clickable to="/faqs/records">
          <q-item-section class="greytext navbarlinks">FAQ's Records</q-item-section>
        </q-item> 
      </q-list>
      </q-menu>
    </q-btn>

    <q-btn color="white" text-color="black" class="borderblack full-width border0 adminbtnpadding" label="Case Studies Management">
        <q-menu class="border0">
         <q-list class="border0" style="min-width: 300px;">
        <q-item clickable to="/cases">
          <q-item-section class="greytext navbarlinks">Add Case Study</q-item-section>
        </q-item>
        <hr/>
        <q-item clickable to="/cases/records">
          <q-item-section class="greytext navbarlinks">Case Studies Records</q-item-section>
        </q-item> 
      </q-list>
      </q-menu>
    </q-btn>

    <q-btn color="white" text-color="black" class="borderblack full-width border0 adminbtnpadding" label="Team Management Module">
        <q-menu class="border0">
         <q-list class="border0" style="min-width: 300px;">
        <q-item clickable to="/teams">
          <q-item-section class="greytext navbarlinks">Add Team Member</q-item-section>
        </q-item>
        <hr/>
        <q-item clickable to="/team/records">
          <q-item-section class="greytext navbarlinks">Teams Record</q-item-section>
        </q-item>
        <hr/>
        <q-item clickable to="/thanks">
          <q-item-section class="greytext navbarlinks">Special Thanks</q-item-section>
        </q-item>
        <hr/> 
        <q-item clickable to="/thanks/records">
          <q-item-section class="greytext navbarlinks">Special Thanks Records</q-item-section>
        </q-item>
      </q-list>
      </q-menu>
    </q-btn>

    

    <q-btn color="white" text-color="black" class="borderblack full-width border0 adminbtnpadding" label="Rules Management Module">
        <q-menu class="border0">
         <q-list class="border0" style="min-width: 300px;">
        <q-item clickable to="/rules">
          <q-item-section class="greytext navbarlinks">Add Rules</q-item-section>
        </q-item>
        <hr/>
        <q-item clickable to="/rules/records">
          <q-item-section class="greytext navbarlinks">Rules Records</q-item-section>
        </q-item> 
      </q-list>
      </q-menu>
    </q-btn>

    <q-btn color="white" text-color="black" class="borderblack full-width border0 adminbtnpadding" label="Users Management Module">
        <q-menu class="border0">
         <q-list class="border0" style="min-width: 300px;">
        <q-item clickable to="/admin/reg">
          <q-item-section class="greytext navbarlinks">Add Admin</q-item-section>
        </q-item>
        <hr/>
        <q-item clickable to="/admin/records">
          <q-item-section class="greytext navbarlinks">Users Records</q-item-section>
        </q-item> 
      </q-list>
      </q-menu>
    </q-btn>

    <q-btn color="white" text-color="black" class="borderblack full-width border0 adminbtnpadding" label="Response Email Message">
        <q-menu class="border0">
         <q-list class="border0" style="min-width: 300px;">
        <q-item clickable to="/ctemplate">
          <q-item-section class="greytext navbarlinks">Contact Form Email</q-item-section>
        </q-item>
        <hr/>
        <q-item clickable to="/ztemplate">
          <q-item-section class="greytext navbarlinks">Zones Form Email</q-item-section>
        </q-item> 
      </q-list>
      </q-menu>
    </q-btn>

    </template>

    <q-btn color="white" text-color="black" class="borderblack full-width border0 adminbtnpadding" label="Public Forms Record List">
        <q-menu class="border0">
         <q-list class="border0" style="min-width: 300px;">
        <q-item clickable to="/cform">
          <q-item-section class="greytext navbarlinks">Contact Us</q-item-section>
        </q-item>
        <hr/>
        <q-item clickable to="/zform">
          <q-item-section class="greytext navbarlinks">Fossil Free Zones</q-item-section>
        </q-item> 
      </q-list>
      </q-menu>
    </q-btn>

    <q-btn color="white" text-color="black" class="borderblack full-width border0 adminbtnpadding" label="Update Your Profile">
        <q-menu class="border0">
         <q-list class="border0" style="min-width: 300px;">
        <q-item clickable to="/personal">
          <q-item-section class="greytext navbarlinks">Change Personal Details</q-item-section>
        </q-item>
        <hr/>
        <q-item clickable to="/password">
          <q-item-section class="greytext navbarlinks">Change Your Password</q-item-section>
        </q-item> 
      </q-list>
      </q-menu>
    </q-btn>

    <q-btn color="orange" text-color="black" class="borderblack full-width border0 adminbtnpadding" label="Logout" @click="signOut()"></q-btn>

    </q-drawer>

    <q-page-container>
      <router-view />
    </q-page-container>
  </q-layout>



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

export default defineComponent({
  name: 'MainLayout',
  mixins: [ storageManagement ],

  link: {
      type: String,
      default: '#'
    },

  mounted: function() {
    const superAdmin = this.getDataFromLocalStorageByKey('is_supper_admin');
    if(superAdmin == 1 || superAdmin == '1') {
      this.isSuperAdmin = true;
    }
  },
  methods: {
    async signOut() {
      //api call
      //sucess

      
      let response: any;
            try {
                 let token: string = getAuthorizationToken();
                response = await axios.post(api.logout_user,{}
                 , {
                     headers: {
                         Authorization: token,
                     },
                 }
                );
            } catch (err) {
                console.error(err);
            } finally {
            }

            if (response && response.data.error === true && response.data.message_key === 'validation_failed') {
                return;
            } else if(response && response.data.error === false) {
              this.logout();
             
            }

    }
  },

  setup() {
   
    const leftDrawerOpen = ref(false);
      
    
    return {
      leftDrawerOpen,
      toggleLeftDrawer() {
        leftDrawerOpen.value = !leftDrawerOpen.value;
      },
      isSuperAdmin : ref(false),
    };
  },
});
</script>
