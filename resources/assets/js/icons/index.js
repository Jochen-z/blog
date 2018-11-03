import Vue from 'vue'
import SvgIcon from '../components/SvgIcon'

// register globally
Vue.component('svg-icon', SvgIcon);

// 自动导入 SVG 图标
const requireAll = requireContext => requireContext.keys().map(requireContext);
const req = require.context('./svg', false, /\.svg$/);
requireAll(req);