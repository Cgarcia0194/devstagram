@extends('layouts.app')

@section('titulo')
    {{ $post->titulo }}
@endsection

@section('contenido')
    <div class="container mx-auto md:flex">
        <div class="md:w-1/2">
            <img src="{{ asset('uploads') . '/' . $post->imagen }}" alt="Imagen del post {{ $post->titulo }}">

            @auth
                {{-- like component --}}
                <livewire:like-post :post="$post" />
            @endauth

            <div class="">
                <p class="font-bold">
                    {{-- esto viene de Post.php función user --}}
                    {{ $post->user->username }}
                </p>
                <p class="text-sm text-gray-500">
                    {{ $post->created_at->diffForHumans() }}
                </p>

                <p class="mt-5">
                    {{ $post->descripcion }}
                </p>
            </div>

            @auth
                @if ($post->user_id == auth()->user()->id)
                    <form action="{{ route('posts.destroy', $post) }}" method="POST" class="">
                        {{-- METODO SPOOFING: ES PORQUE EL NAVEGADOR SOLO PERMITE POST/GET Y CON ESTE SE USAN LOS (DELETE/PUT/PATCH) --}}
                        @method('DELETE')
                        @csrf
                        <input type="submit" value="eliminar publicación"
                            class="bg-red-500 p-2 rounded-xl text-white font-bold mt-4 cursor-pointer uppercase" />
                    </form>
                @endif
            @endauth
        </div>

        <div class="md:w-1/2 p-5">
            <div class="shadow bg-white p-5 mb-5 rounded-xl">
                @auth
                    <p class="text-xl font-bold text-center mb-4">
                        Agregar un nuevo comentario
                        @if (session('mensaje'))
                            <div class="bg-green-500 p-2 rounded-xl mb-6 text-white text-center uppercase font-bold">
                                {{ session('mensaje') }}

                            </div>
                        @endif
                    </p>
                    <form action="{{ route('comentarios.store', ['user' => $user, 'post' => $post]) }}" method="POST">
                        @csrf
                        <div class="mb-5">
                            <label for="comentario" class="mb-2 block uppercase text-gray-500 font-bold">
                                Agrega un comentario
                            </label>

                            <textarea name="comentario" id="comentario" placeholder="Agrega un comentario"
                                class="border p-3 w-full rounded-xl 
                            @error('comentario') border-red-500 @enderror"></textarea>

                            @error('comentario')
                                <p class="bg-red-500 text-white my-2 rounded-xl text-sm p-2">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                        <input type="submit" value="Comentar"
                            class="bg-sky-600 hover:bg-sky700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-xl" />
                    </form>
                @endauth

                <div class="bg-white mb-5 max-h-96 overflow-y-scroll mt-10">
                    @if ($post->comentarios->count())
                        @foreach ($post->comentarios as $comentario)
                            <div class="p-5 border-gray-300 border-b">
                                <a href="{{ route('posts.index', $comentario->user) }}" class="font-bold">
                                    {{ $comentario->user->username }}
                                </a>
                                <p class="">
                                    {{ $comentario->comentario }}
                                </p>

                                <p class="text-sm text-gray-400">
                                    {{ $comentario->created_at->diffForHumans() }}
                                </p>
                            </div>
                        @endforeach
                    @else
                        <p class="p-10 text-center">No hay comentarios</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
