<template>
     <section id="tabelpengumuman">
      <div class="container-fluid">
        <h1>Tabel data Pengumuman Desa</h1>
        <div class="row">
          <div class="col-md-12">
            <div style="overflow: auto;max-height: 400px;position: relative;  ">
                <table id="tabeldatakadus">
                <thead>
                  <col width="1000px">
                  <col width="1000px">
                  <col width="1000px">
                  <col width="1000px">
                  <tr>
                    <th>Judul Pengumuman</th>
                    <th>Deskripsi</th>
                    <th>edit</th> 
                    <th>hapus</th> 
                  </tr>
                </thead>
                 <tbody>
                    <tr v-for="pengumumandesa in pengumumandesas">
                      <td>{{ pengumumandesa['judulpengumuman'] }}</td>
                      <td>{{ pengumumandesa['deskripsi'].substring(0,100) }}</td>
                      <td><a :href="'formeditpengumuman/' +  pengumumandesa['id']" >edit</a></td>
                      <td><a :href="'deletepengumuman/' +  pengumumandesa['id']" >hapus</a></td>
                    </tr>
                </tbody>
              </table>
          </div>
                <a :href="'formaddpengumuman'" class="tomboladd">Buat Pengumuman Baru</a>                      
                
          </div>
        </div>
      </div>
    </section>
</template>

<script>
    export default {
        mounted() {
        console.log("oke");
            
        },
        data(){
            return{
                pengumumandesas:[],
            }
        },
        created(){
            this.fetchpengumumandesas();
        },
        methods:{
            fetchpengumumandesas(){
                this.$http.get("datapengumuman").then(response => {this.pengumumandesas = response.data.pengumumandesas});

            },
        }
    }
</script>
