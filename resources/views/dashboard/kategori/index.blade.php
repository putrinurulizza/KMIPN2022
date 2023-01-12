@extends('dashboard.layouts.main')

@section('content')
  <div class="row">
    <div class="col-lg-6">
      @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @elseif (session()->has('failed'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          {{ session('failed') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif
    </div>
  </div>

  <div class="row">
    <div class="col">
      <a class="btn btn-primary" href="{{ route('kategori-berita.create') }}">
        <i class="fa-regular fa-plus me-2"></i>
        Tambah
      </a>
    </div>
  </div>

  <div class="row">
    <div class="col col-lg-6">
      <div class="card mt-3">
        <div class="card-body">
          {{-- Table --}}
          <table id="myTable" class="table responsive nowrap table-bordered table-striped align-middle" style="width:100%">
            <thead>
              <tr>
                <th>#</th>
                <th>Nama Kategori</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($kategoris as $kategori)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $kategori->nama }}</td>
                  <td>
                    <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $loop->iteration }}">
                      <i class="fa-regular fa-pen-to-square"></i>
                    </button>
                    <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#modalHapus{{ $loop->iteration }}">
                      <i class="fa-regular fa-trash-can fa-lg"></i>
                    </button>
                  </td>
                </tr>

                {{-- Modal Edit Kategori --}}
                <div class="modal fade" id="modalEdit{{ $loop->iteration }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Kategori Berita</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <form action="{{ route('kategori-berita.update', $kategori->id) }}" method="post">
                        <div class="modal-body">
                          @method('put')
                          @csrf
                          <div class="mb-3">
                            <label for="nama" class="form-label">Nama Kategori</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" id="nama" value="{{ old('nama', $kategori->nama) }}" autofocus required>
                            @error('nama')
                              <div class="invalid-feedback">
                                {{ $message }}
                              </div>
                            @enderror
                          </div>
                          <div class="mb-3">
                            <label for="slug" class="form-label">Slug</label>
                            <input type="text" class="form-control @error('slug') is-invalid @enderror" name="slug" id="slug" value="{{ old('slug', $kategori->slug) }}" required>
                            @error('slug')
                              <div class="invalid-feedback">
                                {{ $message }}
                              </div>
                            @enderror
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                          <button type="submit" class="btn btn-primary">Simpan Kategori</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                {{-- / Modal Edit Kategori --}}

                {{-- Modal Hapus Kategori --}}
                <div class="modal fade" id="modalHapus{{ $loop->iteration }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Hapus Kategori</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <form action="{{ route('kategori-berita.destroy', $kategori->slug) }}" method="post">
                        @method('delete')
                        @csrf
                        <div class="modal-body">
                          <p class="fs-6">Apakah anda yakin akan menghapus kategori <b>{{ $kategori->nama }}</b>?</p>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                          <button type="submit" class="btn btn-outline-danger">Hapus</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                {{-- / Modal Hapus Kategori --}}
              @endforeach
            </tbody>
          </table>
          {{-- End Table --}}
        </div>
      </div>
    </div>
  </div>

  <script>
    const nama = document.querySelector('#nama');
    const slug = document.querySelector('#slug');

    nama.addEventListener('change', function() {
      fetch('/dashboard/berita/kategori-berita/createSlug?nama=' + nama.value)
        .then(response => response.json())
        .then(data => slug.value = data.slug)
    });
  </script>
@endsection
