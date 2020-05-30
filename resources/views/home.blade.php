@extends('layouts.app')
@section('page_title', 'Inicio')

@section('content')
    <div class="col-lg-8 col-md-10 mx-auto">
        @foreach($posts as $post)
            <div class="post-preview">
                <a href="{{ route('posts.show', $post->slug) }}">
                    <h2 class="post-title">{{ $post->title }}</h2>
                    <h3 class="post-subtitle">{!! Str::limit($post->content, 100, ' (...)') !!}</h3>
                </a>
                <p class="post-meta">Creado por
                    <a href="{{ route('users.show', $post->user->slug) }}">{{ $post->user->name }}</a>
                    {{ $post->createdDate }}</p>
            </div>
            <hr>
        @endforeach
        <div class="d-flex w-100 justify-content-center">{{ $posts->links() }}</div>
    </div>
@endsection
