import store from './store';
import router from './router';
import 'nprogress/nprogress.css';
import NProgress from 'nprogress';
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
        if (whitelist.indexOf(to.path) !== -1) {
            // 若在白名单中，则不重定向
            return next();
        }

        next(loginRoute);
        return NProgress.done();
    }

    if (! store.getters.name) {
        // 需要获取用户信息
        store.dispatch('getUserInfo');
    }

    if (to.path === loginRoute) {
        next({ path: '/' });
        return NProgress.done();
    }

    next();
});

// 全局后置守卫
router.afterEach(() => {
    NProgress.done();
});