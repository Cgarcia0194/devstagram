@extends('layouts.app')

@section('titulo')
    Crea una nueva publicación
@endsection

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endpush

@section('contenido')
    <div class="md:flex md:items-center">
        <div class="md:w-1/2 px-10">
            <form action="{{ route('imagenes.store') }}" method="POST" enctype="multipart/form-data" id="dropzone"
                class="dropzone border-dashed border-2 w-full h-96 rounded flex flex-col justify-content items-center">
                @csrf
            </form>
        </div>
        <div class="md:w-1/2 p-10 bg-white rounded-xl shadow-lg mt-10 md:mt-0">
            <form action="{{ route('posts.store') }}" method="POST" novalidate>
                @csrf
                <div class="mb-5">
                    <label for="titulo" class="mb-2 block uppercase text-gray-500 font-bold">
                        Título
                    </label>

                    <input type="text" name="titulo" id="titulo" placeholder="Título de la publicación"
                        class="border p-3 w-full rounded-xl 
                        value="{{ old('titulo') }}"
                        @error('titulo') border-red-500 @enderror" />

                    @error('titulo')
                        <p class="bg-red-500 text-white my-2 rounded-xl text-sm p-2">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="descripcion" class="mb-2 block uppercase text-gray-500 font-bold">
                        Descripción
                    </label>

                    <textarea name="descripcion" id="descripcion" placeholder="Descripción de la publicación"
                        class="border p-3 w-full rounded-xl 
                        @error('descripcion') border-red-500 @enderror">{{ old('descripcion') }}</textarea>

                    @error('descripcion')
                        <p class="bg-red-500 text-white my-2 rounded-xl text-sm p-2">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

                <div class="mb-5">
                    <input type="hidden" name="imagen" value="{{old('imagen')}}">
                        @error('imagen')
                            <p class="bg-red-500 text-white my-2 rounded-xl text-sm p-2">
                                {{ $message }}
                            </p>
                        @enderror
                    </input>
                </div>

                <input type="submit" value="Publicar"
                    class="bg-sky-600 hover:bg-sky700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-xl" />
            </form>
        </div>
    </div>
@endsection
