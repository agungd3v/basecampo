<template>
  <div>
    <form @submit.prevent="login">
      <input type="email" autocomplete="off" v-model="email">
      <input type="password" autocomplete="off" v-model="password">
      <button type="submit">Go</button>
    </form>
  </div>
</template>
<script>
export default {
  data() {
    return {
      email: null,
      password: null
    }
  },
  methods: {
    async login() {
      const fetch = await this.$axios.post('/v1/login', {
        email: this.email,
        password: this.password
      })
      console.log(fetch)
    }
  }
}
</script>