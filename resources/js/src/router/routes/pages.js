export default [
  {
    path: '/dashboard',
    name: 'beranda',
    component: () => import('@/views/dashboard/Index.vue'),
    meta: {
      resource: 'Web',
      action: 'read',
      pageTitle: 'Home',
      breadcrumb: [
        {
          text: 'Home',
          active: true,
        },
      ],
      tombol_add: {
        action: 'add-modal',
        link: '',
        variant: 'success',
        text: 'Add New'
      },
    },
  },
  {
    path: '/mitra',
    name: 'mitra',
    component: () => import('@/views/mitra/Index.vue'),
    meta: {
      resource: 'Web',
      action: 'read',
      pageTitle: 'Mitra',
      breadcrumb: [
        {
          text: 'Mitra',
          active: true,
        },
      ],
      /*tombol_add: {
        action: 'add-mitra',
        link: '',
        variant: 'success',
        text: 'Add New'
      },*/
    },
  },
  {
    path: '/profile',
    name: 'profile',
    component: () => import('@/views/pages/Profile.vue'),
    meta: {
      resource: 'Web',
      action: 'read',
      pageTitle: 'Profil Pengguna',
      breadcrumb: [
        {
          text: 'Profil Pengguna',
          active: true,
        },
      ],
    }
  },
  /*{
    path: '/auto-reply',
    name: 'auto-reply',
    component: () => import('@/views/error/Blank.vue'),
    meta: {
      resource: 'Web',
      action: 'read',
      pageTitle: 'Auto Reply',
      breadcrumb: [
        {
          text: 'Auto Reply',
          active: true,
        },
      ],
    }
  },
  {
    path: '/groups',
    name: 'groups',
    component: () => import('@/views/error/Blank.vue'),
    meta: {
      resource: 'Web',
      action: 'read',
      pageTitle: 'Groups',
      breadcrumb: [
        {
          text: 'Groups',
          active: true,
        },
      ],
    }
  },
  {
    path: '/settings',
    name: 'settings',
    component: () => import('@/views/error/Blank.vue'),
    meta: {
      resource: 'Web',
      action: 'read',
      pageTitle: 'Groups',
      breadcrumb: [
        {
          text: 'Groups',
          active: true,
        },
      ],
    }
  },
  {
    path: '/pricing',
    name: 'pricing',
    component: () => import('@/views/error/Blank.vue'),
    meta: {
      resource: 'Web',
      action: 'read',
      pageTitle: 'Pricing',
      breadcrumb: [
        {
          text: 'Pricing',
          active: true,
        },
      ],
    }
  },*/
  {
    path: '/login',
    name: 'auth-login',
    component: () => import('@/views/pages/Login.vue'),
    meta: {
      layout: 'full',
      resource: 'Auth',
      redirectIfLoggedIn: true,
      pageTitle: 'Login Pengguna',
    },
  },
  /*{
    path: '/register',
    name: 'auth-register',
    component: () => import('@/views/pages/Register.vue'),
    meta: {
      layout: 'full',
      resource: 'Auth',
      redirectIfLoggedIn: true,
      pageTitle: 'Registrasi Pengguna',
    },
  },*/
  {
    path: '/logout',
    name: 'logout',
    component: () => import('@/views/pages/Logout.vue'),
    meta: {
      resource: 'Web',
      action: 'read',
    }
  },
  {
    path: '/error-404',
    name: 'error-404',
    component: () => import('@/views/error/Error404.vue'),
    meta: {
      layout: 'full',
      resource: 'Auth',
      action: 'read',
      pageTitle: 'Laman tidak ditemukan',
    },
  },
  {
    path: '/not-authorized',
    name: 'misc-not-authorized',
    component: () => import('@/views/error/NotAuthorized.vue'),
    meta: {
      layout: 'full',
      resource: 'Auth',
      action: 'read',
      pageTitle: 'Akses Terbatas! 🔐',
    },
  },
]
