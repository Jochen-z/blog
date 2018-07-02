<template>
    <div class="createPost-container">
        <el-form class="form-container" :model="article" :rules="rules">
            <div class="createPost-main-container">
                <el-form-item label="标题">
                    <el-input v-model="article.title"></el-input>
                </el-form-item>
                <el-form-item label="摘要">
                    <el-input type="textarea" v-model="article.excerpt"></el-input>
                </el-form-item>
                <!--<div class="editor-container">-->
                    <!--<Tinymce :height=400 ref="editor" v-model="article.content"/>-->
                <!--</div>-->
                <el-form-item label="分类">
                    <el-select v-model="article.category_id" placeholder="请选择">
                        <el-option
                                v-for="category in categories"
                                :key="category.name"
                                :label="category.name"
                                :value="category.id">
                        </el-option>
                    </el-select>
                </el-form-item>
                <el-form-item label="是否公开">
                    <el-switch v-model="article.status"></el-switch>
                </el-form-item>

                <!--<el-button v-loading="loading" type="warning" @click="draftForm">草稿</el-button>-->
                <!--<el-button v-loading="loading" type="success" @click="submitForm">发布</el-button>-->
            </div>
        </el-form>
    </div>
</template>

<script>
    import { getList } from '../../../api/category';

    export default {
        name: 'articleDetail',
        components: {

        },
        props: {
            isEdit: {
                type: Boolean,
                default: false
            }
        },
        data() {
            return {
                categories: [],
                article: {
                    id: undefined,
                    title: '', // 文章标题
                    excerpt: '', // 文章摘要
                    content: '', // 文章内容
                    category_id: '', // 文章分类
                    status: 1, // 是否公开
                },
                loading: false,
                rules: {
                    title: [{ required: true, message: '标题不能为空', trigger: 'blur' }]
                }
            }
        },
        computed: {

        },
        created() {
            this.getCategoryList();

            if (this.isEdit) {
                const id = this.$route.params && this.$route.params.id;
                this.fetchData(id);
            }
        },
        methods: {
            getCategoryList() {
                getList({ limit:100 }).then(response => {
                    this.categories = response.data.data.data;
                })
            },
            fetchData(id) {
                // fetchArticle(id).then(response => {
                //     this.postForm = response.data
                //     // Just for test
                //     this.postForm.title += `   Article Id:${this.postForm.id}`
                //     this.postForm.content_short += `   Article Id:${this.postForm.id}`
                // }).catch(err => {
                //     console.log(err)
                // })
            },
            submitForm() {
                // this.postForm.display_time = parseInt(this.display_time / 1000)
                // console.log(this.postForm)
                // this.$refs.postForm.validate(valid => {
                //     if (valid) {
                //         this.loading = true
                //         this.$notify({
                //             title: '成功',
                //             message: '发布文章成功',
                //             type: 'success',
                //             duration: 2000
                //         })
                //         this.postForm.status = 'published'
                //         this.loading = false
                //     } else {
                //         console.log('error submit!!')
                //         return false
                //     }
                // })
            },
            draftForm() {
                // if (this.postForm.content.length === 0 || this.postForm.title.length === 0) {
                //     this.$message({
                //         message: '请填写必要的标题和内容',
                //         type: 'warning'
                //     })
                //     return
                // }
                // this.$message({
                //     message: '保存成功',
                //     type: 'success',
                //     showClose: true,
                //     duration: 1000
                // })
                // this.postForm.status = 'draft'
            }
        }
    }
</script>

<style rel="stylesheet/scss" lang="scss" scoped>
    @import "../../../styles/mixin.scss";

    .createPost-container {
        position: relative;

        .createPost-main-container {
            padding: 40px 45px 20px 50px;

            .postInfo-container {
                position: relative;
                @include clearfix;
                margin-bottom: 10px;

                .postInfo-container-item {
                    float: left;
                }
            }
            .editor-container {
                min-height: 500px;
                margin: 0 0 30px;

                .editor-upload-btn-container {
                    text-align: right;
                    margin-right: 10px;

                    .editor-upload-btn {
                        display: inline-block;
                    }
                }
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
