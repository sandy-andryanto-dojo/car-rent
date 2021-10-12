<!-- Default box -->
<div class="box {{ CommonHelper::getBoxTheme() }}">
    <div class="box-header with-border">
        <div class="clearfix">
            <div class="pull-left">
                <h3 class="box-title">
                    <i class="fa fa-car"></i>&nbsp;Detail Car
                </h3>
            </div>
            <div class="pull-right">
                <a class="btn btn-info btn-sm" href="javacsript:void(0);" id="btn-refresh" data-toggle='tooltip' data-placement='top'  data-original-title='Reset Filter'>
                    <i class="fa fa-refresh"></i>&nbsp;Reset Filter
                </a>
            </div>
        </div>
    </div>
    <div class="box-body">
       <form id="form-filter">
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="">Filter By Model</label>
                    {!! Form::select('model_id', $models->pluck('name','id'), null, ['id'=>'model_id','class'=>'select2 form-control', 'placeholder'=> '--- Select Model ---']) !!}
                </div>
                <div class="form-group col-md-6">
                    <label for="">Filter By Brand</label>
                    {!! Form::select('brand_id', $brands->pluck('name','id'), null, ['id'=>'brand_id','class'=>'select2 form-control', 'placeholder'=> '--- Select Brand ---']) !!}
                </div>
                <div class="clearfix"></div>
                <div class="form-group col-md-6">
                    <label for="">Filter By Type</label>
                    {!! Form::select('type_id', $types->pluck('name','id'), null, ['id'=>'type_id','class'=>'select2 form-control', 'placeholder'=> '--- Select Type ---']) !!}
                </div>
                <div class="form-group col-md-6">
                    <label for="">Filter By Keyword</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="keyword" placeholder="Enter your keyword..">
                        <div class="input-group-btn">
                            <button class="btn btn-default" type="submit">
                                <i class="glyphicon glyphicon-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
       </form>
       <h1></h1>
       <div id="product-detail-section"></div>
    </div>
    <div class="box-footer">
        <span id="loader"></span>
    </div>
</div><!-- /.box -->