@extends('layouts.app')

<!-- header sections -->
@section('image', '')
@section('class','site-heading-2')
@section('title', '')
@section('page_title', 'Editar Artículo - '.$post->title)
@section('subtitle','')

@section('content')
    <div class="col-lg-8 col-md-10 mx-auto">
        <h3>Editar Artículo</h3>
        <hr class="mb-5">

        @include('flash::message')

        <form action="{{ route('posts.update', $post->slug) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="user_id" value="{{ $post->user_id }}">
            <div class="form-group">
                <label for="">Título</label>
                <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ $post->title }}" autofocus>

                @error('title')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group ">
                <label for="content">Descripción</label>
                <textarea name="content" id="content" cols="30" rows="10" class="form-control @error('content') is-invalid @enderror" autocomplete="content" autofocus>
                    {{ $post->content }}
                </textarea>

                @error('content')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group ">
                <label for="excerpt">Descripción Corta</label>
                <textarea name="excerpt" id="excerpt" rows="6" class="form-control" autocomplete="excerpt" autofocus>{{ $post->excerpt }}</textarea>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-md-6" id="imagePreview">
                        <img src="{{ $post->image_url_path }}" class="img-fluid rounded">
                    </div>
                    <div class="col-md-6">
                        <div class="custom-file">
                            <input type="file" accept="image/*" name="image_url" class="custom-file-input @error('image_url') is-invalid @enderror" id="image_url">
                            <label class="custom-file-label" for="image_url" data-browse="Buscar">Buscar imagen</label>
                            @error('image_url')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <hr>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-sm">Guardar</button>
                <a href="{{ route('posts.destroy', $post->slug) }}" onclick="return confirm('¿Está seguro que desea eliminar el Artículo?')" class="btn btn-danger btn-sm">Eliminar</a>
            </div>
        </form>
    </div>
@endsection

@section('css')
    <!-- include summernote css/js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script src="{{ asset('vendor/summernote-es-ES.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#content').summernote({
                lang: 'es-ES',
                height: 200,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['codeview']]
                ]
            });

            $('#image_url').on('change', function () {
                let image=document.getElementById("image_url").files[0];
                let imageUrl=URL.createObjectURL(image);

                $('#imagePreview').html(
                    '<img src="'+imageUrl+'" class="img-fluid rounded">'
                );
            });
        });
    </script>
@endsection
