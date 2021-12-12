@extends('master')

@section('title')
    <title>Ubah Artikel</title>
@endsection

@section('content')
    <div class="container my-3 py-3">
        <div class="py-3">
            <a class="btn btn-outline-secondary rounded-pill py-2 px-4" href="{{ route('article') }}">
                << Kembali ke Daftar Artikel
            </a>
            <h1 class="my-3">Ubah Informasi Artikel</h1>
            <hr>
            <br>

            <div class="row g-5">
                    <div class="col-md-5 col-lg-4 order-md-last">
                        
                        <h4 class="d-flex justify-content-between align-items-center mb-3">
                            Cover Thumbnail
                        </h4>
                        
                        <form action="{{ route('article.update', $article->id) }}" method="POST" class="needs-validation" enctype="multipart/form-data">
                        @csrf
                        <ul class="list-group mb-3">
                            <label for="thumbnail" class="form-label alert alert-warning">
                                <b>Syarat : Rasio 16:9 & Landscape</b>
                            </label>
                            <input type="file" class="form-control" name="thumbnail">
                        </ul>

                    </div>
                    <div class="col-md-7 col-lg-8">
                        <h4 class="mb-3">Informasi Detail Artikel</h4>
                        <div class="row g-3">

                        <div class="col-12">
                            <label for="title" class="form-label">Judul*</label>
                            <input type="text" class="form-control" name="title" placeholder="contoh : The Adventure of Gumball" required="true" value="{{ $article->title }}">
                        </div>

                        <div class="col-12">
                            <label for="status" class="form-label">Isi Konten*</label>
                            <textarea name="content" class="form-control" cols="30" rows="10">{{ $article->content }}</textarea>
                        </div>

                        <button class="w-100 btn btn-primary btn-lg" type="submit">Update Artikel</button>
                    </div>
            </div>
        </div>
                        </form>
    </div>
@endsection

