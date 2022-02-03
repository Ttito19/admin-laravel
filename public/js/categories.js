$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(`#txtimage`).change(function() {
        let reader = new FileReader();
        reader.onload = (e) => {
            $('#imageselected').attr('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0]);
        // console.log(this.files[0]);
    })
    $(`#txtimage-edit`).change(function() {
        let reader = new FileReader();
        reader.onload = (e) => {
            $('#imgshow').attr('src', e.target.result);     
        }
        reader.readAsDataURL(this.files[0]);
    })

 
//   listar categorías en datatables
$('#table-categorie').DataTable( {  
    language: {
                url: "./dataTables.espanol.json",
            },
    processing: false,
    serverSide: true,
    ajax:"./listaCategorias",
    // retrieve: true,
    // paging: false,
    // aaSorting:[[0,"desc"]],
        columns: [
            // {data: 'id', name: 'id'},
            {
                "render": function (data, type, JsonResultRow, meta) {
                    return meta.row + 1;
                }
            }, 
            {
                data: 'name',
                name: 'name'
            }, {
                "render": function (data, type, JsonResultRow, meta) {
                    // console.log(meta);
                    // console.log(meta.row+1);
                    return '<img height="100px"; src="uploads/categorie/' + JsonResultRow.image + '">';
                }
            }, {
                data: 'action',
                name: 'action'
            },
        ]
    
} );

   
});



$(document).on("submit", "#addFormCategorie", function (e) {
    e.preventDefault();
    let formData = new FormData($("#addFormCategorie")[0]);
    $.ajax({
        type: "POST",
        url: "/create-categories",
        data: formData,
        contentType: false,
        processData: false,
        success: function (res) {
            $("#msg_errors").html("");
            if (res.status == 400) {
                $.each(res.errors, function (key, err_value) { 
                    $("#msg_errors").removeClass('d-none');
                    $("#msg_errors").append(`<li>${err_value}</li>`)
                })
            } else if (res.status = 200) {
                $("#msg_errors").html("");
                $("#msg_errors").addClass('d-none');
                $("#addFormCategorie")[0].reset();
                $("#createcategorie").trigger('reveal:close');
                $("#createcategorie .close").click();
                $('#imageselected').attr('src', "");
                alert(res.message);           
                var oTable = $('#table-categorie').dataTable();
                oTable.fnDraw(false);

            }
        }

    })

})


$(document).on("submit", "#edit-form-categorie", function (e) {
    e.preventDefault();
    var id = $("#cat_id").val();
    let editformData = new FormData($("#edit-form-categorie")[0]);
    $.ajax({
        type: "POST",
        url: "/update-categorie/" + id,
        data: editformData,
        contentType: false,
        processData: false,
        success: function (res) {
            console.log(res);
            $("#update-msg_errors").html("");
            if (res.status == 400) {
                $.each(res.errors, function (key, err_value) { // $("#msg_errors").html("");
                    $("#update-msg_errors").removeClass('d-none');
                    $("#update-msg_errors").append(`<li>${err_value}</li>`)
                })
            } else if (res.status == 404) {
                alert(res.message);
            } else if (res.status == 200) {
                $("#update-msg_errors").html("");
                $("#update-msg_errors").addClass('d-none');

                $("#editacategorie").trigger('reveal:close');
                $("#editacategorie .close").click();
                alert(res.message);
              var oTable = $('#table-categorie').dataTable();
            oTable.fnDraw(false);
            }
        }
    });
})

$(document).on("click", "#btn-edit", function (e) {
    $('#imgshow').removeAttr('src');
    $('#txtimage-edit').val(null)
    $("#cat_id").val("");
    $("#txtname-edit").val("");
    var id = $(this).data("id");
    $.ajax({
        type: "GET",
        url: `/edit-categorie/${id}`,
    }).done(function(res){
            // console.log(res);
            if (res.status == 400) {
                alert(res.message);
                $("#createcategorie").trigger('reveal:close');
             
            } else {
                $("#cat_id").val(res.categorie.id);
                $("#txtname-edit").val(res.categorie.name);
                $('#imgshow').attr('src',`uploads/categorie/${res.categorie.image}`);
            }
    })
})



$(document).on("click", "#btn-delete", function (e) {
    e.preventDefault();
    var id = $(this).data("id");

    Swal.fire({
        title: '¿Seguro desea eliminarlo?',
        text: "se eliminará la categoría",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {

        if (result.isConfirmed) {
            $.ajax({
                type: "DELETE",
                url: "/delete-categorie/" + id,
                dataType: "json",
                success: function (res) {


                    if (res.status == 200) {
                        Swal.fire('Eliminado!', `${
                            res.message
                        }`, 'success');
                        var oTable = $('#table-categorie').dataTable();
                        oTable.fnDraw(false);

                    } else if (res.status == 404) {
                        alert(res.message);
                    }


                }
            });

        } else {
            console.log("cancelado");
        }
    })

})
