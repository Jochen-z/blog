import Cookies from 'js-cookie';


const TokenKey = 'ADMIN_ACCESS_TOKEN';

export function getToken() {
    return Cookies.get(TokenKey);
}

export function setToken(token) {
    let in2Hours = 1/12; // 过期时间以天为单位
    return Cookies.set(TokenKey, token, { expires: in2Hours });
}

export function removeToken() {
    return Cookies.remove(TokenKey);
}