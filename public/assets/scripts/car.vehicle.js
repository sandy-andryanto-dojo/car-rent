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
            data: 'year_established',
            name: 'cars.year_established'
        },
        {
            data: 'brand_name',
            name: 'brands.name'
        },
        {
            data: 'model_name',
            name: 'models.name'
        },
        {
            data: 'status_name',
            name: 'status.name'
        },
        {
            data: 'type_name',
            name: 'types.name'
        },
        {
            data: 'fuel_name',
            name: 'fuels.name'
        },
        {
            data: 'is_rent',
            name: 'cars.is_rent',
            render: function(data, type, row, meta) {
                if (parseInt(data) === 0) {
                    return '<span class="label label-success">Yes</span></td>';
                } else {
                    return '<span class="label label-danger">No</span></td>';
                }
            }
        },
        {
            data: 'key_id',
            name: 'cars.id',
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