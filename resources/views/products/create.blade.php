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
                                    <h3 class="mb-0 text-h3">Agregrar productos</h3>
                                </div>
                                <div class="col-md-6 text-right">
                                    <a  class="btn btn-secondary" href="/products/lista">
                                        <i class="fas fa-eye"></i>
                                        Ver lista</a>
                                </div>
                            </div>
        
        
                        </div>
              <div class="p-3">
                   <ul class="alert alert-warning d-none ml-0" id="msg_errors"> </ul>
                        <form   id="addFormCategorie" method="POST" autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            <div class="row justify-content-center">
                                <div class="col-md-8">
                                    <label>SKU del producto</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-alternative" name="txtname"  placeholder="SKU del producto" required>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <label>Nombre del producto</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-alternative" name="txtname"  placeholder="Nombre del producto" required>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <label>Stock del producto</label>
                                    <div class="form-group">
                                        <input type="number" class="form-control form-control-alternative" name="txtname"  placeholder="Stock" required>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <label>Categorías</label>
                                    <div class="form-group">
                                        <select type="text" class="form-control form-control-alternative" name="txtname"  placeholder="Categorías" required>
                                            <option></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <label>Marca</label>
                                    <select type="text" class="form-control form-control-alternative" name="txtname"  placeholder="Marca" required>
                                        <option></option>
                                    </select>
                                </div> 
                               
                                <div class="col-md-8">
                                    <label>Precio</label>
                                    <div class="form-group">
                                        <input type="number" class="form-control form-control-alternative" name="txtname"  placeholder="Precio" required>
                                    </div>
                                </div>
                             

                                <div class="col-md-8">
                                    <label>Imágenes</label>
                                    <div class="form-group">
                                        <input type="file" class="form-control" name="txtimage" id="txtimage" required>
                                    </div>
                                </div>
                        
                                <div class="col-md-6 mx-auto">
                                    <img id="imageselected"  class="img-fluid"/>
                                </div>

                                <div class="col-md-8">
                                    <label>Descripción</label>
                                    <div class="form-group">
                                        <textarea rows="4" class="form-control" id="textarea-description" required></textarea>
                                    </div>
                                </div>
                                
                              
                        
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Guardar producto</button>
                            </div>
                        </form>
              </div>
                       
        
                    </div>
                </div>
            </div>







          
            @stop
            
            @section('css')
            <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css" rel="stylesheet" />
            <script src="https://cdn.ckeditor.com/ckeditor5/31.1.0/classic/ckeditor.js"></script>

            <link href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
            <link href="{{ asset('css/style.css') }}" rel="stylesheet" />
           

            <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            @stop
            
            @section('js')
            <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>          
            <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
            
            <script src="{{ asset('js/product.js') }}"></script>
            <script>
                ClassicEditor
                    .create( document.querySelector( '#textarea-description' ) )
                    .catch( error => {
                        console.error( error );
                    } );
            </script>
            @stop
