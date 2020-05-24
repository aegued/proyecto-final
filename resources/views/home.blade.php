@extends('layouts.app')

@section('content')
    <div class="col-lg-8 col-md-10 mx-auto">
        @foreach($posts as $post)
            <div class="post-preview">
                <a href="{{ route('posts.show', $post->slug) }}">
                    <h2 class="post-title">{{ $post->title }}</h2>
                    <h3 class="post-subtitle">{!! $post->content !!}</h3>
                </a>
                <p class="post-meta">Creado por
                    <a href="#">{{ $post->user->name }}</a>
                    en {{ $post->created_at }}{{--September 24, 2019--}}</p>
            </div>
            <hr>
        @endforeach
    </div>
@endsection
