<template>
  <ContrasteDeRegistros />
</template>
  
<script setup>
import { onBeforeMount } from 'vue';
import ContrasteDeRegistros from '../indicators-components/oportunidad/contraste-de-registros/ContrasteDeRegistros.vue';
  
onBeforeMount(() => console.log('Request to API from Oportunidad'))
</script>

<style>

</style>