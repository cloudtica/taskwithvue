<template>
    <q-layout view="lHh Lpr lFf">
      <q-page-container>
        <router-view />
      </q-page-container>
    </q-layout>
  </template>
  
  <script lang="ts">
  import { defineComponent} from 'vue';
  import { ref } from 'vue'
  
  export default defineComponent({
    name: 'Blank',
  });
  </script>
  