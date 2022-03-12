require('dotenv').config()
module.exports = {
  head: {
    title: 'Basecamp',
    htmlAttrs: {
      lang: 'en'
    },
    meta: [
      { charset: 'utf-8' },
      { name: 'viewport', content: 'width=device-width, initial-scale=1' },
      { hid: 'description', name: 'description', content: '' },
      { name: 'format-detection', content: 'telephone=no' }
    ],
    link: [
      { rel: 'icon', type: 'image/x-icon', href: '/favicon.ico' }
    ]
  },

  css: [
    '~/assets/base.css'
  ],

  plugins: [
    '~/plugins/vueSelect.js',
    '~/plugins/bootstrapIcon.js',
    { src: '~plugins/axios', ssr: true },
    { src: '~plugins/localStorage', ssr: false }
  ],

  components: true,

  buildModules: [
    '@nuxtjs/dotenv',
    '@nuxtjs/axios',
  ],

  modules: [
    'bootstrap-vue/nuxt',
    ['cookie-universal-nuxt', { alias: 'cookiz' }]
  ],

  router: {
    middleware: ['init']
  },

  axios: {
    apiURL: process.env.API_URL,
  },

  build: {}
}
