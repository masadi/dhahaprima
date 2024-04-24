const emailRouteComponent = () => import('@/pages/apps/email/index.vue')

// 👉 Redirects
export const redirects = [
  // ℹ️ We are redirecting to different pages based on role.
  // NOTE: Role is just for UI purposes. ACL is based on abilities.
  {
    path: '/',
    name: 'index',
    component: () => import('@/pages/index.vue'),
    meta: { 
      public: true
    },
    /*redirect: to => {
      // TODO: Get type from backend
      const userData = useCookie('userData')
      if(userData){
        const userRole = userData.value?.role
        if (userRole === 'admin'){
          return { name: 'dashboards-crm' }
        } else if (userRole === 'client'){
          return { name: 'access-control' }
        } else {
          return { name: 'dashboard' }
        }
      }
      return { name: 'login', query: to.query }
    },*/
  },
  /*{
    path: '/profiles',
    name: 'profiles',
    component: () => import('@/pages/blank.vue'),
    meta: { 
      public: true
    },
  },
  {
    path: '/products',
    name: 'products',
    component: () => import('@/pages/blank.vue'),
    meta: { 
      public: true
    },
  },
  {
    path: '/contact-us',
    name: 'contact-us',
    component: () => import('@/pages/blank.vue'),
    meta: { 
      public: true
    },
  },*/
  {
    path: '/pages/user-profile',
    name: 'pages-user-profile',
    redirect: () => ({ name: 'pages-user-profile-tab', params: { tab: 'profile' } }),
  },
  {
    path: '/pages/account-settings',
    name: 'pages-account-settings',
    redirect: () => ({ name: 'pages-account-settings-tab', params: { tab: 'account' } }),
  },
]
export const routes = [
  // Email filter
  {
    path: '/apps/email/filter/:filter',
    name: 'apps-email-filter',
    component: emailRouteComponent,
    meta: {
      navActiveLink: 'apps-email',
      layoutWrapperClasses: 'layout-content-height-fixed',
    },
  },

  // Email label
  {
    path: '/apps/email/label/:label',
    name: 'apps-email-label',
    component: emailRouteComponent,
    meta: {
      // contentClass: 'email-application',
      navActiveLink: 'apps-email',
      layoutWrapperClasses: 'layout-content-height-fixed',
    },
  },
  {
    path: '/dashboards/logistics',
    name: 'dashboards-logistics',
    component: () => import('@/pages/apps/logistics/dashboard.vue'),
  },
  {
    path: '/dashboards/academy',
    name: 'dashboards-academy',
    component: () => import('@/pages/apps/academy/dashboard.vue'),
  },
  {
    path: '/apps/ecommerce/dashboard',
    name: 'apps-ecommerce-dashboard',
    component: () => import('@/pages/dashboards/ecommerce.vue'),
  },
]
