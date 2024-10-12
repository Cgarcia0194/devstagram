@extends('layouts.app')

@section('titulo')
    Inicia sesión en Devstagram
@endsection

@section('contenido')
    <div class="md:flex md:justify-center md:gap-6 md:items-center">
        <div class="md:w-6/12 p-5">
            <img src="{{ asset('img/login.jpg') }}" alt="Imagen login de usuarios">
        </div>

        <div class="md:w-4/12 bg-white p-6 rounded-xl shadow">
            {{-- route toma el nombre que se asingó en web.php y su método (POST) --}}
            <form action="{{ route('login') }}" method="POST" novalidate>
                @csrf

                {{-- REGRESA EL MENSAJE del back->with()... --}}
                @if (session('mensaje'))
                    <p class="bg-red-500 text-white my-2 rounded-xl text-sm p-2">
                        {{ session('mensaje') }}
                    </p>
                @endif

                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">
                        Correo electrónico
                    </label>

                    <input type="email" name="email" id="email" placeholder="Tu correo electrónico"
                        class="border p-3 w-full rounded-xl" value="{{ old('email') }}"
                        @error('email') border-red-500 @enderror" />

                    @error('email')
                        <p class="bg-red-500 text-white my-2 rounded-xl text-sm p-2">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">
                        Contraseña
                    </label>

                    <input type="password" name="password" id="password" placeholder="Tu contraseña"
                        class="border p-3 w-full rounded-xl" @error('password') border-red-500 @enderror" />

                    @error('password')
                        <p class="bg-red-500 text-white my-2 rounded-xl text-sm p-2">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="mb-5">
                    <input type="checkbox" name="remember">

                    <label for="remember" class="text-gray-500 text-sm">
                        Mantener mi sesión
                    </label>
                    </input>
                </div>

                <input type="submit" value="Iniciar sesión"
                    class="bg-sky-600 hover:bg-sky700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-xl" />
            </form>
        </div>
    </div>
@endsection
