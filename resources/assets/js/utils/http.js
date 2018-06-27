import axios from 'axios';
import store from '../store';
import { getToken } from './cookie';
import { Message } from 'element-ui';


const http = axios.create({
    baseURL: process.env.BASE_API,
    timeout: 5000,
    headers: { 'X-Requested-With' : 'XMLHttpRequest' },
});

// request 拦截器
http.interceptors.request.use(config => {

    if (getToken()) {
        // 从 Cookie 中获取令牌而不是 store.getters.token
        // 解决成功登录之后关闭浏览器再打开需要重新登录的问题
        config.headers['Authorization'] = getToken();
    }

    return config;
}, error => {
    return Promise.reject(error);
});

// response 截器
http.interceptors.response.use(response => {

    if (response.headers['authorization']) {
        // 刷新令牌
        store.dispatch('refreshToken', response.headers['authorization']);
    }

    return response;
}, error => {
    let code = error.response.status;
    let data = error.response.data;

    switch (code) {
        case 400:
            Message.error(data.error);
            break;
        case 401:
            if (data.error === 'Unauthorized') {
                // 登录失败（密码错误）
                Message.error('密码错误');
            } else if (data.error === 'Unauthenticated.') {
                // refresh_token 已过期
                Message.error('授权已过期，请重新登录');
                store.dispatch('cleanUser');
                location.reload();
            } else {
                Message.error(data.error);
            }
            break;
        case 403:
            Message.error(data.error);
            break;
        case 422:
            // 登录校验失败
            Message.error(data.errors.email[0]);
            break;
        default:
            Message.error('未知错误');
    }

    return Promise.reject(error);
});

export default http;