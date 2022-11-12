import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

import HomePage from './pages/HomePage';
import SingleDev from './pages/SingleDev';


const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: HomePage
        },
        {
            path: '/profile-details/:slug',
            name: 'profile-details',
            component: SingleDev
        },
    ] 
});

export default router;
