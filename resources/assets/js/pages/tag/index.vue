<template>
    <div class="app-container">
        <!-- 顶部工具栏 -->
        <div class="filter-container">
            <el-input style="width: 200px;" class="filter-item" placeholder="名称" v-model="listQuery.keyword" @keyup.enter.native="handleFilter">
            </el-input>
            <el-select style="width: 140px" class="filter-item" @change='handleFilter' v-model="listQuery.order">
                <el-option v-for="item in sortOptions" :key="item.key" :label="item.label" :value="item.key"></el-option>
            </el-select>
            <el-button style="margin-left: 10px;" class="filter-item" type="primary" icon="el-icon-search" @click="handleFilter" v-waves>搜索</el-button>
            <el-button style="margin-left: 10px;" class="filter-item" type="primary" icon="el-icon-edit" @click="handleCreate">新建</el-button>
        </div>

        <!-- 表格内容 -->
        <el-table style="width: 100%" :data="categoryList" v-loading="listLoading" border fit highlight-current-row>
            <el-table-column align="center" prop="id" label="ID" width="80"></el-table-column>
            <el-table-column align="center" prop="name" label="名称"></el-table-column>
            <el-table-column align="center" prop="created_at" label="创建时间"></el-table-column>
            <el-table-column align="center" prop="updated_at" label="更新时间"></el-table-column>
            <el-table-column align="center" label="行为" width="200">
                <template slot-scope="scope">
                    <el-button size="mini" @click="handleUpdate(scope.row)">修改</el-button>
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

        <!-- 创建/修改 -->
        <el-dialog :title="textMap[dialogStatus]" :visible.sync="dialogFormVisible" width="25%" center>
            <el-form ref="dataForm" :rules="rules" :model="category" label-position="left" label-width="70px">
                <el-form-item label="名称" prop="name">
                    <el-input v-model="category.name" autofocus></el-input>
                </el-form-item>
            </el-form>
            <div slot="footer" class="dialog-footer">
                <el-button @click="dialogFormVisible = false">取消</el-button>
                <el-button v-if="dialogStatus === 'create'" type="primary" @click="createData">创建</el-button>
                <el-button v-else type="primary" @click="updateData">更改</el-button>
            </div>
        </el-dialog>
    </div>
</template>

<script>
    import waves from '../../directives/waves'; // 水波纹指令
    import { getList, createCategory, updateCategory, deleteCategory } from '../../api/tag';

    export default {
        name: "Tag",
        directives: { waves },
        data() {
            return {
                total: 0,
                listLoading: true,
                categoryList: [],
                dialogStatus: '',
                dialogFormVisible: false,
                category: { name: '' },
                textMap: { update: '修改', create: '创建' },
                listQuery: {
                    page: 1,
                    limit: 15,
                    order: 'asc',
                    keyword: undefined
                },
                sortOptions: [
                    { label: '升序', key: 'asc' },
                    { label: '降序', key: 'desc' },
                ],
                rules: {
                    name: [{ required: true, message: '名称不能为空', trigger: 'blur' }]
                },
            }
        },
        created() {
            this.getCategoryList();
        },
        methods: {
            getCategoryList() {
                this.listLoading = true;

                getList(this.listQuery).then(response => {
                    let result = response.data.data;
                    this.total = result.meta.total;
                    this.categoryList = result.data;
                    this.listLoading = false;
                })
            },
            handleFilter() {
                if (! this.listQuery.keyword) {
                    this.listQuery.keyword = undefined;
                }
                this.listQuery.page = 1;
                this.getCategoryList();
            },
            resetCategory() {
                this.category = { name: '' };
            },
            handleCreate() {
                this.resetCategory();
                this.dialogStatus = 'create';
                this.dialogFormVisible = true;
                this.$nextTick(() => {
                    this.$refs['dataForm'].clearValidate();
                });
            },
            createData() {
                this.$refs['dataForm'].validate((valid) => {
                    if (valid) {
                        createCategory(this.category).then(() => {
                            this.dialogFormVisible = false;
                            this.$message({ message: '创建成功', type: 'success' });
                            this.getCategoryList();
                        })
                    }
                })
            },
            handleUpdate(category) {
                this.category = category;
                this.dialogStatus = 'update';
                this.dialogFormVisible = true;
                this.$nextTick(() => {
                    this.$refs['dataForm'].clearValidate();
                });
            },
            updateData() {
                this.$refs['dataForm'].validate((valid) => {
                    if (valid) {
                        updateCategory(this.category.id, this.category.name).then(() => {
                            this.dialogFormVisible = false;
                            this.$message({ message: '更新成功', type: 'success' });
                            this.getCategoryList();
                        }).catch(() => {
                            this.$message({ message: '更新失败', type: 'error' });
                        })
                    }
                })
            },
            handleDelete(category) {
                this.$confirm('此操作将永久删除该数据, 是否继续？', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    deleteCategory(category.id).then(() => {
                        this.$message({ message: '删除成功', type: 'success' });
                        this.getCategoryList();
                    });
                }).catch(() => {
                    this.$message({ type: 'info', message: '已取消删除' });
                });
            },
            handleSizeChange(val) {
                this.listQuery.page = 1;
                this.listQuery.limit = val;
                this.getCategoryList();
            },
            handleCurrentChange(val) {
                this.listQuery.page = val;
                this.getCategoryList();
            },
        }
    }
</script>