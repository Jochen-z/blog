<template>
    <div class="app-container">
        <!-- 顶部工具栏 -->
        <div class="filter-container">
            <el-input style="width: 200px;" class="filter-item" placeholder="标题" v-model="listQuery.keyword" @keyup.enter.native="handleFilter">
            </el-input>
            <el-select style="width: 140px" class="filter-item" @change='handleFilter' v-model="listQuery.order">
                <el-option v-for="item in sortOptions" :key="item.key" :label="item.label" :value="item.key"></el-option>
            </el-select>
            <el-button style="margin-left: 10px;" class="filter-item" type="primary" icon="el-icon-search" @click="handleFilter" v-waves>搜索</el-button>
            <el-button style="margin-left: 10px;" class="filter-item" type="primary" icon="el-icon-edit" @click="handleCreate">新建</el-button>
        </div>

        <!-- 表格内容 -->
        <el-table style="width: 100%" :data="articleList" v-loading="listLoading" border fit highlight-current-row>
            <el-table-column align="center" prop="id" label="ID" width="80"></el-table-column>
            <el-table-column align="center" prop="title" label="标题"></el-table-column>
            <el-table-column align="center" prop="category_name" label="文章分类" width="140"></el-table-column>
            <el-table-column align="center" prop="read_count" label="阅读总数" width="140"></el-table-column>
            <el-table-column class-name="status-col" prop="status" label="状态" width="100">
                <template slot-scope="scope">
                    <el-tag type="success" v-if="scope.row.status">公开</el-tag>
                    <el-tag type="info" v-else>私密</el-tag>
                </template>
            </el-table-column>
            <el-table-column align="center" prop="created_at" label="创建时间" width="180"></el-table-column>
            <el-table-column align="center" prop="updated_at" label="更新时间" width="180"></el-table-column>
            <el-table-column align="center" label="行为" width="200">
                <template slot-scope="scope">
                    <el-button size="mini" @click="handleUpdate(scope.row.id)">修改</el-button>
                    <el-button type="danger" size="mini" @click="handleDelete(scope.row)">删除</el-button>
                </template>
            </el-table-column>
        </el-table>

        <!-- 分页 -->
        <div class="pagination-container" v-show="total">
            <el-pagination layout="total, sizes, prev, pager, next, jumper" background
                           :total="total"
                           :current-page="listQuery.page"
                           :page-size="listQuery.limit"
                           :page-sizes="[5,10,15,20,50]"
                           @size-change="handleSizeChange"
                           @current-change="handleCurrentChange">
            </el-pagination>
        </div>
    </div>
</template>

<script>
    import waves from '../../directives/waves'; // 水波纹指令
    import { getArticleList, deleteArticle } from '../../api/article';

    export default {
        name: "articleList",
        directives: { waves },
        data() {
            return {
                total: 0,
                listLoading: true,
                articleList: [],
                dialogStatus: '',
                dialogFormVisible: false,
                textMap: { update: '修改', create: '创建' },
                listQuery: {
                    page: 1,
                    limit: 15,
                    order: 'desc',
                    keyword: undefined
                },
                sortOptions: [
                    { label: '降序', key: 'desc' },
                    { label: '升序', key: 'asc' },
                ],
            }
        },
        created() {
            this.getArticleList();
        },
        methods: {
            getArticleList() {
                this.listLoading = true;

                getArticleList(this.listQuery).then(response => {
                    let result = response.data.data;
                    this.total = result.meta.total;
                    this.articleList = result.data;
                    this.listLoading = false;
                })
            },
            handleFilter() {
                if (! this.listQuery.keyword) {
                    this.listQuery.keyword = undefined;
                }
                this.listQuery.page = 1;
                this.getArticleList();
            },
            handleCreate() {
                this.$router.push('/article/create');
            },
            handleUpdate(id) {
                this.$router.push('/article/edit/' + id);
            },
            handleDelete(article) {
                this.$confirm('此操作将永久删除该数据, 是否继续？', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    deleteArticle(article.id).then(() => {
                        this.$message({ message: '删除成功', type: 'success' });
                        this.getArticleList();
                    });
                }).catch(() => {
                    this.$message({ type: 'info', message: '已取消删除' });
                });
            },
            handleSizeChange(val) {
                this.listQuery.page = 1;
                this.listQuery.limit = val;
                this.getArticleList();
            },
            handleCurrentChange(val) {
                this.listQuery.page = val;
                this.getArticleList();
            },
        }
    }
</script>