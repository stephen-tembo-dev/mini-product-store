import { createApp } from 'vue'
import { createPinia } from 'pinia'

import App from './App.vue'
import router from './router'

import './axios';

import 'materialize-css/dist/css/materialize.min.css'
import './assets/main.css'

import M from 'materialize-css'

// Initialize Materialize components
document.addEventListener('DOMContentLoaded', function() {
  M.AutoInit()
})

//import './assets/main.css'


const app = createApp(App)

app.use(createPinia())
app.use(router)
app.mount('#app')

