@extends('layouts.main')

@section('content')
  <div class="container mb-5">
    <div class="row mb-5">
      <div class="col">
        <a href="/berita" class="btn btn-secondary rounded-3">
          <i class="fa-regular fa-chevron-left me-2"></i>
          Kembali
        </a>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <article>
          <h1 class="card-title text-center">{{ $berita->judul }}</h1>
          <div class="card-body mt-3">
            <img src="{{ asset('storage/'. $berita->thumbnail) }}" class="card-img-top" height="300px">
            <p class="card-text mt-4">{!! $berita->isi !!}</p>
          </div>
        </article>
      </div>
    </div>
  </div>
@endsection
