@extends('dashboard.layouts.main')

@section('content')
  <div class="row">
    <div class="col-lg-8">
      <h1 class="mb-3">{{ $berita->judul }}</h1>

      <div class="d-flex justify-content-between align-items-center">
        <div>
          <a class="btn btn-secondary" href="{{ route('data-berita.index') }}">
            <i class="fa-regular fa-chevron-left me-2"></i>
            Kembali
          </a>
        </div>
        <div>
          <a class="btn btn-warning me-md-1" href="{{ route('data-berita.edit', $berita->slug) }}">
            <i class="fa-regular fa-pen-to-square me-2"></i>
            Edit
          </a>
          <a class="btn btn-danger" href="#modalHapus" data-bs-toggle="modal">
            <i class="fa-regular fa-trash-can me-2"></i>
            Delete
          </a>
        </div>
      </div>

      @if ($berita->thumbnail)
        <div style="overflow: hidden; margin-top:5px">
          <img style="max-height: 350px; class="img-fluid mt-3" src="{{ asset('storage/' . $berita->thumbnail) }}" alt="{{ $berita->kategori->nama }}">
        </div>
      @else
        <img class="img-fluid mt-3" src="https://source.unsplash.com/1200x400/?{{ $berita->kategori->nama }}" alt="{{ $berita->kategori->nama }}">
      @endif

      <article class="my-3 fs-5">
        {!! $berita->isi !!}
      </article>

    </div>
  </div>

  {{-- Modal Hapus Berita --}}
  <div class="modal fade" id="modalHapus" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Hapus Berita</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ route('data-berita.destroy', $berita->slug) }}" method="post">
          @method('delete')
          @csrf
          <div class="modal-body">
            <p class="fs-6">Apakah anda yakin ingin menghapus berita ini?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-outline-danger">Hapus</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  {{-- / Modal Hapus Berita --}}
@endsection
