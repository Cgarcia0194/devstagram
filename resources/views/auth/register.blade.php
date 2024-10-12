@extends('layouts.app')

@section('titulo')
    Regístrate en Devstagram
@endsection

@section('contenido')
    <div class="md:flex md:justify-center md:gap-6 md:items-center">
        <div class="md:w-6/12 p-5">
            <img src="{{ asset('img/registrar.jpg') }}" alt="Imagen registro de usuarios">
        </div>

        <div class="md:w-4/12 bg-white p-6 rounded-xl shadow-lg">
            <form action="{{ route('register') }}" method="POST" novalidate>
                @csrf
                <div class="mb-5">
                    <label for="name" class="mb-2 block uppercase text-gray-500 font-bold">
                        Nombre
                    </label>

                    <input type="text" name="name" id="name" placeholder="Tu nombre"
                        class="border p-3 w-full rounded-xl 
                        value="{{ old('name') }}"
                        @error('name') border-red-500 @enderror" />

                    @error('name')
                        <p class="bg-red-500 text-white my-2 rounded-xl text-sm p-2">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">
                        Nombre de usuario
                    </label>

                    <input type="text" name="username" id="username" placeholder="Tu nombre de usuario"
                        class="border p-3 w-full rounded-xl" 
                        value="{{ old('username') }}"
                        @error('username') border-red-500 @enderror" />

                    @error('username')
                        <p class="bg-red-500 text-white my-2 rounded-xl text-sm p-2">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

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
                    <label for="password_confirmation" class="mb-2 block uppercase text-gray-500 font-bold">
                        Confirmar contraseña
                    </label>

                    <input type="password" name="password_confirmation" id="password_confirmation"
                        placeholder="Confirma tu contraseña" class="border p-3 w-full rounded-xl" />
                </div>

                <input type="submit" value="Crear cuenta"
                    class="bg-sky-600 hover:bg-sky700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-xl" />
            </form>
        </div>
    </div>
@endsection
