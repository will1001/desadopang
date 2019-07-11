<template>
  <div>
     <div class="container" style="padding-top: 40px;">
            <div class="row">
                <div class="col-md-4">
                    <div class="kotak1bidangpemerintahan">
                        <ul>
                        <li><a class="bidangpemerintahan_link" :href="'#'"  >Pemerintahan</a></li>
                        <li><a class="bidangpemerintahan_link" :href="'#'"  >Kesejahteraan</a></li>
                        <li><a class="bidangpemerintahan_link" :href="'#'"  >Pelayanan</a></li>
                        <li><a class="bidangpemerintahan_link" :href="'#'"  >Tata Usaha dan Umum</a></li>
                        <li><a class="bidangpemerintahan_link" :href="'#'"  >Keuangan</a></li>
                        <li><a class="bidangpemerintahan_link" :href="'#'"  >Perencanaan</a></li>
                        <li><a class="bidangpemerintahan_link" :href="'#'"  >Kewilayahan</a></li>
                        <li><a class="bidangpemerintahan_link" :href="'#'"  >Pembangunan</a></li>
                    </ul>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="kotak2bidangpemerintahan">
                      <div  :is="currentViewBidangPemerintahan" class="wow fadeIn"  keep-alive></div>
                    </div>
                </div>
            </div>
        </div>
  </div>
</template>

<script>
import Pemerintahan from './BidangPemerintahanComponent/Pemerintahan.vue';
import Kesejahteraan from './BidangPemerintahanComponent/Kesejahteraan.vue';
import Pelayanan from './BidangPemerintahanComponent/Pelayanan.vue';
import Tata_Usaha_dan_Umum from './BidangPemerintahanComponent/Tata_Usaha_dan_Umum.vue';
import Keuangan from './BidangPemerintahanComponent/Keuangan.vue';
import Perencanaan from './BidangPemerintahanComponent/Perencanaan.vue';
import Kewilayahan from './BidangPemerintahanComponent/Kewilayahan.vue';
import Pembangunan from './BidangPemerintahanComponent/Pembangunan.vue';
    export default {
        mounted() {
        console.log("oke pemerintahan");
            
        },
        components : { 
          Pemerintahan,
          Kesejahteraan,
          Pelayanan,
          Tata_Usaha_dan_Umum,
          Keuangan,
          Perencanaan,
          Kewilayahan,
          Pembangunan,
        },
        data() {
            return {
             active_elcomp: 1,
             currentViewBidangPemerintahan : "Pemerintahan",
            }
        },
        methods:{
          testing(el){
              this.active_elcomp = el;
              console.log(this.active_elcomp);
          },
      }
    } 
</script>

