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
            data: 'name',
            name: 'customers_contacts.name'
        },
        {
            data: 'gender',
            name: 'customers_contacts.gender',
            render: function(data, type, row, meta) {
                return parseInt(data) == 1 ? 'Male' : 'Female';
            }
        },
        {
            data: 'email',
            name: 'customers_contacts.email'
        },
        {
            data: 'phone',
            name: 'customers_contacts.phone'
        },
        {
            data: 'address',
            name: 'customers_contacts.address'
        },
        {
            data: 'key_id',
            name: 'customers_contacts.id',
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