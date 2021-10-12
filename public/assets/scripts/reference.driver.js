$(document).ready(function(){
   
    let container = "#data-table";
    let permissions = $(container).attr("data-permissions");
    let route_crud = $(container).attr("data-route-crud");
    let data_model = $(container).attr("data-model");

    let dataTableColumns = [
        {
            data: 'code',
            name: 'drivers.code'
        },
        {
            data: 'name',
            name: 'drivers.name'
        },
        {
            data: 'identity_name',
            name: 'identities.name'
        },
        {
            data: 'id_number',
            name: 'drivers.id_number'
        },
        {
            data: 'gender',
            name: 'drivers.gender',
            render: function(data, type, row, meta) {
                return parseInt(data) == 1 ? 'Male' : 'Female';
            }
        },
        {
            data: 'phone',
            name: 'drivers.phone'
        },
        {
            data: 'is_ready',
            name: 'drivers.is_ready',
            render: function(data, type, row, meta) {
                return parseInt(data) == 1 ? 'Ready' : 'Drive';
            }
        },
        {
            data: 'key_id',
            name: 'drivers.id',
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