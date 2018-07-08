<template>
    <!-- 确定父组件异步获取值之后，再开始渲染子组件，否则子组件中获取不到值 -->
    <article-detail v-if="article.id" :article='article'></article-detail>
</template>

<script>
    import ArticleDetail from './components/ArticleDetail';
    import { getArticle } from '../../api/article'

    export default {
        name: 'editArticle',
        components: { ArticleDetail },
        data() {
            return {
                article: {}
            }
        },
        created() {
            getArticle(this.$route.params['id']).then(response => {
                this.article = response.data.data;
            })
        },
    }
</script>