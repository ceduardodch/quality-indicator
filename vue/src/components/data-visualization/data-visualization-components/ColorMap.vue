<template>
    <div id="svg-container" class="svg-container">
        <svg
            id="chart"
            class="svg-content"
            viewBox="0 0 1400 1000"
            preserveAspectRatio="xMidYMid meet"
            pointer-events="auto"
            clipPathUnits="objectBoundingBox"
        >
            <g class="regions">>
                <path
                    v-for="region in regions" :key="region"
                    :id="region.id"
                    :title="region.title"
                    :d="region.d"
                    class="land"
                    pointer-events="all"
                    style="cursor: pointer;"
                    @mouseover="getInfo"
                >
                  <title>Name - {{ regionTitle }} </title>
                </path>
            </g>
        </svg>
    </div>
</template>

<script>
import { ecuadorRegions as ecRegions } from '../../../assets/ecuador'
export default {
  data () {
    const mapColors = {
      1: '#cee1f2',
      2: '#b4d2ed',
      3: '#82b4e0', 
      4: '#3485cc', 
      5: '#0066c0', 
    }

    const colorPaletteRank3 = ['#deebf7','#9ecae1','#3182bd']
    const colorPaletteRank4 = ['#eff3ff','#bdd7e7','#6baed6','#2171b5']
    const colorPaletteRank5 = ['#eff3ff','#bdd7e7','#6baed6','#3182bd','#08519c']
    const colorPaletteRank6 = ['#eff3ff','#c6dbef','#9ecae1','#6baed6','#3182bd','#08519c']
    const colorPaletteRank7 = ['#eff3ff','#c6dbef','#9ecae1','#6baed6','#4292c6','#2171b5','#084594']
    const colorPaletteRank8 = ['#f7fbff','#deebf7','#c6dbef','#9ecae1','#6baed6','#4292c6','#2171b5','#084594']
    const colorPaletteRank9 = ['#f7fbff','#deebf7','#c6dbef','#9ecae1','#6baed6','#4292c6','#2171b5','#08519c','#08306b']

    return {
      mapColors,
      colorPaletteRank3,
      colorPaletteRank4,
      colorPaletteRank5,
      colorPaletteRank6,
      colorPaletteRank7,
      colorPaletteRank8,
      colorPaletteRank9,
      id: '',
      regionTitle: null,
      regions: ecRegions
    }
  },
  methods: {
    getInfo (e) {
      this.regionTitle = this.regions.filter(x => e.target.id === x.id)[0].title
    }
  }
}
</script>

<style scoped>

.svg-container {
    display: block;
    /* position: relative; */
    /* vertical-align: top; */
    overflow: visible;
    height: 100%;
    width: 100%;
    /* resize: both; */
}
.svg-content {
    width: 95%;
    height: 95%;
    stroke-linecap: round;
    stroke-linejoin: round;
}

path {
  fill: #e0c9c9;
  cursor: pointer;
  -webkit-transition: all 150ms;
  -moz-transition: all 150ms;
  -o-transition: all 150ms;
  transition: all 150ms;
}

path#ECU1267, path#ECU1269 {
    fill:blue;
}

path:hover {
  opacity: 0.85;
}
.land {
  fill-opacity: 1;
  stroke: black;
  stroke-opacity: 1;
  stroke-width: 0.9;
}

</style>
