@extends('layouts.app')

<!-- header sections -->
@section('image', $post->image_url)
@section('class','post-heading')
@section('title', $post->title)
@section('subtitle','')
@section('meta')
    <span class="meta">Creado por <a href="{{ route('users.show',$post->user->id) }}">{{ $post->user->name }}</a> el {{ $post->created_at }}</span>
@endsection

@section('content')
    <div class="col-lg-8 col-md-10 mx-auto">
        {!! $post->content !!}
    </div>
@endsection
