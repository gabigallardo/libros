<x-app-layout>
    <h1>Editar Post</h1>

    <form action="{{ route('posts.update', $post->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Título</label>
        <input type="text" name="title" value="{{ $post->title }}">

        <label>Contenido</label>
        <textarea name="content">{{ $post->content }}</textarea>

        <button type="submit">Actualizar</button>
    </form>
</x-app-layout>