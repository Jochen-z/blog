<template>
    <div class="app-container">
        <!-- 表格内容 -->
        <el-table style="width: 100%" :data="visitorList" v-loading="listLoading" border fit highlight-current-row>
            <el-table-column align="center" prop="id" label="ID" width="60"></el-table-column>
            <el-table-column align="center" prop="path" label="路径" width="140"></el-table-column>
            <el-table-column align="center" prop="ip" label="IP" width="120"></el-table-column>
            <el-table-column align="center" prop="location" label="位置"></el-table-column>
            <el-table-column align="center" prop="agent" label="代理"></el-table-column>
            <el-table-column align="center" prop="created_at" label="访问时间"></el-table-column>
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
    import { getVisitorList } from '../../api/visitor';

    export default {
        name: 'Visitor',
        directives: { waves },
        data() {
            return {
                total: 0,
                listLoading: true,
                visitorList: [],
                listQuery: {
                    page: 1,
                    limit: 15,
                    order: 'desc',
                },
            }
        },
        created() {
            this.getVisitorList();
        },
        methods: {
            getVisitorList() {
                this.listLoading = true;

                getVisitorList(this.listQuery).then(response => {
                    let result = response.data.data;
                    this.total = result.meta.total;
                    this.visitorList = result.data;
                    this.listLoading = false;
                })
            },
            handleFilter() {
                if (! this.listQuery.keyword) {
                    this.listQuery.keyword = undefined;
                }
                this.listQuery.page = 1;
                this.getVisitorList();
            },
            handleSizeChange(val) {
                this.listQuery.page = 1;
                this.listQuery.limit = val;
                this.getVisitorList();
            },
            handleCurrentChange(val) {
                this.listQuery.page = val;
                this.getVisitorList();
            },
        }
    }
</script>

<style scoped>

</style>