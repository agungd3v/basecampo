import { getCookies } from '../helpers/authentication'

export default function (context) {
  let getCookie
  const vuex = context.$cookiz.get('vuex')
  if (vuex) {
    if (vuex.token.identity.exp <= Date.now() / 1000) {
      context.$cookiz.remove('vuex')
      window.location.href = '/'
    }
  }
  if (process.server) {
    let cookie = decodeURI(getCookies('vuex', context.req.headers.cookie))
    if (cookie) {
      getCookie = JSON.parse(cookie.split('%2C').join(','))
      if (!getCookie) {
        return context.redirect('/')
      }
      context.store.commit('setToken', getCookie.token)
    }
  }
}