@extends('layouts.app')
@section('title') {{ $title }} @endsection
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        {{ $title }}
        <small>{{ $subtitle }}</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('') }}"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="javascript:void(0);">Car</a></li>
        <li><a href="{{ route($route.'.index') }}">{{ $title }}</a></li>
        <li class="active">Detail</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    @include('layouts.alert')
    <div class="box {{ CommonHelper::getBoxTheme() }}">

        <div class="box-header with-border">
            <div class="clearfix">
                <div class="pull-left">
                    <h3 class="box-title">
                         <i class="fa fa-search"></i>&nbsp;Detail {{ $title }}
                    </h3>
                </div>
                <div class="pull-right">
                    <a class="btn btn-default btn-sm" href="{{ route($route.'.index') }}" data-toggle='tooltip' data-placement='top'  data-original-title='Back to List'>
                        <i class="fa fa-arrow-left"></i>&nbsp;Back to List
                    </a>
                </div>
            </div>
        </div>
        <div class="box-body">
            <form class="form-horizontal">
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">Brand :</label>
                    <div class="col-sm-10">
                        <p class ="form-control-static">{{ CommonHelper::getVal($model->Brand, 'name') }}</p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">Model :</label>
                    <div class="col-sm-10">
                        <p class ="form-control-static">{{ CommonHelper::getVal($model->Model, 'name') }}</p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">Status :</label>
                    <div class="col-sm-10">
                        <p class ="form-control-static">{{ CommonHelper::getVal($model->Status, 'name') }}</p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">Type :</label>
                    <div class="col-sm-10">
                        <p class ="form-control-static">{{ CommonHelper::getVal($model->Type, 'name') }}</p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">Fuel :</label>
                    <div class="col-sm-10">
                        <p class ="form-control-static">{{ CommonHelper::getVal($model->Fuel, 'name') }}</p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">Color :</label>
                    <div class="col-sm-10">
                        <p class ="form-control-static">{{ CommonHelper::getVal($model, 'color') }}</p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">Id Number :</label>
                    <div class="col-sm-10">
                        <p class ="form-control-static">{{ CommonHelper::getVal($model, 'id_number') }}</p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">Year Published :</label>
                    <div class="col-sm-10">
                        <p class ="form-control-static">{{ CommonHelper::getVal($model, 'year_established') }}</p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">Length :</label>
                    <div class="col-sm-10">
                        <p class ="form-control-static">{{ CommonHelper::getVal($model, 'length') }}</p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">Width :</label>
                    <div class="col-sm-10">
                        <p class ="form-control-static">{{ CommonHelper::getVal($model, 'width') }}</p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">Height :</label>
                    <div class="col-sm-10">
                        <p class ="form-control-static">{{ CommonHelper::getVal($model, 'height') }}</p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">Capacity :</label>
                    <div class="col-sm-10">
                        <p class ="form-control-static">{{ CommonHelper::getVal($model, 'capacity') }}</p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">Charge / Day :</label>
                    <div class="col-sm-10">
                        <p class ="form-control-static">{{ CommonHelper::getVal($model, 'charge') }}</p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">Description :</label>
                    <div class="col-sm-10">
                        <p class ="form-control-static">{{ CommonHelper::getVal($model, 'description') }}</p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">Notes :</label>
                    <div class="col-sm-10">
                        <p class ="form-control-static">{{ CommonHelper::getVal($model, 'notes') }}</p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">Availability :</label>
                    <div class="col-sm-10">
                        <p class ="form-control-static">
                            {!! (int) CommonHelper::getVal($model, 'is_rent') == 0 ? '<span class="label label-success"> Yes</span></td>' : '<span class="label label-danger"> No</span></td>' !!}
                        </p>
                    </div>
                </div>
            </form>
        </div>
        <div class="box-footer">
            <div class="clearfix">
                <div class="pull-left">
                    @can("add_".$route)
                    <a class="btn btn-success btn-sm" href="{{ route($route.'.create') }}" data-toggle='tooltip' data-placement='top'  data-original-title='Add New'>
                        <i class="fa fa-plus"></i>&nbsp;Add New
                    </a>
                    @endcan
                </div>
                <div class="pull-right">
                    @can("edit_".$route)
                    <a class="btn btn-warning btn-sm" href="{{ route($route.'.edit', ['id'=> $model->id]) }}" data-toggle='tooltip' data-placement='top'  data-original-title='Edit'>
                        <i class="fa fa-edit"></i>&nbsp;Edit
                    </a>
                    @endcan
                    @can("delete_".$route)
                    <a class="btn btn-danger btn-sm" href="javacsript:void(0);" id="btn-delete" data-toggle='tooltip' data-placement='top'  data-original-title='Delete'>
                        <i class="fa fa-trash"></i>&nbsp;Delete
                    </a>
                    <form id="delete-form" action="{{ route($route.'.destroy', ['id'=> $model->id]) }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="DELETE">
                    </form>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</section>


@endsection