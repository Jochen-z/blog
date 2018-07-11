import Vue from 'vue';
import Vuex from 'vuex';
import app from './modules/app';
import user from './modules/user';
import tagsView from './modules/tagsView';


Vue.use(Vuex);

export default new Vuex.Store({
    // Vuex 允许我们将 store 分割成模块，每个模块拥有自己的 mutation、state、action、getter、甚至是嵌套子模块
    modules: {
        app,
        user,
        tagsView,
    },
    // “getter” 可以认为是 store 的计算属性，作为共享函数使用，例如 this.$store.getters.sidebar
    getters: {
        name: state => state.user.name,
        token: state => state.user.token,
        avatar: state => state.user.avatar,
        sidebar: state => state.app.sidebar,
        device: state => state.app.device,
    }
});