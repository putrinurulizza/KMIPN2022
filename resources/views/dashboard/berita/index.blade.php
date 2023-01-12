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
      <a class="btn btn-primary" href="{{ route('data-berita.create') }}">
        <i class="fa-regular fa-plus me-2"></i>
        Tambah
      </a>
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
                <th>Judul</th>
                <th>Kategori</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($beritas as $berita)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $berita->judul }}</td>
                  <td>{{ $berita->kategori->nama }}</td>
                  <td>
                    <a href="{{ route('data-berita.show', $berita->slug) }}" class="btn btn-sm btn-info">
                      <i class="fa-regular fa-eye"></i>
                    </a>
                    <a href="{{ route('data-berita.edit', $berita->slug) }}" class="btn btn-sm btn-warning">
                      <i class="fa-regular fa-pen-to-square"></i>
                    </a>
                    <a href="#modalHapus{{ $loop->iteration }}" class="btn btn-sm btn-danger" data-bs-toggle="modal">
                      <i class="fa-regular fa-trash-can fa-lg"></i>
                    </a>
                  </td>
                </tr>

                {{-- Modal Hapus Berita --}}
                <div class="modal fade" id="modalHapus{{ $loop->iteration }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Hapus Berita</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <form action="{{ route('data-berita.destroy', $berita->slug) }}" method="post">
                        @method('delete')
                        @csrf
                        <div class="modal-body">
                          <p class="fs-6">Apakah anda yakin akan menghapus berita <b>{{ $berita->judul }}</b>?</p>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                          <button type="submit" class="btn btn-outline-danger">Hapus</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                {{-- / Modal Hapus Berita --}}
              @endforeach
            </tbody>
          </table>
          {{-- End Table --}}
        </div>
      </div>
    </div>
  </div>
@endsection
