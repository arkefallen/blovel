@extends('master')

@section('title')
    <title>Buat Artikel Baru</title>
@endsection

@section('content')
    <div class="container my-3 py-3">
        <div class="py-3">
            <a class="btn btn-outline-secondary rounded-pill py-2 px-4" href="{{ route('article') }}">
                << Kembali ke Daftar Artikel
            </a>
            <h1 class="my-3">Buat Artikel</h1>
            <hr>
            <br>
            {{-- @if (count($errors) > 0)
                <ul class="alert alert-danger" style="margin-top: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif --}}
            <div class="row g-5">
                    <div class="col-md-5 col-lg-4 order-md-last">
                        
                        <h4 class="d-flex justify-content-between align-items-center mb-3">
                            Cover Thumbnail
                        </h4>
                        
                        <form action="{{ route('article.store') }}" method="POST" class="needs-validation" enctype="multipart/form-data">
                        @csrf
                        <ul class="list-group mb-3">
                            <label for="thumbnail" class="form-label alert alert-warning">
                                <b>Syarat : Rasio 16:9 & Landscape</b>
                            </label>
                            <input type="file" class="form-control" name="thumbnail" required="true">
                        </ul>

                    </div>
                    <div class="col-md-7 col-lg-8">
                        <h4 class="mb-3">Informasi Detail Artikel</h4>
                        <div class="row g-3">

                        <div class="col-12">
                            <label for="title" class="form-label">Judul*</label>
                            <input type="text" class="form-control" name="title" placeholder="contoh : The Adventure of Gumball" required="true">
                        </div>

                        <div class="col-12">
                            <label for="status" class="form-label">Isi Konten*</label>
                            <textarea name="content" class="form-control" cols="30" rows="10"></textarea>
                        </div>

                        <button class="w-100 btn btn-primary btn-lg" type="submit">Unggah Sekarang</button>
                    </div>
            </div>
        </div>
                        </form>
    </div>
@endsection

