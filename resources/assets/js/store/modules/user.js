import { login, userInfo, logout } from '../../api/auth';
import { setToken, removeToken } from '../../utils/cookie';

const user = {
    state: {
        token: '',
        name: '',
        avatar: 'https://wpimg.wallstcn.com/f778738c-e4f8-4870-b634-56703b4acafe.gif?imageView2/1/w/80/h/80',
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
        }
    },
    actions: {
        // 登录
        doLogin({commit}, userInfo) {
            let username = userInfo.username.trim();
            let password = userInfo.password;

            return new Promise((resolve, reject) => {
                login(username, password).then(response => {
                    let token = response.data.data.access_token;
                    setToken(token);
                    commit('SET_TOKEN', token);
                    resolve();
                }).catch(error => {
                    reject(error);
                })
            })
        },

        // 获取用户信息
        getUserInfo({commit}) {
            return new Promise((resolve, reject) => {
                userInfo().then(response => {
                    let data = response.data.data;
                    commit('SET_NAME', data.name);
                    resolve(response);
                }).catch(error => {
                    reject(error);
                })
            })
        },

        // 刷新令牌
        refreshToken({commit}, token) {
            return new Promise((resolve) => {
                setToken(token);
                commit('SET_TOKEN', token);
                resolve();
            })
        },

        // 登出
        doLogout({commit}) {
            return new Promise((resolve, reject) => {
                logout().then(() => {
                    removeToken();
                    commit('SET_TOKEN', '');
                    resolve();
                }).catch(error => {
                    reject(error);
                })
            })
        },

        // 清除用户信息
        cleanUser({ commit }) {
          return new Promise((resolve) => {
              removeToken();
              commit('SET_TOKEN', '');
              resolve();
          })
        }
    }
};

export default user;