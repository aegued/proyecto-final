@extends('layouts.app')

<!-- header sections -->
@section('image', '')
@section('class','site-heading-2')
@section('title', '')
@section('page_title', 'Listado de Artículos')
@section('subtitle','')

@section('content')
    <div class="col-lg-8 col-md-10 mx-auto">
        <h3>Listado de Artículos</h3>
        <hr class="mb-5">
        @include('flash::message')
    </div>

    <div class="col-12">
        <table id="posts-table" class="table table-striped nowrap" style="width: 100%;">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Título</th>
                <th scope="col">Usuario</th>
                <th scope="col">Comentarios</th>
                <th scope="col">Creado</th>
                <th scope="col">Acción</th>
            </tr>
            </thead>
        </table>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
@endsection

@section('js')
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(function () {
            //DataTables
            $('#posts-table').DataTable({
                processing: true,
                serverSide: true,
                scrollX: true,
                order: [[0, 'desc']],
                lengthMenu: [[15, 30, 50, -1], [15, 30, 50, "All"]],
                language: {
                    url: "{{ asset('datatable_spanish.json') }}"
                },
                ajax: '{!! route('getPostsDataTable') !!}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'title', name: 'title' },
                    { data: 'user', name: 'user' },
                    { data: 'comments', name: 'comments'},
                    { data: 'created', name: 'created' },
                    { data: 'actions', name: 'actions', orderable: false, searchable: false },
                ]
            });
        });
    </script>
@endsection

