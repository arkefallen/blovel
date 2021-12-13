@extends('master')

@section('title')
    <title>Dashboard</title>
@endsection

@section('content')
    <section class="py-4 text-center container">
        <div class="row py-lg-5">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h1>Selamat Datang !</h1>

                <p class="lead text-muted">
                  @if (Auth::check() && Auth::user()->level == 'admin')
                    Pantau dan atur segalanya yang ada di aplikasi
                  @else
                    Baca dan bagikan artikel kamu disini
                  @endif  
                </p>
            </div>
        </div>

        @if (Auth::check() && Auth::user()->level == 'user')
          <form action="{{ route('dashboard.search') }}" method="get">
            @csrf
            <div class="input-group mb-3">
              <span class="input-group-text" id="basic-addon1">
                <box-icon name='search-alt-2'></box-icon>
              </span>
              <input type="text" name="search_text" class="form-control " placeholder="Cari artikel..." aria-describedby="basic-addon1">
              <button type="submit" class="btn btn-primary bg-gradient">Cari</button>
            </div>
          </form>
        @endif

    </section>
    
    <div class="album py-5 bg-light">
        <div class="container">
          <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-3">
            @if (Auth::check() && Auth::user()->level == 'admin')
                <div class="feature col text-center">
                  <div class="feature-icon bg-primary bg-gradient">
                    <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" style="fill: rgba(255, 255, 255, 1);transform: ;msFilter:;"><path d="M19.937 8.68c-.011-.032-.02-.063-.033-.094a.997.997 0 0 0-.196-.293l-6-6a.997.997 0 0 0-.293-.196c-.03-.014-.062-.022-.094-.033a.991.991 0 0 0-.259-.051C13.04 2.011 13.021 2 13 2H6c-1.103 0-2 .897-2 2v16c0 1.103.897 2 2 2h12c1.103 0 2-.897 2-2V9c0-.021-.011-.04-.013-.062a.99.99 0 0 0-.05-.258zM16.586 8H14V5.414L16.586 8zM6 20V4h6v5a1 1 0 0 0 1 1h5l.002 10H6z"></path></svg>
                  </div>
                  <h2>{{ $totalArticle }}</h2>
                  <h5>Jumlah Artikel</h5>
                </div>
                <div class="feature col text-center">
                  <div class="feature-icon bg-primary bg-gradient">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="36" height="36" style="fill: rgba(255, 255, 255, 1);transform: ;msFilter:;"><path d="M12 2a5 5 0 1 0 5 5 5 5 0 0 0-5-5zm0 8a3 3 0 1 1 3-3 3 3 0 0 1-3 3zm9 11v-1a7 7 0 0 0-7-7h-4a7 7 0 0 0-7 7v1h2v-1a5 5 0 0 1 5-5h4a5 5 0 0 1 5 5v1z"></path></svg>
                  </div>
                  <h2>{{ $totalUser }}</h2>
                  <h5>Jumlah User</h5>
                </div>
                <div class="feature col text-center">
                  <div class="feature-icon bg-primary bg-gradient">
                    <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" style="fill: rgba(255, 255, 255, 1);transform: ;msFilter:;"><circle cx="7.499" cy="9.5" r="1.5"></circle><path d="m10.499 14-1.5-2-3 4h12l-4.5-6z"></path><path d="M19.999 4h-16c-1.103 0-2 .897-2 2v12c0 1.103.897 2 2 2h16c1.103 0 2-.897 2-2V6c0-1.103-.897-2-2-2zm-16 14V6h16l.002 12H3.999z"></path></svg>
                  </div>
                  <h2>{{ $totalGallery }}</h2>
                  <h5>Jumlah Galeri</h5>
                </div>
            @else
              @foreach ($articles as $article)
                <div class="col">
                  <div class="card h-100 shadow-sm rounded">
                    <img src="{{ asset('assets/img/'.$article->thumbnail) }}" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title">{{ $article->title }}</h5>
                        <p class="card-text">{{ Str::limit($article->content, 100, '...') }}</p>
                    </div>
                    <div class="card-footer">
                      <div class="d-flex justify-content-between align-items-center">
                        <small class="text-muted">{{ $article->created_at->diffForHumans() }}</small>
                        <div class="btn-group">
                          <a class="btn btn-sm btn-outline-secondary" href="{{ route('article.like', $article->id) }}">
                            Suka {{ $article->like }}
                          </a>
                          <a class="btn btn-sm btn-outline-secondary" href="{{ route('article.detail',$article->article_seo) }}">Selengkapnya</a>
                        </div>
                    </div>
                    </div>
                  </div>
                </div>
              @endforeach
            @endif
          </div>
        </div>
    </div>
@endsection