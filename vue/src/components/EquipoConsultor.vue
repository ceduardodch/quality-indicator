<template>

    <div class="indicator-title q-my-xl full-width">
      <h4>{{title}}</h4>
    </div>
    
    <div class="form-container">
      <InputForm />
    </div>

    <div class="output-container">
      <DataVisualization />
    </div>

    
</template>

<script>
import DataVisualization from './data-visualization/DataVisualization.vue';
import InputForm from './input-form/InputForm.vue';
export default {
  name: 'EquipoConsultor',
  components: {
    InputForm,
    DataVisualization
  },
  setup() {
    const title = 'Porcentaje de registros con información incompleta'

    return {
      title,
    }
  },
}
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