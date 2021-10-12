$(document).ready(function(){
   
    let tp = 2;
    let container = "#data-table";
    let permissions = $(container).attr("data-permissions");
    let route_crud = $(container).attr("data-route-crud");
    let data_model = $(container).attr("data-model");

    let dataTableColumns = [
        {
            data: 'created_at',
            name: 'transactions.created_at'
        },
        {
            data: 'invoice_number',
            name: 'transactions.invoice_number'
        },
        {
            data: 'username',
            name: 'users.username'
        },
        {
            data: 'customer_name',
            name: 'customers.name'
        },
        {
            data: 'driver_name',
            name: 'drivers.name'
        },
        {
            data: 'grandtotal',
            name: 'transactions.grandtotal'
        },
        {
            data: 'deposit',
            name: 'transactions.deposit'
        },
        {
            data: 'is_purchased',
            name: 'transactions.is_purchased'
        },
        {
            data: 'notes',
            name: 'transactions.notes'
        },
        {
            data: 'key_id',
            name: 'transactions.id',
            orderable: false,
            searchable: false,
            render: function(data, type, row, meta) {
                return dataTableRenderButton(row, route_crud, data_model, permissions);
            }
        }
    ];

    dataTableRender({
        "customUrl": BASE_URL+"/api/datatable/transaction/"+tp,
        "container": container,
        "route_crud": route_crud,
        "columns": dataTableColumns,
        "model": data_model
    });

});