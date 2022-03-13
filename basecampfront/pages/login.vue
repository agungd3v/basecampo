<template>
  <div class="w-100">
    <div class="vh-100 d-flex justify-content-center align-items-center">
      <form @submit.prevent="login">
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control input-custom" v-model="email" id="email" autocomplete="off">
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control input-custom" v-model="password">
        </div>
        <button type="submit" class="btn btn-sm btn-primary">Sign In</button>
      </form>
    </div>
  </div>
</template>
<script>
export default {
  middleware: ['hasauth'],
  data() {
    return {
      email: null,
      password: null
    }
  },
  methods: {
    async login() {
      try {
        const fetch = await this.$axios.$post('/v1/login', {
          email: this.email,
          password: this.password
        })
        if (fetch.status) {
          this.$store.dispatch('setUser', fetch.data.user)
          this.$store.dispatch('setToken', fetch.data.token)
          return window.location.href = '/projects'
        }
      } catch (error) {
        throw error
      }
    }
  }
}
</script>
<style>
  .input-custom {
    width: 320px;
  }
</style>