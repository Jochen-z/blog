import Vue from 'vue';
import Router from 'vue-router';
import Layout from '../pages/layout/index';

Vue.use(Router);

export default new Router({
    routes: [
        { path: '/login', component: () => import('../pages/login/index') },

        {
            path: '/redirect',
            component: Layout,
            hidden: true,
            children: [
                {
                    path: '/redirect/:path*',
                    component: () => import('../pages/redirect/index')
                }
            ]
        },

        {
            path: '',
            component: Layout,
            redirect: 'dashboard',
            children: [
                {
                    path: 'dashboard',
                    name: 'Dashboard', // 必须与组件名称一致，否则不能页面缓存
                    meta: { title: '仪表盘', icon: 'dashboard' },
                    component: () => import('../pages/dashboard/index'),
                }
            ]
        },
        {
            path: '/article',
            name: 'article',
            component: Layout,
            redirect: '/article/index',
            meta: { title: '文章管理', icon: 'article' },
            children: [
                {
                    path: 'index',
                    name: 'articleList',
                    meta: { title: '列表', icon: 'list' },
                    component: () => import('../pages/article/index'),
                },
                {
                    path: 'create',
                    name: 'createArticle',
                    meta: { title: '新建', icon: 'edit' },
                    component: () => import('../pages/article/create'),
                },
                {
                    path: 'edit/:id(\\d+)',
                    name: 'editArticle',
                    meta: { title: '修改' },
                    component: () => import('../pages/article/edit'),
                    hidden: true
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
                    meta: { title: '分类管理', icon: 'category' },
                    component: () => import('../pages/category/index'),
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
                    meta: { title: '标签管理', icon: 'tag' },
                    component: () => import('../pages/tag/index'),
                }
            ]
        },
        {
            path: '/about',
            component: Layout,
            children: [
                {
                    path: 'index',
                    name: 'About',
                    meta: { title: '关于页面', icon: 'about' },
                    component: () => import('../pages/about/index'),
                }
            ]
        },
        {
            path: '/visitor',
            component: Layout,
            children: [
                {
                    path: 'index',
                    name: 'Visitor',
                    meta: { title: '访客记录', icon: 'visitor' },
                    component: () => import('../pages/visitor/index')
                }
            ]
        },
    ]
});
