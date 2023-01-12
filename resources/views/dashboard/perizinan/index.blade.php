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
    </div>
  </div>

  <div class="row">
    <div class="col">
      <div class="card mt-3">
        <div class="card-body">
          {{-- table 1 --}}
          <table id="myTable" class="table responsive nowrap table-bordered table-striped align-middle" style="width:100%">
            <thead>
              <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Email</th>
                <th>Nama</th>
                <th>No Hp</th>
                <th>Alamat</th>
                <th>KTP</th>
                <th>Permohonan Izin</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($perizinans as $perizinan)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $perizinan->created_at->format('d/m/Y') }}</td>
                  <td>{{ $perizinan->email }}</td>
                  <td>{{ $perizinan->nama }}</td>
                  <td>{{ '+62' . $perizinan->telp }}</td>
                  <td>{{ $perizinan->alamat }}</td>
                  <td>
                    <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#modalLihatKTP{{ $loop->iteration }}">
                      <i class="fa-regular fa-eye me-1"></i>
                      Lihat KTP
                    </button>
                  </td>
                  <td>
                    <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#modalLihat{{ $loop->iteration }}">
                      <i class="fa-regular fa-eye me-1"></i>
                      Lihat Permohonan
                    </button>
                  </td>
                  <td>
                    @php
                      if ($perizinan->status == 1) {
                          $bg = 'bg-warning text-dark';
                          $status = 'Pending';
                      } elseif ($perizinan->status == 2) {
                          $bg = 'bg-success';
                          $status = 'Diterima';
                      } elseif ($perizinan->status == 3) {
                          $bg = 'bg-danger';
                          $status = 'Ditolak';
                      }
                    @endphp
                    <span class="badge {{ $bg }}">{{ $status }}</span>
                  </td>
                  <td>
                    @if ($perizinan->status == 1)
                      <button type="button" class="btn btn-sm btn-dark" data-bs-toggle="modal" data-bs-target="#modalKonfirmasi{{ $loop->iteration }}">
                        <i class="fa-regular fa-check me-1"></i>
                        Konfirmasi
                      </button>
                    @endif
                  </td>
                </tr>

                {{-- Modal Lihat KTP --}}
                <div class="modal fade" id="modalLihatKTP{{ $loop->iteration }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Lihat KTP Pemohon</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body text-center">
                        <img class="rounded-3" src="{{ asset('storage/' . $perizinan->ktp) }}" alt="{{ 'KTP' . $perizinan->nama }}" height="300">
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                      </div>
                    </div>
                  </div>
                </div>
                {{-- / Modal Lihat KTP --}}

                {{-- Modal Lihat Perizinan --}}
                <div class="modal fade" id="modalLihat{{ $loop->iteration }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Lihat Permohonan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <div class="mb-3">
                          <label for="izin" class="form-label">Permohonan Izin</label>
                          <textarea class="form-control" name="izin" id="izin" rows="5" disabled>{{ $perizinan->izin }}</textarea>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                      </div>
                    </div>
                  </div>
                </div>
                {{-- / Modal Lihat Perizinan --}}

                {{-- Modal Konfirmasi Perizinan --}}
                <div class="modal fade" id="modalKonfirmasi{{ $loop->iteration }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Perizinan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <form action="/dashboard/administrasi/perizinan" method="post">
                        @method('put')
                        @csrf
                        <div class="modal-body">
                          <input type="hidden" name="id" value="{{ $perizinan->id }}">
                          <input type="hidden" name="email" value="{{ $perizinan->email }}">
                          <input type="hidden" name="nama" value="{{ $perizinan->nama }}">
                          <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" name="status" id="status" required>
                              <option value="2">Diterima</option>
                              <option value="3">Ditolak</option>
                            </select>
                          </div>
                          <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan (Opsional)</label>
                            <textarea class="form-control" name="keterangan" id="keterangan" rows="5"></textarea>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                          <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                {{-- End Modal Konfirmasi Perizinan --}}
              @endforeach
            </tbody>
          </table>
          {{-- end table 1 --}}
        </div>
      </div>
    </div>
  </div>
@endsection
