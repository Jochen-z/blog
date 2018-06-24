import Vue from 'vue';
import Router from 'vue-router';
import Layout from '../pages/layout/index';

Vue.use(Router);

export default new Router({
    routes: [
        { path: '/login', component: require('../pages/login/index'), hidden: true },

        {
            path: '/',
            component: Layout,
            redirect: '/dashboard',
            name: 'Dashboard',
            meta: { title: 'Dashboard' },
            hidden: true,
            children: [
                {
                    path: 'dashboard',
                    component: require('../pages/dashboard/index')
                }
            ]
        },

    ]
});
