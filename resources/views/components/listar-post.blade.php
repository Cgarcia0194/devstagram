<div>
    {{-- $user->posts = tiene los posts por User::posts, pero no se puede usar la paginación de $posts->links --}}

    @if ($posts->count())

        <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach ($posts as $post)
                <div class="">
                    <a href="{{ route('posts.show', ['user' => $post->user, 'post' => $post]) }}">
                        <img src="{{ asset('uploads') . '/' . $post->imagen }}" alt="Imagen del post {{ $post->titulo }}">
                    </a>

                </div>
            @endforeach
        </div>
        <div class="my-10">
            {{ $posts->links('pagination::tailwind') }}
        </div>
        
    @else
        <p class="text-gray-600 uppercase text-sm text-center font-bold">
            No hay publicaciones
        </p>
    @endif
</div>
