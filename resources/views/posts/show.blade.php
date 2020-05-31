@extends('layouts.app')

<!-- header sections -->
@section('image', asset(Storage::get($post->image_url)) )
@section('class','post-heading')
@section('title', $post->title)
@section('page_title', $post->title)
@section('subtitle','')
@section('meta')
    <span class="meta">Creado por <a href="{{ route('users.show',$post->user->slug) }}" class="text-info">{{ $post->user->name }}</a> {{ $post->createdDate }}</span>
@endsection

@section('content')
    <div class="col-lg-8 col-md-10 mx-auto">
        {!! $post->content !!}

        <hr class="mb-5">

        @if(Auth::check())
            <span class="text-info">Deje un comentario</span>

            <br>

            <form action="{{ route('comments.store') }}" id="commentsForm" method="POST">
                @csrf
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                <input type="hidden" name="post_id" value="{{ $post->id }}">
                <div class="form-group floating-label-form-group controls">
                    <label for="message">Comentario</label>
                    <textarea rows="5" class="form-control" name="text" placeholder="Escriba su comentario aquí..." id="message" required data-validation-required-message="Por favor, escriba su comentario aquí..."></textarea>
                    <p class="help-block text-danger"></p>
                </div>
                <br>
                <div id="success"></div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" id="sendMessageButton">Enviar</button>
                </div>
            </form>
        @endif

        <!-- Comentarios -->
        <h3 class="text-info mb-5 mt-5">Comentarios:</h3>

        <div class="list-group list-group-flush" id="comments-list">
            @foreach($comments as $comment)
            <div class="list-group-item">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1"><a href="{{ route('users.show', $comment->user->slug) }}">{{ $comment->user->name }}</a></h5>
                    <small class="text-secondary">{{ $comment->createdDate }}</small>
                </div>
                <p class="mb-1">{{ $comment->text }}</p>
            </div>
            @endforeach
        </div>
        <br>

    </div>
@endsection

@section('js')
    <script src="{{ asset('js/comments.js') }}"></script>
@endsection
