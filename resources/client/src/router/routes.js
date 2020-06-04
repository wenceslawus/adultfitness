
const routes = [
  {
    path: '/',
    component: () => import('layouts/layout'),
    children: [
      { path: 'login', name: 'login', component: () => import('pages/auth/login'), meta:{freeAccess: true}},
      
      { path: 'register', name: 'register', component: () => import('pages/auth/promo'), meta:{freeAccess: true}},
      //{ path: 'register/update', name: 'register.update', component: () => import('pages/auth/promo'), meta:{freeAccess: true}},
      { path: 'register/sign/:param', name: 'register.sign', component: () => import('pages/auth/register'), meta:{freeAccess: true}},
      
      { path: 'become_trainer', name: 'btrainer', component: () => import('pages/auth/btrainer'), meta:{freeAccess: true}},
      { path: 'forgot', component: () => import('pages/auth/forgot'),meta:{freeAccess: true}},
      { path: 'restore/:token', component: () => import('pages/auth/restore'), meta:{freeAccess: true}},

      { path: '/', name: 'index', component: () => import('pages/index'), meta:{freeAccess: true}},
      { path: 'select', component: () => import('pages/select')},
      { path: 'play/:id', name: 'play', component: () => import('pages/play'), meta:{freeAccess: true}},
      
      { path: 'group/:id', name: 'group', component: () => import('pages/group'), meta:{freeAccess: true}},
      { path: 'blogs', name: 'blogs', component: () => import('pages/blog/list'), meta:{freeAccess: true}},
      { path: 'blog/:id', name: 'blog', component: () => import('pages/blog/item'), meta:{freeAccess: true}},
      
      { path: 'glutes', name: 'group', component: () => import('pages/group'), meta:{freeAccess: true}},
      { path: 'quadriceps', name: 'group', component: () => import('pages/group'), meta:{freeAccess: true}},
      { path: 'pectoralis', name: 'group', component: () => import('pages/group'), meta:{freeAccess: true}},
      { path: 'hamstrings', name: 'group', component: () => import('pages/group'), meta:{freeAccess: true}},
      
      { path: '2257', name: 'page.2257', component: () => import('pages/page'), meta:{freeAccess: true}, },
      { path: 'about-us', name: 'page.about', component: () => import('pages/page'), meta:{freeAccess: true}, },
      { path: 'privacy', name: 'page.privacy', component: () => import('pages/page'), meta:{freeAccess: true}, },
      { path: 'terms', name: 'page.terms', component: () => import('pages/page'), meta:{freeAccess: true}, },
      
      { path: 'search', component: () => import('pages/search')},
      { path: 'feedback', name: 'feedback', component: () => import('pages/send/feedback'), meta:{freeAccess: true}},
      { path: 'contact', name: 'contactus', component: () => import('pages/send/contact'), meta:{freeAccess: true}},

      { path: 'return', component: () => import('pages/return')},
    ]
  },
  {
    path: '/trainer',
    component: () => import('layouts/trainer'),
    children: [
      { path: ':id', name: 'trainer.home', component: () => import('pages/trainer/home')},
      { path: ':id/about', name: 'trainer.about', component: () => import('pages/trainer/about')},
      { path: ':id/videos', name: 'trainer.videos', component: () => import('pages/trainer/videos')},
    ],
  },
  {
    path: '/',
    component: () => import('layouts/profile'),
    children:[
      { path: 'me', name: 'profile.me', component: () => import('pages/user/profile')},
      { path: 'bookmark', name: 'profile.saved', component: () => import('pages/user/bookmark')},
      { path: 'list', name: 'profile.list', component: () => import('pages/user/list')},
      { path: 'settings', name: 'profile.settings', component: () => import('pages/user/settings')},
      { path: 'videos', name: 'profile.videos', component: () => import('pages/user/videos')},
      
      { path: 'vlist/:id', name: 'profile.video_lists', component: () => import('pages/user/video_lists')},
      { path: 'home', name: 'profile.home', component: () => import('pages/user/home')},
    ],
  },
  {
    path: '/notify',
    component: () => import('layouts/layout'),
    children: [
      { path: '/', name: 'notify.list', component: () => import('pages/notifies')},
    ]
  },
  {
    path: '/training',
    component: () => import('layouts/layout'),
    children: [
      { path: '/', name: 'training.list', component: () => import('pages/training/list')},
    ]
  },
  {
    path: '/admin',
    component: () => import('layouts/layout'),
    children: [
      { path: 'category/:id', name: 'admin.category',component: () => import('pages/admin/category')},
      { path: 'category', name: 'admin.categories', component: () => import('pages/admin/categories')},
      //{ path: 'video/:id', name: 'admin.video', component: () => import('pages/admin/video')},
      { path: 'blogs', name: 'admin.blogs', component: () => import('pages/admin/blogs')},
      { path: 'users', name: 'admin.users', component: () => import('pages/admin/users')},
    ]
  },
]

// Always leave this as last one
if (process.env.MODE !== 'ssr') {
  routes.push({
    path: '*',
    component: () => import('pages/Error404.vue'),
    meta:{freeAccess: true}
  })
}//*/

export default routes
