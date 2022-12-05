import { RouteRecordRaw } from 'vue-router';

const routes: RouteRecordRaw[] = [
  {
    path: '/dashboard',
    component: () => import('src/layouts/MainLayout.vue'),
    children: [
      { path: '', component: () => import('pages/Index.vue')  ,
        meta: {
          requiresAuth: true,
          
        }
      },
      { path: '/home/edit', component: () => import('pages/dashboard/Home.vue'),
      meta: {
        requiresAuth: true,
        isSuperAdmin: true,
      }
    },
    { path: '/about/edit', component: () => import('pages/dashboard/About.vue'),
      meta: {
        requiresAuth: true,
        isSuperAdmin: true,
      }
    },
    { path: '/examples/edit', component: () => import('pages/dashboard/Examples.vue'),
      meta: {
        requiresAuth: true,
        isSuperAdmin: true,
      }
    },
    { path: '/contact/edit', component: () => import('pages/dashboard/contact.vue'),
      meta: {
        requiresAuth: true,
        isSuperAdmin: true,
      }
    },
    { path: '/cases', component: () => import('pages/dashboard/Casestudy.vue'),
      meta: {
        requiresAuth: true,
        isSuperAdmin: true,
      }
    },
    { path: '/logos', component: () => import('pages/dashboard/clientLogos.vue'),
      meta: {
        requiresAuth: true,
        isSuperAdmin: true,
      }
    },
    { path: '/slides', component: () => import('pages/dashboard/homeSlider.vue'),
      meta: {
        requiresAuth: true,
        isSuperAdmin: true,
      }
    },
    { path: '/teams', component: () => import('pages/dashboard/Teams.vue'),
      meta: {
        requiresAuth: true,
        isSuperAdmin: true,
      }
    },
    { path: '/thanks', component: () => import('pages/dashboard/Thanks.vue'),
      meta: {
        requiresAuth: true,
        isSuperAdmin: true,
      }
    },
    { path: '/involved', component: () => import('pages/dashboard/GetInvolved.vue'),
      meta: {
        requiresAuth: true,
        isSuperAdmin: true,
      }
    },
    { path: '/zonesedit', component: () => import('pages/dashboard/fossilfreezones.vue'),
      meta: {
        requiresAuth: true,
        isSuperAdmin: true,
      }
    },
    { path: '/addfaqs', component: () => import('pages/dashboard/faqs.vue'),
      meta: {
        requiresAuth: true,
        isSuperAdmin: true,
      }
    },
    { path: '/pics/records', component: () => import('pages/dashboard/pictureRecord.vue'),
      meta: {
        requiresAuth: true,
        isSuperAdmin: true,
      }
    },
    { path: '/team/records', component: () => import('pages/dashboard/TeamsRecord.vue'),
      meta: {
        requiresAuth: true,
        isSuperAdmin: true,
      }
    },
    { path: '/thanks/records', component: () => import('pages/dashboard/ThanksRecord.vue'),
      meta: {
        requiresAuth: true,
        isSuperAdmin: true,
      }
    },

    { path: '/faqs/records', component: () => import('pages/dashboard/faqsRecord.vue'),
      meta: {
        requiresAuth: true,
        isSuperAdmin: true,
      }
    },

    { path: '/cases/records', component: () => import('pages/dashboard/CasesRecord.vue'),
      meta: {
        requiresAuth: true,
        isSuperAdmin: true,
      }
    },

    { path: '/cform', component: () => import('pages/dashboard/contactUsForm.vue'),
      meta: {
        requiresAuth: true,
        isSuperAdmin: true,
      }
    },

    { path: '/zform', component: () => import('pages/dashboard/zonesForm.vue'),
      meta: {
        requiresAuth: true,
      }
    },

    { path: '/personal', component: () => import('pages/dashboard/personal.vue'),
      meta: {
        requiresAuth: true,
      }
    },
    { path: '/password', component: () => import('pages/dashboard/password.vue'),
      meta: {
        requiresAuth: true,
      }
    },

    { path: '/rules', component: () => import('pages/dashboard/addRules.vue'),
      meta: {
        requiresAuth: true,
        isSuperAdmin: true,
      }
    },

    { path: '/ctemplate', component: () => import('pages/dashboard/ctemplate.vue'),
      meta: {
        requiresAuth: true,
        isSuperAdmin: true,
      }
    },

    { path: '/ztemplate', component: () => import('pages/dashboard/ztemplate.vue'),
      meta: {
        requiresAuth: true,
        isSuperAdmin: true,
      }
    },

    { path: '/rules/records', component: () => import('pages/dashboard/rulesRecord.vue'),
      meta: {
        requiresAuth: true,
        isSuperAdmin: true,
      }
    },
    { path: '/footer', component: () => import('pages/dashboard/footer.vue'),
      meta: {
        requiresAuth: true,
        isSuperAdmin: true,
      }
    },

    { path: '/admin/reg', component: () => import('pages/dashboard/addAdmin.vue'),
      meta: {
        requiresAuth: true,
        isSuperAdmin: true,
      }
    },
    { path: '/admin/records', component: () => import('pages/dashboard/usersRecord.vue'),
      meta: {
        requiresAuth: true,
        isSuperAdmin: true,
      }
    },
   
    ],

  },
  {
    path: '/',
    component: () => import('src/layouts/blankLayout.vue'),
    children: [
      { path: '', component: () => import('pages/Login.vue')},
    ],

  },

 

  // Always leave this as last one,
  // but you can also remove it
  {
    path: '/:catchAll(.*)*',
    component: () => import('pages/Error404.vue'),
  },
];

export default routes;
