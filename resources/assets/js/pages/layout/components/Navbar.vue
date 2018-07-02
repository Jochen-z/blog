<template>
    <el-menu class="nav-bar" mode="horizontal">
        <!-- 侧边栏开关按钮 -->
        <hamburger class="hamburger-container" :toggleClick="toggleSideBar" :isActive="sidebar.opened"></hamburger>

        <!-- 面包屑 -->
        <breadcrumb></breadcrumb>

        <!-- 头像等工具 -->
        <div class="right-menu">
            <el-tooltip effect="dark" content="全屏" placement="bottom">
                <screenfull class="full-screen right-menu-item"></screenfull>
            </el-tooltip>

            <el-dropdown class="avatar-container" trigger="click">
                <div class="avatar-wrapper">
                    <img class="user-avatar" :src="avatar">
                </div>
                <el-dropdown-menu slot="dropdown">
                    <el-dropdown-item>
                        <span @click="logout" style="display:block;">Logout</span>
                    </el-dropdown-item>
                </el-dropdown-menu>
            </el-dropdown>
        </div>
    </el-menu>
</template>

<script>
    import { mapGetters } from 'vuex';
    import Breadcrumb from '../../../components/Breadcrumb';
    import Hamburger from '../../../components/Hamburger';
    import Screenfull from '../../../components/Screenfull';

    export default {
        components: {
            Breadcrumb,
            Hamburger,
            Screenfull
        },
        computed: {
            ...mapGetters([
                'sidebar',
                'avatar'
            ])
        },
        methods: {
            toggleSideBar() {
                return this.$store.dispatch('ToggleSideBar');
            },
            logout() {
                return this.$store.dispatch('doLogout').then(() => {
                    location.reload(); // 为了重新实例化vue-router对象 避免bug
                });
            }
        }
    }
</script>

<style rel="stylesheet/scss" lang="scss" scoped>
    .nav-bar {
        height: 50px;
        line-height: 50px;
        border-radius: 0 !important;

        .hamburger-container {
            line-height: 58px;
            height: 50px;
            float: left;
            padding: 0 10px;
        }

        .breadcrumb-container {
            float: left;
        }

        .errLog-container {
            display: inline-block;
            vertical-align: top;
        }

        .right-menu {
            float: right;
            height: 100%;
            &:focus {
                outline: none;
            }

            .right-menu-item {
                display: inline-block;
                margin: 0 8px;
            }

            .full-screen {
                height: 20px;
                margin-right: 20px;
            }

            .avatar-container {
                height: 50px;
                margin-right: 30px;

                .avatar-wrapper {
                    cursor: pointer;
                    margin-top: 5px;
                    position: relative;

                    .user-avatar {
                        width: 40px;
                        height: 40px;
                        border-radius: 10px;
                    }
                    .el-icon-caret-bottom {
                        position: absolute;
                        right: -20px;
                        top: 25px;
                        font-size: 12px;
                    }
                }
            }
        }
    }
</style>

