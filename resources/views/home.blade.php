@extends('layouts.app')
@section('page_title', 'Inicio')

@section('content')
    <div class="col-lg-12 mx-auto">
        <div class="row">
            @foreach($posts as $post)
                <div class="col-md-4 mb-4 post">
                    <div class="card">
                        @if($post->image_url)
                            <img src="{{ $post->image_url_path }}" alt="{{ $post->title }}" class="img-fluid">
                        @else
                            <img src="{{ asset('img/default-image.jpg') }}" alt="{{ $post->title }}" class="img-fluid">
                        @endif
                        <div class="card-body post-preview">
                            <h5 class="card-title"><a href="{{ route('posts.show', $post->slug) }}">{{ $post->title }}</a></h5>
                            <p class="card-text">{{ Str::limit($post->excerpt, 100, ' (...)') }}</p>

                            <p class="post-meta mb-0">Creado por <a href="{{ route('users.comments', $post->user->slug) }}"> {{ $post->user->name }}</a> {{ $post->createdDate }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="d-flex w-100 justify-content-center">{{ $posts->links() }}</div>
    </div>
@endsection

@section('js')
    <script>
        $(function () {
            $('.card').hover(function () {
                $(this).addClass('shadow');
            }, function () {
                $(this).removeClass('shadow');
            });
        });
    </script>
@endsection
