<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['show', 'index']);
    }

    public function index(User $user)
    {
       $posts = Post::where('user_id', $user->id)->latest()->paginate(20);
        
        return view('dashboard', [
            'user' => $user,
           'posts' => $posts
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'titulo' => 'required|max:255',
            'descripcion' => 'required',
            'imagen' => 'required'
        ]);

         Post::create([
             'titulo' => $request->titulo,
             'descripcion' => $request->descripcion,
             'imagen' => $request->imagen,
             'user_id' => auth()->user()->id
         ]);

        // Otra forma
        // $post = new Post;
        // $post->titulo = $request->titulo;
        // $post->descripcion = $request->descripcion;
        // $post->imagen = $request->imagen;
        // $post->user_id = auth()->user()->id;
        // $post->save();


        //Otra forma al estilo de LARAVEL
        //$request->user()->posts()->create([
        //    'titulo' => $request->titulo,
        //    'descripcion' => $request->descripcion,
        //    'imagen' => $request->imagen,
        //    'user_id' => auth()->user()->id
       // ]);

        return redirect()->route('posts.index', auth()->user()->username);
    }

    public function show(User $user, Post $post)
    {
        return view('posts.show', [
            'post' => $post,
            'user' => $user
        ]);
    }
    public function create() 
    {
        return view('posts.create');
    }
}