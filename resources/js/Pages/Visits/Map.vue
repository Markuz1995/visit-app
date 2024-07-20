<template>
    <div v-if="show" class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900 bg-opacity-50">
      <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-7xl">
        <button @click="closeModal" class="text-red-500 float-right">X</button>
        <div class="p-6">
          <h2 class="text-lg font-medium text-gray-900 mb-4">Map</h2>
          <div ref="map" style="height: 400px;"></div>
        </div>
      </div>
    </div>
  </template>

  <script setup>
  import { ref, onMounted, watch, defineProps, defineEmits, nextTick, onBeforeUnmount } from 'vue';
  import L from 'leaflet';

  const props = defineProps({
    visits: Array,
    show: Boolean,
  });

  const emit = defineEmits(['close']);
  const map = ref(null);
  const mapInstance = ref(null);
  const markers = ref([]);

  const closeModal = () => {
    emit('close');
    if (mapInstance.value) {
      mapInstance.value.remove();
      mapInstance.value = null;
    }
  };

  onMounted(() => {
    watch(() => props.visits, (newVisits) => {
      if (mapInstance.value) {
        updateMarkers(newVisits);
      }
    }, { immediate: true });

    watch(() => props.show, async (newVal) => {
      if (newVal && !mapInstance.value) {
        await nextTick();
        mapInstance.value = L.map(map.value).setView([51.505, -0.09], 13);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
          attribution: '&copy; OpenStreetMap contributors'
        }).addTo(mapInstance.value);

        updateMarkers(props.visits);
      }
    });
  });

  const updateMarkers = (visits) => {
    markers.value.forEach(marker => {
      marker.removeFrom(mapInstance.value);
    });

    markers.value = visits.map(visit => {
      return L.marker([visit.latitude, visit.longitude])
        .addTo(mapInstance.value)
        .bindPopup(`<b>${visit.name}</b><br>${visit.email}`)
        .openPopup();
    });
  };

  onBeforeUnmount(() => {
    if (mapInstance.value) {
      mapInstance.value.remove();
    }
  });
  </script>

  <style scoped>
  #map { height: 100%; }
  </style>
