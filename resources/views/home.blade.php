@extends('layouts.app')

@section('titulo')
    Principal
@endsection


@section('contenido')
    <x-listar-post :posts="$posts"/>

    {{-- Es igual al if y foreach de arriba --}}
    {{-- 
    @forelse ($posts as $post)
    <h1>{{ $post->titulo }}</h1>
    
    @empty
    <h1>No hay posts</h1>
    @endforelse
    --}}
@endsection
