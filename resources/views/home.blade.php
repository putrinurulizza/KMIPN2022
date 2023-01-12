@extends('layouts.main')
@section('body-class', 'hero-section')

@section('content')
  <section id="home" class="p-3 p-md-4 p-lg-5">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-5 order-md-1 text-md-end mb-5 mb-md-0" data-aos="fade-left" data-aos-duration="1000">
          <img src="{{ asset('images/bg.png') }}" class="text-end img-fluid rounded-3" alt="...">
        </div>
        <div class="col-md-7 order-md-0" data-aos="fade-right" data-aos-duration="1000">
          <h5 class="fw-light text-white mb-0">WELCOME TO</h5>
          <h1 class="display-3 fw-bold lh-sm text-uppercase">Gampong <br> Ulee Blang Mane</h1>
          <p class="my-4">
            Gampong Ulee Blang Mane merupakan salah satu desa/kelurahan di Kecamatan Blang Mangat, Kota Lhokseumawe, Provinsi Aceh.
            Gampong Ulee Blang Mane berbatasan dengan Gampong Bayu dan Bukitrata. Ulee Blang Mane mempunyai kode telepon 0645 dan kode wilayah menurut Kemendagri 11.73.03.2015, serta memiliki kode pos 24375.
          </p>
          <a href="/tentang" class="btn btn-jelajahi rounded-pill text-white px-4 py-2">JELAJAHI</a>
        </div>
      </div>
    </div>
  </section>

  <section id="visi-misi">
    <div class="container mt-3">
      <div class="row">
        <div class="col" data-aos="fade-right" data-aos-duration="2000">
          <div class="card rounded-3 p-3">
            <div class="card-body text-dark">
              <h2 class="text-center fw-bold">VISI & MISI</h2><br>
              <h3 class="h5 fw-bold">VISI</h3>
              <p>TERWUJUDNYA GAMPONG ULEE BLANG MANE YANG AMAN, ISLAMI, SEJAHTERA, SEHAT, CERDAS, BERBUDAYA DAN MANDIRI.</p>

              <h3 class="h5 fw-bold">MISI</h3>
              <ol>
                <li>Meningkatkan pengembangan kegiatan keagamaan</li>
                <li>Mengupayakan bantuan rumah bagi masyarakat miskin.</li>
                <li>Memberdayakan perekonomian masyarakat gampong demi tercapainya kesejahteraan masyarakat.</li>
                <li>Mewujudkan dan meningkatkan serta meneruskan tata kelola pemerintah gampong yang baik.</li>
                <li>Meningkatan pelayanan yang maksimal kepada masyarakat gampong.</li>
                <li>Meningkatkan kesehatan gampong serta mengusahakan jaminan kesehatan masyarakat melalui program pemerintah.</li>
              </ol>
            </div>
          </div>
        </div>
        <div class="col mt-4 mt-md-0" data-aos="fade-left" data-aos-duration="2000">
          <div class="card rounded-3 p-3">
            <div class="card-body text-dark">
              <h2 class="text-center fw-bold">QANUN-QANUN</h2><br>
              <ol>
                <li>Qanun Bidang Ibadah</li>
                <li>Qanun Bidang Akhwal Al-Syakhsyiah (Hukum Keluarga)
                  <p>Qanun ini terdiri dari hal hal yg diatur dalam pasal 49 UU No.7 Tahun 1989 tentang peradilan agama beserta penjelasan pasal tersebut kecuali wakaf, hibah, dan shadaqah</p>
                </li>
                <li>Qanun Bidang Muamalah (Hukum Perdata)
                  <p>Qanun ini terdiri dari jual beli, hutang piutang, qiradh (permodalan), musaqah, muzara'ah, mukharabah (bagi hasil pertanian), wakilah (perwakilan), syirkah (perkongsian), 'ariyah (pinjam meminjam), hajru ( penyitaan harta), syuf'ah ( hak langgeh), rahnun (gadai), ihya'ul mawat ( pembukaan lahan), wakaf</p>
                </li>
                <li>Qanun Bidang Jinayah (Hukum Pidana)
                  <p>Qanun ini meliputi 3 bagian, yaitu Hudud, Qishash, dan Ta'zir.
                    <br>Hudud meliputi Zina, Qadzaf (menuduh berzina), Mencuri, Merampok, Minuman keras, Murtad, serta Pemberontakan.
                    <br>Qishash meliputi Pembunuhan dan Penganiayaan.
                    <br>Ta'zir meliputi Judi, Penipuan, Pemalsuan, Khalwat, Meninggalkan solat fardhu, serta Meninggalkan puasa ramadhan.
                  </p>
                </li>
                <li>Qanun Bidang Qadla' (Peradilan)</li>
                <li>Qanun Bidang Tarbiyah (Pendidikan)</li>
                <li>Qanun Bidang Dakwah, Syiar, dan Pembelaan Islam</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="pemuka">
    <div class="container mb-5">
      <h2 class="pemuka text-center text-white fw-bold mb-5">PEMUKA GAMPONG</h2>
      <div class="row g-3">
        @foreach ($perangkats as $perangkat)
          <div class="col-sm-6 col-lg-3 g-4" data-aos="fade-up" data-aos-duration="1000">
            <div class="card">
              @if ($perangkat->foto)
                <img src="{{ asset('storage/' . $perangkat->foto) }}" alt="{{ $perangkat->nama }}" class="card-img-top" height="400px">
              @else
                <img src="{{ asset('images/avatar.png') }}" alt="{{ $perangkat->nama }}" class="card-img-top">
              @endif
              <div class="card-body">
                <h5 class="card-title text-dark text-center">{{ $perangkat->nama }}</h5>
                <p class="card-title text-dark text-center">{{ $perangkat->jabatan->nama }}</p>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </section>
@endsection
