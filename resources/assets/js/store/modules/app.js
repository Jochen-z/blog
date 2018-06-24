import Cookies from 'js-cookie';

const app = {
    // 定义数据源：单一状态树
    state: {
        sidebar: {
            opened: !+Cookies.get('sidebarStatus'),
            withoutAnimation: false
        },
        device: 'desktop'
    },
    // 定义更改状态方法，可以在组件中调用，例如 this.$store.commit('TOGGLE_SIDEBAR')
    mutations: {
        TOGGLE_SIDEBAR: state => {
            if (state.sidebar.opened) {
                Cookies.set('sidebarStatus', 1);
            } else {
                Cookies.set('sidebarStatus', 0);
            }
            state.sidebar.opened = !state.sidebar.opened;
            state.sidebar.withoutAnimation = false;
        },
        CLOSE_SIDEBAR: (state, withoutAnimation) => {
            Cookies.set('sidebarStatus', 1);
            state.sidebar.opened = false;
            state.sidebar.withoutAnimation = withoutAnimation;
        },
        TOGGLE_DEVICE: (state, device) => {
            state.device = device;
        }
    },
    // 用于执行 mutations 中的方法，允许包含任意异步操作
    actions: {
        ToggleSideBar: ({ commit }) => {
            commit('TOGGLE_SIDEBAR');
        },
        CloseSideBar({ commit }, { withoutAnimation }) {
            commit('CLOSE_SIDEBAR', withoutAnimation);
        },
        ToggleDevice({ commit }, device) {
            commit('TOGGLE_DEVICE', device);
        }
    }
};

export default app;