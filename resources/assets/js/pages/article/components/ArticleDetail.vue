<template>
    <div class="createPost-container">
        <el-form class="form-container"
                 ref="articleForm"
                 label-position="right"
                 label-width="200px"
                 :model="article"
                 :rules="rules">

            <div style="z-index: 1; height: 50px;">
                <div class="sub-navbar draft" style="top: 0; z-index: 1; height: 50px;">
                    <template v-if="isEdit">
                        <el-button v-loading="loading" type="primary" @click="handleUpdateArticle">更新</el-button>
                    </template>
                    <template v-else>
                        <!--<el-button v-loading="loading" type="warning" @click="handleDraftArticle">草稿</el-button>-->
                        <el-button v-loading="loading" type="success" @click="handleCreateArticle">发布</el-button>
                    </template>
                </div>
            </div>

            <div class="createPost-main-container">
                <el-form-item label="标题" prop="title">
                    <el-input v-model="article.title"></el-input>
                </el-form-item>
                <el-form-item label="摘要" prop="excerpt">
                    <el-input type="textarea" rows="3" v-model="article.excerpt"></el-input>
                </el-form-item>

                <el-form-item label="分类" prop="category_id">
                    <el-select v-model="article.category_id" placeholder="请选择">
                        <el-option v-for="category in categoryList"
                                   :key="category.name"
                                   :label="category.name"
                                   :value="category.id">
                        </el-option>
                    </el-select>
                </el-form-item>
                <el-form-item label="标签">
                    <multi-select label="name"
                                  track-by="id"
                                  tag="addTag"
                                  placeholder="请选择"
                                  :multiple="true"
                                  :options="tagList"
                                  :show-labels="false"
                                  :hide-selected="true"
                                  :preserve-search="true"
                                  v-model="selectTag">
                    </multi-select>
                </el-form-item>
                <el-form-item label="是否公开">
                    <el-switch v-model="article.status"></el-switch>
                </el-form-item>
                <div class="editor-container">
                    <markdown-editor ref="markdownEditor"
                                     preview-class="markdown"
                                     :highlight="true"
                                     :configs="editorConfig"
                                     v-model="article.content">
                    </markdown-editor>
                </div>
            </div>
        </el-form>
    </div>
</template>

<script>
    import { getTagList } from '../../../api/tag'
    import { uploadImage } from "../../../api/upload"
    import { getCategoryList } from '../../../api/category'
    import { createArticle, updateArticle } from '../../../api/article'
    import 'vue-multiselect/dist/vue-multiselect.min.css'
    import MultiSelect from 'vue-multiselect'
    import 'simplemde/dist/simplemde.min.css'
    import MarkdownEditor from 'vue-simplemde/src/markdown-editor'
    import '../../../../sass/markdown.scss'
    import hljs from 'highlight.js'


    window.hljs = hljs;

    export default {
        name: 'articleDetail',
        components: {
            MultiSelect,
            MarkdownEditor,
        },
        props: {
            article: {
                type: Object,
                default() {
                    return {
                        id: undefined,
                        title: '', // 标题
                        excerpt: '', // 摘要
                        content: '', // 内容
                        category_id: '', // 分类
                        status: true, // 是否公开
                        tag: [], // 标签
                    }
                }
            }
        },
        data() {
            return {
                isEdit: false,
                tagList: [],
                categoryList: [],
                selectTag: [],
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
                },
                editorConfig: {
                    spellChecker: false,
                    forceSync: true,
                    tabSize: 4,
                    toolbar: [
                        "bold", "italic", "heading", "|", "quote", "code", "table",
                        "horizontal-rule", "unordered-list", "ordered-list", "|",
                        "link", "image", "|",  "side-by-side", 'fullscreen',
                    ],
                }
            }
        },
        created() {
            if (this.article.id) {
                this.isEdit = true;
                this.selectTag = this.article.tag;
                this.article.status = !!+this.article.status;
            }
            this.getTagList();
            this.getCategoryList();
        },
        mounted() {
            this.dropImage();
        },
        methods: {
            getTagList() {
                getTagList({ limit:100 }).then(response => {
                    this.tagList = response.data.data.data;
                });
            },
            getCategoryList() {
                getCategoryList({ limit:100 }).then(response => {
                    this.categoryList = response.data.data.data;
                })
            },
            handleCreateArticle() {
                this.$refs['articleForm'].validate((valid) => {
                    if (! this.article.content.length) {
                        return this.$notify({ title: '错误', message: '请填写文章内容', type: 'error', offset: 130 });
                    }

                    if (valid) {
                        this.loading = true;

                        this.selectTag.forEach((tag) => {
                            this.article.tag.push(tag.id);
                        });

                        createArticle(this.article).then(() => {
                            this.$notify({ title: '成功', message: '创建成功', type: 'success', offset: 130 });
                            this.loading = false;
                        });
                    }
                })
            },
            handleDraftArticle() {

            },
            handleUpdateArticle() {
                this.$refs['articleForm'].validate((valid) => {
                    if (! this.article.content.length) {
                        return this.$notify({ title: '错误', message: '请填写文章内容', type: 'error', offset: 130 });
                    }

                    if (valid) {
                        this.loading = true;

                        this.article.tag = [];
                        this.selectTag.forEach((tag) => {
                            this.article.tag.push(tag.id);
                        });

                        updateArticle(this.article.id, this.article).then(() => {
                            this.$notify({ title: '成功', message: '更新成功', type: 'success', offset: 130 });
                            this.loading = false;
                        });
                    }
                })
            },
            dropImage() {
                let _this = this;
                let editor = this.$refs['markdownEditor'].simplemde;

                // 图片拖拽上传
                editor.codemirror.on('drop', function (editor, e) {
                    let files = e.dataTransfer.files;

                    if (! (e.dataTransfer && files)) {
                        return _this.$notify({ title: '错误', message: '浏览器不支持此操作', type: 'error', offset: 130 });
                    }

                    if (files.length > 1) {
                        return _this.$notify({ title: '错误', message: '一次只能上传一张图片', type: 'error', offset: 130 });
                    }

                    if (files[0].type.indexOf('image') === -1) {
                        return _this.$notify.error({ title: '错误', message: '只能上传图片', type: 'error', offset: 130 });
                    }

                    let image = new FormData();
                    image.append('image', files[0]);

                    // 占位符
                    let placeholder = `![Uploading ${files[0]['name']} ...]()`;
                    editor.replaceRange(placeholder, {
                        line: editor.getCursor().line,
                        ch: editor.getCursor().ch
                    });

                    uploadImage(image).then((response) => {
                        if (response.data.code === 200) {
                            let imagePath = `\n![](${response.data.data.path})\n`;
                            editor.setValue(editor.getValue().replace(placeholder, imagePath));
                        } else {
                            _this.$notify.error({ title: '错误', message: response.data.message, type: 'error', offset: 130 });
                        }
                    });

                    e.preventDefault();
                });
            }
        }
    }
</script>

<style rel="stylesheet/scss" lang="scss" scoped>
    @import "../../../styles/mixin.scss";
    @import '~highlight.js/styles/atom-one-dark.css';

    .createPost-container {
        position: relative;

        .createPost-main-container {
            padding: 40px 250px 20px 50px;

            .multiselect {
                width: 217px;
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

<style>
    .markdown-editor .CodeMirror,
    .markdown-editor .CodeMirror-scroll {
        min-height: 400px;
    }
</style>