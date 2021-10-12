$(document).ready(function(){
   
    let tp = 1;
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
            name: 'users.username',
            render: function(data, type, row, meta) {
                let fullName = row.first_name+" "+row.last_name;
                let username = row.username;
                if(fullName.length > 0){
                    return fullName;
                }else{
                    return username;
                }
            }
        },
        {
            data: 'customer_name',
            name: 'customers.name',
            render: function(data, type, row, meta) {
                return data ? data : "Unknown";
            }
        },
        {
            data: 'driver_name',
            name: 'drivers.name',
            render: function(data, type, row, meta) {
                return data ? data : "Unknown";
            }
        },
        {
            data: 'day_duration',
            name: 'transactions.day_duration',
            render: function(data, type, row, meta) {
                return data ? data : "-";
            }
        },
        {
            data: 'date_start',
            name: 'transactions.date_start',
            render: function(data, type, row, meta) {
                return data ? data : "-";
            }
        },
        {
            data: 'date_end',
            name: 'transactions.date_end',
            render: function(data, type, row, meta) {
                return data ? data : "-";
            }
        },
        {
            data: 'is_saved',
            name: 'transactions.is_saved',
            render: function(data, type, row, meta) {
                if (parseInt(data) === 1) {
                    return '<span class="label label-success">Saved</span></td>';
                } else {
                    return '<span class="label label-danger">Draft</span></td>';
                }
            }
        },
        {
            data: 'key_id',
            name: 'transactions.id',
            orderable: false,
            searchable: false,
            render: function(data, type, row, meta) {
                let status = parseInt(row.is_saved);
                let _permissions = atob(permissions);
                let permission = JSON.parse(_permissions);
                let detail = route_crud+"/"+row.key_id;
                let edit = route_crud+"/"+row.key_id+"/edit";
                let buttons = new Array();
                if(permission.can_view){
                    buttons.push("<a href='"+detail+"' class='btn btn-sm btn-info btn-detail' data-toggle='tooltip' data-placement='top'  data-original-title='Show Record'><i class='fa fa-search'></i></a>");
                }
                if(permission.can_edit && status == 0){
                    buttons.push("<a href='"+edit+"' class='btn btn-sm btn-warning btn-edit' data-toggle='tooltip' data-placement='top'  data-original-title='Edit Record'><i class='fa fa-edit'></i></a>");
                }
                if(permission.can_delete && status == 0){
                    buttons.push("<a href='javascript:void(0);' data-id='"+row.key_id+"' data-route="+detail+" data-model='"+data_model+"' class='btn btn-sm btn-danger btn-delete' data-toggle='tooltip' data-placement='top'  data-original-title='Delete Record'><i class='fa fa-trash'></i></a>");
                }
                return buttons.join("&nbsp;");
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