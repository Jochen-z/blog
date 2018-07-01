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
            redirect: 'dashboard',
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
            name: 'article',
            component: Layout,
            redirect: '/article/index',
            meta: { title: '文章', icon: 'article' },
            children: [
                {
                    path: 'index',
                    name: 'articleList',
                    meta: { title: '列表', icon: 'list' },
                    component: require('../pages/article/index'),
                },
                {
                    path: 'create',
                    name: 'createArticle',
                    meta: { title: '新建', icon: 'edit' },
                    component: require('../pages/article/create'),
                },
                {
                    path: 'edit/:id(\\d+)',
                    name: 'editArticle',
                    meta: { title: '修改' },
                    component: require('../pages/article/edit'),
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
