<template>
<div class="container" style="padding-top: 40px;">
            <div class="row">
                <div class="col-md-12">
                    <div class="kotakpanduanpenduduk">
                        <h1>Panduan Penduduk</h1>
                          <div class="cari">
                            <input type="text" name="Cari" class="cari_text"
                               v-model="caritext"
                               placeholder="Cari Panduan"/>
                          </div>
                          <ul>
                            <li v-for="panduan in caripanduans"><a :href="panduan.link" target="_blank">{{ panduan.title }}</a></li>
                          </ul>
                    </div>
                </div>
            </div>
        </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        data() {
          return {
            caritext:'',
            panduans:[
              {
                title: 'Panduan Beasiswa LPDP',
                link:'https://www.lpdp.kemenkeu.go.id',
              },
              {
                title:'Panduan BPJS',
                link:'https://www.bpjs-kesehatan.go.id/bpjs/',
              },
              {
                title:'Petunjuk penempatan TKI perorangan',
                link:'http://www.bnp2tki.go.id/read/8998/Petunjuk-Penempatan-TKI-Perseorangan.html',
              },
              {
                title:'Panduang mengurus administrasi setelah menikah',
                link:'https://www.bridestory.com/id/blog/panduan-mengurus-5-administrasi-penting-setelah-menikah',
              },
              {
                title:'Mengurus akta nikah',
                link:'https://www.finansialku.com/mengurus-catatan-sipil-akta-nikah/amp/',
              },
              {
                title:'Cara mengurus SIUP (Surat Izin Usaha Perdagangan)',
                link:'https://www.cermati.com/artikel/cara-membuat-siup-surat-izin-usaha-perdagangan',
              },
              {
                title:'Cara bayar pajak online',
                link:'https://www.online-pajak.com/e-billing-pajak-cara-bayar-pajak-online',
              },
              {
                title:'E-billing pajak',
                link:'http://www.pajak.go.id/content/e-billing',
              },
              {
                title:'Pasang meter listrik',
                link:'https://www.pln.co.id',
              },
            ]
          }
      },
  computed : {
          caripanduans:function(){
              return this.panduans.filter((panduan) => {
              return panduan.title.toLowerCase().match(this.caritext)
               });

          }
        },
    }
</script>
