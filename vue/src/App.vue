<template>
  <q-layout view="lHr lpR lFr">
    <q-page-container>
      <q-page class="column flex-center">

        <div class="q-my-xl full-width">
          <h1 class="main-page__header text-center">
            Sistema de Indicadores de Calidad
          </h1>
        </div>

        <div class="q-mb-xl full-width row items-center">
          <q-banner class="main-page__banner full-width items-center">
            <template v-slot:avatar>
              <q-icon v-if="resize.width <= 425" name="menu" color="primary" size="md"/>
            </template>
            <template v-slot:default>
              <p class="text-center">Dimensiones de los Indicadores de Calidad</p>
            </template>
          </q-banner>
        </div>

        <div class="toggle-buttons__wrapper full-width flex-start q-gutter-md">
          <q-btn-toggle
          v-model="dimensions"
          toggle-color="primary"
          emit-value
          map-options
          flat
          spread
          :options="[
            {label: 'Completitud', value: 'completitud'},
            {label: 'Oportunidad', value: 'oportunidad'},
            {label: 'Exactitud', value: 'exactitud'},
            {label: 'Precisión', value: 'precision'}
          ]"
          />
        </div>

        <CompletitudPage v-if="dimensions==='completitud'"/>
        <ExactitudPage v-if="dimensions==='exactitud'"/>
        <OportunidadPage v-if="dimensions==='oportunidad'"/>
        <PrecisionPage v-if="dimensions==='precision'"/>
      
      </q-page>
    </q-page-container>
    
    
  </q-layout>
  <footer>
    <div class="footer__flag row no-wrap">
      <div class="flag__elem-1 col-4"></div>
      <div class="flag__elem-2 col-4"></div>
      <div class="flag__elem-3 col-4"></div>
    </div>
    <div class="footer__main_block q-pt-lg q-px-lg">
      <h2 class="text-center">Servicio Nacional de Contratación Pública</h2>
      <p class="text-center">Plataforma Gubernamental Financiera</p>
      <p class="text-center">Av. Amazonas entre Unión Nacional de Periodistas y Alfonso Pereira, Bloque Amarillo Piso 7</p>
      <p class="text-center">Quito - Ecuador</p>
      <p class="text-center">593-2 2440050 Teléfono: 1700-737267</p>
    </div>
    <div class="footer__supporters_block">
      
    </div>
  </footer>
  <q-resize-observer @resize="onResize" />
</template>

<script setup>
import { ref, watch } from 'vue'
import CompletitudPage from './components/dimensions_pages/CompletitudPage.vue'
import ExactitudPage from './components/dimensions_pages/ExactitudPage.vue';
import OportunidadPage from './components/dimensions_pages/OportunidadPage.vue';
import PrecisionPage from './components/dimensions_pages/PrecisionPage.vue';

const dimensions = ref('completitud')
const resize = ref(0)
const onResize = function (size) {
  resize.value = size
}

watch(dimensions, () => {
  console.log(dimensions.value)
})

</script>

<style scoped>

  .main-page__header {
    margin: 0;
    font-size: 3vh;
    color:#0066c0;
    font-weight: bold;
    line-height: 1.5;
  }

  .main-page__banner {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 7vh;
    background-color: #f8f8f8;
  }

  .main-page__banner p {
    margin: 0;
    font-size: 2.5vh;
    font-weight: 300;
    color: #5c5b5e;
  }

  .q-btn {
    padding: 0 !important;
  }

  .q-btn-group {
    margin: 0;
  }

  footer {
    width: 100%
  }
  .footer__flag {
    height: 15px;
  }

  .flag__elem-1 {
    background-color: #ffce2d;
  }

  .flag__elem-2, .footer__main_block {
    background-color: #0555b5;
  }
  .flag__elem-3 {
    background-color: #e7302d;
  }

  .footer__main_block {
    height: 25vh;
    display: flex;
    flex-direction: column;
  }

  .footer__main_block h2 {
    color: white;
    font-size: 2vh;
    font-weight: 700;
    line-height: 1.4;
  }

  .footer__main_block p {
    color: white;
    margin: 0;
    font-weight: 300;
  }


  @media only screen and (max-width: 620px) {
    
    .q-page {
      padding: 5% 5%;
    }

    .q-btn-group {
      display: flex;
      flex-direction: column;
      justify-items: stretch;
    }
    .q-btn {
      width: 100%;
    }
  }
</style>
