import store from './store';
import router from './router';
import 'nprogress/nprogress.css';
import NProgress from 'nprogress';
import { Message } from 'element-ui';
import { getToken } from './utils/cookie';


// 登录页面路径
const loginRoute = '/login';
// 不重定向白名单
const whitelist = [ loginRoute ];

// 全局前置守卫
router.beforeEach((to, from, next) => {
    NProgress.start();

    if (! getToken()) {
        // 尚未登录或者 token 已过期，需要重定向到登录页面
        // 若在白名单中，则不重定向
        return (whitelist.indexOf(to.path) !== -1) ? next() : next(loginRoute);
    }

    if (store.getters.name === '') {
        // 获取用户信息
        store.dispatch('getUserInfo').catch(() => {
            // token 已过期
            Message.error('Verification failed, please login again');
            store.dispatch('clearUser');
            return next({ path: loginRoute });
        });
        console.log('Verification failed, please login again');
    }

    if (to.path === loginRoute) {
        NProgress.done();
        return next({ path: '/' });
    }

    next();
});

// 全局后置守卫
router.afterEach(() => {
    NProgress.done();
});