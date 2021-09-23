function page (path) {
  return () => import(/* webpackChunkName: '' */ `~/pages/${path}`).then(m => m.default || m)
}

export default [
  { path: '/', name: 'welcome', component: page('welcome.vue') },

  { path: '/login', name: 'login', component: page('auth/login.vue') },
  { path: '/register', name: 'register', component: page('auth/register.vue') },
  { path: '/password/reset', name: 'password.request', component: page('auth/password/email.vue') },
  { path: '/password/reset/:token', name: 'password.reset', component: page('auth/password/reset.vue') },
  { path: '/email/verify/:id', name: 'verification.verify', component: page('auth/verification/verify.vue') },
  { path: '/email/resend', name: 'verification.resend', component: page('auth/verification/resend.vue') },

  { path: '/home', name: 'home', component: page('home.vue') },
  { path: '/dashboard', name: 'dashboard', component: page('tenongan/dashboard.vue') },
  { path: '/produk', name: 'produk', component: page('tenongan/produk.vue') },
  { path: '/produsen', name: 'produsen', component: page('tenongan/produsen.vue') },
  { path: '/pedagang', name: 'pedagang', component: page('tenongan/pedagang.vue') },
  { path: '/penjualan', name: 'penjualan', component: page('tenongan/penjualan.vue') },
  { path: '/kas', name: 'kas', component: page('tenongan/kas.vue') },
  { path: '/saldo', name: 'saldo', component: page('tenongan/saldo.vue') },
  { path: '/user', name: 'user', component: page('tenongan/user.vue') },
  { path: '/transaksi', name: 'transaksi', component: page('tenongan/transaksi.vue') },
  { path: '/kas/harian', name: 'kas.harian', component: page('tenongan/kas-harian.vue') },

  { path: '/test', name: 'test', component: page('test.vue') },
  {
    path: '/settings',
    component: page('settings/index.vue'),
    children: [
      { path: '', redirect: { name: 'settings.profile' } },
      { path: 'profile', name: 'settings.profile', component: page('settings/profile.vue') },
      { path: 'password', name: 'settings.password', component: page('settings/password.vue') }
    ]
  },

  { path: '*', component: page('errors/404.vue') }
]
