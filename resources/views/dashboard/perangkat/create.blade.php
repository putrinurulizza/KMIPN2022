@extends('dashboard.layouts.main')

@section('content')
  <div class="row">
    <div class="col col-md-6">
      <a class="btn btn-outline-secondary" href="{{ route('perangkat-gampong.index') }}">
        <i class="fa-regular fa-chevron-left me-2"></i>
        Kembali
      </a>

      <div class="card mt-3">
        <div class="card-body">
          {{-- Form Perangkat Gampong --}}
          <form action="{{ route('perangkat-gampong.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
              <label for="nama" class="form-label">Nama Lengkap</label>
              <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" id="nama" value="{{ old('nama') }}" autofocus required>
              @error('nama')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>

            <div class="mb-3">
              <label for="id_jabatan" class="form-label">Jabatan</label>
              <select class="form-select @error('id_jabatan') is-invalid @enderror" name="id_jabatan" id="id_jabatan">
                @foreach ($jabatans as $jabatan)
                  @if (old('id_jabatan') == $jabatan->id)
                    <option value="{{ $jabatan->id }}" selected>{{ $jabatan->nama }}</option>
                  @else
                    <option value="{{ $jabatan->id }}">{{ $jabatan->nama }}</option>
                  @endif
                @endforeach
              </select>
              @error('id_jabatan')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>

            <div class="mb-3">
              <label for="foto" class="form-label">Foto</label>
              <img class="img-preview img-fluid mb-3 col-sm-5">
              <input class="form-control @error('foto') is-invalid @enderror" type="file" name="foto" id="foto" onchange="previewImage()">
              @error('foto')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="text-end">
              <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
          </form>
          {{-- End Form Perangkat Gampong --}}
        </div>
      </div>
    </div>
  </div>

  <script>
    function previewImage() {
      const image = document.querySelector('#foto');
      const imgPreview = document.querySelector('.img-preview');

      imgPreview.style.display = 'block';

      const oFReader = new FileReader();
      oFReader.readAsDataURL(image.files[0]);

      oFReader.onload = function(OFREvent) {
        imgPreview.src = OFREvent.target.result;
      }
    }
  </script>
@endsection
