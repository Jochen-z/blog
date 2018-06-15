<template>
    <el-scrollbar wrapClass="scrollbar-wrapper">
        <el-menu mode="vertical"
                 :show-timeout="200"
                 :default-active="$route.path"
                 :collapse="isCollapse"
                 background-color="#304156"
                 text-color="#bfcbd9"
                 active-text-color="#409EFF">
            <sidebar-item :routes="routes"></sidebar-item>
        </el-menu>
    </el-scrollbar>
</template>

<script>
    import {mapGetters} from 'vuex'; // mapGetters 辅助函数可以将 store 中的 getter 映射到局部计算属性
    import SidebarItem from './SidebarItem';

    export default {
        components: {SidebarItem},
        computed: {
            // ... 展开运算符，Array,Set,String 可以使用
            ...mapGetters([
                'sidebar'
            ]),
            routes() {
                return this.$router.options.routes;
            },
            isCollapse() {
                return !this.sidebar.opened;
            }
        }
    }
</script>
