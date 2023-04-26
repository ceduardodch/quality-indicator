<template>
  <NumeroRegistros/>
  <RankingProveedores />
  <RankingEntidades />
  <RegistrosDiferencias />
</template>

<script setup>
import { onBeforeMount } from 'vue';
import NumeroRegistros from '../indicators-components/exactitud/numero-registros/NumeroRegistros.vue';
import RankingProveedores from '../indicators-components/exactitud/ranking-proveedores/RankingProveedores.vue';
import RankingEntidades from '../indicators-components/exactitud/ranking-entidades/RankingEntidades.vue';
import RegistrosDiferencias from '../indicators-components/exactitud/registros-diferencias/RegistrosDiferencias.vue';

onBeforeMount(() => console.log('Request to API from Exactitud'))
</script>

<style>

</style>