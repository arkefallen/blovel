<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Image;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $galleries = Gallery::with('user')->where('user_id',Auth::id())->paginate(6);

        $rawGalleries = Gallery::with('user','article')->orderBy('id','desc')->paginate(6);

        return view('galleries.gallery',compact('galleries','rawGalleries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $articles = Article::with('user')->where('creator_id',Auth::id())->paginate(6);

        return view('galleries.create',compact('articles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        $this->validate($req, [
            'gallery_name' => 'required|string',
            'article_id' => 'required',
            'image' => 'required|image|mimes:jpeg,jpg,png'
        ]);
        
        $gallery = new Gallery;
        $gallery->gallery_name = $req->gallery_name;
        $gallery->article_id = $req->article_id;
        $gallery->gallery_seo = Str::slug($gallery->gallery_name,'-');
        $gallery->user_id = Auth::id();

        $image = $req->image;
        $imageFile = time().'.'.$image->getClientOriginalExtension();

        Image::make($image)->resize(1280,720)->save('assets/img/'.$imageFile);
        $image->move('images/'.$imageFile);

        $gallery->image = $imageFile;

        $gallery->save();
        return redirect('/gallery')->with('msg_success_store','Selamat ! Artikel mu berhasil dipublikasikan ! 🤩');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $gallery = Gallery::find($id);

        $articles = Article::with('user')->where('creator_id',Auth::id())->get();

        return view('galleries.edit',compact('gallery','articles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, $id)
    {
        $this->validate($req, [
            'gallery_name' => 'required|string',
            'article_id' => 'required'
        ]);
        
        $gallery = Gallery::find($id);
        $gallery->gallery_name = $req->gallery_name;
        $gallery->article_id = $req->article_id;
        $gallery->gallery_seo = Str::slug($gallery->gallery_name,'-');
        $gallery->user_id = Auth::id();

        if ($req->image != null) {
            $image = $req->image;
            $imageFile = time().'.'.$image->getClientOriginalExtension();
    
            Image::make($image)->resize(1280,720)->save('assets/img/'.$imageFile);
            $image->move('images/'.$imageFile);
    
            $gallery->image = $imageFile;
        }

        $gallery->update();
        return redirect('/gallery')->with('msg_success_update','Selamat ! Galeri artikel mu berhasil diperbarui ! 🤩');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $gallery = Gallery::find($id);

        $gallery->delete();

        return redirect('/gallery')->with('msg_success_remove','Galeri artikel mu berhasil dihapus 😊');
    }
}
