<template>
    <div class="createPost-container">
        <el-form class="form-container" ref="article" :model="article" :rules="rules">

            <sticky :className="'sub-navbar '+ article.status">
                <el-button v-loading="loading" style="margin-left: 10px;" type="success" @click="submitForm">发布
                </el-button>
                <el-button v-loading="loading" type="warning" @click="draftForm">草稿</el-button>
            </sticky>

            <div class="createPost-main-container">
                <el-row>
                    <el-col :span="21">
                        <el-form-item style="margin-bottom: 40px;" prop="title">
                            <MDinput name="name" v-model="article.title" required :maxlength="100">
                                标题
                            </MDinput>
                        </el-form-item>
                    </el-col>
                </el-row>

                <el-form-item style="margin-bottom: 40px;" label-width="45px" label="摘要:">
                    <el-input type="textarea" class="article-textarea" :rows="1" autosize placeholder="请输入内容"
                              v-model="article.excerpt">
                    </el-input>
                    <span class="word-counter" v-show="contentLength">{{contentLength}}字</span>
                </el-form-item>

                <div class="editor-container">
                    <Tinymce :height=400 ref="editor" v-model="article.content"/>
                </div>

            </div>
        </el-form>

    </div>
</template>

<script>
    // import Tinymce from '@/components/Tinymce'
    // import MDinput from '@/components/MDinput'
    // import Multiselect from 'vue-multiselect'// 使用的一个多选框组件，element-ui的select不能满足所有需求
    // import 'vue-multiselect/dist/vue-multiselect.min.css'// 多选框组件css
    // import Sticky from '@/components/Sticky' // 粘性header组件
    // import Warning from './Warning'
    // import {CommentDropdown, PlatformDropdown, SourceUrlDropdown} from './Dropdown'


    export default {
        name: 'articleDetail',
        components: {
            // Tinymce,
            // MDinput,
            // Upload,
            // Multiselect,
            // Sticky,
            // Warning,
            // CommentDropdown,
            // PlatformDropdown,
            // SourceUrlDropdown
        },
        props: {
            isEdit: {
                type: Boolean,
                default: false
            }
        },
        data() {
            return {
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
            contentLength() {
                return this.article.content.length;
            }
        },
        created() {
            if (this.isEdit) {
                const id = this.$route.params && this.$route.params.id;
                this.fetchData(id);
            }
        },
        methods: {
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
