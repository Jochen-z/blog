<template>
    <section class="app-main">
        <transition name="fade-transform" mode="out-in">
            <keep-alive :include="cachedViews" v-if="isRouterAlive">
                <router-view :key="key"></router-view>
            </keep-alive>
        </transition>
    </section>
</template>

<script>
    export default {
        name: 'AppMain',
        data () {
            return {
                isRouterAlive: true
            }
        },
        provide () {
            return {
                reloadPage: this.reload
            }
        },
        computed: {
            cachedViews() {
                return this.$store.state.tagsView.cachedViews;
            },
            key() {
                return this.$route.fullPath;
            }
        },
        methods: {
            reload () {
                this.isRouterAlive = false;
                this.$nextTick(() => (this.isRouterAlive = true));
            }
        }
    }
</script>

<style scoped>
    .app-main {
        /*84 = navbar + tags-view = 50 +34 */
        min-height: calc(100vh - 84px);
        width: 100%;
        position: relative;
        overflow: hidden;
    }
</style>
