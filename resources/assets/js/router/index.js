import Vue from 'vue';
import Router from 'vue-router';
import Layout from '../pages/layout/index';

Vue.use(Router);

export default new Router({
    routes: [
        { path: '/login', component: require('../pages/login/index') },

        {
            path: '',
            component: Layout,
            redirect: '/dashboard',
            children: [
                {
                    path: 'dashboard',
                    name: 'Dashboard',
                    meta: { title: '仪表盘', icon: 'dashboard' },
                    component: require('../pages/dashboard/index'),
                }
            ]
        },
        {
            path: '/article',
            component: Layout,
            children: [
                {
                    path: 'index',
                    name: 'article',
                    meta: { title: '文章', icon: 'article' },
                    component: require('../pages/article/index'),
                }
            ]
        },
        {
            path: '/category',
            component: Layout,
            children: [
                {
                    path: 'index',
                    name: 'Category',
                    meta: { title: '分类', icon: 'category' },
                    component: require('../pages/category/index'),
                }
            ]
        },
        {
            path: '/tag',
            component: Layout,
            children: [
                {
                    path: 'index',
                    name: 'Tag',
                    meta: { title: '标签', icon: 'tag' },
                    component: require('../pages/tag/index'),
                }
            ]
        },
    ]
});
