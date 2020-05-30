@extends('layouts.app')

<!-- header sections -->
@section('image', '')
@section('class','site-heading-2')
@section('title', '')
@section('page_title', 'Contacto')
@section('subtitle','')

@section('content')
    <div class="col-lg-10 col-md-10 mx-auto">
        <h2>Contacto</h2>
        <hr class="mb-5">

        <div class="row">
            <div class="col text-center">
                <h3 class="mb-5">Datos del Desarrollador</h3>
            </div>
        </div>

        <div class="row">
            <div class="col text-center">
                <i class="fas fa-user fa-5x text-info"></i>
                <p class="font-weight-bold mt-4 mb-0 text-info">Nombre</p>
                <small class="text-muted m-0">Alfredo Egüed Guerra</small>
            </div>

            <div class="col text-center">
                <i class="fas fa-home fa-5x text-info"></i>
                <p class="font-weight-bold mt-4 mb-0 text-info">Dirección</p>
                <small class="text-muted m-0">Calle Jesus, 4, 2a, Palma de Mallorca, España</small>
            </div>

            <div class="col text-center">
                <i class="fas fa-envelope fa-5x text-info"></i>
                <p class="font-weight-bold mt-4 mb-0 text-info">Email</p>
                <small class="text-muted m-0"><a href="mailto:egued89@gmail.com">egued89@gmail.com</a></small>
            </div>
        </div>

        {{--<hr class="mt-5 mb-5">

        <div class="row">
            <div class="col">
                <h3 class="mb-5 text-center">Agradecimientos</h3>


            </div>
        </div>--}}
    </div>
@endsection
