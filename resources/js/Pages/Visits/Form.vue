<template>
    <div class="container mx-auto mt-8">
      <h1 class="text-2xl font-bold mb-4">
        {{ isEdit ? 'Edit Visit' : 'Create Visit' }}
      </h1>
      <form @submit.prevent="submitForm" class="space-y-4">
        <div>
          <label class="block text-gray-700">Name</label>
          <input
            v-model="visit.name"
            type="text"
            class="w-full px-4 py-2 border rounded"
            :class="{'border-red-500': errors.name}"
            required
          />
          <p v-if="errors.name" class="text-red-500 text-xs mt-1">{{ errors.name }}</p>
        </div>
        <div>
          <label class="block text-gray-700">Email</label>
          <input
            v-model="visit.email"
            type="email"
            class="w-full px-4 py-2 border rounded"
            :class="{'border-red-500': errors.email}"
            required
          />
          <p v-if="errors.email" class="text-red-500 text-xs mt-1">{{ errors.email }}</p>
        </div>
        <div>
          <label class="block text-gray-700">Latitude</label>
          <input
            v-model="visit.latitude"
            type="text"
            class="w-full px-4 py-2 border rounded"
            :class="{'border-red-500': errors.latitude}"
            required
          />
          <p v-if="errors.latitude" class="text-red-500 text-xs mt-1">{{ errors.latitude }}</p>
        </div>
        <div>
          <label class="block text-gray-700">Longitude</label>
          <input
            v-model="visit.longitude"
            type="text"
            class="w-full px-4 py-2 border rounded"
            :class="{'border-red-500': errors.longitude}"
            required
          />
          <p v-if="errors.longitude" class="text-red-500 text-xs mt-1">{{ errors.longitude }}</p>
        </div>
        <div class="flex space-x-4">
          <button
            type="button"
            @click="goBack"
            class="bg-gray-500 text-white px-4 py-2 rounded"
          >
            Back
          </button>
          <button
            type="submit"
            class="bg-blue-500 text-white px-4 py-2 rounded"
          >
            {{ isEdit ? 'Update' : 'Create' }}
          </button>
        </div>
      </form>
    </div>
  </template>

  <script>
  import axios from 'axios';

  export default {
    data() {
      return {
        visit: {
          name: '',
          email: '',
          latitude: '',
          longitude: '',
        },
        errors: {},
        isEdit: false,
      };
    },
    methods: {
      async fetchVisit(id) {
        const response = await axios.get(`/api/visits/${id}`);
        this.visit = response.data;
      },
      async submitForm() {
        try {
          if (this.isEdit) {
            await axios.put(`/api/visits/${this.$route.params.id}`, this.visit);
          } else {
            await axios.post('/api/visits', this.visit);
          }
          this.$router.push({ name: 'Index' });
        } catch (error) {
          if (error.response && error.response.status === 422) {
            this.errors = error.response.data.errors;
          }
        }
      },
      goBack() {
        this.$router.push({ name: 'Index' });
      },
    },
    mounted() {
      if (this.$route.params.id) {
        this.isEdit = true;
        this.fetchVisit(this.$route.params.id);
      }
    },
  };
  </script>
