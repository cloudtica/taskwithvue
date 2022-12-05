<template>
    <div class="">
      <q-layout view="lHh lpr lFf" >
        <q-header elevated>
          
          <PublicNavbar></PublicNavbar>
        </q-header>

        
       
        
        <q-page-container class="margin-0 padding-0">
          <router-view />
        </q-page-container>
  
        <q-footer>
          <PublicFooter></PublicFooter>
        </q-footer>
  
      </q-layout>
    </div>
  </template>

<script lang="ts">
import { defineComponent} from 'vue';
import PublicTopbar from 'src/components/PublicTopbar.vue'
import PublicNavbar from 'src/components/PublicNavbar.vue'
import PublicFooter from 'src/components/PublicFooter.vue'

export default defineComponent({
  name: 'PublicLayout',

  components: {
   
    PublicNavbar,
    PublicFooter
  },
});
</script>

<style>
    .fullscreen, .fixed-center, .fixed-bottom, .fixed-left, .fixed-right, .fixed-top, .fixed-top-left, .fixed-top-right, .fixed-bottom-left, .fixed-bottom-right {
        position: relative !important;
    }
</style>
