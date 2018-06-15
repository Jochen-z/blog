import Vue from 'vue';
import store from './stores/';
import router from './routes';

import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';
import 'normalize.css/normalize.css'; // A modern alternative to CSS resets

import './styles/index.scss'; // global css

import './icons/index' // icon

Vue.use(ElementUI);

const app = new Vue({
    router,
    store,
}).$mount('#app');
