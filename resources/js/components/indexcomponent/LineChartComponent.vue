<template>
  <div class="small">
    <jenis-chart :chart-data="chartData" ref="canvasChart"></jenis-chart>
    <button @click="fillData()">Randomize</button>
    <button @click="downloadchart('canvasChart')">Save Image!</button>
    <img src="" alt="">
  </div>
</template>

<script>

  import JenisChart from './LineChart.js'

  export default {
    components: {
      JenisChart
    },
    data () {
      return {
        chartData: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
          datasets: [
            {
              label: 'Data One',
              borderColor: '#FC2525',
              pointBackgroundColor: 'white',
              borderWidth: 1,
              pointBorderColor: 'white',
              backgroundColor: this.gradient,
              data: [40, 39, 10, 40, 39, 80, 40]
            },{
              label: 'Data Two',
              borderColor: '#05CBE1',
              pointBackgroundColor: 'white',
              pointBorderColor: 'white',
              borderWidth: 1,
              backgroundColor: this.gradient2,
              data: [60, 55, 32, 10, 2, 12, 53]
            }
          ]
        },
        gradient: null,
        gradient2: null

      }
    },
    mounted () {
    this.gradient = this.$refs.canvas.getContext('2d').createLinearGradient(0, 0, 0, 450)
    this.gradient2 = this.$refs.canvas.getContext('2d').createLinearGradient(0, 0, 0, 450)

    this.gradient.addColorStop(0, 'rgba(255, 0,0, 0.5)')
    this.gradient.addColorStop(0.5, 'rgba(255, 0, 0, 0.25)');
    this.gradient.addColorStop(1, 'rgba(255, 0, 0, 0)');
    
    this.gradient2.addColorStop(0, 'rgba(0, 231, 255, 0.9)')
    this.gradient2.addColorStop(0.5, 'rgba(0, 231, 255, 0.25)');
    this.gradient2.addColorStop(1, 'rgba(0, 231, 255, 0)');
    },
    methods: {
    
    downloadchart(ref) {

      const component = this.$refs[ref] 

      const canvas = component.$refs.canvas       
      
      canvas.toBlob(function(blob) {
            var a = document.createElement("a");
            a.download = "grafikchart.png";
            a.href = URL.createObjectURL(blob);
            a.click();
      },'grafikchart.png');


      }
    },

  }
</script>

<style>
  .small {
    max-width: 600px;
    margin:  150px auto;
  }
</style>