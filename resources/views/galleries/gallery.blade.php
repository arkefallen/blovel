@extends('master')

@section('title')
    <title>Galeri Artikel</title>
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
            <h1>Galeri Foto Artikel</h1>
            @if (Auth::check() && Auth::user()->level == 'user')
              <a href="{{ route('gallery.create') }}" class="btn btn-primary">Tambah Gambar</a>
            @endif
        </section>
        <hr>
        <br>

        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                  <tr>
                    <th scope="col">Nama Galeri</th>
                    <th scope="col">Gambar</th>
                    <th scope="col">Artikel</th>
                    @if (Auth::check() && Auth::user()->level == 'admin')
                        <th scope="col">Owner</th>
                    @endif
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @if (Auth::check() && Auth::user()->level == 'admin')
                    @foreach ($rawGalleries as $rawGallery)
                    <tr>
                      <td>{{ $rawGallery->gallery_name }}</td>
                      <td>
                        <img src="{{ asset('assets/img/'.$rawGallery->image) }}" style="width: 160px; height:90px">
                      </td>
                      <td>{{ $rawGallery->article->title }}</td>
                      <td>{{ $rawGallery->user->name }}</td>
                      <td>
                          <a href="{{ route('article.edit', $rawGallery->id) }}" class="my-2 btn btn-secondary mx-2">Edit</a>
                          <a href="{{ route('article.destroy', $rawGallery->id) }}" onclick=" confirm('Yakin ingin dihapus ?'); " class="my-2 btn btn-danger mx-2">Hapus</a>
                      </td>
                    </tr>
                    @endforeach
                  @else
                    @foreach ($galleries as $gallery)
                      <tr>
                        <td>{{ $gallery->gallery_name }}</td>
                        <td>
                          <img src="{{ asset('assets/img/'.$gallery->image) }}" style="width: 160px; height:90px">
                        </td>
                        <td>{{ $gallery->article->title }}</td>
                        <td>
                            <a href="{{ route('gallery.edit', $gallery->id) }}" class="my-2 btn btn-secondary mx-2">Edit</a>
                            <a href="{{ route('gallery.destroy', $gallery->id) }}" onclick=" confirm('Yakin ingin dihapus ?'); " class="my-2 btn btn-danger mx-2">Hapus</a>
                        </td>
                      </tr>
                    @endforeach
                  @endif
                </tbody>
              </table>
        </div>
    </div>
@endsection