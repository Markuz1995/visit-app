<template>
    <div class="container mx-auto mt-8">
        <div class="flex justify-end">
            <button
            @click="logout"
            class=" bg-gray-500 hover:bg-red-700 text-white font-semibold py-2 px-5 rounded transition duration-300"
            >
            Logout
            </button>
        </div>
      <h1 class="text-2xl font-bold mb-4">Visits</h1>
      <div class="flex justify-between mb-4">
        <button
          @click="modalMap = true"
          class="bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-5 rounded transition duration-300"
        >
          Map Visit
        </button>
        <button
          @click="createVisit"
          class="bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-5 rounded transition duration-300"
        >
          Create Visit
        </button>


      </div>
      <div class="overflow-x-auto">
        <table v-if="visits && visits.data.length" class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
          <thead class="bg-gray-50">
            <tr>
              <th class="py-3 px-4 text-left text-gray-700 font-semibold">Name</th>
              <th class="py-3 px-4 text-left text-gray-700 font-semibold">Email</th>
              <th class="py-3 px-4 text-left text-gray-700 font-semibold">Latitude</th>
              <th class="py-3 px-4 text-left text-gray-700 font-semibold">Longitude</th>
              <th class="py-3 px-4 text-left text-gray-700 font-semibold">Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="visit in visits.data" :key="visit.id" class="border-b hover:bg-gray-100 transition duration-150">
              <td class="py-3 px-4">{{ visit.name }}</td>
              <td class="py-3 px-4">{{ visit.email }}</td>
              <td class="py-3 px-4">{{ visit.latitude }}</td>
              <td class="py-3 px-4">{{ visit.longitude }}</td>
              <td class="py-3 px-4 flex space-x-2">
                <button
                  @click="showVisit(visit.id)"
                  class="bg-green-500 hover:bg-green-700 text-white font-semibold py-1 px-2 rounded transition duration-300"
                >
                  <i class="fas fa-eye"></i>
                </button>
                <button
                  @click="editVisit(visit.id)"
                  class="bg-yellow-500 hover:bg-yellow-700 text-white font-semibold py-1 px-2 rounded transition duration-300"
                >
                  <i class="fas fa-edit"></i>
                </button>
                <button
                  @click="confirmDeleteVisit(visit.id)"
                  class="bg-red-500 hover:bg-red-700 text-white font-semibold py-1 px-2 rounded transition duration-300"
                >
                  <i class="fas fa-trash-alt"></i>
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="flex justify-end mt-4">
        <paginate v-if="visits" :pagination="visits" :fetchData="fetchVisits"></paginate>
      </div>
      <modal-show v-if="modalShow" :show="modalShow" :visit="selectedVisit" @close="modalShow = false"></modal-show>
      <modal-map :show="modalMap" :visits="visits.data" @close="modalMap = false"></modal-map>
    </div>
  </template>

  <script>
  import axios from 'axios';
  import Paginate from '../Components/Paginate.vue';
  import ModalShow from './Show.vue';
  import ModalMap from './Map.vue';

  export default {
    components: {
      Paginate,
      ModalShow,
      ModalMap,
    },
    data() {
      return {
        visits: {
          data: [],
          current_page: 1,
          last_page: 1,
          next_page_url: null,
          prev_page_url: null,
        },
        modalShow: false,
        modalMap: false,
        selectedVisit: null,
      };
    },
    methods: {
      async fetchVisits(url = '/api/visits') {
        const response = await axios.get(url);
        this.visits = response.data;
      },
      createVisit() {
        this.$router.push({ name: 'CreateForm' });
      },
      editVisit(id) {
        this.$router.push({ name: 'EditForm', params: { id } });
      },
      async confirmDeleteVisit(id) {
        if (window.confirm('Are you sure you want to delete this visit?')) {
          await this.deleteVisit(id);
        }
      },
      async deleteVisit(id) {
        await axios.delete(`/api/visits/${id}`);
        this.fetchVisits();
      },
      async showVisit(id) {
        const response = await axios.get(`/api/visits/${id}`);
        this.selectedVisit = response.data;
        this.modalShow = true;
      },
      async logout() {
        await axios.post('/api/logout');
        localStorage.removeItem('authToken');
        this.$router.push({ name: 'Login' });
      },
    },
    mounted() {
      this.fetchVisits();
    },
  };
  </script>
