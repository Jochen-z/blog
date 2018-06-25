import http from '../utils/http';

export function login(username, password) {
    return http({
        url: 'api/auth/login',
        method: 'post',
        data: {
            email: username,
            password: password
        }
    })
}

export function userInfo() {
    return http({
        url: 'api/auth/user',
        method: 'get',
    })
}

export function logout() {
    return http({
        url: 'api/auth/logout',
        method: 'get',
    })
}