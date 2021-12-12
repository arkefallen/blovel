@extends('master')

@section('title')
    <title>Daftar Pengguna</title>
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
        @if (count($errors) > 0)
          <ul class="alert alert-danger" style="margin-top: 20px;">
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
        @endif
        <section class="mt-5 d-flex justify-content-between align-items-center justify-content-center">
            <h1>Daftar Pengguna</h1>
            <a href="{{ route('user.create') }}" class="btn btn-primary">Tambah User Manual</a>
        </section>
        <hr>
        <br>

        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                  <tr>
                    <th scope="col">Nama</th>
                    <th scope="col">Email</th>
                    <th scope="col">Level</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($users as $user)
                    <tr>
                      <td>{{ $user->name }}</th>
                      <td>{{ $user->email }}</td>
                      <td>{{ $user->level }}</td>
                      <td>
                          <a href="{{ route('user.edit', $user->id) }}" class="btn btn-secondary mx-2">Edit</a>
                          <a href="{{ route('user.destroy', $user->id) }}" onclick="confirm('Yakin ingin dihapus ?');" class="btn btn-danger mx-2">Hapus</a>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
        </div>
    </div>
@endsection