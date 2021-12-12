@extends('master')

@section('title')
    <title>Daftar Artikel</title>
@endsection

@section('content')
    <div class="container py-3">
        @if(Session::has('msg_success_store'))
          <div class="alert alert-success">
              {{Session::get('msg_success_store')}}
          </div>
        @endif
        @if(Session::has('msg_success_update'))
            <div class="alert alert-success">
                {{Session::get('msg_success_update')}}
            </div>
        @endif
        @if(Session::has('msg_success_remove'))
            <div class="alert alert-success">
                {{Session::get('msg_success_remove')}}
            </div>
        @endif
        <section class="mt-5 d-flex justify-content-between align-items-center justify-content-center">
            <h1>Daftar Artikel</h1>
            @if (Auth::check() && Auth::user()->level == 'user')
              <a href="/article/create" class="btn btn-primary">Tambah Artikel</a>
            @endif
        </section>
        <hr>
        <br>

        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                  <tr>
                    <th scope="col">Judul</th>
                    <th scope="col">Gambar</th>
                    <th scope="col">Isi</th>
                    @if (Auth::check() && Auth::user()->level == 'admin')
                      <th scope="col">Owner</th>
                    @endif
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @if (Auth::check() && Auth::user()->level == 'admin')
                    @foreach ($rawArticles as $rawArticle)
                    <tr>
                      <td>{{ $rawArticle->title }}</td>
                      <td>
                        <img src="{{ asset('assets/img/'.$rawArticle->thumbnail) }}" style="width: 160px; height:90px">
                      </td>
                      <td class="p-5">{{ $rawArticle->content }}</td>
                      <td>{{ $rawArticle->user->name }}</td>
                      <td>
                          <a href="{{ route('article.edit', $rawArticle->id) }}" class="my-2 btn btn-secondary mx-2">Edit</a>
                          <a href="{{ route('article.destroy', $rawArticle->id) }}" onclick=" confirm('Yakin ingin dihapus ?'); " class="my-2 btn btn-danger mx-2">Hapus</a>
                      </td>
                    </tr>
                    @endforeach
                  @else
                    @foreach ($articles as $article)
                      <tr>
                        <td>{{ $article->title }}</td>
                        <td>
                          <img src="{{ asset('assets/img/'.$article->thumbnail) }}" style="width: 160px; height:90px">
                        </td>
                        <td class="p-5">{{ $article->content }}</td>
                        <td>
                            <a href="{{ route('article.edit', $article->id) }}" class="my-2 btn btn-secondary mx-2">Edit</a>
                            <a href="{{ route('article.destroy', $article->id) }}" onclick=" confirm('Yakin ingin dihapus ?'); " class="my-2 btn btn-danger mx-2">Hapus</a>
                        </td>
                      </tr>
                    @endforeach
                  @endif
                </tbody>
              </table>
        </div>
    </div>
@endsection