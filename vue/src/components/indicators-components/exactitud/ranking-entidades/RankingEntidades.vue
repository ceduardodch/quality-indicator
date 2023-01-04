<template>
  
  <div class="indicator-title q-my-xl full-width">
    <h4>Ranking de entidades contratantes por mayor cantidad de registros con monto &lt; $0,5 en la fase de adjudicación</h4>
  </div>
  
  <div class="form-container">
    <RankingEntidadesInputs 
      v-model="indicatorDataModel"
    />
  </div>

  <div class="output-container">
    <DataVisualization />
  </div>

</template>
  
<script setup>
import { reactive, watch } from 'vue';
import RankingEntidadesInputs from './RankingEntidadesInputs.vue';
import DataVisualization from '@/components/data-visualization/DataVisualization.vue';

const provinciasDefaultSelect = [
  'A', 'B', 'F', 'C', 'H', 'X', 
  'O', 'E', 'W', 'G', 'I', 'L', 
  'R', 'M', 'S', 'N', 'D', 'Y', 
  'P', 'SE', 'SD', 'U', 'T', 'Z'
]

const userDateRangeQuery = {
  userDateQueryStart: {
    pickedYear: 2018,
    pickedMonth: 0,
    isDateRangeValid: true
  },
  userDateQueryEnd: {
    pickedYear: 2020,
    pickedMonth: 0,
    isDateRangeValid: true
  }
}

const indicatorDataModel = reactive(
  {
    provinciasSelectedValues: provinciasDefaultSelect,
    userDateRangeQuery: userDateRangeQuery
  }
)

watch(indicatorDataModel, () => {
  console.log('FROM THE THIRD INDICATOR', indicatorDataModel)
})

</script>

<style>
.q-page {
  padding: 5% 10%;
}

.form-container {
  width: 100%;
}

.indicator-title h4 {
  font-size: 5vh;
  font-weight: lighter;
  text-align: left;
  margin: 0;
  line-height: 1.3;
}

.output-container {
  /* background-color: lavender; */
  padding: 2%;
  border: 1px solid lightgrey;
  border-radius: 25px;
  box-shadow: 0 8px 8px -4px lightblue;
  width: 100%;
}

.separator {
  width: 100%;
  background-color: #ffce2d;
  /* border-color: #ffce2d; */
  /* border-width: 2px; */
  /* padding-bottom: 10px; */
  margin-top: 10vh;
  margin-bottom: 10vh;
  height: 2px;
}
</style>