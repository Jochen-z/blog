<template>
    <div class="dashboard-container">
        <panel-group></panel-group>

        <traffic-chart></traffic-chart>
    </div>
</template>

<script>
    import PanelGroup from './components/PanelGroup'
    import TrafficChart from './components/TrafficChart'

    export default {
        name: 'Dashboard',
        components: {
            PanelGroup,
            TrafficChart,
        },
    }
</script>

<style scoped>
    .dashboard-container {
        padding: 32px;
        background-color: rgb(240, 242, 245);
        height: -webkit-fill-available;
    }
</style>