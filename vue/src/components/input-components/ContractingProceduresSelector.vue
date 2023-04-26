<template>
  <q-select
    :options="contractingProceduresOptions"
    v-model="localModel"
    emit-value
    map-options
    filled
    dropdown-icon="expand_more"
    style="width: 100% !important"
    options-dense
    :input-style="{ backgroundColor: '#f8f8f8' }"
    behavior: menu
    menu-shrink
    menu-anchor='top middle'
    menu-self="bottom middle"
  />
</template>

<script setup>
import { computed, defineProps, defineEmits } from 'vue';


const props = defineProps({
  modelValue: String
})

const emit = defineEmits(['update:modelValue'])
  
const localModel = computed({
  get: () => props.modelValue,
  set: (value) => {
    emit("update:modelValue", value)
  },
})

  const contractingProceduresOptions = [
    { label: 'Asesoría y Patrocinio Jurídico', value: 'asesoria_y_patrocinio_juridico' },
    { label: 'Asesoría y Patrocinio Jurídico – Cons. puntuales y específicas', value: 'asesoria_y_patrocinio_juridico_cons_puntuales_y_especificas' },
    { label: 'Bienes y Servicios únicos', value: 'bienes_y_servicios_unicos' },
    { label: 'Comunicación Social – Contratación Directa', value: 'comunicacion_social_contratacion_directa' },
    { label: 'Comunicación Social – Proceso de Selección', value: 'comunicacion_social_proceso_de_seleccion' },
    { label: 'Concurso publico', value: 'concurso_publico' },
    { label: 'Concurso Público por Contratación Directa Desierta', value: 'concurso_publico_por_contratacion_desierta' },
    { label: 'Concurso Público por Lista Corta Desierta', value: 'concurso_publico_por_lista_corta_desierta' },
    { label: 'Cont. de Instituciones Financieras y de Seguros del Estado', value: 'cont_de_instituciones_financieras_y_de_seguros_del_estado' },
    { label: 'Contratación de Seguros', value: 'contratacion_de_seguros' },
    { label: 'Contratacion directa', value: 'contratacion_directa' },
    { label: 'Contratación Directa por Terminación Unilateral', value: 'contratacion_directa_por_terminacion_unilateral' },
    { label: 'Contrataciones con empresas públicas internacionales', value: 'contrataciones_con_empresas_publicas_internacionales' },
    { label: 'Contratos entre Entidades Públicas o sus subsidiarias', value: 'contratos_entre_entidades_publicas_o_sus_subsidiarias' },
    { label: 'Convenio Marco', value: 'convenio_marco' },
    { label: 'Cotización', value: 'cotizacion' },
    { label: 'Empresas Públicas, Mercantiles o Subsidiarias', value: 'empresas_publicas_mercantiles_o_subsidiarias' },
    { label: 'Licitación', value: 'licitacion' },
    { label: 'Licitación de Seguros', value: 'licitacion_de_seguros' },
    { label: 'Lista corta', value: 'lista_corta' },
    { label: 'Lista Corta por Contratación Directa Desierta', value: 'lista_corta_por_contratacion_directa_desierta' },
    { label: 'Menor Cuantía', value: 'menor_cuantia' },
    { label: 'Obra artística, científica o literaria', value: 'obra_artistica_cientifica_o_literaria' },
    { label: 'Repuestos o Accesorios', value: 'repuestos_o_accesorios' },
    { label: 'Sectores Estratégicos', value: 'sectores_estrategicos' },
    { label: 'Subasta Inversa Electrónica', value: 'subasta_inversa_electronica' },
    { label: 'Transporte de correo interno o internacional', value: 'transporte_de_correo_interno_o_internacional' },
  ];
</script>

<style>
.selector-label {
  font-size: 1.8vh;
  font-weight: 300;
}

.q-field__control {
  border-radius: 15px !important;
}

i.q-select__dropdown-icon {
  font-size: 5vh;
  color: blue;
}

</style>