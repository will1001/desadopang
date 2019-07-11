<template>
  <div class="small">
    <line-chart :chart-data="datacollection" ref="lineChart"></line-chart>
    <button @click="fillData()">Randomize</button>
    <button @click="saveImage('lineChart')">Save Image!</button>
    <img src="" alt="">
  </div>
</template>

<script>

  import LineChart from './LineChart.js'

  export default {
    components: {
      LineChart
    },
    data () {
      return {
        datacollection: null,
        
      }
    },
    mounted () {
      this.fillData()
    },
    methods: {
      fillData () {
        this.datacollection = {
          labels: [this.getRandomInt()],
          datasets: [
            {
              label: 'Data One',
              backgroundColor: '#f87979',
              data: [this.getRandomInt()]
            }, {
              label: 'Data two',
              backgroundColor: '#f87921',
              data: [this.getRandomInt()]
            }, {
              label: 'Data three',
              backgroundColor: '#f87fff',
              data: [this.getRandomInt()]
            }, {
              label: 'Data four',
              backgroundColor: '#de4921',
              data: [this.getRandomInt()]
            }
          ]
        }
      },
      getRandomInt () {
        return Math.floor(Math.random() * (50 - 5 + 1)) + 5
      },
      saveImage(ref) {
    // console.log(this.$refs[ref] )


      // get the component via the ref we set up in the template
      const component = this.$refs[ref] 

      // the component itself has a ref to the canvas element.
      // https://github.com/apertureless/vue-chartjs/blob/develop/src/BaseCharts/Line.js#L20
      const canvas = component.$refs.canvas 

      
      // now you can use your usual jquery code
     // I'm not familiar with these jquery plugins so you are on your own with those.
          canvas.toBlob(function(blob) {
            var a = document.createElement("a");
            a.download = "image.png";
            a.href = URL.createObjectURL(blob);
            a.click();
          },'image/png');


      }
    }
  }
</script>

<style>
  .small {
    max-width: 600px;
    margin:  150px auto;
  }
</style>