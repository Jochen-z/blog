<template>
    <div class="createPost-container">
        <el-form class="form-container"
                 ref="articleForm"
                 label-position="right"
                 label-width="200px"
                 :model="article"
                 :rules="rules">

            <div style="z-index: 1; height: 50px;">
                <div class="sub-navbar draft" style="top: 0px; z-index: 1; height: 50px;">
                    <el-button v-loading="loading" type="warning" @click="handleDraftArticle">草稿</el-button>
                    <el-button v-loading="loading" type="success" @click="handleCreateArticle">发布</el-button>
                </div>
            </div>

            <div class="createPost-main-container">
                <el-form-item label="标题">
                    <el-input v-model="article.title"></el-input>
                </el-form-item>
                <el-form-item label="摘要">
                    <el-input type="textarea" rows="3" v-model="article.excerpt"></el-input>
                </el-form-item>
                <el-form-item label="分类">
                    <el-select v-model="article.category_id" placeholder="请选择">
                        <el-option v-for="category in categories"
                                   :key="category.name"
                                   :label="category.name"
                                   :value="category.id">
                        </el-option>
                    </el-select>
                </el-form-item>
                <el-form-item label="标签">
                    <multiselect label="name"
                                 track-by="id"
                                 tag="addTag"
                                 :multiple="true"
                                 :options="tags"
                                 :hide-selected="true"
                                 :preserve-search="true"
                                 v-model="article.tags">
                    </multiselect>
                </el-form-item>
                <el-form-item label="是否公开">
                    <el-switch v-model="article.status"></el-switch>
                </el-form-item>
                <div class="editor-container">
                    <markdown-editor :configs="editorConfig" v-model="article.content" ref="editor"></markdown-editor>
                </div>
            </div>
        </el-form>
    </div>
</template>

<script>
    import { getTagList } from '../../../api/tag'
    import { getCategoryList } from '../../../api/category'
    import { createArticle } from '../../../api/article'
    import 'vue-multiselect/dist/vue-multiselect.min.css'
    import Multiselect from 'vue-multiselect'
    import 'simplemde/dist/simplemde.min.css'
    import MarkdownEditor from 'vue-simplemde/src/markdown-editor'

    export default {
        name: 'articleDetail',
        components: {
            Multiselect,
            MarkdownEditor,
        },
        props: {
            isEdit: {
                type: Boolean,
                default: false
            }
        },
        data() {
            return {
                tags:[],
                categories: [],
                article: {
                    id: undefined,
                    title: '', // 文章标题
                    excerpt: '', // 文章摘要
                    content: '', // 文章内容
                    category_id: '', // 文章分类
                    status: true, // 是否公开
                },
                loading: false,
                rules: {
                    title: [
                        { type: 'string', required: true, message: '请填写文章标题', trigger: 'blur' },
                        { min: 1, max: 255, message: '标题长度必须在 255 个字符以内', trigger: 'blur' }
                    ],
                    excerpt: [
                        { type: 'string', required: true, message: '请填写文章摘要', trigger: 'blur' }
                    ],
                    category_id: [
                        { type: 'number', required: true, message: '请选择文章分类', trigger: 'blur' }
                    ],
                    content: [
                        { type: 'string', required: true, message: '请填写文章内容', trigger: 'blur' }
                    ],
                },
                editorConfig: {
                    spellChecker: false,
                    forceSync: true,
                    tabSize: 4,
                    // autosave: {
                    //     enabled: true,
                    //     delay: 5000,
                    //     unique_id: "topic_content"
                    // },
                }
            }
        },
        computed: {

        },
        created() {
            this.getTagList();
            this.getCategoryList();
        },
        methods: {
            getTagList() {
                getTagList({ limit:100 }).then(response => {
                    this.tags = response.data.data.data;
                });
            },
            getCategoryList() {
                getCategoryList({ limit:100 }).then(response => {
                    this.categories = response.data.data.data;
                })
            },
            handleCreateArticle() {
                this.$refs['articleForm'].validate((valid) => {
                    if (valid) {
                        this.loading = true;
                        console.log(this.article);
                        // createArticle(this.article).then(() => {
                        //     this.$notify({
                        //         title: '成功',
                        //         message: '文章发布成功',
                        //         type: 'success',
                        //         duration: 2000
                        //     });
                        //     this.loading = false;
                        // });
                    }
                })
            },
            handleDraftArticle() {

            }
        }
    }
</script>

<style rel="stylesheet/scss" lang="scss" scoped>
    @import "../../../styles/mixin.scss";

    .createPost-container {
        position: relative;
        .createPost-main-container {
            padding: 40px 250px 20px 50px;
            .postInfo-container {
                position: relative;
                @include clearfix;
                margin-bottom: 10px;
                .postInfo-container-item {
                    float: left;
                }
            }
            .editor-container {
                margin-left: 200px;
            }
        }
        .word-counter {
            width: 40px;
            position: absolute;
            right: -10px;
            top: 0;
        }
    }
</style>
