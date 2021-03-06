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
        <li><a href="#">Car</a></li>
        <li class="active">{{ $title }}</li>
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
                         <i class="fa fa-list"></i>&nbsp;List {{ $title }}
                    </h3>
                </div>
                <div class="pull-right">
                    @can("add_".$route)
                    <a class="btn btn-success btn-sm" href="{{ route($route.'.create') }}" data-toggle='tooltip' data-placement='top'  data-original-title='Add New'>
                        <i class="fa fa-plus"></i>&nbsp;Add New
                    </a>
                    @endcan
                </div>
            </div>
        </div>
        <div class="box-body">
        <table class="table table-striped table-responsive" data-permissions="{{ base64_encode(json_encode($permissions)) }}"  data-route-crud="{{ route($route.'.index') }}" data-model="{{ $dataTableModel }}"  id="data-table">
                <thead>
                    <tr>
                        <th>ID Number</th>
                        <th>Year Published</th>
                        <th>Brand</th>
                        <th>Model</th>
                        <th>Status</th>
                        <th>Type</th>
                        <th>Fuel</th>
                        <th>Availability</th>
                        <th width="200">Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div><!-- /.box -->
</section><!-- /.content -->

@endsection

@section('scripts')
<script src="{{ asset('assets/scripts/car.vehicle.js') }}?{{ time() }}"></script>
@endsection