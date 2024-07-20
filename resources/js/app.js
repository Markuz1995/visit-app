import { createApp } from 'vue';
import App from './App.vue';
import router from './router';
import axios from './axios';
import '@fortawesome/fontawesome-free/css/all.css';
import '@fortawesome/fontawesome-free/js/all.js';
import 'leaflet/dist/leaflet.css';

const app = createApp(App);

app.use(router);

app.config.globalProperties.$axios = axios;

app.mount('#app');
