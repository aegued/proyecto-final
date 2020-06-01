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
    </div>
@endsection
