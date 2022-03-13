import * as Cookies from 'js-cookie'
import cookie from 'cookie'


export default function ({ req, redirect }) {
  if (process.server) {
    let cok = req.headers.cookie
    if (typeof cok !== 'string') {
        cok = '';
      }
      const parsedCookies = cookie.parse(cok)
      const token = parsedCookies['vuex'] ? JSON.parse(parsedCookies['vuex']).token : undefined
    if (typeof token !== 'undefined') {
      if (token) return redirect('/')
    }
  } else {
    let token = Cookies.get('vuex')
    if (token) return redirect('/')
  }
}