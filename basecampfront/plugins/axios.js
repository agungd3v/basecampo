export default function ({ app, $axios, redirect, store }) {
  $axios.onRequest(async (config) => {
    const token = store.state.token
    if (token !== null || token !== 'null') {
      config.headers.common['Authorization'] = token ? `Bearer ${token}` : null
    }
    config.headers.post['Content-Type'] = 'application/json'
    return config
  })

  $axios.onError(error => {
    if(typeof error.response != 'undefined'){
      if(typeof error.response.status != 'undefined'){
        if(error.response.status === 500) {
          return error.response.status
        }
      }
    }
  })
}