<template>
      <section id="tabelberita" class="section-padding  gray-bg">
      <div class="container-fluid">
         <h1>Tabel data Berita Desa</h1>
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
                    <th>Judul Berita</th>
                    <th>Deskripsi</th>
                    <th>edit</th> 
                    <th>hapus</th> 
                  </tr>
                </thead>
                 <tbody>
                    <tr v-for="berita in beritas">
                      <td>{{ berita['judulberita'] }}</td>
                      <td>{{ berita['deskripsi'].substring(0,100) }}</td>
                      <td><a :href="'formeditberita/' +  berita['id'] ">edit</a></td>
                      <td><a :href="'deleteberita/' +  berita['id'] ">hapus</a></td>
                    </tr>
                </tbody>
              </table>
          </div>
              <a :href="'formaddberita'" class="tomboladd">Buat Berita Baru</a>
              
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
                beritas:[],
            }
        },
        created(){
            this.fetchberitas();
        },
        methods:{
            fetchberitas(){
                this.$http.get("databerita").then(response => {this.beritas = response.data.beritas});
            },
        }
    }
</script>
