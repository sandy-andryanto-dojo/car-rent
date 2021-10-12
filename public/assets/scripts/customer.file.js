$(document).ready(function(){
   
    let container = "#data-table";
    let permissions = $(container).attr("data-permissions");
    let route_crud = $(container).attr("data-route-crud");
    let data_model = $(container).attr("data-model");

    let dataTableColumns = [
        {
            data: 'customer_name',
            name: 'customers.name'
        },
        {
            data: 'description',
            name: 'customers_files.description'
        },
        {
            data: 'path',
            name: 'customers_files.path',
            render: function(data, type, row, meta) {
                let url = BASE_URL+"/"+data;
                return `<a class="btn btn-sm btn-primary" target="_blank" href="`+url+`"><i class="fa fa-download"></i>&nbsp;Download</a>`;
            }
        },
        {
            data: 'key_id',
            name: 'customers_files.id',
            orderable: false,
            searchable: false,
            render: function(data, type, row, meta) {
                return dataTableRenderButton(row, route_crud, data_model, permissions);
            }
        }
    ];

    dataTableRender({
        "container": container,
        "route_crud": route_crud,
        "columns": dataTableColumns,
        "model": data_model
    });

});