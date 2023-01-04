<template>
    <PorcentajeIncompleta
      v-if="isFetched"
      :dataIndicator="res.porcentaje_incompleta"
    />
    <PorcentajeIncompletaAdjudicacion
      v-if="isFetched" 
      />
      <!-- :dataIndicator="res.porcentaje_incompleta_adjudicacion" -->
      <RankingEntidadesContratantesIncompletos
      v-if="isFetched"
      />
      <!-- :dataIndicator="res.ranking_entidades_contratantes_incompletos"  -->
    <RankingEntidadesContratantesIncompletosPorProcedimiento
      v-if="isFetched"
      :dataIndicator="res.ranking_entidades_contratantes_incompletos_por_procedimiento"  
    />
  </template>
  
  <script setup>
  import { onBeforeMount, ref } from 'vue'

  import fetchData from '../../composables/fetchData' 

  import PorcentajeIncompleta from '../indicators-components/completitid/porcentaje-incompleta/PorcentajeIncompleta.vue';
  import PorcentajeIncompletaAdjudicacion from '../indicators-components/completitid/porcentaje-incompleta-adjudicacion/PorcentajeIncompletaAdjudicacion.vue';
  import RankingEntidadesContratantesIncompletos from '../indicators-components/completitid/ranking-entidades-contratantes-incompletos/RankingEntidadesContratantesIncompletos.vue';
  import RankingEntidadesContratantesIncompletosPorProcedimiento from '../indicators-components/completitid/ranking-entidades-contratantes-incompletos-por-procedimiento/RankingEntidadesContratantesIncompletosPorProcedimiento.vue';
  
  const url = 'http://localhost:3000/completitud'
  
  let res = ref({})
  let isFetched = ref(false)
  
  onBeforeMount(async() => {
    await fetchData(url).then((data) => res.value = data).then(() => isFetched.value = true)
    console.log(res.value)
  })
  
  </script>
  
  <style scoped>
  
  </style>