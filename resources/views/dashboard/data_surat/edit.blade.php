@extends('dashboard.layouts.main')

@section('content')
  <div class="row">
    <div class="col col-md-9">
      {{-- Button --}}
      <a class="btn btn-outline-secondary" href="{{ route('data-surat.index') }}">
        <i class="fa-regular fa-chevron-left me-2"></i>
        Kembali
      </a>
      {{-- End Button --}}

      <div class="card mt-3">
        <div class="card-body">
          {{-- Form Data Surat --}}
          <form action="{{ route('data-surat.update', $surat->id) }}" method="post" enctype="multipart/form-data">
            @method('put')
            @csrf
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $surat->email) }}" required autofocus>
              @error('email')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="mb-3">
              <label for="nama" class="form-label">Nama Lengkap</label>
              <input type="text" class="form-control  @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama', $surat->nama) }}" required>
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
                <input type="telp" class="form-control @error('telp') is-invalid @enderror" id="telp" name="telp" value="{{ old('telp', $surat->telp) }}" required>
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
                  @if (old('id_jenis_surat', $surat->id_jenis_surat) == $jenis_surat->id)
                    <option value="{{ $jenis_surat->id }}" selected>{{ $jenis_surat->nama }}</option>
                  @else
                    <option value="{{ $jenis_surat->id }}">{{ $jenis_surat->nama }}</option>
                  @endif
                @endforeach
              </select>
            </div>
            <div class="mb-3">
              <label for="kk" class="form-label">Upload Kartu Keluarga (KK)</label>
              <input type="hidden" name="oldKK" value="{{ $surat->kk }}">
              <img src="{{ asset('storage/' . $surat->kk) }}" class="img-preview1 img-fluid mb-3 col-sm-5 d-block">

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
              <input type="hidden" name="oldKTP" value="{{ $surat->ktp }}">
              <img src="{{ asset('storage/' . $surat->ktp) }}" class="img-preview2 img-fluid mb-3 col-sm-5 d-block">

              <input type="file" class="form-control @error('ktp') is-invalid @enderror" name="ktp" id="ktp" onchange="previewKTP()" required>
              <div id="ktpHelp" class="form-text">Ekstensi file: JPG, PNG maksimal 2MB</div>
              @error('ktp')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="text-end">
              <button type="submit" class="btn btn-primary">Update Permohonan</button>
            </div>
          </form>
          {{-- End Form Data Surat --}}
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
