<template>
    <div class="app-wrapper" :class="classObj">
        <div v-if="device === 'mobile' && sidebar.opened" class="drawer-bg" @click="handleClickOutside"></div>

        <!-- 侧边栏 -->
        <sidebar class="sidebar-container"></sidebar>

        <div class="main-container">
            <!-- 顶部导航栏 -->
            <navbar></navbar>

            <!-- 内容主体 -->
            <app-main></app-main>
        </div>
    </div>
</template>

<script>
    import ResizeMixin from './ResizeHandler';
    import Navbar from './Navbar/';
    import Sidebar from './Sidebar/';
    import AppMain from './Main/';

    export default {
        name: 'layout',
        components: {
            Sidebar,
            Navbar,
            AppMain
        },
        mixins: [ResizeMixin],
        computed: {
            sidebar() {
                return this.$store.state.app.sidebar;
            },
            device() {
                return this.$store.state.app.device;
            },
            classObj() {
                return {
                    hideSidebar: !this.sidebar.opened,
                    withoutAnimation: this.sidebar.withoutAnimation,
                    mobile: this.device === 'mobile'
                }
            }
        },
        methods: {
            handleClickOutside() {
                this.$store.dispatch('CloseSideBar', { withoutAnimation: false });
            }
        }
    }
</script>

<style scoped>
    .app-wrapper {
    @include clearfix;
        position: relative;
        height: 100%;
        width: 100%;
    }
    .drawer-bg {
        background: #000;
        opacity: 0.3;
        width: 100%;
        top: 0;
        height: 100%;
        position: absolute;
        z-index: 999;
    }
</style>