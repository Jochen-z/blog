import { login, userInfo, logout } from '../../api/auth';
import { setToken, removeToken } from '../../utils/cookie';

const user = {
    state: {
        token: '',
        name: '',
        avatar: 'https://wpimg.wallstcn.com/f778738c-e4f8-4870-b634-56703b4acafe.gif',
        auth: false,
    },
    mutations: {
        SET_TOKEN: (state, token) => {
            state.token = token
        },
        SET_NAME: (state, name) => {
            state.name = name
        },
        SET_AVATAR: (state, avatar) => {
            state.avatar = avatar
        },
        SET_AUTH: (state, auth) => {
            state.auth = auth;
        }
    },
    actions: {
        // 登录
        doLogin({ commit }, userInfo) {
            let username = userInfo.username.trim();
            let password = userInfo.password;

            return new Promise((resolve, reject) => {
                login(username, password).then(response => {
                    let token = response.data.access_token;
                    commit('SET_AUTH', true);
                    commit('SET_TOKEN', token);
                    setToken(token);
                    resolve();
                }).catch(error => {
                    reject(error);
                })
            })
        },

        // 获取用户信息
        getUserInfo({ commit }) {
            return new Promise((resolve, reject) => {
                userInfo().then(response => {
                    let data = response.data;
                    commit('SET_NAME', data.name);
                    resolve(response);
                }).catch(error => {
                    reject(error);
                })
            })
        },

        // 登出
        doLogout({ commit }) {
            return new Promise((resolve, reject) => {
                logout().then(() => {
                    commit('SET_AUTH', false);
                    commit('SET_TOKEN', '');
                    removeToken();
                    resolve();
                }).catch(error => {
                    reject(error);
                })
            })
        },

        // 清空用户信息
        clearUser({ commit }) {
            return new Promise(resolve => {
                commit('SET_AUTH', false);
                commit('SET_TOKEN', '');
                removeToken();
                resolve();
            })
        }
    }
};

export default user;