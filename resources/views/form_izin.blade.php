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

      <h1 class="text-center fw-bold my-4" style="color:#000957;">FORM PERIZINAN</h1>
      <div class="col">
        <div class="card">
          <div class="card-body">
            <form action="/administrasi/perizinan" method="post" enctype="multipart/form-data">
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
                <label for="alamat" class="form-label">Alamat Rumah/Tempat Menginap</label>
                <textarea class="form-control @error('alamat') is-invalid @enderror" name="alamat" id="alamat" required>{{ old('alamat') }}</textarea>
                @error('alamat')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
              <div class="mb-3">
                <label for="ktp" class="form-label">Upload Kartu Tanda Penduduk (KTP)</label>
                <input type="file" class="form-control @error('ktp') is-invalid @enderror" name="ktp" id="ktp" required>
                @error('ktp')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
              <div class="mb-3">
                <label for="izin" class="form-label">Permohonan Izin</label>
                <textarea class="form-control @error('izin') is-invalid @enderror" name="izin" id="izin" rows="5" required>{{ old('izin') }}</textarea>
                @error('izin')
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
@endsection
