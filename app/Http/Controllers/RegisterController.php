<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    //Todas las vistas se deben regresar con la función index
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {

        $request->request->add([
            'username' => Str::slug($request->username)
        ]);

        //Validación
        $this->validate($request, [
            'name' => ['required', 'min:3', 'max:30'],
            'username' => ['required', 'unique:users', 'min:5', 'max:20'],
            'email' => ['required', 'unique:users'],
            'password' => ['required', 'confirmed', 'min:4'],
        ]);

        User::create([
            'name'  => $request->name,
            'username'  => $request->username,
            'email'  => $request->email,
            'password'  => Hash::make($request->password),
        ]);

        //auth()->attempt([
        //    'email' => $request->email,
        //    'password' => $request->password,
        //]);

        //otra manera de autenticar
        auth()->attempt($request->only('email', 'password'));

        //redireccionar al usuario
        return redirect()->route('posts.index', auth()->user()->username);
    }
}
