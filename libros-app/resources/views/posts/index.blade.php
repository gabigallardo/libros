<x-app-layout>
    <h1>Listado de Posts</h1>

    <ul>
        @foreach($posts as $post)
        <li>
            <strong>{{ $post->title }}</strong><br>
            <small>{{ $post->slug }}</small><br>
            <p>{{ $post->content }}</p>
        </li>
        @endforeach
    </ul>

</x-app-layout>