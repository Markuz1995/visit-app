<template>
    <div v-if="show" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50">
      <div class="bg-white p-8 rounded-lg shadow-lg w-1/3">
        <div class="flex justify-between items-center mb-4">
          <h2 class="text-xl font-bold">Visit Details</h2>
        </div>
        <div>
          <p><strong>Name:</strong> {{ visit.name }}</p>
          <p><strong>Email:</strong> {{ visit.email }}</p>
          <p><strong>Latitude:</strong> {{ visit.latitude }}</p>
          <p><strong>Longitude:</strong> {{ visit.longitude }}</p>
        </div>
        <div class="flex justify-end mt-4">
          <button @click="closeModal" class="bg-blue-500 text-white px-4 py-2 rounded">Close</button>
        </div>
      </div>
    </div>
  </template>

  <script>
  export default {
    props: {
      show: {
        type: Boolean,
        required: true,
      },
      visit: {
        type: Object,
        required: true,
      },
    },
    methods: {
      closeModal() {
        this.$emit('close');
      },
    },
  };
  </script>

  <style scoped>
  </style>
