$(document).ready(function () {
    //   listar categorías en datatables
$('#table-products').DataTable( {  
    language: {
                url: "../dataTables.espanol.json",
            },
    processing: false,
    serverSide: true,
    ajax:"../listaProducts",
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
                data: 'sku',
                name: 'sku'
            },
            {
                data: 'name',
                name: 'name'
            },
            {
                data: 'price',
                name: 'price'
            },
            {
                data: 'stock',
                name: 'stock'
            },
            {
                data: 'categorie_id',
                name: 'categorie_id'
            },
            {
                data: 'brand_id',
                name: 'brand_id'
            },
           
            {
                "render": function (data, type, JsonResultRow, meta) {
                    // console.log(meta);
                    // console.log(meta.row+1);
                    return '<img height="100px"; src="../uploads/products/' + JsonResultRow.image + '">';
                }
            }, {
                data: 'action',
                name: 'action'
            },
        ]
    
} );

   
});