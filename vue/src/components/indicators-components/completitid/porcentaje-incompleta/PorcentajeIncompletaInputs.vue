<template>

  <div class="row wrap q-ma-none q-my-md q-py-lg justify-between items-center radio-buttons-group__wrapper">
    
    <div class="radio-buttons-group__label q-py-md">
      <p>Parámetros información incompleta</p>
    </div>

    <div class="radio-buttons-group__background q-pa-sm">
      <q-option-group
        type="radio"
        :options="paramsInformacionIncompletaOptions"
        v-model="localModel.paramsInformacionIncompletaValue"
        inline
        emit-value
      />
    </div>

  </div>

  <div class="indicator-description">
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis facere hic laudantium dolor dicta adipisci quisquam ipsa. Ad odit ut id quidem! Eos, nulla laboriosam commodi dignissimos adipisci amet numquam.</p>
  </div>
  
  <div class="selectors__wrapper row wrap justify-between q-py-md">
    
    <div class="single-selector__wrapper fase_selector col-auto q-ma-none q-mt-md">
      <p class="selector-label">Fase del proceso</p>
      <q-select
        :options="processFasesOptions"
        v-model="localModel.processFasesSelectedValue"
        emit-value
        map-options
        dropdown-icon="expand_more"
        fill-input
        filled
        style="width: 100% !important"
        :input-style="{ backgroundColor: '#f8f8f8' }"
      />
    </div>

    <div class="single-selector__wrapper fase_selector col-auto q-ma-none q-mt-md">
      <ProvinceSelector 
        v-model="localModel.provinciasSelectedValues"
      />
    </div>
  
  </div>

  <DateRangeSelector 
    :startYearOfPeriod=2013
    :endYearOfPeriod=2022
    v-model="localModel.userDateRangeQuery" 
  />

</template>

<script setup>
import { computed, defineProps, defineEmits } from 'vue'
import ProvinceSelector from '../../../input-components/ProvinceSelector.vue'
import DateRangeSelector from '../../../input-components/DateRangeSelector.vue'

const props = defineProps({
  modelValue: Object
})

const emit = defineEmits(['update:modelValue'])

const localModel = computed({
  get: () => props.modelValue,
  set: (value) => {
    emit("update:modelValue", value)
  },
})

const paramsInformacionIncompletaOptions = [
  { label: 'Monto', value: 'monto' },
  { label: 'Fecha', value: 'fecha' },
]

const processFasesOptions = [
  { label: 'Planning (planificación)', value: 'planificacion' },
  { label: 'Tender (licitación)', value: 'licitacion' },
  { label: 'Awards (adjudicación)', value: 'adjudicacion' },
  { label: 'Contracts (contractual)', value: 'contractual' },
];


</script>

<style>

.indicator-description p {
  font-size: 2vh;
  font-weight: 300;
}

.selector-label {
  font-size: 1.8vh;
  font-weight: 300;
}

.single-selector__wrapper {
  width: 47% !important;
  flex: 2 1 auto;
}
  
.q-field__control {
  border-radius: 15px !important;
}

i.q-select__dropdown-icon {
  font-size: 5vh;
  color: blue;
}

.radio-buttons-group__label p {
  margin: 0;
  font-style: italic;
  font-size: 3vh;
}

.radio-buttons-group__background {
  background-color: #f8f8f8;
  border-radius: 10px;
  min-width: 50%;
}

@media only screen and (max-width: 620px) {
  .radio-buttons-group__background {
    width: 100%;
  }

  .single-selector__wrapper {
    width: 100% !important;
  }
}

</style>