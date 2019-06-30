
@extends('layouts.layouthalamanlain')
@section('content')
  <section id="grafik-STOK">
    <div class="container">
      <div class="row text-center">
        <div class="col-md-12">
          <h1>Susunan Organisasi dan Tata Kerja Desa </h1>
          <img src="images/STOK.png" alt="">
        </div>
        </div>
    </div>
  </section>  

  <section id="kades">
    <div class="container">
      <div class="row">
          <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
          <div class="wow bounceInUp text-center" data-wow-delay="0.1s">
            <h4>{{ $SOTKs[0]->Jabatan }}</h4>
            <img src="{{ $SOTKs[0]->urlgambar }}" alt=""  />
            <h4>{{ $SOTKs[0]->Nama }}</h4>
          </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
          <div class="wow bounceInUp" data-wow-delay="0.1s">
            <h4>KEDUDUKAN, TUGAS, WEWENANG, DAN FUNGSI KEPALA DESA</h4>
            <ol class="text-left">
              <li>Kepala Desa Berkedudukan Sebagai Kepala Pemerintah Desa Yang Memimpin Penyelenggaraan Pemerintahan Desa.</li>
              <li>Kepala Desa Bertugas Menyelenggarakan Pemerintahan Desa, Melaksanakan Pembangunan, Pembinaan Kemasyarakatan, Dan Pemberdayaan Masyarakat.</li>
              <li>Untuk Melaksanakan Tugas Kepala Desa Berwenang :</li>
              <ul class="text-left">
                <li>Memimpin Penyelenggaraan Pemerintahan Desa.</li>
                <li>Mengangkat Dan Memberhentikan Perangkat Desa.</li>
                <li>Memegang Kekuasaan Pengelolaan Keuangan Dan Aset Desa.</li>
                <li>Menetapkan Peraturan Desa.</li>
                <li>Menetapkan Anggaran Pendapatan Dan Belanja Desa.</li>
                <li>Membina Kehidupan Masyarakat Desa.</li>
                <li>Membina Ketenteraman Dan Ketertiban Masyarakat Desa.</li>
                <li>Membina Dan Meningkatkan Perekonomian Desa Serta Mengintegrasikannya Agar Mencapai Perekonomian Skal.</li>Produktif Untuk Sebesar-Besarnya Kemakmuran Masyarakat Desa; 
                <li>Mengembangkan Sumber Pendapatan Desa.</li>
                <li>Mengusulkan Dan Menerima Pelimpahan Sebagian Kekayaan Negara Guna Meningkatkan Kesejahteraan Masyarakat Desa</li>
                <li>Mengembangkan Kehidupan Sosial Budaya Masyarakat Desa.</li>
                <li>Memanfaatkan Teknologi Tepat Guna.</li>
                <li>Mengoordinasikan Pembangunan Desa Secara Partisipatif.</li>
                <li>Mewakili Desa Di Dalam Dan Di Luar Pengadilan Atau Menunjuk Kuasa Hukum Untuk Mewakilinya Sesuai Dengan Ketentuan Peraturan Perundang-Undangan.</li> 
                <li>Melaksanakan Wewenang Lain Yang Sesuai Dengan Ketentuan Peraturan Perundang-Undanga.</li>
            </ul>
            </ol>
            
            <strong><h5>Kepala Desa Memiliki Fungsi-Fungsi Sebagai Berikut:</h5></strong>
            <ul class="text-left">
              <li>Menyelenggarakan Pemerintahan Desa, Meliputi Tata Praja Pemerintahan, Penetapan Peraturan Di Desa, Pembinaan Masalah Pertanahan, Pembinaan Ketentraman Dan Ketertiban, Administrasi Kependudukan, Dan Penataan Dan Pengelolaan Wilayah</li>
              <li>Melaksanakan Pembangunan, Meliputi Pembangunan Sarana Prasarana Perdesaan, Pembangunan Di Bidang Pendidikan Dan Kesehatan.</li>
              <li>Pembinaan Kemasyarakatan, Meliputi Pelaksanaan Hak Dan Kewajiban Masyarakat, Partisipasi Masyarakat, Sosial Budaya Masyarakat, Keagamaan, Dan Ketenagakerjaan.</li>
              <li>Pemberdayaan Masyarakat, Meliputi Melakukan Sosialisasi Dan Motivasi Masyarakat Di Bidang Budaya, Ekonomi, Politik, Lingkungan Hidup, Pemberdayaan Keluarga, Pemuda, Olahraga, Dan Karang Taruna.</li>
              <li>Menjaga Hubungan Kemitraan Dengan Lembaga Masyarakat Dan Lembaga Lainnya.</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>


 
  <section id="sekretaris">
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
          <div class="wow bounceInUp" data-wow-delay="0.1s">
            <h4>KEDUDUKAN, TUGAS, DAN FUNGSI SEKRETARIS DESA</h4>
            <ol class="text-left">
              <li>Sekretaris Desa berkedudukan sebagai unsur pimpinan Sekretariat Desa.</li>
              <li>Sekretaris Desa bertugas membantu Kepala Desa dalam bidang administrasi pemerintahan.</li>
              <li>Untuk melaksanakan tugas Sekretaris Desa mempunyai fungsi :</li>
            </ol>
            <ul class="text-left">
              <li>melaksanakan Urusan Ketatausahaan, meliputi :</li>
              <ol>
                  <li>melaksanakan urusan tata naska</li>
                  <li>pengelolaan administrasi surat menyurat dan ekspedisi</li>
                  <li>pengelolaan arsip desa</li>
                  <li>penyusunan rancangan regulasi Desa meliputi Peraturan Desa, Peraturan Kepala Desa, dan Keputusan Kepala Desa</li>
              </ol>
              <li>melaksanakan Urusan Umum, meliputi  :</li>
              <ol>
                  <li>pengelolaan administrasi Kepala Desa dan Perangkat Desa</li>
                  <li>penyediaan prasarana Kepala Desa dan Perangkat Desa</li>
                  <li>penyediaan prasarana kantor desa</li>
                  <li>pengelolaan perpustakaan desa </li>
                  <li>penyiapan rapat-rapat</li>
                  <li>pengelolaan aset desa</li>
                  <li>penyiapan kegiatan perjalanan dinas</li>
                  <li>pelayanan umum</li>
              </ol>
              <li>melaksanakan Urusan Keuangan, meliputi :</li>
              <ol>
                   <li>pengurusan administrasi keuangan</li>
                   <li>pengadministrasian sumber-sumber penerimaan dan pengeluaran </li>
                   <li>verifikasi administrasi keuangan</li>
                   <li>pengadministrasian penghasilan Kepala Desa dan Perangkat Desa</li>
              </ol>
              <li>melaksanakan Urusan Perencanaan, meliputi :</li>
              <ol>
                  <li>penyusunan rencana anggaran pendapatan dan belanja desa</li>
                  <li>inventarisasi data dan penyusunan perencanaan pembangunan desa</li>
                  <li>monitoring dan evaluasi program</li>
                  <li>penyusunan laporan desa</li>
              </ol>
            </ul>
          </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
          <div class="wow bounceInUp text-center" data-wow-delay="0.1s">
            <h4>{{ $SOTKs[2]->Jabatan }}</h4>
            <img src="{{ $SOTKs[2]->urlgambar }}" alt=""  />
            <h4>{{ $SOTKs[2]->Nama }}</h4>
          </div>
        </div>
      </div>
    </div>
  </section>


  <section id="kaurdesa">
    <div class="container">
      <h1 class="text-center">Kepala Urusan Desa</h1>
      <div class="row">
          <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 text-center">
          <div class="wow bounceInUp text-center" data-wow-delay="0.5s">
            <p>{{ $SOTKs[3]->Jabatan }}</p>
           <img src="{{ $SOTKs[3]->urlgambar }}" alt=""  />
            <h4>{{ $SOTKs[3]->Nama }}</h4>
          </div>
        </div>

        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 text-center">
          <div class="wow bounceInUp text-center" data-wow-delay="0.5s">
            <p>{{ $SOTKs[4]->Jabatan }}</p>
           <img src="{{ $SOTKs[4]->urlgambar }}" alt=""  />
            <h4>{{ $SOTKs[4]->Nama }}</h4>
          </div>
        </div> 

        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 text-center">
          <div class="wow bounceInUp text-center" data-wow-delay="0.5s">
            <p>{{ $SOTKs[5]->Jabatan }}</p>
           <img src="{{ $SOTKs[5]->urlgambar }}" alt=""  />
            <h4>{{ $SOTKs[5]->Nama }}</h4>
          </div>
        </div>
      </div>
      
      <div class="row">
          <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 text-center">
          <div class="wow bounceInUp text-center" data-wow-delay="0.5s">
            <p>{{ $SOTKs[6]->Jabatan }}</p>
           <img src="{{ $SOTKs[6]->urlgambar }}" alt=""  />
            <h4>{{ $SOTKs[6]->Nama }}</h4>
          </div>
        </div>

        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 text-center">
          <div class="wow bounceInUp text-center" data-wow-delay="0.5s">
            <p>{{ $SOTKs[7]->Jabatan }}</p>
           <img src="{{ $SOTKs[7]->urlgambar }}" alt=""  />
            <h4>{{ $SOTKs[7]->Nama }}</h4>
          </div>
        </div> 

        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 text-center">
          <div class="wow bounceInUp text-center" data-wow-delay="0.5s">
            <p>{{ $SOTKs[8]->Jabatan }}</p>
           <img src="{{ $SOTKs[8]->urlgambar }}" alt=""  />
            <h4>{{ $SOTKs[8]->Nama }}</h4>
          </div>
        </div>
      </div>

    </div>
  </section>








  @endsection