<div class="x_panel">
  <div class="x_title">
    <h2>{{$pageTitle}}</h2>
    <ul class="nav navbar-right panel_toolbox">
      <li><a href="{{$navigationButtonUrl}}"><button type="button" class="btn btn-default btn-sm">{{$navigationButtonName}}</button></a></li>
    </ul>
    <div class="clearfix"></div>
  </div>
  <div class="x_content table-responsive" style="display: block;">
    <table class="table table-hover">
      <thead>
        <tr class="pointer">
          <th class="a-center check-all-box">#</th>
          @foreach ($columnTitleName as $zh)
          <th>{{$zh}}</th>
          @endforeach
          <th style="width: 20%">#操作</th>
        </tr>
      </thead>
      <tbody>
          @if (! empty($list))
              @foreach ($list as $item)
              <tr class="pointer">
              <td class="a-center">
              <div class="data-row" data-actionid="{{$item[$primaryKey]}}"><input type="checkbox" class="flat" name="table_records" style="position: absolute; opacity: 0;"></div>
              </td>
              @foreach($columnKey as $en)
              <td>{{$item[$en]}}</td>
              @endforeach
              <td>
                <a href="{{$editRoute}}/{{$item[$primaryKey]}}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> 编辑</a>
                <a href="javascript:;" class="btn btn-danger btn-xs remove-item" data-actionid="{{$item[$primaryKey]}}"><i class="fa fa-trash-o"></i> 删除</a>
              </td>
              </tr>
              @endforeach
          @endif
          
      </tbody>
    </table>
  </div>
  <div class="x_content">
      <div class="col-md-4 col-sm-4 col-xs-4">
      <div class="pagination" style="margin: 0">
      <input type="checkbox" class="check-box-all-delete" style="vertical-align: sub"><span style="margin-right: 10px;"> 全选</span>
      <button type="button" class="btn btn-default remove-all-btn">删除所选</button>
      </div>
      </div>
      <div class="col-md-8 col-sm-8 col-xs-8">
      <ul class="pagination" style="float: right; margin: 0;">
        <li>
          <a href="#" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
          </a>
        </li>
        <li><a href="#">1</a></li>
        <li><a href="#">2</a></li>
        <li><a href="#">3</a></li>
        <li><a href="#">4</a></li>
        <li><a href="#">5</a></li>
        <li>
          <a href="#" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
          </a>
        </li>
      </ul>
      </div>
  </div>
</div>