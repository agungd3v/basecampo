import { getCookies } from '../helpers/authentication'

export default function (context) {
  let getCookie
  if (process.server) {
    let cookie = getCookies('vuex', context.req.headers.cookie)
    if (cookie) {
      getCookie = JSON.parse(cookie.split('%2C').join(','))
      if (!getCookie) {
        return context.redirect('/login')
      }
      context.store.commit('setUser', getCookie.user)
      context.store.commit('setToken', getCookie.token)
    }
  }
}