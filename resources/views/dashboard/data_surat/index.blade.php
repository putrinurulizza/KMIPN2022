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

  <div class="row">
    <div class="col">
      <a class="btn btn-primary" href="{{ route('data-surat.create') }}">
        <i class="fa-regular fa-plus me-2"></i>
        Tambah
      </a>
    </div>
  </div>

  <div class="row">
    <div class="col">
      <div class="card mt-3">
        <div class="card-body">
          {{-- Tabel Data Surat --}}
          <table id="myTable" class="table responsive nowrap table-bordered table-striped align-middle" style="width:100%">
            <thead>
              <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Email</th>
                <th>No Hp</th>
                <th>jenis Surat</th>
                <th>KK</th>
                <th>KTP</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($surats as $surat)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $surat->nama }}</td>
                  <td>{{ $surat->email }}</td>
                  <td>{{ '+62' . $surat->telp }}</td>
                  <td>{{ $surat->jenis_surat->nama }}</td>
                  <td>
                    <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#modalLihatKK{{ $loop->iteration }}">
                      <i class="fa-regular fa-eye me-1"></i>
                      Lihat KK
                    </button>
                  </td>
                  <td>
                    <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#modalLihatKTP{{ $loop->iteration }}">
                      <i class="fa-regular fa-eye me-1"></i>
                      Lihat KTP
                    </button>
                  </td>
                  <td>
                    @php
                      if ($surat->status == 1) {
                          $bg = 'bg-warning text-dark';
                          $status = 'Sedang Diproses';
                      } elseif ($surat->status == 2) {
                          $bg = 'bg-info';
                          $status = 'Selesai Dibuat';
                      } elseif ($surat->status == 3) {
                          $bg = 'bg-success';
                          $status = 'Sudah Diambil';
                      }
                    @endphp
                    <span class="badge {{ $bg }}">{{ $status }}</span>
                  </td>
                  <td>
                    @if ($surat->status == 1)
                      <a href="{{ route('data-surat.edit', $surat->id) }}" class="btn btn-sm btn-warning">
                        <i class="fa-regular fa-pen-to-square"></i>
                      </a>
                      <button class="btn btn-sm btn-dark" data-bs-target="#modalSelesai{{ $loop->iteration }}" data-bs-toggle="modal">
                        <i class="fa-regular fa-envelope-circle-check"></i>
                        Selesai
                      </button>
                    @elseif ($surat->status == 2)
                      <button class="btn btn-sm btn-success" data-bs-target="#modalDiambil{{ $loop->iteration }}" data-bs-toggle="modal">
                        <i class="fa-regular fa-check me-1"></i>
                        Diambil
                      </button>
                    @endif
                  </td>
                </tr>

                {{-- Modal Lihat KK --}}
                <div class="modal fade" id="modalLihatKK{{ $loop->iteration }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Lihat KK Pemohon</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body text-center">
                        <img class="rounded-1" src="{{ asset('storage/' . $surat->kk) }}" alt="{{ 'KK' . $surat->nama }}" height="300">
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                      </div>
                    </div>
                  </div>
                </div>
                {{-- / Modal Lihat KK --}}

                {{-- Modal Lihat KTP --}}
                <div class="modal fade" id="modalLihatKTP{{ $loop->iteration }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Lihat KTP Pemohon</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body text-center">
                        <img class="rounded-1" src="{{ asset('storage/' . $surat->ktp) }}" alt="{{ 'KTP' . $surat->nama }}" height="300">
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                      </div>
                    </div>
                  </div>
                </div>
                {{-- / Modal Lihat KTP --}}

                {{-- Modal Selesai --}}
                <div class="modal fade" id="modalSelesai{{ $loop->iteration }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update Status Data Surat</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <form action="/dashboard/administrasi/data-surat" method="post">
                        @method('put')
                        @csrf
                        <div class="modal-body">
                          <input type="hidden" name="id" value="{{ $surat->id }}">
                          <input type="hidden" name="email" value="{{ $surat->email }}">
                          <input type="hidden" name="status" value="2">
                          Apakah anda yakin mengubah status menjadi <span class="badge bg-info">Selesai Dibuat</span> ?
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                          <button type="submit" class="btn btn-primary">Yakin</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                {{-- Modal Selesai --}}

                {{-- Modal Diambil --}}
                <div class="modal fade" id="modalDiambil{{ $loop->iteration }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update Status Data Surat</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <form action="/dashboard/administrasi/data-surat" method="post">
                        @method('put')
                        @csrf
                        <div class="modal-body">
                          <input type="hidden" name="id" value="{{ $surat->id }}">
                          <input type="hidden" name="status" value="3">
                          Apakah anda yakin mengubah status menjadi <span class="badge bg-success">Sudah Diambil</span> ?
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                          <button type="submit" class="btn btn-primary">Yakin</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                {{-- Modal Diambil --}}
              @endforeach
            </tbody>
          </table>
          {{-- / Tabel Data Surat --}}
        </div>
      </div>
    </div>
  </div>
@endsection
