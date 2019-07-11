<template>
   <div>
      <section id="kotak1">
                <div class="container">
                <div class="row">
                    <div class="col-12 col-xs-12 col-sm-12 col-md-4">
                        <a href="#" @click="childcallparent('selayangpandang')" :value="value">
                          <div class="tentang_desa inner text-left">
                            <h2>Selayang Pandang</h2>
                            <p>Desa Pringgajurang terletak di ke Kecamatan Montong Gading, Kabupaten Lombok Timur, NTB. Desa ini berada tidak jauh dari objek Wisata Otak Kokok-Joben. Desa ini dapat diakses dari Bandara Internasional Lombok, Pelabuhan Lembar, Kota Matar . . .</p>
                        </div>
                        </a>
                    </div>
                    <div class="col-12 col-xs-12 col-sm-12 col-md-4">
                        <div class="berita_terbaru inner text-center">
                            <div id="carouselExampleControls" class="carousel slide my-carousel" data-ride="carousel">
                              <div class="carousel-inner">
                                <div class="carousel-item active" v-for="berita in beritas.slice(0,1)">
                                  <h2 class="text-left">Berita Terbaru</h2>
                                    <h3><a :href="'beritadesa'">{{ berita['judulberita'].substr(0,100) }}</a></h3>
                                    <br>
                                    <p class="text-right footsign">admin,{{ berita['created_at'] }}</p>
                                </div>
                                <div class="carousel-item" v-for="berita in beritas.slice(1)">
                                  <h2 class="text-left">Berita Terbaru</h2>
                                    <h3><a :href="'beritadesa'">{{ berita['judulberita'].substr(0,100) }}</a></h3>
                                    <br>
                                    <p class="text-right footsign">admin,{{ berita['created_at'] }}</p>
                                </div>
                              </div>
                              <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                              </a>
                              <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                              </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-xs-12 col-sm-12 col-md-4">
                        <div class="pengumuman inner text-center">
                                <div id="carouselExampleControls2" class="carousel slide my-carousel" data-ride="carousel">
                              <div class="carousel-inner">
                                <div class="carousel-item active" v-for="pengumuman in pengumumandesas.slice(0,1)">
                                  <h2 class="text-left">{{ pengumuman['judulpengumuman'] }}</h2>
                                    <p><a class="text-dark" :href="'detailpengumuman/' +  pengumuman['judulpengumuman']">{{ pengumuman['deskripsi'].substr(0,100) }}</a></p>
                                </div>
                                <div class="carousel-item" v-for="pengumuman in pengumumandesas.slice(1)">
                                  <h2 class="text-left">{{ pengumuman['judulpengumuman'] }}</h2>
                                    <p><a class="text-dark" :href="'detailpengumuman/' +  pengumuman['judulpengumuman']">{{ pengumuman['deskripsi'].substr(0,100) }}</a></p>
                                </div>
                              </div>
                              <a class="carousel-control-prev" href="#carouselExampleControls2" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                              </a>
                              <a class="carousel-control-next" href="#carouselExampleControls2" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                              </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          </section>

          <section id="kotak2">
                <div class="container">
                <div class="row">
                    <div class="col-12 col-xs-12 col-sm-12 col-md-4">
                        <div class="outter">
                            <a :href="'/barangdesa'">
                                <img src="/images/ntp-pangan.jpg" alt="">
                            <div class="inner1 d-flex flex-last">
                                <h3 class="mt-auto">PASAR ONLINE</h3>
                            </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-12 col-xs-12 col-sm-12 col-md-2">
                        <div class="outter2">
                            <a :href="'transparansi/apbd'">
                                <img src="/images/Screenshot from 2018-10-16 17-11-07.jpg" alt="">
                            <div class="inner2 d-flex flex-last">
                                <h3 class="mt-auto">DANA DESA</h3>
                            </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-12 col-xs-12 col-sm-12 col-md-4">
                        <div class="outter">
                            <a :href="'statistik'">
                                <img src="/images/Grafik-Bonus-Demografi.jpg" alt="">
                            <div class="inner1 d-flex flex-last">
                                <h3 class="mt-auto">STATISTIK</h3>
                            </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-12 col-xs-12 col-sm-12 col-md-2">
                        <div class="outter2">
                            <a :href="'galery'">
                                <img src="/images/kopi.jpg" alt="">
                            <div class="inner2 d-flex flex-last">
                                <h3 class="mt-auto">GALERY</h3>
                            </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            </section>  


            <section id="kotak3">
                <div class="container">
                <div class="row">
                    <div class="col-4 col-xs-4 col-sm-4 col-md-2 offset-md-1">
                        <div class="inner text-center">
                            <a href="#" @click="childcallparent('lembagaindex')"><i class="fas fa-sitemap"></i><br>
                            <h4><strong>LEMBAGA</strong></h4></a>
                        </div>
                    </div>
                    <div class="col-4 col-xs-4 col-sm-4 col-md-2">
                        <div class="inner text-center">
                            <a href="/organisasi"><i class="fa-2x fas fa-users"></i><br>
                            <h4><strong>SOTK</strong></h4></a>
                        </div>
                    </div>
                    <div class="col-4 col-xs-4 col-sm-4 col-md-2">
                        <div class="inner text-center">
                            <a href="https://goo.gl/maps/ru5HSKJND5t"><i class="fas fa-map-marked-alt"></i><br>
                            <h4><strong>PETA</strong></h4></a>
                        </div>
                    </div>
                    <div class="col-4 col-xs-4 col-sm-4 col-md-2">
                        <div class="inner text-center">
                            <a href="#" @click="childcallparent('agenda')"><i class="fas fa-calendar-alt"></i><br>
                            <h4><strong>AGENDA</strong></h4></a>
                        </div>
                    </div>
                    <div class="col-4 col-xs-4 col-sm-4 col-md-2">
                        <div class="inner text-center">
                            <a href="#" @click="childcallparent('datadesa')"><i class="fas fa-chart-bar"></i><br>
                            <h4><strong>DATA</strong></h4></a>
                        </div>
                    </div>
                </div>
            </div>
            </section>

   </div>
</template>

<script>
    export default {
        mounted() {
        console.log("oke bro");
            
        },
        props: ['value'],
        data() {
            return {
              active_elcomp: 0,
              currentViewBidangPemerintahan : "pemerintahan",
              beritas:[],
              pengumumandesas:[],
              isHidden : false,
            }
        },
        created(){
            this.fetchberitas();
            this.fetchpengumumandesas();
        },
        methods:{
          childcallparent(even){
            this.$emit('clicked', even);
          },
          fetchpengumumandesas(){
                this.$http.get("datapengumuman").then(response => {this.pengumumandesas = response.data.pengumumandesas});
          },
          fetchberitas(){
                this.$http.get("databerita").then(response => {this.beritas = response.data.beritas});
          },
          activate:function(el){
              this.active_el = el;
              console.log(this.active_el);
          },
          
      }
    }
</script>

