<template>
    <p class="selector-label">Provincia</p>
    <q-select
      :options="ecProvincias"
      v-model="localModel"
      :rules="[ selectAtLeastOne ]"
      multiple
      emit-value
      map-options
      dropdown-icon="expand_more"
      menu-anchor='top middle'
      menu-self="bottom middle"
      use-chips
      filled
      options-dense
      style="width: 100% !important"
      :input-style="{ backgroundColor: '#f8f8f8' }"
      behavior: menu
      menu-shrink

      @popup-show="popupStateToggle(true)"
      @popup-hide="popupStateToggle(false)"
      @update:model-value="profileSelected()"
    >
    
      <template v-slot:prepend>
        <q-chip 
          size="md" 
          color="primary" 
          text-color="white" 
          v-if="localModel.length > 0"
        >
        {{localModel.length}}
        </q-chip>
      </template>

      <template #before-options>
        <q-item>
          <q-item-section side>
            <q-checkbox 
              v-model="all" 
              @update:model-value="pickAll()"
              checked-icon="radio_button_checked"
              unchecked-icon="radio_button_unchecked"
            />
          </q-item-section>
          <q-item-section>
            <q-item-label>Todas</q-item-label>
          </q-item-section>
        </q-item>
      </template>

      <template v-slot:option="{ itemProps, opt, selected, toggleOption }">
        <q-item dense v-bind="itemProps">
          <q-item-section side>
            <q-checkbox 
              :model-value="selected" 
              @update:model-value="toggleOption(opt)"
              checked-icon="radio_button_checked"
              unchecked-icon="radio_button_unchecked"
            />
          </q-item-section>
          <q-item-section>
            <q-item-label v-html="opt.label" />
          </q-item-section>
        </q-item>
      </template>

      <template v-slot:append>
        <div class="flex">
          <div class="icon-wrapper q-pa-sm">
            <q-icon 
              v-if="localModel.length > 0" 
              @click.stop="clearProvinciasChoise()" 
              name="close" 
              size="md" 
              color="primary" 
              class="cursor-pointer" 
            />
          </div>
          <div class="icon-wrapper  q-pa-sm">
            <q-icon 
              v-if="localModel.length > 0 && isPopupShow" 
 
              v-close-popup="-1" 
              name="done" 
              size="md" 
              color="primary" 
              class="cursor-pointer" 
            />
          </div>
        </div>
      </template>

    </q-select>
</template>

<script setup>
import { ref, computed, defineProps, defineEmits } from 'vue'


  const props = defineProps({
    'modelValue': Object
  })

  const emit = defineEmits(['update:modelValue'])
  
  const localModel = computed({
    get: () => props.modelValue,
    set: (value) => {
      emit("update:modelValue", value)
    },
  })

  const ecProvincias = [
    { label: 'Azuay', value: 'A' },
    { label: 'Bolívar', value: 'B' },
    { label: 'Cañar', value: 'F' },
    { label: 'Carchi', value: 'C' },
    { label: 'Chimborazo', value: 'H' },
    { label: 'Cotopaxi', value: 'X' },
    { label: 'El Oro', value: 'O' },
    { label: 'Esmeraldas', value: 'E' },
    { label: 'Galápagos', value: 'W' },
    { label: 'Guayas', value: 'G' },
    { label: 'Imbabura', value: 'I' },
    { label: 'Loja', value: 'L' },
    { label: 'Los Ríos', value: 'R' },
    { label: 'Manabí', value: 'M' },
    { label: 'Morona Santiago', value: 'S' },
    { label: 'Napo', value: 'N' },
    { label: 'Orellana', value: 'D' },
    { label: 'Pastaza', value: 'Y' },
    { label: 'Pichincha', value: 'P' },
    { label: 'Santa Elena', value: 'SE' },
    { label: 'Santo Domingo de los Tsáchilas', value: 'SD' },
    { label: 'Sucumbíos', value: 'U' },
    { label: 'Tungurahua', value: 'T' },
    { label: 'Zamora Chinchipe', value: 'Z' },
  ]

  const all = ref(true)

  let isPopupShow = ref(false)

  const pickAll = function(){
    if(this.all){
      this.localModel = this.ecProvincias;
      this.profileSelected()
      return
    }
    this.clearProvinciasChoise()
  }

  const profileSelected = function(){
    if (this.localModel.length === ecProvincias.length) {
      this.all = true
    } else {
      this.all = false
    }
  }

  const clearProvinciasChoise = function() {
    this.all = false
    this.localModel = []
    this.profileSelected()
  }

  const popupStateToggle = function(state) {
    this.isPopupShow = state;
  }

  const selectAtLeastOne = function(val) {
    if (val.length < 1) {
      return 'Seleccione al menos una provincia'
    }
  }
</script>

<style scoped>

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

/* province_selector .q-field {
  width: 30vw !important;
} */

@media only screen and (max-width: 620px) {

  .single-selector__wrapper {
    width: 100% !important;
  }
}

.q-field {
  max-height: 50vh !important;
  overflow-y: scroll;
  -ms-overflow-style: none;
  scrollbar-width: none;
}
.q-field::-webkit-scrollbar {
  display: none;
}

.scroll {
  max-height: 40vh;
  overflow-y: scroll;
}

.q-chip__content .ellipsis {
  font-size: 1.5vh;
}

</style>