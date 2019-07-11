<template>
  <div class="barchart text-center" v-model="datakirim">
    <select id="filter" @change="gantichart($event.target.value)">
        <option selected="true" disabled="disabled">Jenis Chart</option>
        <option value="barchartcomponent" >Bar</option>
        <option value="piechartcomponent" >Pie</option>
    </select>
    <select id="filter" @change="chartfunction($event.target.value)">
        <option selected="true" disabled="disabled">Data Grafik</option>
        <option value="Data Pendidikan" >Data Pendidikan</option>
        <option value="Data Pekerjaan" >Data Pekerjaan</option>
        <option value="Data Agama" >Data Agama</option>
        <option value="Data Jenis Kelamin" >Data Jenis Kelamin</option>
        <option value="Data Golongan Darah" >Data Golongan Darah</option>
        <option value="Data Kelompok Umur" >Data Kelompok Umur</option>
    </select>
    <button class="tombol_download" @click="saveImage('canvasChart')">Download Grafik data    </button>
    <download-excel
    class   = "btn btn-default"
    :data   = "json_data"
    worksheet = "My Worksheet"
    name    = "Data.xls">
 
    Download data Excel
 
   </download-excel>
    <jenis-chart v-if="loaded" :chart-data="datacollection" ref="canvasChart" class="chartnya text-center"></jenis-chart>
    <div style="overflow: auto;max-height: auto;position: relative;margin: 5px 25px;" class="text-center">
                            <table>
                            <thead>
                              <col width="1000px">
                              <col width="1000px">
                              <col width="1000px">
                              <tr>
                                        <th rowspan="2">No</th>
                                        <th rowspan="2">Kelompok</th>
                                        <th colspan="2">Jumlah</th>
                                        <th colspan="2">Laki-Laki</th>
                                        <th colspan="2">Perempuan</th>
                              </tr>
                              <tr>
                                <th>n</th>
                                <th>%</th>
                                <th>n</th>
                                <th>%</th>
                                <th>n</th>
                                <th>%</th>
                              </tr>
                            </thead>
                            <tbody id="tbodytabel">
                              <tr v-for="(data,index) in dataAPI">
                                  <td>{{index+1}}</td>
                                  <td>{{data.kelompok}}</td>
                                  <td>{{data.jumlah}}</td>
                                  <td>{{data.PersentaseJumlah}}</td>
                                  <td>{{data.Laki_Laki}}</td>
                                  <td>{{data.Persentase_Laki_Laki}}</td>
                                  <td>{{data.Perempuan}}</td>
                                  <td>{{data.Persentase_Perempuan}}</td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
  </div>
</template>

<script>
  import Vue from 'vue';
  import JenisChart from './BarChart.js'
  
  import JsonExcel from 'vue-json-excel';
 
  Vue.component('downloadExcel', JsonExcel);

  export default {
    components: {
      JenisChart
    },
    data () {
      return {
        datacollection: null,
        tinggi: 600,
        lebar: 600,
        pendidikans:1,
        jenis_kelamins:1,
        dataAPI:[
          {
            kelompok:"",
            jumlah:"",
            PersentaseJumlah:"",
            Laki_Laki:"",
            Persentase_Laki_Laki:"",
            Perempuan:"",
            Persentase_Perempuan:"",
          }
        ],
        datakirim:[],
        loaded: false,
        json_data: [],
        json_meta: [
            [
                {
                    'key': 'charset',
                    'value': 'utf-8'
                }
            ]
        ],
      }
    },
   async  mounted () {
    },
    methods: {
      chartfunction(even){
       this.loaded = false
      try {

        let PersentaseJumlahtotal=0;

        let datatabelapi = [
              {
                kelompok:"",
                jumlah:"",
                PersentaseJumlah:"",
                Laki_Laki:"",
                Persentase_Laki_Laki:"",
                Perempuan:"",
                Persentase_Perempuan:"",
              }
            ];

            let datachartapi = {
              labels: [],
              datasets: []
             };




        if(even=="Data Pendidikan"){

              this.$http.get("datastatistik/pendidikan/")
            .then(response => {

              

             

              response.data.data_pendidikans_totals.forEach(function(data, index) {
                PersentaseJumlahtotal=PersentaseJumlahtotal+response.data.data_pendidikans_totals[index];
              });



                response.data.tabel_pendidikans.forEach(function(data, index) {

                datachartapi.datasets[index] = 
                {
                  label: data.pendidikan,
                  backgroundColor: '#'+(function lol(m,s,c){return s[m.floor(m.random() * s.length)] +
                                    (c && lol(m,s,c-1));})(Math,'0123456789ABCDEF',4),
                  data: [response.data.data_pendidikans_totals[index]]
                };

                datatabelapi[index] = 
                {
                  kelompok:response.data.tabel_pendidikans[index].pendidikan,
                  jumlah:response.data.data_pendidikans_totals[index],
                  PersentaseJumlah:(response.data.data_pendidikans_totals[index]/PersentaseJumlahtotal*100).toFixed(2),
                  Laki_Laki:response.data.data_pendidikans_L[index],
                  Persentase_Laki_Laki:(response.data.data_pendidikans_L[index]/PersentaseJumlahtotal*100).toFixed(2),
                  Perempuan:response.data.data_pendidikans_P[index],
                  Persentase_Perempuan:(response.data.data_pendidikans_P[index]/PersentaseJumlahtotal*100).toFixed(2),
                };


              });

              // datachartapi.datasets.shift();
              // datatabelapi.shift();
              

              this.datacollection=datachartapi;
              this.dataAPI=datatabelapi;

              this.json_data = datatabelapi;

              
           });

            

        }if(even=="Data Agama"){

              this.$http.get("datastatistik/agama/")
            .then(response => {


              response.data.tabel_agamas_totals.forEach(function(data, index) {
                PersentaseJumlahtotal=PersentaseJumlahtotal+response.data.tabel_agamas_totals[index];
              });



               

              response.data.tabel_agamas.forEach(function(data, index) {
                datachartapi.datasets[index] = 
                {
                  label: data.agama,
                  backgroundColor: '#'+(function lol(m,s,c){return s[m.floor(m.random() * s.length)] +
                                    (c && lol(m,s,c-1));})(Math,'0123456789ABCDEF',4),
                  data: [response.data.tabel_agamas_totals[index]]
                };

                datatabelapi[index] = 
                {
                  kelompok:response.data.tabel_agamas[index].agama,
                  jumlah:response.data.tabel_agamas_totals[index],
                  PersentaseJumlah:(response.data.tabel_agamas_totals[index]/PersentaseJumlahtotal*100).toFixed(2),
                  Laki_Laki:response.data.data_agamas_L[index],
                  Persentase_Laki_Laki:(response.data.data_agamas_L[index]/PersentaseJumlahtotal*100).toFixed(2),
                  Perempuan:response.data.data_agamas_P[index],
                  Persentase_Perempuan:(response.data.data_agamas_P[index]/PersentaseJumlahtotal*100).toFixed(2),
                };
              });


              this.datacollection=datachartapi;
              this.dataAPI=datatabelapi;

              this.json_data = datatabelapi;

              
           });

        }if(even=="Data Pekerjaan"){

              this.lebar=1000;

              this.$http.get("datastatistik/jenis_pekerjaan/")
            .then(response => {

              


             response.data.tabel_jenis_pekerjaans_totals.forEach(function(data, index) {
                PersentaseJumlahtotal=PersentaseJumlahtotal+response.data.tabel_jenis_pekerjaans_totals[index];
              });

              response.data.tabel_jenis_pekerjaans.forEach(function(data, index) {

                datachartapi.datasets[index] = 
                {
                  label: data.jenis_pekerjaan,
                  backgroundColor: '#'+(function lol(m,s,c){return s[m.floor(m.random() * s.length)] +
                                    (c && lol(m,s,c-1));})(Math,'0123456789ABCDEF',4),
                  data: [response.data.tabel_jenis_pekerjaans_totals[index]]
                };

                datatabelapi[index] = 
                {
                  kelompok:response.data.tabel_jenis_pekerjaans[index].jenis_pekerjaan,
                  jumlah:response.data.tabel_jenis_pekerjaans_totals[index],
                  PersentaseJumlah:(response.data.tabel_jenis_pekerjaans_totals[index]/PersentaseJumlahtotal*100).toFixed(2),
                  Laki_Laki:response.data.data_jenis_pekerjaans_L[index],
                  Persentase_Laki_Laki:(response.data.data_jenis_pekerjaans_L[index]/PersentaseJumlahtotal*100).toFixed(2),
                  Perempuan:response.data.data_jenis_pekerjaans_P[index],
                  Persentase_Perempuan:(response.data.data_jenis_pekerjaans_P[index]/PersentaseJumlahtotal*100).toFixed(2),
                };

              });

              
              

              this.datacollection=datachartapi;
              this.dataAPI=datatabelapi;

              this.json_data = datatabelapi;

              
           });

        }if(even=="Data Jenis Kelamin"){

              this.$http.get("datastatistik/jenis_kelamin/")
            .then(response => {


              response.data.tabel_jenis_kelamins_totals.forEach(function(data, index) {
                PersentaseJumlahtotal=PersentaseJumlahtotal+response.data.tabel_jenis_kelamins_totals[index];
              });
               

              response.data.tabel_jenis_kelamins.forEach(function(data, index) {
                datachartapi.datasets[index] = 
                {
                  label: data.jenis_kelamin,
                  backgroundColor: '#'+(function lol(m,s,c){return s[m.floor(m.random() * s.length)] +
                                    (c && lol(m,s,c-1));})(Math,'0123456789ABCDEF',4),
                  data: [response.data.tabel_jenis_kelamins_totals[index]]
                };

                datatabelapi[index] = 
                {
                  kelompok:response.data.tabel_jenis_kelamins[index].jenis_kelamin,
                  jumlah:response.data.tabel_jenis_kelamins_totals[index],
                  PersentaseJumlah:(response.data.tabel_jenis_kelamins_totals[index]/PersentaseJumlahtotal*100).toFixed(2),
                  Laki_Laki:response.data.data_jenis_kelamins_L[index],
                  Persentase_Laki_Laki:(response.data.data_jenis_kelamins_L[index]/PersentaseJumlahtotal*100).toFixed(2),
                  Perempuan:response.data.data_jenis_kelamins_P[index],
                  Persentase_Perempuan:(response.data.data_jenis_kelamins_P[index]/PersentaseJumlahtotal*100).toFixed(2),
                };
              });

              
              

              this.datacollection=datachartapi;
              this.dataAPI=datatabelapi;

              this.json_data = datatabelapi;

              
           });

        }if(even=="Data Golongan Darah"){

              this.$http.get("datastatistik/golongan_darah/")
            .then(response => {


              response.data.tabel_golongan_darahs_totals.forEach(function(data, index) {
                PersentaseJumlahtotal=PersentaseJumlahtotal+response.data.tabel_golongan_darahs_totals[index];
              });
               

              response.data.tabel_golongan_darahs.forEach(function(data, index) {
                datachartapi.datasets[index] = 
                {
                  label: data.golongan_darah,
                  backgroundColor: '#'+(function lol(m,s,c){return s[m.floor(m.random() * s.length)] +
                                    (c && lol(m,s,c-1));})(Math,'0123456789ABCDEF',4),
                  data: [response.data.tabel_golongan_darahs_totals[index]]
                };

                datatabelapi[index] = 
                {
                  kelompok:response.data.tabel_golongan_darahs[index].golongan_darah,
                  jumlah:response.data.tabel_golongan_darahs_totals[index],
                  PersentaseJumlah:(response.data.tabel_golongan_darahs_totals[index]/PersentaseJumlahtotal*100).toFixed(2),
                  Laki_Laki:response.data.data_golongan_darahs_L[index],
                  Persentase_Laki_Laki:(response.data.data_golongan_darahs_L[index]/PersentaseJumlahtotal*100).toFixed(2),
                  Perempuan:response.data.data_golongan_darahs_P[index],
                  Persentase_Perempuan:(response.data.data_golongan_darahs_P[index]/PersentaseJumlahtotal*100).toFixed(2),
                };
              });

              
              

              this.datacollection=datachartapi;
              this.dataAPI=datatabelapi;

              this.json_data = datatabelapi;

              
           });

        }if(even=="Data Kelompok Umur"){

          this.$http.get("datastatistik/kelompok_umur/")
            .then(response => {


              response.data.tabel_kelompok_umurs_totals.forEach(function(data, index) {
                PersentaseJumlahtotal=PersentaseJumlahtotal+response.data.tabel_kelompok_umurs_totals[index];
              });
               

              response.data.tabel_kelompok_umurs.forEach(function(data, index) {
                datachartapi.datasets[index] = 
                {
                  label: data,
                  backgroundColor: '#'+(function lol(m,s,c){return s[m.floor(m.random() * s.length)] +
                                    (c && lol(m,s,c-1));})(Math,'0123456789ABCDEF',4),
                  data: [response.data.tabel_kelompok_umurs_totals[index]]
                };

                datatabelapi[index] = 
                {
                  kelompok:response.data.tabel_kelompok_umurs[index],
                  jumlah:response.data.tabel_kelompok_umurs_totals[index],
                  PersentaseJumlah:(response.data.tabel_kelompok_umurs_totals[index]/PersentaseJumlahtotal*100).toFixed(2),
                  Laki_Laki:response.data.data_kelompok_umurs_L[index],
                  Persentase_Laki_Laki:(response.data.data_kelompok_umurs_L[index]/PersentaseJumlahtotal*100).toFixed(2),
                  Perempuan:response.data.data_kelompok_umurs_P[index],
                  Persentase_Perempuan:(response.data.data_kelompok_umurs_P[index]/PersentaseJumlahtotal*100).toFixed(2),
                };
              });

              
              

              this.datacollection=datachartapi;
              this.dataAPI=datatabelapi;

              this.json_data = datatabelapi;

              
           });

        }
        

        this.loaded = true
      } catch (e) {
        console.error(e)
      }


      },
       fetchdata_pendidikans(){
            this.$http.get("datastatistik/pendidikan/"+this.pendidikans+"/"+this.jenis_kelamins).then(response => {this.tabel_pendidikans = response.data.data_chart});
        },
        saveImage(ref) {

        const component = this.$refs[ref] 

        const canvas = component.$refs.canvas       
        
        canvas.toBlob(function(blob) {
              var a = document.createElement("a");
              a.download = "grafikchart.png";
              a.href = URL.createObjectURL(blob);
              a.click();
        },'grafikchart.png');


        },gantichart(even){
          this.$emit('clicked', even);
        },
    }
  }
</script>

<style>
  .barchart {
    overflow:auto; 
    height: auto;
    margin:31px auto;
    background-color: white;
  }

  .tombol_download{
    border: 1px gray solid;
    background-color: transparent;
    border-radius: 25px;
    padding: 5px 5px;
    font-size: 12px;
    
  }
  .tombol_download:hover{
    background-color: gray;
    box-shadow: 5px 5px 5px #000;
    transition: 1s;
    border-radius: 25px;
    padding: 5px 5px;
  }

  .btn-default{
    border: 1px gray solid;
    background-color: transparent;
    border-radius: 25px;
    padding: 5px 5px;
    font-size: 12px;
  }

  .btn-default:hover{
    background-color: gray;
    box-shadow: 5px 5px 5px #000;
    transition: 1s;
    border-radius: 25px;
    padding: 5px 5px;
  }

  .chartnya {
    width: 100%;
   }

   @media only screen and (min-width: 320px) and (max-width: 479px) {
      .chartnya {
        width: 800px;
     }

   }
</style>