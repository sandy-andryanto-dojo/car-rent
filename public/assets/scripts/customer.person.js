$(document).ready(function(){
   
    let container = "#data-table";
    let permissions = $(container).attr("data-permissions");
    let route_crud = $(container).attr("data-route-crud");
    let data_model = $(container).attr("data-model");

    let dataTableColumns = [
        {
            data: 'code',
            name: 'customers.code'
        },
        {
            data: 'name',
            name: 'customers.name'
        },
        {
            data: 'identity_name',
            name: 'identities.name'
        },
        {
            data: 'id_number',
            name: 'customers.id_number'
        },
        {
            data: 'gender',
            name: 'customers.gender',
            render: function(data, type, row, meta) {
                return parseInt(data) == 1 ? 'Male' : 'Female';
            }
        },
        {
            data: 'phone',
            name: 'customers.phone'
        },
        {
            data: 'is_banned',
            name: 'customers.is_banned',
            render: function(data, type, row, meta) {
                return parseInt(data) == 1 ? 'Banned' : 'Active';
            }
        },
        {
            data: 'key_id',
            name: 'customers.id',
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