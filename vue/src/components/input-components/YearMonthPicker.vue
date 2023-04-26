<template>
  <div class="monthpicker">
    <q-field
      v-model="localModel"
      class="cursor-pointer"
      filled
      :error="!localModel.isDateRangeValid"
      :error-message="'La fecha de Inicio del período debe ser anterior a la fecha de finalización del período'"
    >
      <template v-slot:default>
        <div 
          class="self-center q-pa-sm full-width no-outline" 
          tabindex="0"
        >
          {{monthsList[localModel.pickedMonth].nameLong}} {{localModel.pickedYear}}
        </div>
        <q-menu cover class="">
            <div class="monthpicker__header z-max">
              <q-btn
                @click="changeYear('decrYear')"
                :disable="isYearChangeDisabled('decrYear')"
                dense
                flat
                :icon="getIconName('decr')"
                size="lg"
                round
              />
              <div class="pickedYearIndicator">
                {{localModel.pickedYear}}
              </div>
              <q-btn
                @click="changeYear('incrYear')"
                :disable="isYearChangeDisabled('incrYear')"
                dense
                flat
                :icon="getIconName('incr')"
                size="lg"
                round
              />
            </div>
            <div class="monthpicker__monthtable z-max">
                <q-btn
                  v-for="month in monthsList"
                  :key="month"
                  :disable="isMonthDisabled(month.value)"
                  :push="isMonthSelected(month.value)"
                  :flat="!isMonthSelected(month.value)"
                  :color="isMonthSelected(month.value) ? 'primary': 'standart'"
                  :text-color="isMonthSelected(month.value) ? 'white': 'black'"
                  @click="selectMonth(month.value)"
                  no-caps
                  no-outline
                  no-ripple
                >
                  {{month.label}}
                </q-btn>
            </div>
        </q-menu>
      </template>
      <template v-slot:append>
        <q-icon name="event" class="cursor-pointer" />
      </template>
    </q-field>
  </div>
  <q-resize-observer @resize="onResize" />
</template>

<script setup>
  import { ref, computed, defineProps, defineEmits } from 'vue'

  const props = defineProps({
    startYearOfPeriod: Number,
    endYearOfPeriod: Number,
    isDateRangeValid: Boolean,
    modelValue: Object,
  }) 

  const emit = defineEmits(['update:modelValue'])
  
  const localModel = computed({
    get: () => props.modelValue,
    set: (value) => {
      emit("update:modelValue", value)
    },
  })
  
  const currentYear = new Date().getFullYear()
  const currentMonth = new Date().getMonth()

  const monthsList = [
    {label: 'Ene', nameLong: 'Enero', value: 0},
    {label: 'Feb', nameLong: 'Febrero', value: 1},
    {label: 'Mar', nameLong: 'Marzo', value: 2},
    {label: 'Abr', nameLong: 'Abril', value: 3},
    {label: 'May', nameLong: 'Mayo', value: 4},
    {label: 'Jun', nameLong: 'Junio', value: 5},
    {label: 'Jul', nameLong: 'Julio', value: 6},
    {label: 'Ago', nameLong: 'Agosto', value: 7},
    {label: 'Sep', nameLong: 'Septiembre', value: 8},
    {label: 'Oct', nameLong: 'Octubre', value: 9},
    {label: 'Nov', nameLong: 'Noviembre', value: 10},
    {label: 'Dic', nameLong: 'Diciembre', value: 11},
  ]

  const resize = ref(0)

  const onResize = function (size) {
    resize.value = size
  }

  const getIconName = function(buttonType) {
    if (buttonType === 'decr') {
      if (resize.value.width  < 338) {
        return 'expand_less'
      } else {
        return 'navigate_before'
      }
    } else if (buttonType === 'incr') {
      if (resize.value.width  < 338) {
        return 'expand_more'
      } else {
        return 'navigate_next'
      }
    }
  }

  const changeYear = function (arg) {
    if (arg === 'decrYear') {
      localModel.value.pickedYear -=1
    } else if (arg === 'incrYear') {
      localModel.value.pickedYear +=1
    }
  }

  const selectMonth = function(val) {
    this.localModel.pickedMonth = val
  }

  const isMonthSelected = function(val) {
    if (val === this.localModel.pickedMonth) {
      return true
    }
    return false
  }

  const isMonthDisabled = function(val) {
    if (this.localModel.pickedYear === currentYear && val === currentMonth) {
      return true
    }
    return false
  }

  const isYearChangeDisabled = function(action) {
    if (action === 'incrYear') {
      if (localModel.value.pickedYear === currentYear) {
        return true
      }
      return false
    } else if (action === 'decrYear') {
      if (localModel.value.pickedYear <= props.startYearOfPeriod ) {
        return true
      }
      return false
    }
  }  

</script>

<style scoped>
	.monthpicker {
		width: 20vw;
	}

  /* PROBLEM WITH SIZE OF MENU WHEN SCREEN SIZE IS MOBILE M */

  .q-menu {
    width: 30vw
  }

  .monthpicker__header {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
		margin-bottom: 8px;
	}

  @media only screen and (max-width: 840px) {
    .monthpicker {
      width: 30vw;
    }

    .q-menu {
      width: 40vw;
    }
  }
	
  @media only screen and (max-width: 620px) {
    .monthpicker {
      width: 50vw;
    }

    .q-menu {
      width: 40vw;
    }
  }

  @media only screen and (max-width: 374px) {
    .monthpicker__header {
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      margin-bottom: 8px;
    }
  }

  .pickedYearIndicator {
    display: flex;
    justify-content: center;
    align-items: center;
    font-weight: bold;
    font-size: 2rem;
  }

  .monthpicker__monthtable {
		display: flex;
		justify-content: space-between;
		flex-wrap: wrap;
	}

  .monthpicker__monthtable .q-btn {
		box-shadow: none;
		margin: 4px 0;
		width: 30%;
	}

  .month_selected {
    font-weight: bold;
  }

</style>