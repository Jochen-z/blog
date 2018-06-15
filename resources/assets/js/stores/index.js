import Vue from 'vue';
import Vuex from 'vuex';
import app from './modules/app';
import user from './modules/user';

Vue.use(Vuex);

export default new Vuex.Store({
    // Vuex 允许我们将 store 分割成模块，每个模块拥有自己的 mutation、state、action、getter、甚至是嵌套子模块
    modules: {
        app,
        user,
    },
    // “getter” 可以认为是 store 的计算属性，作为共享函数使用，例如 this.$store.getters.sidebar
    getters: {
        sidebar: state => state.app.sidebar,
        avatar: state => state.user.avatar,
        device: state => state.app.device,
        token: state => state.user.token,
    }
});