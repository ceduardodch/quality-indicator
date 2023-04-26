<template>
  <div class="pickers_wrapper row wrap q-py-md justify-between">
    
    <div class="single_picker_wrapper col-auto q-ma-none q-mt-md">
      <YearMonthPicker 
        :startYearOfPeriod=possibleStartYearOfPeriod
        :endYearOfPeriod=possibleEndYearOfPeriod
        v-model="localModel.userDateQueryStart" 
      />
    </div>

    <div class="single_picker_wrapper col-auto q-ma-none q-mt-md">
      <YearMonthPicker 
        :startYearOfPeriod=possibleStartYearOfPeriod
        :endYearOfPeriod=possibleEndYearOfPeriod
        v-model="localModel.userDateQueryEnd" 
      />
    </div>

  </div>
</template>

<script setup>
import { ref, computed, watchEffect, defineProps, defineEmits } from 'vue'
import YearMonthPicker from './YearMonthPicker.vue';

  const props = defineProps({
    startYearOfPeriod: Number,
    endYearOfPeriod: Number,
    modelValue: Object
  }) 

  const emit = defineEmits(['update:modelValue'])
  
  const localModel = computed({
    get: () => props.modelValue,
    set: (value) => {
      emit("update:modelValue", value)
    },
  })
  
  const possibleStartYearOfPeriod = ref(props.startYearOfPeriod)
  const possibleEndYearOfPeriod = ref(props.endYearOfPeriod)
    

  const checkDateRangeValid = function() {
    const startDateObject = new Date(localModel.value.userDateQueryStart.pickedYear, localModel.value.userDateQueryStart.pickedMonth, 1, 0, 0, 0, 0)
    const endDateObject = new Date(localModel.value.userDateQueryEnd.pickedYear, localModel.value.userDateQueryEnd.pickedMonth + 1, 0, 0, 0, 0, 0)
    if (startDateObject <= endDateObject) {
      localModel.value.userDateQueryStart.isDateRangeValid = true
      localModel.value.userDateQueryEnd.isDateRangeValid = true
    } else {
      localModel.value.userDateQueryStart.isDateRangeValid = false
      localModel.value.userDateQueryEnd.isDateRangeValid = false
    }
  }

  watchEffect(() => {
    checkDateRangeValid()
  })

</script>

<style>

.single_picker_wrapper {
  width: 47% !important;
  flex: 2 1 auto;
}

@media only screen and (max-width: 620px) {

  .single_picker_wrapper {
    width: 100% !important;
  }
}

</style>