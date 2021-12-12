<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Gallery;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {   
        $this->middleware('auth');
    }

    public function index()
    {
        $articles = Article::orderBy('created_at','desc')->paginate(6);
        $pages = 6*($articles->currentPage()-1);

        $galleries = Gallery::all();
        $users = User::all();

        $totalArticle = count($articles);
        $totalUser = count($users);
        $totalGallery = count($galleries);
        return view('dashboard',compact('articles','pages','totalArticle','totalUser','totalGallery'));
    }

    public function search(Request $req)
    {
        
        $articles = Article::where('title','like',"%".$req->search_text."%")->paginate(6);
        $pages = 6*($articles->currentPage()-1);

        $galleries = Gallery::all();
        $users = User::all();

        $totalArticle = count($articles);
        $totalUser = count($users);
        $totalGallery = count($galleries);
        return view('dashboard',compact('articles','pages','totalArticle','totalUser','totalGallery'));
    }
}
