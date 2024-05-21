import 'bootstrap/dist/css/bootstrap.min.css';
import { createApp } from 'vue';
import axios from 'axios';
import './bootstrap';

import UrlShortener from './components/UrlShortener.vue';

// Create a new Vue 3 app instance and mount it to the #app element in the DOM
const app = createApp({
    components: {
        UrlShortener,
    },
});

app.config.globalProperties.$http = axios;

app.mount('#app');
