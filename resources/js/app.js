import 'bootstrap/scss/bootstrap.scss'

import { createApp } from 'vue'
import App from '@site/App.vue'
import { createPinia } from 'pinia'
// import router from '@site/bootstrap/router'

const pinia = createPinia()
const app = createApp(App)

app
    // .use(router)
    .use(pinia)
    .mount('#app')
