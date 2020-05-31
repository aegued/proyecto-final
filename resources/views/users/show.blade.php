@extends('layouts.app')

<!-- header sections -->
@section('image', '')
@section('class','site-heading-2')
@section('title', '')
@section('page_title', $user->name)
@section('subtitle','')

@section('content')
    <div class="col-lg-10 col-md-10 mx-auto">
        <h3>{{ $user->name }}</h3>
        <hr class="mb-5">

        <h4 class="text-info mb-5">Comentarios: {{ $user->comments->count() }}</h4>

        <div class="list-group list-group-flush mb-5" id="comments-list">
            @foreach($comments as $comment)
                <div class="list-group-item">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">Artículo: <a href="{{ route('posts.show', $comment->post->slug) }}" class="font-weight-normal text-info">{{ $comment->post->title }}</a></h5>
                        <small class="text-secondary">{{ $comment->createdDate }}</small>
                    </div>
                    <p class="mb-1">{{ $comment->text }}</p>
                </div>
            @endforeach
        </div>

        <div class="d-flex w-100 justify-content-center">{{ $comments->links() }}</div>

    </div>
@endsection
