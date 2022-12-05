<template>
  <div class="loading-component">
    <img class='loading-image' src='dual.gif' alt='Loading...' />
  </div>

</template>

<script lang='ts'>
import { defineComponent } from 'vue';

const $ = document.querySelector.bind(document);

export default defineComponent({

  el: '#app',
  name: 'Loader',
  props: ['show', 'hide', 'zIndex'],
  data() {
    return {
    };
  },
  watch: {
    show() {
      this.showLoader();
    },
    hide() {
      this.hideLoader();
    },
    zIndex() {
      ($('.loading-component') as HTMLElement).style.zIndex = this.zIndex;
    }
  },
  methods: {
    showLoader() {
      ($('.loading-component') as HTMLElement).style.display = 'block';
    },
    hideLoader() {
      ($('.loading-component') as HTMLElement).style.display = 'none';
    }
  }
});
</script>

<style>
.gridHeader .q-btn-item {
  padding: 0 !important;
}

.gridHeader .justify-center {
  justify-content: flex-start !important;
}

.loading-component {
  position: fixed;
  display: none;
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  /* text-align: center; */
  opacity: 0.7;
  background-color: #fff;
  z-index: 9999;
}

.loading-image {
  /*
  position: absolute;
  top: 100px;
  left: 240px;
  z-index: 100;
  display:block;
  margin: 0 auto;
  */

  position: absolute;
  top: 60%;
  left: 55%;
  width: 100px;
  height: 100px;
  margin: -100px 0px 0px -100px;
}
</style>
