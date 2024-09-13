import { createApp } from 'vue';
import { createWebHistory , createRouter } from 'vue-router';
import { createPinia } from 'pinia';
import MessagerieComponent from './components/MessagerieComponent.vue';
import MessagesComponent from './components/MessagesComponent.vue';

const pinia = createPinia();


const routes = [
    {path: '/'},
    {path: '/inbox/:id', component: MessagesComponent, name: 'inbox.show'}
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

const messagerieComponent = createApp(MessagerieComponent);

messagerieComponent.use(pinia);
messagerieComponent.use(router);
messagerieComponent.mount('#conversations-container');
