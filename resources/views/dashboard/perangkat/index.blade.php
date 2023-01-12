@extends('dashboard.layouts.main')

@section('content')
  <div class="row">
    <div class="col-md-10">
      <a class="btn btn-primary" href="{{ route('perangkat-gampong.create') }}">
        <i class="fa-regular fa-plus me-2"></i>
        Tambah
      </a>

      <div class="card mt-3">
        <div class="card-body">
          {{-- Table --}}
          <table id="myTable" class="table responsive nowrap table-bordered table-striped align-middle" style="width:100%">
            <thead>
              <tr>
                <th>#</th>
                <th>Foto</th>
                <th>Nama Lengkap</th>
                <th>Jabatan</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($perangkats as $perangkat)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>
                    <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#modalLihatFoto{{ $loop->iteration }}">
                      <i class="fa-regular fa-eye me-1"></i>
                      Lihat Foto
                    </button>
                  </td>
                  <td>{{ $perangkat->nama }}</td>
                  <td>{{ $perangkat->jabatan->nama }}</td>
                  <td>
                    <a href="{{ route('perangkat-gampong.edit', $perangkat->id) }}" class="btn btn-sm btn-warning">
                      <i class="fa-regular fa-pen-to-square"></i>
                    </a>
                    <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#modalHapus{{ $loop->iteration }}">
                      <i class="fa-regular fa-trash-can"></i>
                    </button>
                  </td>
                </tr>

                {{-- Modal Hapus Perangkat Gampong --}}
                <div class="modal fade" id="modalHapus{{ $loop->iteration }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Hapus Perangkat Gampong</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <form action="{{ route('perangkat-gampong.destroy', $perangkat->id) }}" method="post">
                        @method('delete')
                        @csrf
                        <div class="modal-body">
                          <p class="fs-6">Apakah anda yakin akan menghapus <b>{{ $perangkat->nama }}</b> dari Perangkat Gampong?</p>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                          <button type="submit" class="btn btn-outline-danger">Hapus</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                {{-- / Modal Hapus Perangkat Gampong --}}

                {{-- Modal Lihat Foto --}}
                <div class="modal fade" id="modalLihatFoto{{ $loop->iteration }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Lihat Foto</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body text-center">
                        <img class="rounded-3" src="{{ asset('storage/' . $perangkat->foto) }}" alt="{{ 'KTP-' . $perangkat->nama }}" height="300">
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                      </div>
                    </div>
                  </div>
                </div>
                {{-- / Modal Lihat Foto --}}
              @endforeach
            </tbody>
          </table>
          {{-- End Table --}}
        </div>
      </div>
    </div>
  </div>
  </div>
@endsection
