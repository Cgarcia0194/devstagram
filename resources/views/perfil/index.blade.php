@extends('layouts.app')

@section('titulo')
    Editar Perfil: {{ auth()->user()->username }}
@endsection

@section('contenido')
    <div class="md:flex md:justify-center">
        <div class="md:w-1/2 bg-white shadow p-6">
            <form method="POST" action="{{ route('perfil.store') }}" class="mt-10 md:mt-0" enctype="multipart/form-data">
                @csrf
                <div class="mb-5">
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">
                        Username
                    </label>

                    <input type="text" name="username" id="username" placeholder="Tu nombre de usuario"
                        class="border p-3 w-full rounded-xl 
                        @error('username') border-red-500 @enderror"
                        value="{{ auth()->user()->username }}" />


                    @error('username')
                        <p class="bg-red-500 text-white my-2 rounded-xl text-sm p-2">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">
                        Email
                    </label>

                    <input type="text" name="email" id="email" placeholder="Tu correo electrónico"
                        class="border p-3 w-full rounded-xl 
                        @error('email') border-red-500 @enderror"
                        value="{{ auth()->user()->email }}" />

                    @error('email')
                        <p class="bg-red-500 text-white my-2 rounded-xl text-sm p-2">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">
                        Contraseña actual
                    </label>

                    <input type="password" name="password" id="password" placeholder="Tu contraseña"
                        class="border p-3 w-full rounded-xl 
                        @error('password') border-red-500 @enderror" />

                    @error('password')
                        <p class="bg-red-500 text-white my-2 rounded-xl text-sm p-2">
                            {{ $message }}
                        </p>
                    @enderror

                    @if (session('mensaje'))
                        <p class="bg-red-500 text-white my-2 rounded-xl text-sm p-2">
                            {{ session('mensaje') }}
                        </p>
                    @endif
                </div>

                <div class="mb-5">
                    <label for="newPassword" class="mb-2 block uppercase text-gray-500 font-bold">
                        Nueva contraseña
                    </label>

                    <input type="password" name="newPassword" id="newPassword" placeholder="Tu contraseña"
                        class="border p-3 w-full rounded-xl 
                        @error('newPassword') border-red-500 @enderror" />


                    @error('newPassword')
                        <p class="bg-red-500 text-white my-2 rounded-xl text-sm p-2">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

                <div class="mb-5">
                    <label for="imagen" class="mb-2 block uppercase text-gray-500 font-bold">
                        Imagen perfil
                    </label>

                    <input type="file" name="imagen" id="imagen" class="border p-3 w-full rounded-xl accept=".jpg,
                        .jpeg, .png" />
                </div>

                <input type="submit" value="Guardar cambios"
                    class="bg-sky-600 hover:bg-sky700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-xl" />
            </form>
        </div>

    </div>
@endsection
