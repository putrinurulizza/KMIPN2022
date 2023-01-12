@extends('dashboard.layouts.main')

@section('content')
  <div class="row">
    <div class="col col-md-8 col-lg-6">
      {{-- Button --}}
      <a class="btn btn-outline-secondary" href="{{ route('keuangan.index') }}">
        <i class="fa-regular fa-chevron-left me-2"></i>
        Kembali
      </a>
      {{-- End Button --}}

      <div class="card mt-3">
        <div class="card-body">
          <form action="{{ route('keuangan.update', $keuangan->id) }}" method="post" enctype="multipart/form-data">
            @method('put')
            @csrf
            <div class="mb-3">
              <label for="sumber_dana" class="form-label">Sumber Dana</label>
              <input type="text" class="form-control @error('sumber_dana') is-invalid @enderror" name="sumber_dana" id="sumber_dana" value="{{ old('sumber_dana', $keuangan->sumber_dana) }}" autofocus required>
              @error('sumber_dana')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="mb-3">
              <label for="pemasukan" class="form-label">Pemasukan</label>
              <input type="text" class="form-control @error('pemasukan') is-invalid @enderror" name="pemasukan" id="pemasukan" value="{{ old('pemasukan', $keuangan->pemasukan) }}">
              @error('pemasukan')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="mb-3">
              <label for="pengeluaran" class="form-label">Pengeluaran</label>
              <input type="text" class="form-control @error('pengeluaran') is-invalid @enderror" name="pengeluaran" id="pengeluaran" value="{{ old('pengeluaran', $keuangan->pengeluaran) }}">
              @error('pengeluaran')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="mb-3">
              <label for="bukti" class="form-label">Bukti</label>
              <input type="hidden" name="oldBukti" value="{{ $keuangan->bukti }}">
              @if ($keuangan->bukti)
                <img src="{{ asset('storage/' . $keuangan->bukti) }}" class="img-preview img-fluid mb-3 col-sm-5 d-block">
              @else
                <img class="img-preview img-fluid mb-3 col-sm-5">
              @endif
              <input class="form-control @error('bukti') is-invalid @enderror" type="file" name="bukti" id="bukti" onchange="previewImage()">
              <div id="buktiHelp" class="form-text">Ekstensi file: JPG, PNG maksimal 2MB</div>
              @error('bukti')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="text-end">
              <button type="submit" class="btn btn-primary">Update Data</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script>
    function previewImage() {
      const image = document.querySelector('#bukti');
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
