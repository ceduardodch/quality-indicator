<template>
  <div id="chart-container">
    <GChart :type="type" :data="data" :options="options" :resizeDebounce="0" />
  </div>
</template>

<script>
    import { GChart } from 'vue-google-charts';
    import { chartType, chartData, chartOptions } from '../../../assets/google_chart_data';

    export default {
        name: 'GoogleChart',
        components: {
            GChart,
        },
        data() {
            return {
                type: chartType,
                data: chartData,
                options: chartOptions,
            };
        },
    };
</script>

<style scoped>
  #chart-container {
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    /* align-content: stretch';
    align-items: center;
    justify-content: center; */
  }
</style>