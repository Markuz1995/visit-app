<template>
    <div class="flex justify-center items-center h-screen bg-gray-100">
      <div class="bg-white p-8 rounded shadow-md w-full max-w-md">
        <h1 class="text-2xl font-bold mb-4">Login</h1>
        <form @submit.prevent="login" class="space-y-4">
          <div>
            <label class="block text-gray-700">Email</label>
            <input
              v-model="email"
              type="email"
              placeholder="Email"
              class="w-full px-4 py-2 border rounded"
              :class="{ 'border-red-500': errors.email }"
            />
            <span v-if="errors.email" class="text-red-500 text-sm">{{ errors.email }}</span>
          </div>
          <div>
            <label class="block text-gray-700">Password</label>
            <input
              v-model="password"
              type="password"
              placeholder="Password"
              class="w-full px-4 py-2 border rounded"
              :class="{ 'border-red-500': errors.password }"
            />
            <span v-if="errors.password" class="text-red-500 text-sm">{{ errors.password }}</span>
          </div>
          <button
            type="submit"
            class="bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded transition duration-300 w-full"
          >
            Login
          </button>
          <p v-if="loginError" class="text-red-500 text-sm">{{ loginError }}</p>
        </form>
        <div class="mt-4 text-center">
          <router-link to="/register" class="text-sm text-gray-600 hover:text-gray-900">Need an account? Register here</router-link>
        </div>
      </div>
    </div>
  </template>

  <script>
  export default {
    data() {
      return {
        email: '',
        password: '',
        errors: {},
        loginError: ''
      };
    },
    methods: {
      async login() {
        this.errors = {};
        this.loginError = '';
        if (!this.email) {
          this.errors.email = 'Email is required';
        } else if (!this.validEmail(this.email)) {
          this.errors.email = 'Email is not valid';
        }
        if (!this.password) {
          this.errors.password = 'Password is required';
        }
        if (Object.keys(this.errors).length === 0) {
          try {
            const response = await this.$axios.post('/api/login', {
              email: this.email,
              password: this.password
            });
            localStorage.setItem('authToken', response.data.token);
            this.$router.push('/');
          } catch (error) {
            this.loginError = 'Login failed. Please check your credentials.';
          }
        }
      },
      validEmail(email) {
        const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@(([^<>()[\]\.,;:\s@"]+\.)+[^<>()[\]\.,;:\s@"]{2,})$/i;
        return re.test(email);
      }
    }
  };
  </script>

  <style>
  /* Add any custom styles here */
  </style>
