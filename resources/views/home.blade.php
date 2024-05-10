@extends('layouts.app')

@section('titulo')
    Página Principal
@endsection

@section('contenido')
    <x-listar-post :posts="$posts" />
@endsection


@section('contenido2')
<div class="flex flex-col items-center w-full gap-4  px-10 pb-5 bg-neutral-400">
    <h3 class="mt-5 text-center font-black text-xl" >Usuarios</h3>
    @foreach($user as $users)   
        <div  class="w-10 h-10 flex items-center" >       
            <a href="{{ route('posts.index', $users->username ) }}">
                <img src="{{  $users->imagen ?  
                    asset('perfiles') . '/' . $users->imagen : 
                    asset('img/usuario.svg') }}" alt="Imagen del usuario" 
                    class="w-full h-full rounded-full">                   
            </a> 
        </div>        
               
    @endforeach
</div>
@endsection

