<template>
    <el-row style="background:#fff;padding:16px 16px 0;margin-bottom:32px;">
        <div class="chart" ref="traffic" :style="{height:height,width:width}"></div>
    </el-row>
</template>

<script>
    require('echarts/theme/macarons');
    import echarts from 'echarts';
    import { debounce } from '../../../utils';
    import { getStatisticalTraffic } from '../../../api/dashboard';

    export default {
        props: {
            width: {
                type: String,
                default: '100%'
            },
            height: {
                type: String,
                default: '350px'
            },
            autoResize: {
                type: Boolean,
                default: true
            }
        },
        data() {
            return {
                chart: null,
                chartData: []
            }
        },
        created() {
            this.getChartData();
        },
        mounted() {
            // this.initChart();
            if (this.autoResize) {
                this.__resizeHandler = debounce(() => {
                    if (this.chart) {
                        this.chart.resize()
                    }
                }, 100);
                window.addEventListener('resize', this.__resizeHandler);
            }

            // 监听侧边栏的变化
            const sidebarElm = document.getElementsByClassName('sidebar-container')[0];
            sidebarElm.addEventListener('transitionend', this.sidebarResizeHandler);
        },
        beforeDestroy() {
            if (!this.chart) {
                return;
            }
            if (this.autoResize) {
                window.removeEventListener('resize', this.__resizeHandler);
            }

            const sidebarElm = document.getElementsByClassName('sidebar-container')[0];
            sidebarElm.removeEventListener('transitionend', this.sidebarResizeHandler);

            this.chart.dispose();
            this.chart = null;
        },
        methods: {
            getChartData() {
                getStatisticalTraffic().then(response => {
                    if (response.data.code === 200) {
                        this.chartData = response.data.data;
                        this.initChart();
                    }
                });
            },
            initChart() {
                this.chart = echarts.init(this.$refs.traffic, 'macarons');
                this.setOptions(this.chartData);
            },
            setOptions({ xAxis, yAxis } = {}) {
                this.chart.setOption({
                    title: {
                        subtext: '七日流量图',
                        x: 'right'
                    },
                    legend: {
                        data: ['pv', 'uv']
                    },
                    xAxis: {
                        data: xAxis,
                        boundaryGap: false,
                        axisTick: {
                            show: false
                        }
                    },
                    yAxis: {
                        axisTick: {
                            show: false
                        }
                    },
                    grid: {
                        left: 10,
                        right: 10,
                        bottom: 20,
                        top: 30,
                        containLabel: true
                    },
                    tooltip: {
                        trigger: 'axis',
                        axisPointer: {
                            type: 'cross'
                        },
                        padding: [5, 10]
                    },
                    series: [
                        {
                            name: 'pv',
                            itemStyle: {
                                normal: {
                                    color: '#FF005A',
                                    lineStyle: {
                                        color: '#FF005A',
                                        width: 2
                                    }
                                }
                            },
                            smooth: true,
                            type: 'line',
                            data: yAxis['pv'],
                            animationDuration: 2800,
                            animationEasing: 'cubicInOut'
                        },
                        {
                            name: 'uv',
                            smooth: true,
                            type: 'line',
                            itemStyle: {
                                normal: {
                                    color: '#3888fa',
                                    lineStyle: {
                                        color: '#3888fa',
                                        width: 2
                                    },
                                    areaStyle: {
                                        color: '#f3f8ff'
                                    }
                                }
                            },
                            data: yAxis['uv'],
                            animationDuration: 2800,
                            animationEasing: 'quadraticOut'
                        }
                    ]
                })
            },
            sidebarResizeHandler(e) {
                if (e.propertyName === 'width') {
                    this.__resizeHandler()
                }
            },
        }
    }
</script>