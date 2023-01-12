@extends('layouts.main')

@section('content')
  <section id="header">
    <div class="container-fluid px-0">
      <div class="row">
        <div class="col">
          <div class="card bg-dark text-white border-0 rounded-0 p-0">
            <img id="bg-header-tentang" src="{{ asset('images/sawah.jpg') }}" class="card-img" alt="" width="100%" height="500">
            <div class="card-img-overlay d-flex align-items-center p-0">
              <h1 class="display-4 fw-semibold text-center text-white flex-fill p-4 text-uppercase">Ulee Blang Mane</h1>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="info-geo">
    <div class="container mt-5">
      <div class="row">
        <div class="col">
          <div class="gap-3 gap-md-0">
            <h2 class="text-center mt-5" style="color:#000957; font-weight: bold;">INFORMASI GEOGRAFIS</h2>
            <figure class="text-center">
              <img src="{{ asset('images/peta.jpeg') }}" class="img-fluid rounded-3 mt-3" width="1000">
              <figcaption><a href="https://www.google.co.id/maps/place/Keude+Punteut,+Kec.+Blang+Mangat,+Kota+Lhokseumawe,
                      +Aceh/@5.114676,97.1640508,16.08z/data=!4m5!3m4!1s0x304783efd1e53a21:0xe32052def041dac8!8m2!3d5.
                      1158335!4d97.1679147" class="map"> https://www.google.co.id/maps </a></figcaption>
            </figure>
            <p class="card-text mt-3">
              Batas-batas wilayah Gampong Ulee Blang Mane sebagai berikut:
            <ul>
              <li>Sebelah Timur berbatasan dengan Gampong Bayu </li>
              <li>Sebelah Barat berbatasan dengan Gampong Bukitrata </li>
            </ul>
            Luas Desa Ulee Blang Mane adalah 2 km2 dengan jumlah penduduk desa berjumlah 1185
            jiwa yang terbagi menjadi 579 laki-laki dan 606 perempuan.
            <br>Jarak dari desa ke ibukota kecamatan sekitar 9,7 km apabila melalui jalur transportasi darat.
            </p>
            <br>
          </div>
        </div>
      </div>
    </div>
  </section>

  @if (auth()->check())
    <section id="laporan">
      <div class="container mt-5">
        <div class="row">
          <h2 class="text-center mb-5" style="color:#000957; font-weight: bold;">LAPORAN KEUANGAN DESA</h2>
          <div class="col">
            <div class="card">
              <div class="card-body">
                <table id="myTable" class="table responsive nowrap table-bordered table-striped align-middle" style="width:100%">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Tanggal</th>
                      <th>Sumber Dana</th>
                      <th>Pemasukan</th>
                      <th>Pengeluaran</th>
                      <th>Saldo</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($keuangans as $keuangan)
                      <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $keuangan->created_at->format('d/m/Y') }}</td>
                        <td>{{ $keuangan->sumber_dana }}</td>
                        <td>{{ 'Rp' . number_format($keuangan->pemasukan, 0, ',', '.') }}</td>
                        <td>{{ 'Rp' . number_format($keuangan->pengeluaran, 0, ',', '.') }}</td>
                        <td>{{ 'Rp' . number_format($keuangan->saldo, 0, ',', '.') }}</td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  @endif

  <section id="masukan">
    <div class="container my-5">
      <div class="row">
        <h2 class="text-center mb-5" style="color:#000957; font-weight: bold;">SOLUSI KAMI</h2>
        <div class="col">
          <div class="accordion accordion-flush" id="accordionFlushExample">
            <div class="accordion-item">
              <h2 class="accordion-header" id="flush-headingOne">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                  {{ $solusis[0]->masukan }}
                </button>
              </h2>
              <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">{{ $solusis[0]->respon }}</div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header" id="flush-headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                  {{ $solusis[1]->masukan }}
                </button>
              </h2>
              <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">{{ $solusis[1]->respon }}</div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header" id="flush-headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                  {{ $solusis[2]->masukan }}
                </button>
              </h2>
              <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">{{ $solusis[2]->respon }}</div>
              </div>
            </div>
          </div>
          <div class="text-center mt-5">
            <button type="button" class="btn btn-primary px-4" data-bs-toggle="modal" data-bs-target="#modalSolusi">
              Selengkapnya
            </button>
          </div>
        </div>
      </div>
    </div>
  </section>

  <div class="modal fade" id="modalSolusi" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Solusi Kami</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="accordion accordion-flush" id="accordionFlushExample">
            @foreach ($solusis as $solusi)
              <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingOne">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{ $loop->iteration }}" aria-expanded="false" aria-controls="flush-collapseOne">
                    {{ $solusi->masukan }}
                  </button>
                </h2>
                <div id="flush-collapse{{ $loop->iteration }}" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                  <div class="accordion-body">{{ $solusi->respon }}</div>
                </div>
              </div>
            @endforeach
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        </div>
      </div>
    </div>
  </div>
@endsection
