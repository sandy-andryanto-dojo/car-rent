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
        <li class="active">{{ isset($model->id) ? 'Edit' : 'Add New' }}</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    @include('layouts.alert')
    <!-- Default box -->
    <div class="box {{ CommonHelper::getBoxTheme() }}">
        <div class="box-header with-border">
            <div class="clearfix">
                <div class="pull-left">
                    <h3 class="box-title">
                         <i class="fa fa-edit"></i>&nbsp;Form {{ isset($model->id) ? 'Edit' : 'Add New' }}
                    </h3>
                </div>
                <div class="pull-right">
                    <a class="btn btn-default btn-sm" href="{{ route($route.'.index') }}" data-toggle='tooltip' data-placement='top'  data-original-title='Back to List'>
                        <i class="fa fa-arrow-left"></i>&nbsp;Back to List
                    </a>
                </div>
            </div>
        </div>
        {!! Form::model($model, ['method' => isset($model->id) ? 'PATCH' : 'POST','class'=>'form-horizontal','id'=>'form-submit','route' => isset($model->id) ? [$route.'.update', $model->id] : $route.".store" ,'enctype'=>'multipart/form-data']) !!} 
        <div class="box-body">
            <div class="form-group {{ $errors->has('brand_id') ? ' has-error' : '' }}">
                <label for="" class="col-sm-2 control-label">Brand</label>
                <div class="col-sm-8">
                    {!! Form::select('brand_id', $brands->pluck('name','id'), null, ['id'=>'brand_id','class'=>'select2 form-control', 'placeholder'=> '--- Select Brand ---']) !!}
                    @if ($errors->has('brand_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('brand_id') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group {{ $errors->has('model_id') ? ' has-error' : '' }}">
                <label for="" class="col-sm-2 control-label">Model</label>
                <div class="col-sm-8">
                    {!! Form::select('model_id', $models->pluck('name','id'), null, ['model_id','class'=>'select2 form-control', 'placeholder'=> '--- Select Model ---']) !!}
                    @if ($errors->has('model_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('model_id') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group {{ $errors->has('status_id') ? ' has-error' : '' }}">
                <label for="" class="col-sm-2 control-label">Brand</label>
                <div class="col-sm-8">
                    {!! Form::select('status_id', $status->pluck('name','id'), null, ['id'=>'status_id','class'=>'select2 form-control', 'placeholder'=> '--- Select Status ---']) !!}
                    @if ($errors->has('status_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('status_id') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group {{ $errors->has('type_id') ? ' has-error' : '' }}">
                <label for="" class="col-sm-2 control-label">Type</label>
                <div class="col-sm-8">
                    {!! Form::select('type_id', $types->pluck('name','id'), null, ['id'=>'type_id','class'=>'select2 form-control', 'placeholder'=> '--- Select Type ---']) !!}
                    @if ($errors->has('type_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('type_id') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group {{ $errors->has('fuel_id') ? ' has-error' : '' }}">
                <label for="" class="col-sm-2 control-label">Fuel Type</label>
                <div class="col-sm-8">
                    {!! Form::select('fuel_id', $fuels->pluck('name','id'), null, ['id'=>'fuel_id','class'=>'select2 form-control', 'placeholder'=> '--- Select Fuel Type ---']) !!}
                    @if ($errors->has('fuel_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('fuel_id') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group {{ $errors->has('color') ? ' has-error' : '' }}">
                <label for="" class="col-sm-2 control-label">Color</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="color" name="color" value="{{ CommonHelper::getVal($model, 'color') }}">
                    @if ($errors->has('color'))
                        <span class="help-block">
                            <strong>{{ $errors->first('color') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group {{ $errors->has('id_number') ? ' has-error' : '' }}">
                <label for="" class="col-sm-2 control-label">ID Number</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="id_number" name="id_number" value="{{ CommonHelper::getVal($model, 'id_number') }}">
                    @if ($errors->has('id_number'))
                        <span class="help-block">
                            <strong>{{ $errors->first('id_number') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group {{ $errors->has('year_established') ? ' has-error' : '' }}">
                <label for="" class="col-sm-2 control-label">Year Published</label>
                <div class="col-sm-8">
                    <input type="number" min="1945" class="form-control" id="year_established" name="year_established" value="{{ CommonHelper::getVal($model, 'year_established') }}">
                    @if ($errors->has('year_established'))
                        <span class="help-block">
                            <strong>{{ $errors->first('year_established') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group {{ $errors->has('length') ? ' has-error' : '' }}">
                <label for="" class="col-sm-2 control-label">Length</label>
                <div class="col-sm-8">
                    <input type="number" min="0" class="form-control" id="length" name="length" value="{{ CommonHelper::getVal($model, 'length') }}">
                    @if ($errors->has('length'))
                        <span class="help-block">
                            <strong>{{ $errors->first('length') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group {{ $errors->has('width') ? ' has-error' : '' }}">
                <label for="" class="col-sm-2 control-label">Width</label>
                <div class="col-sm-8">
                    <input type="number" min="0" class="form-control" id="width" name="width" value="{{ CommonHelper::getVal($model, 'width') }}">
                    @if ($errors->has('width'))
                        <span class="help-block">
                            <strong>{{ $errors->first('width') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group {{ $errors->has('height') ? ' has-error' : '' }}">
                <label for="" class="col-sm-2 control-label">Height</label>
                <div class="col-sm-8">
                    <input type="number" min="0" class="form-control" id="height" name="height" value="{{ CommonHelper::getVal($model, 'height') }}">
                    @if ($errors->has('height'))
                        <span class="help-block">
                            <strong>{{ $errors->first('height') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group {{ $errors->has('capacity') ? ' has-error' : '' }}">
                <label for="" class="col-sm-2 control-label">Capacity</label>
                <div class="col-sm-8">
                    <input type="number" min="0" class="form-control" id="capacity" name="capacity" value="{{ CommonHelper::getVal($model, 'capacity') }}">
                    @if ($errors->has('capacity'))
                        <span class="help-block">
                            <strong>{{ $errors->first('capacity') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group {{ $errors->has('charge') ? ' has-error' : '' }}">
                <label for="" class="col-sm-2 control-label">Charge / Day</label>
                <div class="col-sm-8">
                    <input type="number" min="0" class="form-control" id="charge" name="charge" value="{{ CommonHelper::getVal($model, 'charge') }}">
                    @if ($errors->has('charge'))
                        <span class="help-block">
                            <strong>{{ $errors->first('charge') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
                <label for="" class="col-sm-2 control-label">Description</label>
                <div class="col-sm-8">
                    <textarea class="form-control" rows="8" id="description" name="description">{{ CommonHelper::getVal($model, 'description') }}</textarea>
                    @if ($errors->has('description'))
                        <span class="help-block">
                            <strong>{{ $errors->first('description') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group {{ $errors->has('notes') ? ' has-error' : '' }}">
                <label for="" class="col-sm-2 control-label">Notes</label>
                <div class="col-sm-8">
                    <textarea class="form-control" rows="8" id="notes" name="notes">{{ CommonHelper::getVal($model, 'notes') }}</textarea>
                    @if ($errors->has('notes'))
                        <span class="help-block">
                            <strong>{{ $errors->first('notes') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group {{ $errors->has('is_rent') ? ' has-error' : '' }}">
                <label for="" class="col-sm-2 control-label">Availability</label>
                <div class="col-sm-8">
                    <select id="is_rent" name="is_rent" class="select2 form-control">
                        <option selected disabled>-- Choose Availability --</option>
                        <option value="0" {{ (int)CommonHelper::getVal($model, 'is_rent') == 0 ? 'selected' : null }}>Yes</option>
                        <option value="1" {{ (int)CommonHelper::getVal($model, 'is_rent') == 1 ? 'selected' : null }}>No</option>
                    </select>
                    @if ($errors->has('is_rent'))
                        <span class="help-block">
                            <strong>{{ $errors->first('is_rent') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        </div>
        <div class="box-footer">
            <div class="clearfix">
                <div class="pull-left">
                    <button type="submit" class="btn btn-info btn-sm" data-toggle='tooltip' data-placement='top'  data-original-title='{{ isset($model->id) ? 'Update' : 'Save' }}'>
                        <i class="fa fa-save"></i>&nbsp;{{ isset($model->id) ? 'Update' : 'Save' }}
                    </button>
                </div>
                <div class="pull-right">
                    <button type="reset" class="btn btn-warning btn-sm" data-toggle='tooltip' data-placement='top'  data-original-title='Reset'>
                        <i class="fa fa-refresh"></i>&nbsp;Reset Form
                    </button>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div><!-- /.box -->
</section><!-- /.content -->

@endsection
