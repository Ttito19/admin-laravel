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
$('#table-brands').DataTable( {  
    language: {
                url: "./dataTables.espanol.json",
            },
    processing: false,
    serverSide: true,
    ajax:"./listaBrands",
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
                    return '<img height="100px"; src="uploads/brands/' + JsonResultRow.image + '">';
                }
            }, {
                data: 'action',
                name: 'action'
            },
        ]
    
} );

   
});



$(document).on("submit", "#addFormBrand", function (e) {
    e.preventDefault();
    let formData = new FormData($("#addFormBrand")[0]);
    $.ajax({
        type: "POST",
        url: "/create-brand",
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
                $("#addFormBrand")[0].reset();
                $("#createbrands").trigger('reveal:close');
                $("#createbrands .close").click();
                $('#imageselected').attr('src', "");
                alert(res.message);           
                var oTable = $('#table-brands').dataTable();
                oTable.fnDraw(false);

            }
        }

    })

})


$(document).on("submit", "#edit-form-brand", function (e) {
    e.preventDefault();
    var id = $("#brand_id").val();
    let editformData = new FormData($("#edit-form-brand")[0]);
    $.ajax({
        type: "POST",
        url: "/update-brand/" + id,
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

                $("#editBrands").trigger('reveal:close');
                $("#editBrands .close").click();
                alert(res.message);
              var oTable = $('#table-brands').dataTable();
            oTable.fnDraw(false);
            }
        }
    });
})

$(document).on("click", "#btn-edit", function (e) {
    $('#imgshow').removeAttr('src');
    $('#txtimage-edit').val(null)
    $("#brand_id").val("");
    $("#txtname-edit").val("");
    var id = $(this).data("id");
    $.ajax({
        type: "GET",
        url: `/edit-brand/${id}`,
    }).done(function(res){
            console.log(res);
            if (res.status == 400) {
                alert(res.message);
                $("#createbrands").trigger('reveal:close');
             
            } else {
                $("#brand_id").val(res.brand.id);
                $("#txtname-edit").val(res.brand.name);
                $('#imgshow').attr('src',`uploads/brands/${res.brand.image}`);
            }
    })
})



$(document).on("click", "#btn-delete", function (e) {
    e.preventDefault();
    var id = $(this).data("id");

    Swal.fire({
        title: '¿Seguro desea eliminarlo?',
        text: "se eliminará la marca",
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
                url: "/delete-brand/" + id,
                dataType: "json",
                success: function (res) {


                    if (res.status == 200) {
                        Swal.fire('Eliminado!', `${
                            res.message
                        }`, 'success');
                        var oTable = $('#table-brands').dataTable();
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