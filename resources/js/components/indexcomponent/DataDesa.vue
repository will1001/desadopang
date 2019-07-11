<template>
<div class="container" style="padding-top: 40px;">
            <div class="row">
                <div class="col-md-12">
                    <div class="kotakpanduanpenduduk">
                        <h1>Data Desa</h1>
                        <!-- <form action="{{url('caripanduanpenduduk')}}" method="post" accept-charset="utf-8">
                              {{ csrf_field() }}
                              <input type="text"  id="search" name="search" placeholder="cari panduan" >
                              <input type="submit" value="Search" id="tombol_search_panduan">
                          </form> -->
                          <div class="cari">
                            <input type="text" name="Cari" class="cari_text"
                               v-model="caritext"
                               placeholder="Cari Data"/>
                          </div>
                          <ul>
                            <li v-for="datadesa in caridatadesas"><a v-bind:href="datadesa.link" target="_blank">{{ datadesa.title }}</a></li>
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
        data(){
          return{
            caritext:'',
            datadesas:[
              {
                title: 'Dana Desa',
                link:'https://desapringgajurang.id/dokumen/Dana_Desa.pdf',
              },
              {
                title:'Profil Desa',
                link:'https://desapringgajurang.id/dokumen/Profil%20Desa%20PRINGGAJURANG.pdf',
              }
            ]
          }
        },
        computed : {
          caridatadesas:function(){
              return this.datadesas.filter((datadesa) => {
              return datadesa.title.toLowerCase().match(this.caritext)
               });

          }
        },
    }
</script>
