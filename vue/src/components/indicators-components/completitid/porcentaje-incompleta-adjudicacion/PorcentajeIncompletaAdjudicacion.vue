<template>
  
  <div class="indicator-title q-my-xl full-width">
    <h4>Porcentaje de registros con información incompleta por tipo de procedimiento de contratación en la fase de adjudicación</h4>
  </div>
  
  <div class="form-container">
    <PorcentajeIncompletaAdjudicacionInputs 
      v-model="indicatorDataModel"
    />
  </div>

  <div class="output-container">
    <DataVisualization />
  </div>

</template>
  
<script setup>
import { reactive, watch } from 'vue';
import PorcentajeIncompletaAdjudicacionInputs from './PorcentajeIncompletaAdjudicacionInputs.vue';
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
    pickedYear: 2018,
    pickedMonth: 2,
    isDateRangeValid: true
  },
  userDateQueryEnd: {
    pickedYear: 2019,
    pickedMonth: 1,
    isDateRangeValid: true
  }
}

const contractingProcedures = [
  'asesoria_y_patrocinio_juridico',
  'asesoria_y_patrocinio_juridico_cons_puntuales_y_especificas',
  'bienes_y_servicios_unicos',
  'comunicacion_social_contratacion_directa',
  'comunicacion_social_proceso_de_seleccion',
  'concurso_publico',
  'concurso_publico_por_contratacion_desierta',
  'concurso_publico_por_lista_corta_desierta',
  'cont_de_instituciones_financieras_y_de_seguros_del_estado',
  'contratacion_de_seguros',
  'contratacion_directa',
  'contratacion_directa_por_terminacion_unilateral',
  'contrataciones_con_empresas_publicas_internacionales',
  'contratos_entre_entidades_publicas_o_sus_subsidiarias',
  'convenio_marco',
  'cotizacion',
  'empresas_publicas_mercantiles_o_subsidiarias',
  'licitacion',
  'licitacion_de_seguros',
  'lista_corta',
  'lista_corta_por_contratacion_directa_desierta',
  'menor_cuantia',
  'obra_artistica_cientifica_o_literaria',
  'repuestos_o_accesorios',
  'sectores_estrategicos',
  'subasta_inversa_electronica',
  'transporte_de_correo_interno_o_internacional',
];


const indicatorDataModel = reactive(
  {
    paramsInformacionIncompletaValue: paramsInformacionIncompleta[0],
    contractingProceduresSelectedValue: contractingProcedures[2],
    provinciasSelectedValues: provinciasDefaultSelect,
    userDateRangeQuery: userDateRangeQuery
  }
)

watch(indicatorDataModel, () => {
  console.log('FROM THE SECOND INDICATOR', indicatorDataModel)
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