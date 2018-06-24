<template>
    <el-menu class="nav-bar" mode="horizontal">
        <!-- 侧边栏开关按钮 -->
        <hamburger class="hamburger-container" :toggleClick="toggleSideBar" :isActive="sidebar.opened"></hamburger>

        <!-- 面包屑 -->
        <breadcrumb></breadcrumb>

        <!-- 头像及下拉 -->
        <el-dropdown class="avatar-container" trigger="click">
            <div class="avatar-wrapper">
                <img class="user-avatar" :src="avatar+'?imageView2/1/w/80/h/80'">
                <!--<i class="el-icon-caret-bottom"></i>-->
            </div>
            <el-dropdown-menu class="user-dropdown" slot="dropdown">
                <!--<router-link class="inlineBlock" to="/">-->
                    <!--<el-dropdown-item>-->
                        <!--Home-->
                    <!--</el-dropdown-item>-->
                <!--</router-link>-->
                <el-dropdown-item divided>
                    <span @click="logout" style="display:block;">LogOut</span>
                </el-dropdown-item>
            </el-dropdown-menu>
        </el-dropdown>
    </el-menu>
</template>

<script>
    import { mapGetters } from 'vuex';
    import Breadcrumb from '../../../components/Breadcrumb';
    import Hamburger from '../../../components/Hamburger';

    export default {
        components: {
            Breadcrumb,
            Hamburger
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
                })
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

        .avatar-container {
            height: 50px;
            display: inline-block;
            position: absolute;
            right: 35px;

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
</style>

