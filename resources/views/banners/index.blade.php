@extends('adminlte::page')

@section('title', 'Banners')

@section('content_header')
    {{-- <h1>Dashboard</h1> --}}
@stop

@section('content')
@include('banners.create')
@include('banners.edit')


    <div class="row p-2">
        <div class="col">
            <div class="card">
                <!-- Card header -->
                <div class="card-header border-0">
                    <div class="row">
                        <div class="col-md-6">
                            <h3 class="mb-0 text-h3">Banners</h3>
                        </div>
                        <div class="col-md-6 text-right">
                            <button  class="btn btn-light" data-toggle="modal" data-target="#createbanners">
                                <i class="fas fa-plus"></i>
                                Nuevo</button>
                        </div>
                    </div>


                </div>
      
                <!-- Light table -->
                <div class="table-responsive" >
                    <table id="table-banners" class="table align-items-center table-flush display" style="width:100%">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Banner</th>
                                <th scope="col">Imagen</th>
                                <th scope="col">Acción</th>
                            </tr>
                        </thead>
                        <tbody class="list" id="listarbanners">
                         

                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

@stop

@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css" rel="stylesheet" />

<link href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
<link href="{{ asset('css/style.css') }}" rel="stylesheet" />

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@stop

@section('js')
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>          
<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>


<script src="{{ asset('js/banners.js') }}"></script>
  
@stop
