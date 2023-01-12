@extends('dashboard.layouts.main')

@section('content')
  <div class="row">
    <div class="col">
      @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif
    </div>
  </div>

  <div class="row g-3 g-md-0 d-flex align-items-end">
    <div class="col-sm-6 col-md-9 order-1 order-md-0">
      <a class="btn btn-primary" href="{{ route('keuangan.create') }}">
        <i class="fa-regular fa-plus me-2"></i>
        Tambah
      </a>
    </div>
    <div class="col-sm-6 col-md-3 order-0 order-md-1">
      <div class="card">
        <div class="card-body d-flex align-items-center">
          <i class="fa-duotone fa-coins fa-3x text-warning"></i>
          <div class="d-flex flex-column ms-4">
            <h5 class="card-title fs-6 mb-0">Saldo Saat Ini</h5>
            <p class="card-text fs-4 fw-semibold">{{ 'Rp' . number_format($saldo, 0, ',', '.') }}</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col">
      <div class="card mt-3">
        <div class="card-body">
          {{-- Table --}}
          <table id="myTable" class="table responsive nowrap table-bordered table-striped align-middle" style="width:100%">
            <thead>
              <tr>
                <th>#</th>
                <th>Tanggal</th>
                <th>Sumber Dana</th>
                <th>Pemasukan</th>
                <th>Pengeluaran</th>
                <th>Saldo</th>
                <th>Bukti</th>
                <th>Action</th>
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
                  <td>
                    <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#modalLihat{{ $loop->iteration }}">
                      <i class="fa-regular fa-eye me-1"></i>
                      Lihat Bukti
                    </button>
                  </td>
                  <td>
                    @can('admin')
                      <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#modalHapus{{ $loop->iteration }}">
                        <i class="fa-regular fa-trash-can fa-lg"></i>
                      </button>
                    @endcan
                  </td>
                </tr>

                {{-- Modal Lihat Bukti --}}
                <div class="modal fade" id="modalLihat{{ $loop->iteration }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Lihat Bukti</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body text-center">
                        <img class="rounded-3" src="{{ asset('storage/' . $keuangan->bukti) }}" alt="{{ 'Bukti' . $keuangan->sumber_dana }}" height="300">
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                      </div>
                    </div>
                  </div>
                </div>
                {{-- / Modal Lihat Bukti --}}

                {{-- Modal Hapus Laporan Keuangan --}}
                <div class="modal fade" id="modalHapus{{ $loop->iteration }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Hapus Laporan Keuangan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <form action="{{ route('keuangan.destroy', $keuangan->id) }}" method="post">
                        @method('delete')
                        @csrf
                        <div class="modal-body">
                          <p class="fs-6">Apakah anda yakin akan menghapus data laporan keuangan ini?</p>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                          <button type="submit" class="btn btn-outline-danger">Hapus</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                {{-- / Modal Hapus Laporan Keuangan --}}
              @endforeach
            </tbody>
          </table>
          {{-- End Table --}}
        </div>
      </div>
    </div>
  </div>
@endsection
