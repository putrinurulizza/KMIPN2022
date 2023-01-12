@extends('layouts.main')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col">
        @if (session()->has('success'))
          <div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif
      </div>
    </div>
  </div>

  <section id="header">
    <div class="container-fluid px-0">
      <div class="row">
        <div class="col">
          <div class="card bg-dark text-white border-0 rounded-0 p-0">
            <img id="bg-header-adm" src="{{ asset('images/hand.jpg') }}" class="card-img" alt="" width="100%" height="500">
            <div class="card-img-overlay d-flex align-items-center p-0">
              <h1 class="display-4 fw-semibold text-center text-white flex-fill p-4 text-uppercase">Solusi Kita</h1>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <div class="container">
    <div class="kendala row">
      <h1 class="text-center mb-5" style="color:#000957; font-weight: bold;">KENDALA - KENDALA</h1>
      <div class="col col-md-4">
        <div class="card" style="border-radius:15px; border-style:none;">
          <img class="img-kendala" src="{{ asset('images/surat.jpg') }}" alt="" style="border-radius: 15px;">
          <h3 class="p-2">SURAT MENYURAT</h3>
          <p> Buat surat yang anda butuhkan dari Gampong kami hanya dengan mengisi data-data yang diperlukan pada form administrasi tanpa harus menunggu lama.
          </p>
        </div>
      </div>

      <div class="col col-md-4">
        <div class="card" style="border-radius:15px; border-style:none;">
          <img class="img-kendala" src="{{ asset('images/keluarga.jpg') }}" alt="" style="border-radius: 15px;">
          <h3 class="p-2">KELUARGA</h3>
          <p> Beritahu kendala-kendala yang anda alami sebagai warga Gampong Ulee Blang Mane serta dapatkan solusi terbaik dari kami.
          </p>
        </div>
      </div>

      <div class="col col-md-4">
        <div class="card" style="border-radius:15px; border-style:none;">
          <img class="img-kendala" src="{{ asset('images/izin.jpg') }}" alt="" style="border-radius: 15px;">
          <h3 class="p-2">IZIN 1 X 24 JAM</h3>
          <p> Sampaikan permohonan izin anda sebagai pendatang di Gampong kami Ulee Blang Mane dengan cepat dan mudah.
          </p>
        </div>
      </div>
    </div>
  </div>

  <section class="administrasi p-5" style="background-image: linear-gradient(to right, #5080da,#012258); color:white">
    <div class="container">
      <div class="row">
        <div class="col-sm-6 col-md">
          <h4>ADMINISTRASI</h4>
          <p>Buat permintaan surat administrasi yang anda butuhkan pada menu request di bawah ini.</p>
          <a class="btn btn-adm px-4" href="/administrasi/form-adm">Request</a>
  
          <h4 class="mt-5">KONTAK</h4>
          <a class="btn btn-adm px-4" href="#">
            <i class="fa-brands fa-whatsapp"></i>
            +62 813 6441 2394
          </a>
        </div>
        
        <div class="col-sm-6 col-md">
          <h4>MASUKAN</h4>
          <form action="/administrasi/masukan" method="post">
            @csrf
            <div class="mb-3">
              <label for="email" class="form-label">Email Address</label>
              <input type="email" class="form-control rounded-3" name="email" id="email" required>
            </div>
            <div class="mb-3">
              <label for="masukan" class="form-label">Masukan</label>
              <textarea class="form-control rounded-3" name="masukan" id="masukan" placeholder="Tuliskan masukan anda untuk gampong kami" rows="3" required></textarea>
            </div>
            <div class="text-end">
              <button type="submit" class="btn btn-adm px-4">Kirim</button>
            </div>
          </form>
        </div>
  
        <div class="col-sm-6 col-md">
          <h4>PERIZINAN</h4>
          <P>Buat permohonan izin anda pada menu request di bawah ini. </P>
          <a class="btn btn-adm px-4" href="/administrasi/form-izin">Request</a>
        </div>
      </div>
    </div>
  </section>
@endsection
