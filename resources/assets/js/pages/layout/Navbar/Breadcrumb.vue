<template>
    <el-breadcrumb class="app-breadcrumb" separator="/">
        <transition-group name="breadcrumb">
            <el-breadcrumb-item v-for="(route,index) in routes" :key="route.path" v-if="route.meta.title">
                <!-- 最后一级 -->
                <span v-if="index === routes.length-1" class="no-redirect">{{route.meta.title}}</span>
                <!-- 非最后一级 -->
                <router-link v-else :to="route.redirect || route.path">{{route.meta.title}}</router-link>
            </el-breadcrumb-item>
        </transition-group>
    </el-breadcrumb>
</template>

<script>
    export default {
        // 一个组件的 data 选项必须是一个函数
        data() {
            return {
                routes: []
            }
        },
        created() {
            this.getBreadcrumb();
        },
        watch: {
            // 当监听到路由变化时，改变面包屑
            $route() {
                this.getBreadcrumb();
            }
        },
        methods: {
            getBreadcrumb() {
                // $route.matched 数组记录着所有路由信息
                this.routes = this.$route.matched;
            }
        }
    }
</script>

<style rel="stylesheet/scss" lang="scss" scoped>
  .app-breadcrumb.el-breadcrumb {
    display: inline-block;
    font-size: 14px;
    line-height: 50px;
    margin-left: 10px;
    .no-redirect {
      color: #97a8be;
      cursor: text;
    }
  }
</style>
