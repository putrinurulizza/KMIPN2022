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

      @if (session()->has('failed'))
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('failed') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif
    </div>
  </div>

  <div class="row">
    <div class="col">
      <a class="btn btn-primary" href="{{ route('user.create') }}">
        <i class="fa-regular fa-plus me-2"></i>
        Tambah
      </a>

      <div class="card mt-3">
        <div class="card-body">
          {{-- Table --}}
          <table id="myTable" class="table responsive nowrap table-bordered table-striped align-middle" style="width:100%">
            <thead>
              <tr>
                <th>#</th>
                <th>Nama Lengkap</th>
                <th>Username</th>
                <th>Alamat</th>
                <th>No. Hp</th>
                <th>Role</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($users as $user)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $user->nama }}</td>
                  <td>{{ '@' . $user->username }}</td>
                  <td>{{ $user->alamat }}</td>
                  <td>{{ '+62' . $user->no_hp }}</td>
                  <td>
                    @php
                      if ($user->role == 0) {
                          $role = 'Warga';
                      } elseif ($user->role == 1) {
                          $role = 'Admin';
                      } elseif ($user->role == 2) {
                          $role = 'Sekretaris Desa';
                      } elseif ($user->role == 3) {
                          $role = 'Bendahara Desa';
                      }
                    @endphp
                    {{ $role }}
                  </td>
                  <td>
                    <button class="btn btn-sm btn-dark" data-bs-toggle="modal" data-bs-target="#modalResetPassword{{ $loop->iteration }}">
                      <i class="fa-regular fa-unlock-keyhole"></i>
                    </button>
                    <a href="{{ route('user.edit', $user->id) }}" class="btn btn-sm btn-warning">
                      <i class="fa-regular fa-pen-to-square"></i>
                    </a>
                    @if ($user->role != 1)
                      <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#modalHapus{{ $loop->iteration }}">
                        <i class="fa-regular fa-trash-can fa-lg"></i>
                      </button>
                    @endif
                  </td>
                </tr>

                {{-- Modal Hapus User --}}
                <div class="modal fade" id="modalHapus{{ $loop->iteration }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Hapus User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <form action="{{ route('user.destroy', $user->id) }}" method="post">
                        @method('delete')
                        @csrf
                        <div class="modal-body">
                          <p class="fs-6">Apakah anda yakin akan menghapus user <b>{{ '@' . $user->username }}</b>?</p>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                          <button type="submit" class="btn btn-outline-danger">Hapus</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                {{-- / Modal Hapus User --}}

                {{-- Modal Reset Password --}}
                <div class="modal fade" id="modalResetPassword{{ $loop->iteration }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <form action="/dashboard/user/reset-password" method="post">
                        @csrf
                        <div class="modal-body">
                          <input type="hidden" name="id" value="{{ $user->id }}">
                          <div class="mb-3">
                            <label for="password" class="form-label">Password Baru</label>
                            <div id="pwd1" class="input-group">
                              <input type="password" class="form-control border-end-0 @error('password') is-invalid @enderror" name="password" id="password" value="{{ old('password') }}" required>
                              <span class="input-group-text cursor-pointer">
                                <i class="fa-regular fa-eye-slash" id="togglePassword"></i>
                              </span>
                              @error('password')
                                <div class="invalid-feedback">
                                  {{ $message }}
                                </div>
                              @enderror
                            </div>
                          </div>

                          <div class="mb-3">
                            <label for="password2" class="form-label">Konfirmasi Password Baru</label>
                            <div id="pwd2" class="input-group">
                              <input type="password" class="form-control border-end-0 @error('password2') is-invalid @enderror" name="password2" id="password2" value="{{ old('password2') }}" required>
                              <span class="input-group-text cursor-pointer">
                                <i class="fa-regular fa-eye-slash" id="togglePassword"></i>
                              </span>
                              @error('password2')
                                <div class="invalid-feedback">
                                  {{ $message }}
                                </div>
                              @enderror
                            </div>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                {{-- / Modal Reset Password --}}
              @endforeach
            </tbody>
          </table>
          {{-- End Table --}}
        </div>
      </div>
    </div>
  </div>
  </div>

  <script>
    const input1 = document.querySelector("#pwd1 input");
    const eye1 = document.querySelector("#pwd1 .fa-eye-slash");

    eye1.addEventListener("click", () => {
      if (input1.type === "password") {
        input1.type = "text";

        eye1.classList.remove("fa-eye-slash");
        eye1.classList.add("fa-eye");
      } else {
        input1.type = "password";

        eye1.classList.remove("fa-eye");
        eye1.classList.add("fa-eye-slash");
      }
    });

    const input2 = document.querySelector("#pwd2 input");
    const eye2 = document.querySelector("#pwd2 .fa-eye-slash");

    eye2.addEventListener("click", () => {
      if (input2.type === "password") {
        input2.type = "text";

        eye2.classList.remove("fa-eye-slash");
        eye2.classList.add("fa-eye");
      } else {
        input2.type = "password";

        eye2.classList.remove("fa-eye");
        eye2.classList.add("fa-eye-slash");
      }
    });
  </script>
@endsection
