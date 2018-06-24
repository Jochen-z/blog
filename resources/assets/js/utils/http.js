import axios from 'axios';
import { getToken } from './cookie';
import { Message, MessageBox } from 'element-ui';


const http = axios.create({
    baseURL: process.env.BASE_API,
    timeout: 5000,
});

// request 拦截器
http.interceptors.request.use(config => {
    config.headers['X-Requested-With'] = 'XMLHttpRequest';

    if (getToken()) {
        config.headers['Authorization'] = getToken();
    }

    return config;
}, error => {
    return Promise.reject(error);
});

// response 截器
// http.interceptors.response.use(response => {
//     console.log(response.status);
//     return response.data;
// }, error => {
//     let code = error.response.status;
//     let message = '';
//
//     if (code === 422) {
//         let errors = error.response.data.errors;
//
//         if (errors.email) {
//             message = errors.email;
//         } else if (errors.password) {
//             message = errors.password;
//         } else {
//             message = '登录失败，请重试';
//         }
//     } else {
//         message = '未知错误';
//     }
//
//
//     Message({
//         type: 'error',
//         duration: 5 * 1000,
//         message: message,
//     });
//
//     return Promise.reject(error);
// });

export default http;