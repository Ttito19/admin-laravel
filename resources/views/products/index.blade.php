@extends('adminlte::page')

            @section('title', 'Productos')
            
            @section('content_header')
                {{-- <h1>Dashboard</h1> --}}
            @stop
            
            @section('content')
                <div class="row p-2">
                    <div class="col">
                        <div class="card">
                            <!-- Card header -->
                            <div class="card-header border-0">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h3 class="mb-0 text-h3">Lista de productos</h3>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <a  class="btn btn-secondary" href="/products/create">
                                            <i class="fas fa-plus"></i>
                                            Agregar</a>
                                    </div>
                                </div>
            
            
                            </div>
                  
                            <!-- Light table -->
                            <div class="table-responsive">
                                <table id="table-products" class="table align-items-center table-flush display" style="width:100%">
                                    <thead class="thead-light">
                                        <tr>
            
                                            <th scope="col">ID</th>
                                            <th scope="col">Sku</th>
                                            <th scope="col">Nombre</th>
                                            <th scope="col">Precio</th>
                                            <th scope="col">Stock</th>
                                            <th scope="col">Categoría</th>
                                            <th scope="col">Marca</th>
                                            <th scope="col">Imagen</th>
                                            <th scope="col">Acción</th>
                                            {{-- <th scope="col">Eliminar</th> --}}
            
            
                                        </tr>
                                    </thead>
                                    <tbody class="list" id="listarproducts">
                                     
            
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
          
            <script src="{{ asset('js/product.js') }}"></script>
              
            @stop
