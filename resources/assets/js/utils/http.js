import axios from 'axios';
import store from '../store';
import { getToken } from './cookie';
import { Message, MessageBox } from 'element-ui';


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
    let data = response.data;
    let success = [200, 201, 204];

    if (success.indexOf(data.code) !== -1) {
        if (response.headers['authorization']) {
            // 刷新令牌
            store.dispatch('refreshToken', response.headers['authorization']);
        }

        return response;
    }

    if (data.code === 401) {
        if (data.message === '密码错误') {
            // 登录失败（密码错误）
            Message.error('密码错误');
        } else if (data.message === 'The token has been blacklisted') {
            // refresh_token 已过期
            MessageBox.confirm('授权已过期，请重新登录，或者取消继续留在该页面', '确定登出', {
                confirmButtonText: '重新登录',
                cancelButtonText: '取消',
                type: 'warning',
            }).then(() => {
                store.dispatch('cleanUser').then(() => {
                    location.reload(); // 为了重新实例化vue-router对象 避免bug
                })
            });
        } else {
            Message.error(data.message);
        }
    } else {
        Message.error(data.message);
    }

    return Promise.reject('error');

}, error => {
    Message({
        message: error.message,
        type: 'error',
        duration: 5 * 1000
    });
    return Promise.reject(error);
});

export default http;