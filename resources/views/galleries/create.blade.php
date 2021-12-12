@extends('master')

@section('title')
    <title>Tambah Galeri Foto</title>
@endsection

@section('content')
    <div class="container my-3 py-3">
        <div class="py-3">
            <a class="btn btn-outline-secondary rounded-pill py-2 px-4" href="{{ route('gallery') }}">
                << Kembali ke Daftar Galeri
            </a>
            <h1 class="my-3">Tambah Gambar</h1>
            <hr>
            <br>
            @if (count($errors) > 0)
                <ul class="alert alert-danger" style="margin-top: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
            <div class="row g-5">
                    <div class="col-md-5 col-lg-4 order-md-last">
                        
                        <h4 class="d-flex justify-content-between align-items-center mb-3">
                            Gambar
                        </h4>
                        
                        <form action="{{ route('gallery.store') }}" method="POST" class="needs-validation" enctype="multipart/form-data">
                        @csrf
                        <ul class="list-group mb-3">
                            <label for="thumbnail" class="form-label alert alert-warning">
                                <b>Syarat : Rasio 16:9 & Landscape</b>
                            </label>
                            <input type="file" class="form-control" name="image" required="true">
                        </ul>

                    </div>
                    <div class="col-md-7 col-lg-8">
                        <h4 class="mb-3">Informasi Detail Gambar</h4>
                        <div class="row g-3">

                        <div class="col-12">
                            <label for="title" class="form-label">Nama Foto</label>
                            <input type="text" class="form-control" name="gallery_name" placeholder="contoh : Kondisi Terkini" required="true">
                        </div>

                        <div class="col-12">
                            <label for="status" class="form-label">Artikel</label>
                            <select name="article_id" class="form-control">
                                <option value="-"> - Pilih Artikel - </option>
                                @foreach ($articles as $article)
                                    <option value="{{ $article->id }}">{{ $article->title }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button class="w-100 btn btn-primary btn-lg" type="submit">Unggah Sekarang</button>
                    </div>
            </div>
        </div>
                        </form>
    </div>
@endsection

