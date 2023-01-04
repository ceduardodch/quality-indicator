<template>

  <div class="indicator-title q-my-xl full-width">
    <h4>Porcentaje de registros con información incompleta</h4>
  </div>
  
  <div class="form-container">
    <PorcentajeIncompletaInputs 
      v-model="indicatorDataModel"
    />
  </div>

  <div class="output-container">
    <DataVisualization />
  </div>
  
</template>

<script setup>
import { reactive, defineProps, toRaw, watchEffect } from 'vue';
import PorcentajeIncompletaInputs from './PorcentajeIncompletaInputs.vue';
import DataVisualization from '../../../data-visualization/DataVisualization.vue';

const props = defineProps({
  dataIndicator: Object
})


const paramsInformacionIncompleta = [
  'monto',
  'fecha',
]

const processFases = [
  'planificacion', 
  'licitacion', 
  'adjudicacion', 
  'contractual'
]

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
    pickedYear: 2018,
    pickedMonth: 11,
    isDateRangeValid: true
  }
}

const getArrayFromInterval = (start, stop, step) => 
  Array.from({ length: (stop - start) / step + 1}, (_, i) => start + (i * step))


  
const indicatorDataModel = reactive(
  {
    paramsInformacionIncompletaValue: paramsInformacionIncompleta[0],
    processFasesSelectedValue: processFases[0],
    provinciasSelectedValues: provinciasDefaultSelect,
    userDateRangeQuery: userDateRangeQuery
  }
)
    
const dataFilter = function(){
  
  const dataIndicator = toRaw(props.dataIndicator)

  let yearsArray = getArrayFromInterval(
    indicatorDataModel.userDateRangeQuery.userDateQueryStart.pickedYear,
    indicatorDataModel.userDateRangeQuery.userDateQueryEnd.pickedYear,
    1 
  ).map(elem => elem.toString())


  const result = dataIndicator[indicatorDataModel.processFasesSelectedValue]

  const result2 = Object.keys(result)
	.filter(key => indicatorDataModel.provinciasSelectedValues.includes(key))
	.reduce((obj, key) => {
		obj[key] = result[key];
		return obj;
  }, {});

  for (let provincia in result2) {
    const filteredYears = Object.keys(result2[provincia])
    .filter(key => yearsArray.includes(key.toString()))
    .reduce((obj, key) => {
      obj[key] = result2[provincia][key];
      return obj;
    }, {})

    result2[provincia] = filteredYears
  }

  const result3 = JSON.parse(JSON.stringify(result2))

  for (let provincia in result2) {
    for (let year in result2[provincia]) {
      for (let month in result2[provincia][year]) {
        if (indicatorDataModel.paramsInformacionIncompletaValue === 'monto'){
          result3[provincia][year][month] = result2[provincia][year][month][0]
        } else if (indicatorDataModel.paramsInformacionIncompletaValue === 'fecha') {
          result3[provincia][year][month] = result2[provincia][year][month][1]
        }
      }
    }
  }

  console.log('data prop', result3)
}



watchEffect(() => {
  dataFilter()
}
)

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