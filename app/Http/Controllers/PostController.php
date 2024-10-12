<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['show', 'index']);
    }

    //Recibe user desde la ruta y aquí se manda al view como parametro a $user
    public function index(User $user)
    {

        //trae todos los registros
        //$posts = Post::where('user_id', $user->id)->get();
        //$posts = Post::where('user_id', $user->id)->simplePaginate(5);
        $posts = Post::where('user_id', $user->id)->latest()->paginate(20);

        return view('dashboard', [
            'user' => $user,
            'posts' => $posts
        ]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'titulo' => ['required', 'max:100'],
            'descripcion' => ['required', 'max:255'],
            'imagen' => ['required'],
        ]);

        //formas de registrar

        //Post::create([
        //    'titulo' => $request->titulo,
        //    'descripcion' => $request->descripcion,
        //    'imagen' => $request->imagen,
        //    'user_id' => auth()->user()->id
        //]);

        //$post = new Post;
        //$post->titulo = $request->titulo;
        //$post->descripcion = $request->descripcion;
        //$post->imagen = $request->imagen;
        //$post->user_id = auth()->user()->id;
        //$post->save();

        $request->user()->posts()->create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
            'user_id' => auth()->user()->id
        ]);

        return redirect()->route('posts.index', auth()->user()->username);
    }

    public function show(User $user, Post $post)
    {
        return view('posts.show', [
            'post' => $post,
            'user' => $user
        ]);
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();
        //eliminar la imagen
        $imagenPath = public_path('uploads/' . $post->imagen);

        if (File::exists($imagenPath)) {
            unlink($imagenPath);
        }

        return redirect()->route('posts.index', auth()->user()->username);
    }
}
