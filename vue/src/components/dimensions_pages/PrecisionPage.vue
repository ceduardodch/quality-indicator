<template>
  <VariabilidadMonto />
  <MontoLicitado />
  <MontoAdjudicado />
</template>

<script setup>
import { onBeforeMount } from 'vue';
import VariabilidadMonto from '../indicators-components/precision/variabilidad-monto/VariabilidadMonto.vue';
import MontoLicitado from '../indicators-components/precision/monto-licitado/MontoLicitado.vue';
import MontoAdjudicado from '../indicators-components/precision/monto-adjudicado/MontoAdjudicado.vue';

onBeforeMount(() => console.log('Request to API from Precision'))
</script>


<style>

</style>