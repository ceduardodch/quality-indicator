export const chartType = 'ColumnChart';

export const chartData = [
  ['Mes', 'Percentaje (%) de registros con informacion incompleta'],
  ['Ene', 20],
  ['Feb', 32],
  ['Mar', 43],
  ['Abr', 15],
  ['May', 44],
  ['Jun', 9],
  ['Jul', 20],
  ['Ago', 7],
  ['Sep', 16],
  ['Oct', 41],
  ['Nov', 27],
  ['Dic', 3],
];

export const chartOptions = {
  // title: 'Percentaje (%) de registros con informacion incompleta',
  vAxis: {viewWindowMode: 'maximized'},
  legend: {
    position: 'bottom',
    alignment: 'center'
  },
  height: 400,
  
  // axisTitlesPosition: 'out'
  
//   width: 800,
//   height: 100%,
};