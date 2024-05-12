@extends('layouts.app')

@section('titulo')
    Página Principal
@endsection

@section('contenido')
    <x-listar-post :posts="$posts" />
@endsection


@section('contenido2')
    @foreach($user as $users)   
        <div  class=" h-10 w-10 flex items-center" >       
            <a href="{{ route('posts.index', $users->username ) }}">
                <img src="{{  $users->imagen ?  
                    asset('perfiles') . '/' . $users->imagen : 
                    asset('img/usuario.svg') }}" alt="Imagen del usuario" 
                    class="w-full h-full rounded-full">                   
            </a> 
        </div>                     
    @endforeach
@endsection

