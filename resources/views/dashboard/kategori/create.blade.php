@extends('dashboard.layouts.main')

@section('content')
  <div class="row">
    <div class="col col-lg-6">
      {{-- Button --}}
      <a class="btn btn-outline-secondary" href="{{ route('kategori-berita.index') }}">
        <i class="fa-regular fa-chevron-left me-2"></i>
        Kembali
      </a>
      {{-- End Button --}}

      <div class="card mt-3">
        <div class="card-body">
          <form action="{{ route('kategori-berita.store') }}" method="post">
            @csrf
            <div class="mb-3">
              <label for="nama" class="form-label">Nama Kategori</label>
              <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" id="nama" value="{{ old('nama') }}" autofocus required>
              @error('nama')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="mb-3">
              <label for="slug" class="form-label">Slug</label>
              <input type="text" class="form-control @error('slug') is-invalid @enderror" name="slug" id="slug" value="{{ old('slug') }}" required>
              @error('slug')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="text-end">
              <button type="submit" class="btn btn-primary">Simpan Kategori</button>
            </div>
          </form>
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
