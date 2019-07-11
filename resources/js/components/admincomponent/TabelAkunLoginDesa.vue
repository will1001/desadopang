<template>
    <section id="dataakundesa" class="section-padding tabel5kolom  gray-bg">
      <div class="container-fluid">
         <h1>Tabel Data Akun Login Web Desa</h1>
        <div class="row">
          <div class="col-md-12">
            <div style="overflow: auto;max-height: 400px;position: relative;">
                <table id="tabeldatakadus">
                <thead>
                  <col width="1000px">
                  <col width="1000px">
                  <col width="1000px">
                  <col width="1000px">
                  <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Status</th> 
                    <th>Aktifasi</th> 
                    <th>hapus</th> 
                  </tr>
                </thead>
                 <tbody>
                    <tr v-for="userr in user">
                      <td>{{ userr['name'] }}</td>
                      <td>{{ userr['email']}}</td>
                      <td>{{ userr['status']}}</td>
                      <td><a :href="'aktifasiakun/' +  userr['id'] ">aktifasi</a></td>
                      <td><a :href="'deleteakun/' +  userr['id'] ">hapus</a></td>
                    </tr>
                </tbody>
              </table>
          </div>
              
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
                user:[],
            }
        },
        created(){
            this.fetchusers();
        },
        methods:{
            fetchusers(){
                this.$http.get("datalogin").then(response => {this.user = response.data.users});

            },
        }
    }
</script>

