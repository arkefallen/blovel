<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index()
    {
        $users = User::all();

        return view('users.user',compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $req)
    {
        $this->validate($req, [
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required',
            'level' => 'required'
        ]);
        
        $user = new User;
        $user->name = $req->name;
        $user->email = $req->email;
        $user->password = bcrypt($req->password);
        $user->level = $req->level;

        $user->save();

        return redirect('/user')->with('msg_success_store','Selamat ! User baru telah berhasil ditambahkan ! 🤩');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect('/user')->with('msg_success_remove','User berhasil dihapus ! 😊');
    }

    public function edit($id)
    {
        $user = User::find($id);

        return view('users.edit',compact('user'));
    }

    public function update(Request $req, $id)
    {
        $this->validate($req, [
            'name' => 'required|string',
            'email' => 'required|email',
            'level' => 'required'
        ]);
        
        $user = User::find($id);
        $user->name = $req->name;
        $user->email = $req->email;
        
        if ($req->password != null) {
            $user->password = bcrypt($req->password);
        }

        $user->level = $req->level;

        $user->update();

        return redirect('/user')->with('msg_success_update','Selamat ! Informasi user berhasil diperbarui ! 🤩');
    }
}
