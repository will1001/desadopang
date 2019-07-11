<template>
      <div class="container" style="padding-top: 40px;">
        <div class="row pasaronlineslideshow">
            <div class="col-md-12">
                <div class="kotak1halamanbisnis">
                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                  <div class="carousel-inner">
                    <div class="carousel-item active">
                      <div class="row">
                                                <div class="col-xs-6 col-6 col-sm-6 col-md-3" v-for="barangdesa in barangdesas.slice(0,4)">
                                                    <a :href="'detailbarangdesa/' +  barangdesa['id']" class="tombol_produk">
                                                    <div class="card">
                                                      <img class="card-img-top" :src="barangdesa['urlgambar']" alt="Card image cap">
                                                      <div class="card-body text-left">
                                                        <h5 class="card-title">{{ barangdesa['nama'].substr(0,23) }}</h5>
                                                        <p class="card-text">Rp. {{barangdesa['harga']}}</p>
                                                      </div>
                                                    </div>
                                                </a>
                                                </div>
                          </div>
                    </div>
                    <div class="carousel-item">
                      <div class="row">
                                            <div class="col-xs-6 col-6 col-sm-6 col-md-3" v-for="barangdesa in barangdesas.slice(4,8)">
                                                    <a :href="'detailbarangdesa/' +  barangdesa['id'] " class="tombol_produk">
                                                    <div class="card">
                                                      <img class="card-img-top" :src="barangdesa['urlgambar']" alt="Card image cap">
                                                      <div class="card-body text-left">
                                                        <h5 class="card-title">{{ barangdesa['nama'].substr(0,23) }}</h5>
                                                        <p class="card-text">Rp. {{barangdesa['harga']}}</p>
                                                      </div>
                                                    </div>
                                                </a>
                                                </div>
                      </div>
                    </div>
                    <div class="carousel-item">
                      <div class="row">
                                            <div class="col-xs-6 col-6 col-sm-6 col-md-3" v-for="barangdesa in barangdesas.slice(8,12)">
                                                    <a :href="'detailbarangdesa/' +  barangdesa['id'] " class="tombol_produk">
                                                    <div class="card">
                                                      <img class="card-img-top" :src="barangdesa['urlgambar']" alt="Card image cap">
                                                      <div class="card-body text-left">
                                                        <h5 class="card-title">{{ barangdesa['nama'].substr(0,23) }}</h5>
                                                        <p class="card-text">Rp. {{barangdesa['harga']}}</p>
                                                      </div>
                                                    </div>
                                                </a>
                                                </div>
                      </div>
                    </div>
                  </div>
                  <a class="carousel-control-prev" :href="'#carouselExampleControls'" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                  </a>
                  <a class="carousel-control-next" :href="'#carouselExampleControls'" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                  </a>
                </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="kotak2Ahalamanbisnis">
                <h2>Pelaku Usaha :</h2>
                <ul>
                    <li>UD Ondak Jaya (Las dan Teknologi tepat guna)</li>
                    <li>UD Kurnia (Print dan Photocopy)</li>
                </ul>
                </div>
            </div>
            <div class="col-md-4">
                <div class="kotak2Bhalamanbisnis">
                <h2>Panduan Bisnis</h2>
                <ul>
                    <li><a :href="'#'">Panduan mungurus UD,CV,dan PT</a></li>
                    <li><a :href="'#'">Panduan mengurus SIUP,dan TDP</a></li>
                    <li><a :href="'#'">Panduan Membayar Pajak Secara Online</a></li>
                </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="kotak3Ahalamanbisnis">
                <h2>Potensi Penanaman Modal</h2>
                <ul>
                    <li><a target="_blank" :href="'#'">Potensi Air</a></li>
                    <li><a target="_blank" :href="'#'">Potensi Pertanian</a></li>
                    <li><a target="_blank" :href="'#'">Potensi Wisata</a></li>
                    <li><a target="_blank" :href="'#'">Potensi Peternakan</a></li>
                </ul>
                </div>
            </div>
            <div class="col-md-4">
                <div class="kotak3Bhalamanbisnis">
                <h2>Lowongan Kerja</h2>
                <ul>
                    <li><a target="_blank" :href="'https://id.indeed.com/'">https//id.indeed.com/</a></li>
                    <li><a target="_blank" :href="'https://freelancer.com/'">https//freelancer.com/</a></li>
                    <li><a target="_blank" :href="'https://glassdoor.com/'">https//glassdoor.com/</a></li>
                    <li><a target="_blank" :href="'https://idealist.com/'">https//idealist.com/</a></li>
                </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
        console.log("oke");
            
        },
        data(){
            return{
                barangdesas:[],
            }
        },
        created(){
            this.fetchbarangdesas();
        },
        methods:{
            fetchbarangdesas(){
                this.$http.get("databarangdesa").then(response => {this.barangdesas = response.data.barangdesas});
            },
        }
    }
</script>
