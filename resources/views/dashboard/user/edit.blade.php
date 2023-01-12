@extends('dashboard.layouts.main')

@section('content')
  <div class="row">
    <div class="col col-md-6">
      <a class="btn btn-outline-secondary" href="{{ route('user.index') }}">
        <i class="fa-regular fa-chevron-left me-2"></i>
        Kembali
      </a>

      <div class="card mt-3">
        <div class="card-body">
          {{-- Form Berita --}}
          <form action="{{ route('user.update', $user->id) }}" method="post">
            @method('put')
            @csrf
            <div class="mb-3">
              <label for="nama" class="form-label">Nama Lengkap</label>
              <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" id="nama" value="{{ old('nama', $user->nama) }}" autofocus required>
              @error('nama')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>

            <div class="mb-3">
              <label for="username" class="form-label">Username</label>
              <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" id="username" value="{{ old('username', $user->username) }}" required>
              @error('username')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>

            <div class="mb-3">
              <label for="alamat" class="form-label">Alamat</label>
              <input type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat" id="alamat" value="{{ old('alamat', $user->alamat) }}" required>
              @error('alamat')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>

            <div class="mb-3">
              <label for="no_hp" class="form-label">No. HP</label>
              <div class="input-group">
                <span class="input-group-text">+62</span>
                <input type="text" class="form-control @error('no_hp') is-invalid @enderror" name="no_hp" id="no_hp" value="{{ old('no_hp', $user->no_hp) }}" required>
                @error('no_hp')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
            </div>

            <div class="mb-3">
              <label for="role" class="form-label">Role</label>
              <select class="form-select" name="role" id="role">
                <option value="0">Warga</option>
                <option value="1">Admin</option>
                <option value="2">Sekretaris Desa</option>
                <option value="3">Bendahara Desa</option>
              </select>
            </div>
            <div class="text-end">
              <button type="submit" class="btn btn-primary">Update User</button>
            </div>
          </form>
          {{-- End Form Berita --}}
        </div>
      </div>
    </div>
  </div>

  <script src="{{ asset('js/show-hide-password.js') }}"></script>
@endsection
