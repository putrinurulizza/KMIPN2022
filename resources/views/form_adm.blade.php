@extends('layouts.main')

@section('content')
  <div class="container my-5 d-flex justify-content-center">
    <div class="row">
      @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif

      <h1 class="text-center fw-bold my-4" style="color:#000957;">FORM ADMINISTRASI</h1>
      <div class="col">
        <div class="card">
          <div class="card-body">
            <form action="/administrasi/form-adm" method="post" enctype="multipart/form-data">
              @csrf
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required autofocus>
                @error('email')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
              <div class="mb-3">
                <label for="nama" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control  @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama') }}" required>
                @error('nama')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
              <div class="mb-3">
                <label for="telp" class="form-label">No. Hp</label>
                <div class="input-group">
                  <span class="input-group-text">+62</span>
                  <input type="telp" class="form-control @error('telp') is-invalid @enderror" id="telp" name="telp" value="{{ old('telp') }}" required>
                  @error('telp')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>
              <div class="mb-3">
                <label for="id_jenis_surat" class="form-label">Jenis Surat</label>
                <select class="form-select" id="id_jenis_surat" name="id_jenis_surat" required>
                  <option disabled selected>Pilih Jenis Surat</option>
                  @foreach ($jenis_surats as $jenis_surat)
                    @if (old('id_jenis_surat') == $jenis_surat->id)
                      <option value="{{ $jenis_surat->id }}" selected>{{ $jenis_surat->nama }}</option>
                    @else
                      <option value="{{ $jenis_surat->id }}">{{ $jenis_surat->nama }}</option>
                    @endif
                  @endforeach
                </select>
              </div>
              <div class="mb-3">
                <label for="kk" class="form-label">Upload Kartu Keluarga (KK)</label>
                <img class="img-preview1 img-fluid mb-3 col-sm-3">
                <input type="file" class="form-control @error('kk') is-invalid @enderror" name="kk" id="kk" onchange="previewKK()" required>
                <div id="kkHelp" class="form-text">Ekstensi file: JPG, PNG maksimal 2MB</div>
                @error('kk')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
              <div class="mb-3">
                <label for="ktp" class="form-label">Upload Kartu Tanda Penduduk (KTP)</label>
                <img class="img-preview2 img-fluid mb-3 col-sm-3">
                <input type="file" class="form-control @error('ktp') is-invalid @enderror" name="ktp" id="ktp" onchange="previewKTP()" required>
                <div id="ktpHelp" class="form-text">Ekstensi file: JPG, PNG maksimal 2MB</div>
                @error('ktp')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
              <div class="text-end">
                <button type="submit" class="btn btn-primary">Kirim</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    function previewKK() {
      const image = document.querySelector('#kk');
      const imgPreview = document.querySelector('.img-preview1');

      imgPreview.style.display = 'block';

      const oFReader = new FileReader();
      oFReader.readAsDataURL(image.files[0]);

      oFReader.onload = function(OFREvent) {
        imgPreview.src = OFREvent.target.result;
      }
    }

    function previewKTP() {
      const image = document.querySelector('#ktp');
      const imgPreview = document.querySelector('.img-preview2');

      imgPreview.style.display = 'block';

      const oFReader = new FileReader();
      oFReader.readAsDataURL(image.files[0]);

      oFReader.onload = function(OFREvent) {
        imgPreview.src = OFREvent.target.result;
      }
    }
  </script>
@endsection
