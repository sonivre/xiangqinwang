@extends('intranet.layouts.intranet_iframe_style')
@section('page-main')
<div class="x_panel">

    @if (count($errors) > 0)
    <div class="alert alert-danger alert-dismissible fade in" role="alert">
        <a href="#" class="close" data-dismiss="alert">
            &times;
        </a>
        <ul>
            <li style="list-style: none"><strong>警告！</strong></li>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <!-- 错误信息输出 -->
    @if (! empty($errorMsg))
        <div class="alert alert-danger alert-dismissible fade in" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
            </button>
            <strong>糟糕！</strong> @if (! empty($errorMsg)) {{$errorMsg}} @endif
        </div>
    @endif

    <div class="x_title">
        <h2>收入范围编辑</h2>
        <ul class="nav navbar-right panel_toolbox">
            <li><a href="{{url('intranet/RegisterRevenue/list')}}"><button type="button" class="btn btn-default btn-sm">查看列表</button></a></li>
        </ul>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
        <br>
        <form action="{{url('intranet/RegisterRevenue/update')}}" method="post" class="form-horizontal form-label-left">
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">收入范围 <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" required="required" name="revenue" value="{{$detail['revenue']}}" class="form-control col-md-7 col-xs-12">
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    {{csrf_field()}}
                    <input type="hidden" name="action_id" value="{{$detail['rev_id']}}">
                    <input type="hidden" name="old_revenue" value="{{$detail['revenue']}}">
                    <button type="submit" class="btn btn-success">提交</button>
                    <button class="btn btn-primary" type="reset" onclick="window.location.href=window.location.href;">重置</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection