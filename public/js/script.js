$(window).scroll(function () {
    $('nav').toggleClass('scrolled',$(this).scrollTop() > 500);
});

$(window).scroll(function () {
    $('ul.navbar-nav.ml-auto').toggleClass('scrolled',$(this).scrollTop() > 500);
});

$(document).ready(function(){
  $(".nav-link").on('click', function(event) {


    if (this.hash !== "") {
      event.preventDefault();

      var hash = this.hash;

      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 1000, function(){
   
        window.location.hash = hash;
      });
    } 
  });


  new WOW().init();
});


$("#logBPD").hover(function(){
    $('#BPDshow').fadeToggle(1000);
 });

$("#logLPMD").hover(function(){
    $('#LPMDshow').fadeToggle(1000);
 });

$("#logkarangtaruna").hover(function(){
    $('#karangtarunashow').fadeToggle(1000);
 });


$("#logPKK").hover(function(){
    $('#PKKshow').fadeToggle(1000);
 });




var nomor=0;

function loadTabelDataPenduduk(data) {
  $('#tbodytabel').remove();
      
      $('#tabeldatakadus').append('<tbody id="tbodytabel"></tbody>');
      
      j=1;
      $.each(data, function () {
        $('#tbodytabel').append('<tr id="trtabel'+j+'"></tr>');

        $('#trtabel'+j+'').append('<td id="No'+j+'"></td>');
        $('#trtabel'+j+'').append('<td id="Alamat'+j+'"></td>');
        $('#trtabel'+j+'').append('<td id="RW'+j+'"></td>');
        $('#trtabel'+j+'').append('<td id="RT'+j+'"></td>');
        $('#trtabel'+j+'').append('<td id="Nama'+j+'"></td>');
        $('#trtabel'+j+'').append('<td id="Nomor_KK'+j+'"></td>');
        $('#trtabel'+j+'').append('<td id="NIK'+j+'"></td>');
        $('#trtabel'+j+'').append('<td id="Jenis_Kelamin'+j+'"></td>');
        $('#trtabel'+j+'').append('<td id="Tempat_Lahir'+j+'"></td>');
        $('#trtabel'+j+'').append('<td id="Tanggal_Lahir'+j+'"></td>');
        $('#trtabel'+j+'').append('<td id="Usia'+j+'"></td>');
        $('#trtabel'+j+'').append('<td id="Agama'+j+'"></td>');
        $('#trtabel'+j+'').append('<td id="Pendidikan'+j+'"></td>');
        $('#trtabel'+j+'').append('<td id="Jenis_Pekerjaan'+j+'"></td>');
        $('#trtabel'+j+'').append('<td id="Status_Perkawinan'+j+'"></td>');
        $('#trtabel'+j+'').append('<td id="Status_Hubungan_Dalam_Keluarga'+j+'"></td>');
        $('#trtabel'+j+'').append('<td id="Kewarganegaraan'+j+'"></td>');
        $('#trtabel'+j+'').append('<td id="Nama_Ayah'+j+'"></td>');
        $('#trtabel'+j+'').append('<td id="Nama_Ibu'+j+'"></td>');
        $('#trtabel'+j+'').append('<td id="Golongan_Darah'+j+'"></td>');
        $('#trtabel'+j+'').append('<td id="Akta_Lahir'+j+'"></td>');
        $('#trtabel'+j+'').append('<td id="No_Paspor'+j+'"></td>');
        $('#trtabel'+j+'').append('<td id="Tanggal_akhir_Paspor'+j+'"></td>');
        $('#trtabel'+j+'').append('<td id="No_KITAS'+j+'"></td>');
        $('#trtabel'+j+'').append('<td id="NIK_Ayah'+j+'"></td>');
        $('#trtabel'+j+'').append('<td id="NIK_Ibu'+j+'"></td>');
        $('#trtabel'+j+'').append('<td id="No_Akta_Perkawinan'+j+'"></td>');
        $('#trtabel'+j+'').append('<td id="Tanggal_Perkawinan'+j+'"></td>');
        $('#trtabel'+j+'').append('<td id="No_Akta_Perceraian'+j+'"></td>');
        $('#trtabel'+j+'').append('<td id="Tanggal_Perceraian'+j+'"></td>');
        $('#trtabel'+j+'').append('<td id="Cacat'+j+'"></td>');
        $('#trtabel'+j+'').append('<td id="Cara_KB'+j+'"></td>');
        $('#trtabel'+j+'').append('<td id="Hamil'+j+'"></td>');
        $('#trtabel'+j+'').append('<td id="Status_kependudukan'+j+'"></td>');
        $('#trtabel'+j+'').append('<td id="Keterangan'+j+'"></td>');        
        $('#trtabel'+j+'').append('<td id="tempat_mendapatkan_air_bersih'+j+'"></td>');        
        $('#trtabel'+j+'').append('<td id="status_gizi_balita'+j+'"></td>');        
        $('#trtabel'+j+'').append('<td id="kebiasaan_berobat_bila_sakit'+j+'"></td>');  

        if(this.foto_ktp==null && this.foto_kk==null ){
        $('#trtabel'+j+'').append('<td id="foto_ktp'+j+'"><a href="'+this.foto_ktp+'"></a></td>');        
        $('#trtabel'+j+'').append('<td id="foto_kk'+j+'"><a href="'+this.foto_kk+'"></a></td>');
        }
        if(this.foto_ktp==null && this.foto_kk!=null){
        $('#trtabel'+j+'').append('<td id="foto_ktp'+j+'"><a href="'+this.foto_ktp+'"></a></td>');        
        $('#trtabel'+j+'').append('<td id="foto_kk'+j+'"><a href="'+this.foto_kk+'">lihat</a></td>');
        }
        if(this.foto_ktp!=null && this.foto_kk==null){
        $('#trtabel'+j+'').append('<td id="foto_ktp'+j+'"><a href="'+this.foto_ktp+'">lihat</a></td>');        
        $('#trtabel'+j+'').append('<td id="foto_kk'+j+'"><a href="'+this.foto_kk+'"></a></td>');
        }
        if(this.foto_ktp!=null && this.foto_kk!=null){
        $('#trtabel'+j+'').append('<td id="foto_ktp'+j+'"><a href="'+this.foto_ktp+'">lihat</a></td>');        
        $('#trtabel'+j+'').append('<td id="foto_kk'+j+'"><a href="'+this.foto_kk+'">lihat</a></td>');
        }      
                
        $('#trtabel'+j+'').append('<td><a href="formeditdatapendudukkades/'+this.NIK+'/'+this.Id_Dusun+'">edit</a></td>');        
        $('#trtabel'+j+'').append('<td><a href="deletedatapendudukkades/'+this.NIK+'/'+this.Id_Dusun+'">hapus</a></td>');        

        $('#No'+j+'').append(nomor);
        $('#Alamat'+j+'').append(this.Alamat);
        $('#RW'+j+'').append(this.RW);
        $('#RT'+j+'').append(this.RT);
        $('#Nama'+j+'').append(this.Nama);
        $('#Nomor_KK'+j+'').append(this.Nomor_KK);
        $('#NIK'+j+'').append(this.NIK);
        $('#Jenis_Kelamin'+j+'').append(this.jenis_kelamin);
        $('#Tempat_Lahir'+j+'').append(this.Tempat_Lahir);
        $('#Tanggal_Lahir'+j+'').append(this.Tanggal_Lahir);
        $('#Usia'+j+'').append(this.Usia);
        $('#Agama'+j+'').append(this.agama);
        $('#Pendidikan'+j+'').append(this.pendidikan);
        $('#Jenis_Pekerjaan'+j+'').append(this.jenis_pekerjaan);
        $('#Status_Perkawinan'+j+'').append(this.status_perkawinan);
        $('#Status_Hubungan_Dalam_Keluarga'+j+'').append(this.status_hubungan_dalam_keluarga);
        $('#Kewarganegaraan'+j+'').append(this.kewarganegaraan);
        $('#Nama_Ayah'+j+'').append(this.Nama_Ayah);
        $('#Nama_Ibu'+j+'').append(this.Nama_Ibu);
        $('#Golongan_Darah'+j+'').append(this.golongan_darah);
        $('#Akta_Lahir'+j+'').append(this.Akta_Lahir);
        $('#No_Paspor'+j+'').append(this.No_Paspor);
        $('#Tanggal_akhir_Paspor'+j+'').append(this.Tanggal_akhir_Paspor);
        $('#No_KITAS'+j+'').append(this.No_KITAS);
        $('#NIK_Ayah'+j+'').append(this.NIK_Ayah);
        $('#NIK_Ibu'+j+'').append(this.NIK_Ibu);
        $('#No_Akta_Perkawinan'+j+'').append(this.No_Akta_Perkawinan);
        $('#Tanggal_Perkawinan'+j+'').append(this.Tanggal_Perkawinan);
        $('#No_Akta_Perceraian'+j+'').append(this.No_Akta_Perceraian);
        $('#Tanggal_Perceraian'+j+'').append(this.Tanggal_Perceraian);
        $('#Cacat'+j+'').append(this.Cacat);
        $('#Cara_KB'+j+'').append(this.Cara_KB);
        $('#Hamil'+j+'').append(this.Hamil);
        $('#Status_kependudukan'+j+'').append(this.Status_kependudukan);
        $('#Keterangan'+j+'').append(this.Keterangan);
        $('#tempat_mendapatkan_air_bersih'+j+'').append(this.tempat_mendapatkan_air_bersih);
        $('#status_gizi_balita'+j+'').append(this.status_gizi_balita);
        $('#kebiasaan_berobat_bila_sakit'+j+'').append(this.kebiasaan_berobat_bila_sakit);
 
        j++;
        nomor++;
      });
}

var skipdata=0;

$(document).ready(function(){
  $('#pilihankadus').change(function () {
    skipdata=0;
    nomor=skipdata+1;
    $.get('reloadtabeldatapendudukajax/'+$('#pilihankadus option:selected').val()+'/'+skipdata,loadTabelDataPenduduk);
  });
});

$(document).ready(function(){
 $('.next').on('click', function() {
    skipdata=skipdata+25;
    nomor=skipdata+1;
    $.get('reloadtabeldatapendudukajax/'+$('#pilihankadus option:selected').val()+'/'+skipdata,loadTabelDataPenduduk);
 });
});

$(document).ready(function(){
 $('.previous').on('click', function() {
    skipdata=skipdata-25;
    nomor=skipdata+1;
    $.get('reloadtabeldatapendudukajax/'+$('#pilihankadus option:selected').val()+'/'+skipdata,loadTabelDataPenduduk);
 });
});



$(document).ready(function(){
 $('#filter').change(function () {
    $.get('cekumur/10',loadTabelDataPenduduk);
    
  });
});


$(document).ready(function(){
    pil=1;
  $('#nama_tombol').click(function () {
    if(pil==1){
        $.get('reloadtabeldatapendudukajaxurutnama/'+$('#pilihankadus option:selected').val()+'/'+pil,loadTabelDataPenduduk);
        pil=0;
    }else{
        $.get('reloadtabeldatapendudukajaxurutnama/'+$('#pilihankadus option:selected').val()+'/'+pil,loadTabelDataPenduduk);
        pil=1;
    }
    
    
  });
   
});




$(document).ready(function(){
 $('.tomboledit').on('click', function() {
    document.getElementById("edittombol").href="penduduk_keluar/"+document.getElementById("NIK").value; 
 });
});

$(document).ready(function(){
 $('#tombol_search').on('click', function() {
    nomor=1;
    $.get('cari/'+$('#filter option:selected').val()+'/'+document.getElementById("search").value,loadTabelDataPenduduk);
 });
});

$(document).ready(function(){
 $('#tombol_searchkadus').on('click', function() {
    console.log(this.value);
    nomor=1;
    $.get('caridatakadus/'+$('#filterkadus option:selected').val()+'/'+document.getElementById("searchkadus").value,loadTabelDataPenduduk);
 });
});


$(document).ready(function(){
 $('#tombolbuatsurat').on('click', function() {
    document.getElementById("tombolbuatsurat").href= $('#pilihsurat option:selected').val()+"/"+document.getElementById("NIKsurat").value; 
 });
});

