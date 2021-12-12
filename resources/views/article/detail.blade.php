@extends('master')

@section('title')
    <title>Buat Artikel Baru</title>
@endsection

@section('content')
    <div class="container my-3">
        <div class="py-3">
            <a class="btn btn-outline-secondary rounded-pill py-2 px-4" href="{{ route('dashboard') }}">
                << Kembali ke Dashboard
            </a>
            <div class="container">
              
            </div>
            <h1 class="my-3">{{ $article->title }}</h1>

              <div id="carouselCaptions" class="carousel slide my-5 rounded mx-auto" data-bs-ride="carousel">
                <div class="carousel-indicators">
                  @for ($i = 0; $i < $totalGallery + 1; $i++)
                    <button type="button" data-bs-target="#carouselCaptions" data-bs-slide-to="{{ $i }}" aria-label="Slide {{ $i+1 }}"
                    @if ($i == 0)
                      class="active" aria-current="true"
                    @endif></button>
                  @endfor
                </div>
                <div class="carousel-inner">
                  @for ($i = 0; $i < $totalGallery + 1; $i++)
                      @if ($i == 0)
                        <div class="carousel-item active">
                          <img src="{{ asset('assets/img/'.$article->thumbnail) }}" class="d-block w-100">
                          <div class="carousel-caption d-none d-md-block">
                            <h5></h5>
                          </div>
                        </div>
                      @else
                        <div class="carousel-item">
                          <img src="{{ asset('assets/img/'.$galleries[$i-1]->image) }}" class="d-block w-100">
                          <div class="carousel-caption d-none d-md-block">
                            <a href="{{ asset('assets/img/'.$galleries[$i-1]->image) }}" data-lightbox="image-{{ $i+1 }}" class="btn btn-light">Lihat Detail</a>
                          </div>
                        </div>
                      @endif
                  @endfor
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselCaptions" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselCaptions" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </button>
              </div>
            

              <h6 class="mb-3">Penulis : {{ $article->user->name }}</h6>
              <p>{{ $article->content }}</p>

              <br><hr>
              <h3>Komentar</h3>

              @if(Session::has('msg_success_comment'))
                <div class="alert alert-success">
                    {{Session::get('msg_success_comment')}}
                </div>
              @endif

              <form action="{{ route('article.comment', $article->id) }}" method="post" class="d-flex flex-row justify-content-start align-items-center">
                @csrf
                <textarea name="comment" id="" cols="20" placeholder="Isi komentar anda...." class="form-control"  style="margin-right: 50px"></textarea>
                <button type="submit" class="btn btn-primary my-3">Kirim Komentar</button>
              </form>

              @foreach ($comments as $comment)
                <div class="card border-secondary mb-3 w-100">
                  <div class="card-header text-secondary">{{ $comment->user->name }}</div>
                  <div class="card-body">
                    <p class="card-text">{{ $comment->comments }}</p>
                  </div>
                </div>
              @endforeach
        </div>
    </div>
@endsection

