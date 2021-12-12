@extends('master')

@section('title')
    <title>Tambah User Baru</title>
@endsection

@section('content')
    <div class="container my-3 py-3">
        <div class="py-3">
            <a class="btn btn-outline-secondary rounded-pill py-2 px-4" href="{{ route('user') }}">
                << Kembali ke Daftar Pengguna
            </a>
            <h1 class="my-3">Tambah User</h1>
            <hr>
            <br>
            <div class="row g-5">
                    <div class="col">
                        <h4 class="mb-3">Informasi User</h4>
                        <div class="row g-3">
                        <form action="{{ route('user.store') }}" method="POST" class="needs-validation"> 
                            @csrf
                            <div class="col-12">
                                <label for="title" class="form-label">Nama*</label>
                                <input type="text" class="form-control" name="name" placeholder="contoh : Henry Ford" required="true">
                            </div>

                            <div class="col-12">
                                <label for="status" class="form-label">E-Mail*</label>
                                <input type="email" class="form-control" name="email" placeholder="contoh : nama@mail.domain " required="true">
                            </div>

                            <div class="col-12">
                                <label for="status" class="form-label">Password*</label>
                                <input type="password" class="form-control" name="password" placeholder="Isi password disini..." required="true">
                            </div>

                            <div class="col-12">
                                <label for="status" class="form-label">Hak Akses*</label>
                                <table class="table" border="0">
                                    <tr>
                                        <td>
                                            <input type="radio" name="level" value="user"> User
                                        </td>
                                        <td>
                                            <input type="radio" name="level" value="admin"> Admin
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <button class="w-100 btn btn-primary btn-lg" type="submit">Tambah User</button>

                        </form>
                    </div>
            </div>
        </div>
                        </form>
    </div>
@endsection

