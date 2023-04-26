<template>
  <div class="data-visualization__container">
    <div class="data-visualization__title-wrapper">
      <h6 class="data-visualization__title">{{subtitle}}</h6>
    </div>
    <div class="data-visualization__flex-wrapper row justify-start q-gutter-md">
      <div class="data-visualization__color-map-container">
        <colorMap />
      </div>
      <div class="data-visualization__chart-container">
        <!-- <gchart /> -->
      </div>
    </div>
    <div class="data-visualization__container__footer row items-center justify-between">
      <p class="info-source">Fuente: Lorem ipsum dolor sit, amet consectetur adipisicing elit.</p>
      <div class="buttons-wrapper .col-md-4 row q-pa-md q-gutter-sm">
        <q-btn padding="10px" rounded push color="primary" icon="file_download" label="Metodologia" />
        <q-btn padding="10px" rounded push color="primary" icon="insert_chart_outlined" label="Grafico">
          <q-menu self="bottom left" style="width: 150px" auto-close>
            <q-list style="width: 150px">
              <q-item clickable>
                <q-item-section>Impresión</q-item-section>
              </q-item>
              <q-item clickable>
                <q-item-section>Descarga PNG</q-item-section>
              </q-item>
              <q-item clickable>
                <q-item-section>Descarga JPG</q-item-section>
              </q-item>
              <q-item clickable>
                <q-item-section>Documento PDF</q-item-section>
              </q-item>
              <q-item clickable>
                <q-item-section>Archivo XLS, CSV</q-item-section>
              </q-item>
              <q-item clickable>
                <q-item-section>Visualización de datos en forma tabular</q-item-section>
              </q-item>
            </q-list>
          </q-menu>
        </q-btn>
      </div>
    </div>
  </div>
</template>

<script>
import colorMap from './data-visualization-components/ColorMap.vue'
// import gchart from './data-visualization-components/GoogleChart.vue'
export default {
  data (){
    return {
      subtitle: 'Subtitulo Dinamico'
    }
  },
  components: {
    colorMap,
    // gchart
  }
}
</script>

<style scoped>

  /* .data-visualization__container {
    min-width: 80vw;
  } */

  /* .data-visualization__flex-wrapper {
    max-height: 50vh;
  } */

  .q-btn {
    border-radius: 10px;
  }
  .data-visualization__color-map-container, .data-visualization__chart-container {
    flex: 2 1 auto;
    border: 1px solid blue;
    /* height: 34vh !important; */
    min-width: 30vw;
    max-width: 100%;
  }

  .data-visualization__chart-container {
    /* width: 600px; */
    /* height: 100%; */
  }

  .info-source {
    margin: 0;
    font-size: 15px;
  }

</style>