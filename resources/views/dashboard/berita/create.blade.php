@extends('dashboard.layouts.main')

@section('content')
  <div class="row">
    <div class="col col-md-9">
      {{-- Button --}}
      <a class="btn btn-outline-secondary" href="{{ route('data-berita.index') }}">
        <i class="fa-regular fa-chevron-left me-2"></i>
        Kembali
      </a>
      {{-- End Button --}}

      <div class="card mt-3">
        <div class="card-body">
          {{-- Form Berita --}}
          <form action="{{ route('data-berita.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
              <label for="judul" class="form-label">Judul</label>
              <input type="text" class="form-control @error('judul') is-invalid @enderror" name="judul" id="judul" value="{{ old('judul') }}" autofocus required>
              @error('judul')
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
            <div class="mb-3">
              <label for="id_kategori" class="form-label">Category</label>
              <select class="form-select" name="id_kategori" id="id_kategori">
                @foreach ($kategoris as $kategori)
                  @if (old('id_kategori') == $kategori->id)
                    <option value="{{ $kategori->id }}" selected>{{ $kategori->nama }}</option>
                  @else
                    <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                  @endif
                @endforeach
              </select>
            </div>
            <div class="mb-3">
              <label for="thumbnail" class="form-label">Thumbnail</label>
              <img class="img-preview img-fluid mb-3 col-sm-5">
              <input class="form-control @error('thumbnail') is-invalid @enderror" type="file" name="thumbnail" id="thumbnail" onchange="previewImage()">
              <div id="thumbnailHelp" class="form-text">Ekstensi file: JPG, PNG maksimal 2MB</div>
              @error('thumbnail')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="mb-3">
              <label for="isi" class="form-label">Isi Berita</label>
              @error('isi')
                <p class="text-danger">{{ $message }}</p>
              @enderror
              <input id="isi" type="hidden" name="isi" value="{{ old('isi') }}">
              <trix-editor input="isi"></trix-editor>
            </div>
            <div class="text-end">
              <button type="submit" class="btn btn-primary">Buat Berita</button>
            </div>
          </form>
          {{-- End Form Berita --}}
        </div>
      </div>
    </div>
  </div>

  <script>
    const judul = document.querySelector('#judul');
    const slug = document.querySelector('#slug');

    judul.addEventListener('change', function() {
      fetch('/dashboard/berita/data-berita/checkSlug?judul=' + judul.value)
        .then(response => response.json())
        .then(data => slug.value = data.slug)
    });

    document.addEventListener('trix-file-accept', function(e) {
      e.preventDefault();
    });

    function previewImage() {
      const image = document.querySelector('#thumbnail');
      const imgPreview = document.querySelector('.img-preview');

      imgPreview.style.display = 'block';

      const oFReader = new FileReader();
      oFReader.readAsDataURL(image.files[0]);

      oFReader.onload = function(OFREvent) {
        imgPreview.src = OFREvent.target.result;
      }
    }
  </script>

  {{-- Trix JS --}}
  <script type="text/javascript" src="{{ asset('js/trix.js') }}"></script>
@endsection
