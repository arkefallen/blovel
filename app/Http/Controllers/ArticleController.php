<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Image;
use App\Models\Gallery;

class ArticleController extends Controller
{

    public function __construct()
    {   
        $this->middleware('auth');
    }
    
    public function index()
    {
        $articles = Article::with('user')->where('creator_id', Auth::id())->paginate(6);

        $rawArticles = Article::orderBy('id','desc')->paginate(6);

        return view('article.article',compact('articles','rawArticles'));
    }


    public function create()
    {
        return view('article.create');
    }

    public function detail($title)
    {
        $article = Article::with('user')->where('article_seo',$title)->first();

        $galleries = Gallery::with('article')->where('article_id', $article->id)->get();

        $comments = Comment::with('user','article')->where('article_id', $article->id)->get();
    
        $totalGallery = count($galleries);

        return view('article.detail', compact('article','totalGallery','galleries','comments'));
    }

    public function store(Request $req)
    {
        $this->validate($req, [
            'title' => 'required|string',
            'content' => 'required',
            'thumbnail' => 'required|image|mimes:jpeg,jpg,png'
        ]);
        
        $article = new Article;
        $article->title = $req->title;
        $article->content = $req->content;
        $article->article_seo = Str::slug($article->title,'-');
        $article->creator_id = Auth::id();

        $image = $req->thumbnail;
        $imageFile = time().'.'.$image->getClientOriginalExtension();

        Image::make($image)->resize(1280,720)->save('assets/img/'.$imageFile);
        $image->move('images/'.$imageFile);

        $article->thumbnail = $imageFile;

        $article->save();
        return redirect('/article')->with('msg_success_store','Selamat ! Artikel mu berhasil dipublikasikan ! 🤩');
    }

    public function edit($id)
    {
        $article = Article::find($id);

        return view('article.edit',compact('article'));
    }

    public function update(Request $req, $id)
    {
        $this->validate($req, [
            'title' => 'required|string',
            'content' => 'required'
        ]);
        
        $article = Article::find($id);
        $article->title = $req->title;
        $article->content = $req->content;
        $article->article_seo = Str::slug($article->title,'-');

        if ( $req->thumbnail != null ) {
            $image = $req->thumbnail;
            $imageFile = time().'.'.$image->getClientOriginalExtension();

            Image::make($image)->resize(1280,720)->save('assets/img/'.$imageFile);
            $image->move('images/'.$imageFile);

            $article->thumbnail = $imageFile;
        }
        
        $article->save();
        return redirect('/article')->with('msg_success_update','Selamat ! Artikel mu berhasil diperbarui ! 🤩');
    }

    public function destroy($id)
    {
        $article = Article::find($id);
        $article->delete();
        return redirect('/article')->with('msg_success_remove','Karyamu berhasil dihapus ! 😊');
    }

    public function like(Request $req, $id)
    {
        $article = Article::find($id);
        $article->increment('like');
        Return back();
    }

    public function comment(Request $req, $article_id) {

        $this->validate($req, [
            'comment' => 'required'
        ]);

        
        $user_id = Auth::id();

        $article = Article::find($article_id);

        $comment = new Comment;
        $comment->article_id = $article->id;
        $comment->user_id = $user_id;
        $comment->comments = $req->comment;

        $comment->save();

        $galleries = $article->gallery()->orderBy('id','asc')->get();
        $comments = $article->comments()->orderBy('id','desc')->get();

        $totalGallery = count($galleries);

        return view('article.detail',compact('article','galleries','comments','totalGallery'))->with('msg_success_comment','Berhasil komentar !');
    }
}
