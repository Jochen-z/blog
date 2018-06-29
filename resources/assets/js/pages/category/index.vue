<template>
    <div class="app-container">
        <div class="filter-container">
            <el-input style="width: 200px;"
                      class="filter-item"
                      v-model="listQuery.name"
                      placeholder="名称"
                      @keyup.enter.native="handleFilter">
            </el-input>
            <el-select style="width: 140px"
                       class="filter-item"
                       @change='handleFilter'
                       v-model="listQuery.sort">
                <el-option v-for="item in sortOptions" :key="item.key" :label="item.label" :value="item.key"></el-option>
            </el-select>
            <el-button class="filter-item" type="primary" icon="el-icon-search" @click="handleFilter" v-waves>搜索</el-button>
            <el-button class="filter-item" type="primary" icon="el-icon-edit" @click="handleCreate" style="margin-left: 10px;">新建</el-button>
        </div>

        <el-table style="width: 100%;min-height:1000px;"
                  :data="categoryList"
                  v-loading="listLoading"
                  border fit highlight-current-row>
            <el-table-column align="center" prop="id" label="id" width="65"></el-table-column>
            <el-table-column align="center" prop="name" label="名称" min-width="150px"></el-table-column>
            <el-table-column align="center" prop="sum" label="文章总数" min-width="150px"></el-table-column>
            <el-table-column align="center" prop="created_at" label="创建时间" width="150px"></el-table-column>
            <el-table-column align="center" prop="updated_at" label="更新时间" width="150px"></el-table-column>
            <el-table-column align="center" prop="actions" label="行为" width="230" class-name="small-padding fixed-width">
                <el-button type="primary" size="mini" @click="handleUpdate()">修改</el-button>
                <el-button type="danger" size="mini" @click="handleDelete()">删除</el-button>
            </el-table-column>
        </el-table>

        <!--<div class="pagination-container">-->
            <!--<el-pagination background @size-change="handleSizeChange" @current-change="handleCurrentChange"-->
                           <!--:current-page="listQuery.page" :page-sizes="[10,20,30, 50]" :page-size="listQuery.limit"-->
                           <!--layout="total, sizes, prev, pager, next, jumper" :total="total">-->
            <!--</el-pagination>-->
        <!--</div>-->

        <!--<el-dialog :title="textMap[dialogStatus]" :visible.sync="dialogFormVisible">-->
            <!--<el-form :rules="rules" ref="dataForm" :model="temp" label-position="left" label-width="70px"-->
                     <!--style='width: 400px; margin-left:50px;'>-->
                <!--<el-form-item :label="$t('table.type')" prop="type">-->
                    <!--<el-select class="filter-item" v-model="temp.type" placeholder="Please select">-->
                        <!--<el-option v-for="item in  calendarTypeOptions" :key="item.key" :label="item.display_name"-->
                                   <!--:value="item.key">-->
                        <!--</el-option>-->
                    <!--</el-select>-->
                <!--</el-form-item>-->
                <!--<el-form-item :label="$t('table.date')" prop="timestamp">-->
                    <!--<el-date-picker v-model="temp.timestamp" type="datetime" placeholder="Please pick a date">-->
                    <!--</el-date-picker>-->
                <!--</el-form-item>-->
                <!--<el-form-item :label="$t('table.title')" prop="title">-->
                    <!--<el-input v-model="temp.title"></el-input>-->
                <!--</el-form-item>-->
                <!--<el-form-item :label="$t('table.importance')">-->
                    <!--<el-rate style="margin-top:8px;" v-model="temp.importance"-->
                             <!--:colors="['#99A9BF', '#F7BA2A', '#FF9900']" :max='3'></el-rate>-->
                <!--</el-form-item>-->
                <!--<el-form-item :label="$t('table.remark')">-->
                    <!--<el-input type="textarea" :autosize="{ minRows: 2, maxRows: 4}" placeholder="Please input" v-model="temp.remark">-->
                    <!--</el-input>-->
                <!--</el-form-item>-->
            <!--</el-form>-->
            <!--<div slot="footer" class="dialog-footer">-->
                <!--<el-button @click="dialogFormVisible = false">{{$t('table.cancel')}}</el-button>-->
                <!--<el-button v-if="dialogStatus=='create'" type="primary" @click="createData">{{$t('table.confirm')}}</el-button>-->
                <!--<el-button v-else type="primary" @click="updateData">{{$t('table.confirm')}}</el-button>-->
            <!--</div>-->
        <!--</el-dialog>-->

        <!--<el-dialog title="Reading statistics" :visible.sync="dialogPvVisible">-->
            <!--<el-table :data="pvData" border fit highlight-current-row style="width: 100%">-->
                <!--<el-table-column prop="key" label="Channel"></el-table-column>-->
                <!--<el-table-column prop="pv" label="Pv"></el-table-column>-->
            <!--</el-table>-->
            <!--<span slot="footer" class="dialog-footer">-->
                <!--<el-button type="primary" @click="dialogPvVisible = false">{{$t('table.confirm')}}</el-button>-->
            <!--</span>-->
        <!--</el-dialog>-->
    </div>
</template>

<script>
    import waves from '../../directives/waves'; // 水波纹指令
    import { getList, createCategory, updateCategory, deleteCategory } from '../../api/category';

    export default {
        name: 'Category',
        directives: { waves },
        data() {
            return {
                listQuery: {
                    page: 1,
                    limit: 20,
                    sort: '+id'
                },
                sortOptions: [
                    { label: '降序', key: '+id' },
                    { label: '升序', key: '-id' }
                ],
                categoryList: [],




                total: null,
                listLoading: true,
                showReviewer: false,
                temp: {
                    id: undefined,
                    importance: 1,
                    remark: '',
                    timestamp: new Date(),
                    title: '',
                    type: '',
                    status: 'published'
                },
                dialogFormVisible: false,
                dialogStatus: '',
                textMap: {
                    update: 'Edit',
                    create: 'Create'
                },
                dialogPvVisible: false,
                pvData: [],
                rules: {
                    type: [{ required: true, message: 'type is required', trigger: 'change' }],
                    timestamp: [{ type: 'date', required: true, message: 'timestamp is required', trigger: 'change' }],
                    title: [{ required: true, message: 'title is required', trigger: 'blur' }]
                },
                downloadLoading: false
            }
        },
        // filters: {
        //     statusFilter(status) {
        //         const statusMap = {
        //             published: 'success',
        //             draft: 'info',
        //             deleted: 'danger'
        //         }
        //         return statusMap[status]
        //     }
        // },
        created() {
            this.getList();
        },
        methods: {
            getList() {
                this.listLoading = true;

                getList(this.listQuery).then(response => {
                    // this.list = response.data.items
                    // this.total = response.data.total
                    //
                    // // Just to simulate the time of the request
                    // setTimeout(() => {
                    //     this.listLoading = false
                    // }, 1.5 * 1000)
                })
            },
            handleFilter() {
                this.listQuery.page = 1;
                this.getList();
            },
            handleCreate() {

            },
            handleUpdate() {

            },
            handleDelete() {

            },



            handleSizeChange(val) {
                this.listQuery.limit = val
                this.getList()
            },
            handleCurrentChange(val) {
                this.listQuery.page = val
                this.getList()
            },
            handleModifyStatus(row, status) {
                this.$message({
                    message: '操作成功',
                    type: 'success'
                })
                row.status = status
            },
            resetTemp() {
                this.temp = {
                    id: undefined,
                    importance: 1,
                    remark: '',
                    timestamp: new Date(),
                    title: '',
                    status: 'published',
                    type: ''
                }
            },

            createData() {
                // this.$refs['dataForm'].validate((valid) => {
                //     if (valid) {
                //         this.temp.id = parseInt(Math.random() * 100) + 1024 // mock a id
                //         this.temp.author = 'vue-element-admin'
                //         createArticle(this.temp).then(() => {
                //             this.list.unshift(this.temp)
                //             this.dialogFormVisible = false
                //             this.$notify({
                //                 title: '成功',
                //                 message: '创建成功',
                //                 type: 'success',
                //                 duration: 2000
                //             })
                //         })
                //     }
                // })
            },

            handleFetchPv(pv) {
                // fetchPv(pv).then(response => {
                //     this.pvData = response.data.pvData
                //     this.dialogPvVisible = true
                // })
            },

            formatJson(filterVal, jsonData) {
                return jsonData.map(v => filterVal.map(j => {
                    if (j === 'timestamp') {
                        return parseTime(v[j])
                    } else {
                        return v[j]
                    }
                }))
            }
        }
    }
</script>

<style scoped>

</style>