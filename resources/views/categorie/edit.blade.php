

  
<!-- Modal -->
<div class="modal fade" id="editacategorie" tabindex="-1" aria-labelledby="editcategorie-form"  aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="editcategorie-form">Editar Categorías</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <ul class="alert alert-warning d-none ml-0" id="update-msg_errors"> </ul>
            <form  method="POST" autocomplete="off"  id="edit-form-categorie" enctype="multipart/form-data">
                
                <input type="hidden" name="cat_id" id="cat_id">
                <div class="row" style="width:100%">
                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="text" class="form-control form-control-alternative" name="txtname" id="txtname-edit"  placeholder="Nombre de la categoría" >
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="file" class="form-control form-control-alternative" name="txtimage" id="txtimage-edit"   >
                        </div>
                    </div>
                    <div class="col-md-6 mx-auto">
                        <img id="imgshow" class="img-fluid" />
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