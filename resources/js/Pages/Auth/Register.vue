<template>
    <div class="flex justify-center items-center h-screen bg-gray-100">
      <div class="bg-white p-8 rounded shadow-md w-full max-w-md">
        <h1 class="text-2xl font-bold mb-4">Register</h1>
        <form @submit.prevent="register" class="space-y-4">
          <div>
            <label for="name" class="block text-gray-700">Name</label>
            <input
              v-model="name"
              id="name"
              type="text"
              placeholder="Enter your name"
              class="w-full px-4 py-2 border rounded"
            />
          </div>
          <div>
            <label for="email" class="block text-gray-700">Email</label>
            <input
              v-model="email"
              id="email"
              type="email"
              placeholder="Enter your email"
              class="w-full px-4 py-2 border rounded"
              :class="{ 'border-red-500': errors.email }"
            />
            <span v-if="errors.email" class="text-red-500 text-sm">{{ errors.email }}</span>
          </div>
          <div>
            <label for="password" class="block text-gray-700">Password</label>
            <input
              v-model="password"
              id="password"
              type="password"
              placeholder="Enter your password"
              class="w-full px-4 py-2 border rounded"
              :class="{ 'border-red-500': errors.password }"
            />
            <span v-if="errors.password" class="text-red-500 text-sm">{{ errors.password }}</span>
          </div>
          <button
            type="submit"
            class="bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded transition duration-300 w-full"
          >
            Register
          </button>
          <p v-if="registerError" class="text-red-500 text-sm">{{ registerError }}</p>
        </form>
      </div>
    </div>
  </template>

  <script>
  export default {
    data() {
      return {
        name: '',
        email: '',
        password: '',
        errors: {},
        registerError: ''
      };
    },
    methods: {
      async register() {
        this.errors = {};
        this.registerError = '';

        if (!this.name) {
          this.errors.name = 'Name is required';
        }
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
            const response = await this.$axios.post('/api/register', {
              name: this.name,
              email: this.email,
              password: this.password
            });
            localStorage.setItem('authToken', response.data.token);
            this.$router.push('/');
          } catch (error) {
            console.error('Registration failed', error);
            this.registerError = 'Registration failed. Please try again.';
          }
        }
      },
      validEmail(email) {
        const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@(([^<>()[\]\.,;:\s@"]+\.)+[^<>()[\]\.,;:\s@"]{2,})$/i;
        return re.test(String(email).toLowerCase());
      }
    }
  };
  </script>

  <style>
  </style>
