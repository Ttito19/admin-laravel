

  <!-- Modal -->
  <div class="modal fade" id="createbanners" tabindex="-1" aria-labelledby="createbanners-form" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="createbanners-form">Agregar Marcas</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <ul class="alert alert-warning d-none ml-0" id="msg_errors"> </ul>
            <form   id="addFormBanners" method="POST" autocomplete="off" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="text" class="form-control form-control-alternative" name="txtname"  placeholder="Nombre de la marca" required>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="file" class="form-control" name="txtimage" id="txtimage" required>
                        </div>
                    </div>

                    <div class="col-md-6 mx-auto">
                        <img id="imageselected"  class="img-fluid"/>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </div>
            </form>
        </div>
      
      </div>
    </div>
  </div>

  