@extends('layouts.app')

@section('titulo')
    Página Principal
@endsection

@section('contenido')
    <x-listar-post :posts="$posts" />
@endsection


@section('contenido2')
<div class="flex flex-row w-full h-10 gap-6 ">
    @foreach($user as $users)   
        <div  class="w-10 h-10 flex justify-center items-center rounded-full" >       
            <a href="{{ route('posts.index', $users->username ) }}">
                <img src="{{  $users->imagen ?  
                    asset('perfiles') . '/' . $users->imagen : 
                    asset('img/usuario.svg') }}" alt="Imagen del usuario" 
                    class="w-full h-full rounded-full object-cover">                   
            </a> 
        </div>        
               
    @endforeach
</div>
@endsection

