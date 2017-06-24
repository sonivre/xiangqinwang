@extends('intranet.layouts.intranet_iframe_style')
@section('page-main')
<div class="right_col" role="main" style="min-height: 1161px;">
<div class="x_panel">
  <div class="x_title">
    <h2>权限列表 <small></small></h2>
    <ul class="nav navbar-right panel_toolbox">
      <li><a class="close-link"><i class="fa fa-close"></i></a>
      </li>
    </ul>
    <div class="clearfix"></div>
  </div>
  <div class="x_content" style="display: block;">
    <table class="table table-hover">
      <thead>
        <tr>
          <th>#</th>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Username</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th scope="row">1</th>
          <td>Mark</td>
          <td>Otto</td>
          <td>@mdo</td>
        </tr>
        <tr>
          <th scope="row">2</th>
          <td>Jacob</td>
          <td>Thornton</td>
          <td>@fat</td>
        </tr>
        <tr>
          <th scope="row">3</th>
          <td>Larry</td>
          <td>the Bird</td>
          <td>@twitter</td>
        </tr>
      </tbody>
    </table>

  </div>
</div>
</div>
@endsection