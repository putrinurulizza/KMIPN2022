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
          {{-- Table Solusi --}}
          <table id="myTable" class="table responsive nowrap table-bordered table-striped align-middle" style="width:100%">
            <thead>
              <tr>
                <th>#</th>
                <th>Waktu</th>
                <th>Email Pengirim</th>
                <th>Masukan</th>
                <th>Respon</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($solusis as $solusi)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $solusi->created_at->format('d/m/Y') }}</td>
                  <td>{{ $solusi->email }}</td>
                  <td>{{ $solusi->masukan }}</td>
                  <td>
                    <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#modalLihatRespon{{ $loop->iteration }}">
                      <i class="fa-regular fa-eye me-1"></i>
                      Lihat Respon
                    </button>
                  </td>
                  <td>
                    <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#modalRespon{{ $loop->iteration }}">
                      <i class="fa-regular fa-pen-to-square me-1"></i>
                      @if ($solusi->respon)
                        Edit Respon
                      @else
                        Respon
                      @endif
                    </button>
                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#modalHapus{{ $loop->iteration }}">
                      <i class="fa-regular fa-trash-can fa-lg"></i>
                    </button>
                  </td>
                </tr>

                {{-- Modal Lihat Respon --}}
                <div class="modal fade" id="modalLihatRespon{{ $loop->iteration }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Lihat Respon</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <div class="mb-3">
                          @if ($solusi->respon)
                            <label for="respon" class="form-label">Respon</label>
                            <textarea class="form-control" name="respon" id="respon" rows="5" disabled>{{ $solusi->respon }}</textarea>
                          @else
                            <div class="text-center">Belum ada respon</div>
                          @endif
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                      </div>
                    </div>
                  </div>
                </div>
                {{-- / Modal Lihat Respon --}}

                {{-- Modal Berikan Respon --}}
                <div class="modal fade" id="modalRespon{{ $loop->iteration }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Berikan Respon</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <form action="{{ route('solusi.update', $solusi->id) }}" method="post">
                        @method('put')
                        @csrf
                        <div class="modal-body">
                          <div class="mb-3">
                            <label for="masukan" class="form-label">Masukan</label>
                            <textarea class="form-control" name="masukan" id="masukan" placeholder="Tuliskan masukan anda untuk gampong kami" rows="3" disabled>{{ $solusi->masukan }}</textarea>
                          </div>
                          <div class="mb-3">
                            <label for="respon" class="form-label">Respon</label>
                            <textarea class="form-control" name="respon" id="respon" rows="5">{{ $solusi->respon }}</textarea>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                          <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                {{-- / Modal Berikan Respon --}}

                {{-- Modal Hapus Solusi --}}
                <div class="modal fade" id="modalHapus{{ $loop->iteration }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Hapus Data Solusi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <form action="{{ route('solusi.destroy', $solusi->id) }}" method="post">
                        @method('delete')
                        @csrf
                        <div class="modal-body">
                          <p class="fs-6">Apakah anda yakin akan menghapus data solusi ini?</p>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                          <button type="submit" class="btn btn-outline-danger">Hapus</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                {{-- / Modal Hapus Solusi --}}
              @endforeach
            </tbody>
          </table>
          {{-- / Table Solusi --}}
        </div>
      </div>
    </div>
  </div>
@endsection
