$(document).ready(function(){
   
    let container = "#data-table";
    let permissions = $(container).attr("data-permissions");
    let route_crud = $(container).attr("data-route-crud");
    let data_model = $(container).attr("data-model");

    let dataTableColumns = [
        {
            data: 'id_number',
            name: 'cars.id_number'
        },
        {
            data: 'name',
            name: 'cars_penalties.name'
        },
        {
            data: 'cost',
            name: 'cars_penalties.cost'
        },
        {
            data: 'description',
            name: 'cars_penalties.description'
        },
        {
            data: 'notes',
            name: 'cars_penalties.notes'
        },
        {
            data: 'key_id',
            name: 'cars_penalties.id',
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