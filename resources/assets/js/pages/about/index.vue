<template>
    <div>
        <el-form ref="aboutForm" :model="about">
            <div style="z-index: 1; height: 50px;">
                <div class="sub-navbar draft" style="top: 0; z-index: 1; height: 50px;">
                    <el-button type="primary" @click="handleUpdateAbout">提交</el-button>
                </div>
            </div>
            <div class="post-container">
                <markdown-editor ref="markdownEditor"
                                 preview-class="markdown"
                                 :configs="editorConfig"
                                 v-model="about.content">
                </markdown-editor>
            </div>
        </el-form>
    </div>
</template>

<script>
    import 'simplemde/dist/simplemde.min.css'
    import '../../../sass/markdown.scss'
    import MarkdownEditor from 'vue-simplemde/src/markdown-editor'
    import { uploadImage } from "../../api/upload"
    import { getAbout, updateAbout } from '../../api/about'

    export default {
        name: "About",
        components: { MarkdownEditor },
        data() {
            return {
                about: {
                    id: undefined,
                    content: ''
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
            this.getAbout();
        },
        mounted() {
            let _this = this;
            let editor = this.$refs['markdownEditor'].simplemde;

            // 图片拖拽
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

                _this.uploadImagesFile(editor, files[0]);

                e.preventDefault();
            });
        },
        methods: {
            getAbout() {
                getAbout(1).then(response => {
                    this.about = response.data.data;
                })
            },
            handleUpdateAbout() {
                if (! this.about.content.length) {
                    return this.$notify({ title: '错误', message: '简介不能为空', type: 'error', offset: 130 });
                }

                updateAbout(this.about.id, this.about.content).then(() => {
                    this.$notify({ title: '成功', message: '提交成功', type: 'success', offset: 130 });
                    this.loading = false;
                });
            },
            uploadImagesFile(editor, file) {
                let image = new FormData();
                image.append('image', file);

                uploadImage(image).then((response) => {
                    if (response.data.code === 200) {
                        editor.setValue(editor.getValue() + `![file](${response.data.data.path})` + '\n');
                    }
                });
            }
        },
    }
</script>

<style rel="stylesheet/scss" lang="scss" scoped>
    .post-container {
        width: 60%;
        margin: 30px auto;
    }
</style>

<style>
    .markdown-editor .CodeMirror,
    .markdown-editor .CodeMirror-scroll {
        min-height: 600px;
    }
</style>