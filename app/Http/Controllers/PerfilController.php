<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        return view('perfil.index');
    }

    public function store(Request $request)
    {
        $request->request->add([
            'username' => Str::slug($request->username)
        ]);

        $this->validate($request, [
            'username' => [
                'required', 'min:5', 'max:20',
                'not_in:twitter,facebook,editar-perfil,youtube',
                'unique:users,username,' . auth()->user()->id,
            ],
            'email' => [
                'required',
                'unique:users,email,' . auth()->user()->id
            ],
            'password' => [
                'required'
            ],
            'newPassword' => [
                'required',
                'min:4'
            ],
        ]);

        if (!auth()->attempt($request->only('email', 'password'), $request->remember)) {
            return back()->with('mensaje', 'Credenciales incorrectas');
        }

        if ($request->imagen) {
            $imagen = $request->file('imagen');

            $nombreImagen = Str::uuid() . ".{$imagen->extension()}";
            $imagenServidor = Image::make($imagen);

            $imagenServidor->fit(600, 360);

            $imagenPath = public_path('perfiles' . "/{$nombreImagen}");

            $imagenServidor->save($imagenPath);
        }

        //Guardar cambios
        $usuario = User::find(auth()->user()->id);

        $usuario->username = $request->username;
        $usuario->email = $request->email;
        $usuario->password = Hash::make($request->newPassword);
        $usuario->imagen = $nombreImagen ?? auth()->user()->imagen ?? null;

        $usuario->save();

        return redirect()->route('posts.index', $usuario->username);
    }
}
