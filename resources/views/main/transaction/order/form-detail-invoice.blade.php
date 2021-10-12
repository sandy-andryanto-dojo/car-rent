<div class="clearfix">
    <div class="pull-left">
        <a href="javascript:void(0);" class="btn btn-info btn-sm">
            <i class="fa fa-car"></i>&nbsp; Total Car : <span class="txt-total-cars">0</span> 
        </a>
    </div>
    <div class="pull-right">
        <a class="btn btn-warning btn-sm" href="{{ route($route.'.index') }}" data-toggle='tooltip' data-placement='top'  data-original-title='Cancel'>
            <i class="fa fa-close"></i>&nbsp;Cancel
        </a>
        @can("delete_".$route)
        <a class="btn btn-danger btn-sm" href="javacsript:void(0);" id="btn-delete" data-toggle='tooltip' data-placement='top'  data-original-title='Delete'>
            <i class="fa fa-trash"></i>&nbsp;Delete
        </a>
        <form id="delete-form" action="{{ route($route.'.destroy', ['id'=> $model->id]) }}" method="POST" style="display: none;">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="DELETE">
        </form>
        @endcan
        @can("edit_".$route)
        <a class="btn btn-primary btn-sm hidden" href="javacsript:void(0);" id="empty-cart" data-toggle='tooltip' data-placement='top'  data-original-title='Empty Cart'>
            <i class="fa fa-cart-arrow-down"></i>&nbsp;Empty Cart
        </a>
        @endcan
    </div>
</div>
<h1></h1>
<form class="form-invoice">
    <div class="row">
        <div class="form-group col-md-4">
            <label for="">Invoice Date</label>
            <input type="text" class="form-control" id="invoice_date" name="invoice_date" disabled="disabled" value="{{ $model->invoice_date }}" />
        </div>
        <div class="form-group col-md-4">
            <label for="">Invoice Number</label>
            <input type="text" class="form-control" id="invoice_number" name="invoice_number" disabled="disabled" value="{{ $model->invoice_number }}" />
        </div>
        <div class="form-group col-md-4">
            <label for="">Casheir</label>
            <input type="text" class="form-control" disabled="disabled" value="{{ \Auth::User()->getFullname() }}" />
        </div>
    </div>
    <div class="row">
        <input type="hidden" id="model_id" value="{{ $model->id }}"/>
        <div class="form-group col-md-3">
            <label for="">Customer</label>
            {!! Form::select('customer_id', $customers->pluck('name','id'), null, ['id'=>'customer_id','class'=>'select2 form-control', 'placeholder'=> '--- Select Customer ---']) !!}
        </div>
        <div class="form-group col-md-3">
            <label for="">Driver</label>
            {!! Form::select('driver_id', $drivers->pluck('name','id'), null, ['id'=>'driver_id','class'=>'select2 form-control', 'placeholder'=> '--- Select Driver ---']) !!}
        </div>
        <div class="form-group col-md-3">
            <label for="">Date Rent</label>
            <input type="text" class="form-control" id="date_rent" />
        </div>
        <div class="form-group col-md-3">
            <label for="">Total Paid</label>
            <input type="text" class="form-control" id="date_rent" />
        </div>
    </div>
    <h1></h1>
    <div class="row">
        <div class="col-md-5">
            <strong>Product</strong>
        </div>
        <div class="col-md-2">
            <strong>Price</strong>
        </div>
        <div class="col-md-2">
            <strong>Qty</strong>
        </div>
        <div class="col-md-2">
            <strong>Total</strong>
        </div>  
        <div class="col-md-1"></div>
    </div>
    <p></p>
    <div id="bill-section-list"></div>
</form>
