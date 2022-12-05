<template>
        <div class="row topbar-bg margin-0 topbar-padding topbar-height">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="col-xs-2 col-sm-2 col-md-1 col-lg-1 topbar-icons-padding right">
                    <a href="" class="text-decoration-none">
                    <q-icon name="fab fa-instagram-square topbar-icons-color"  
                        v-for="size in ['sm']"
                        :key="size"
                        :size="size"
                    />
                    </a>
                </div>
                <div class="col-xs-2 col-sm-2 col-md-1 col-lg-1 topbar-icons-padding right">
                    <a href="" class="text-decoration-none">
                    <q-icon name="fab fa-twitter-square topbar-icons-color"  
                        v-for="size in ['sm']"
                        :key="size"
                        :size="size"
                    />
                    </a>
                </div>
                <div class="col-xs-2 col-sm-2 col-md-1 col-lg-1 topbar-icons-padding right">
                    <a href="" class="text-decoration-none">
                    <q-icon name="fab fa-facebook-square topbar-icons-color"  
                        v-for="size in ['sm']"
                        :key="size"
                        :size="size"
                    />
                    </a>
                </div>
                <div class="col-xs-2 col-sm-2 col-md-1 col-lg-1 topbar-icons-padding right">
                    <a href="" class="text-decoration-none">
                    <q-icon name="fab fa-linkedin topbar-icons-color"  
                        v-for="size in ['sm']"
                        :key="size"
                        :size="size"
                    />
                    </a>
                </div>

                <div class="col-xs-8 col-sm-8 col-md-3 col-lg-3 topbar-icons-padding right lang-dropdown-margin">
                    <q-select borderless v-model="currentLanguage" :options="options">
                        <template v-slot:prepend>
                            <q-avatar>
                                <img :src="currentLanguage.iconLink">
                            </q-avatar>
                        </template>
                         <template v-slot:option="scope">
                          <q-item v-bind="scope.itemProps">
                            <q-item-section avatar>
                              <img :src="scope.opt.iconLink" />
                            </q-item-section>
                            <q-item-section>
                              <q-item-label>{{ scope.opt.label }}</q-item-label>
                            </q-item-section>
                          </q-item>
                        </template> 
                    </q-select>
                </div>
            </div>
          </div>
  </template>
  
  <script lang="ts">
  import { defineComponent} from 'vue';
  import { ref } from 'vue';

  export default defineComponent({
    name: 'FossilFreeZonesTopbar',

    setup () {
      const defaultLang = {
          label: 'English',
          value: 'english',
          iconLink: 'icons/lang.png'
        };
    return {
      currentLanguage: ref(defaultLang),
      options: [
        {
          label: 'English',
          value: 'english',
          iconLink: 'icons/lang.png'
        },
        {
          label: 'Spanish',
          value: 'spanish',
          iconLink: 'icons/lang.png'
        },
        {
          label: 'German',
          value: 'german',
          iconLink: 'icons/lang.png'
        },
        {
          label: 'French',
          value: 'french',
          iconLink: 'icons/lang.png'
        },
        {
          label: 'Arabic',
          value: 'arabic',
          iconLink: 'icons/lang.png'
        },
      ]
    }
  }
   
  });
  </script>
  