<template>

  <div class="indicator-title q-my-xl full-width">
    <h4>Ranking de entidades contratantes con mayor cantidad de registros incompletos</h4>
  </div>

  <div class="form-container">
    <RankingEntidadesContratantesIncompletosInputs 
      v-model="indicatorDataModel"
    />
  </div>

  <div class="output-container">
    <DataVisualization />
  </div>
  
</template>

<script setup>
import { reactive, watch } from 'vue';
import RankingEntidadesContratantesIncompletosInputs from './RankingEntidadesContratantesIncompletosInputs.vue';
import DataVisualization from '@/components/data-visualization/DataVisualization.vue';


const paramsInformacionIncompleta = [
  'monto',
  'fecha',
]

const provinciasDefaultSelect = [
  'A', 'B', 'F', 'C', 'H', 'X', 
  'O', 'E', 'W', 'G', 'I', 'L', 
  'R', 'M', 'S', 'N', 'D', 'Y', 
  'P', 'SE', 'SD', 'U', 'T', 'Z'
]

const userDateRangeQuery = {
  userDateQueryStart: {
    pickedYear: 2020,
    pickedMonth: 0,
    isDateRangeValid: true
  },
  userDateQueryEnd: {
    pickedYear: 2021,
    pickedMonth: 1,
    isDateRangeValid: true
  }
}

const indicatorDataModel = reactive(
  {
    paramsInformacionIncompletaValue: paramsInformacionIncompleta[0],
    provinciasSelectedValues: provinciasDefaultSelect,
    userDateRangeQuery: userDateRangeQuery
  }
)

watch(indicatorDataModel, () => {
  console.log('FROM THE THIRD INDICATOR', indicatorDataModel)
})


</script>

<style>

</style>