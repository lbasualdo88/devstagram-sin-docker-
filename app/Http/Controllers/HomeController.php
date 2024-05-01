<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function __invoke()
    {

        // Obtener todas las publicaciones (posts) del usuario autenticado
        $user = auth()->user();
        $userPosts = Post::where('user_id', $user->id)->latest()->get();

        // Obtener a quienes seguimos
        $ids = auth()->user()->followings->pluck('id')->toArray();
        $followingsPosts = Post::whereIn('user_id', $ids)->latest()->get();

        // Combinar ambas colecciones de publicaciones
        $allPosts = $userPosts->concat($followingsPosts);

        // Ordenar las publicaciones por fecha de creación descendente
        $sortedPosts = $allPosts->sortByDesc('created_at');

        // Crear una instancia de LengthAwarePaginator
        $perPage = 20;
        $page = request()->get('page', 1);
        $offset = ($page - 1) * $perPage;
        $posts = new LengthAwarePaginator(
            $sortedPosts->slice($offset, $perPage),
            $sortedPosts->count(),
            $perPage,
            $page
        );

        $userDev = User::all();

        //dd($userDev);

        return view('home', [
            'posts' => $posts,
            'user' => $userDev
        ]);
        }
    }
    
    //dd($posts);