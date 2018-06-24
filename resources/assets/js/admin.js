import Vue from 'vue';
import store from './store';
import router from './router';
import ElementUI from 'element-ui';
import 'normalize.css/normalize.css'; // A modern alternative to CSS resets
import 'element-ui/lib/theme-chalk/index.css';
import './styles/index.scss'; // global css
import './icons'; // svg icon
import './permission'; //permission control


Vue.use(ElementUI);

const app = new Vue({
    router,
    store,
}).$mount('#app');
