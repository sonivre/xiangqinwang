<?php
/**
 * Created by PhpStorm.
 * File: list.blade.php
 * User: konohanaruto
 * Blog: http://www.muyesanren.com
 * QQ: 1039814413
 * Wechat Number: wikitest
 * Date: 11/5/2017
 * Time: 5:13 PM
 */
?>
@extends('intranet.layouts.intranet_iframe_style')
@section('page-main')
    <div class="x_panel">
        <div class="x_title">
            <h2>{{trans('common.gift_list')}}</h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a href="{{url('intranet/MemberGift/showAddForm')}}"><button type="button" class="btn btn-default btn-sm">{{trans('buttons.add')}}</button></a></li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content table-responsive" style="display: block;">
            <table class="table table-hover" style="margin-bottom: 40px;">
                <thead>
                <tr class="pointer">
                    <th class="a-center check-all-box">#</th>
                    <th style="width: 20%">{{trans('label_fields.gift_picture')}}</th>
                    <th style="width: 20%">{{trans('label_fields.gift_name')}}</th>
                    <th>{{trans('label_fields.htb')}}</th>
                    <th>{{trans('label_fields.only_vip')}}</th>
                    <th>{{trans('label_fields.is_valid')}}</th>
                    <th style="width: 20%;">#{{trans('label_fields.action')}}</th>
                </tr>
                </thead>
                <tbody>
                @if(! empty($list))
                @foreach($list as $item)
                <tr class="pointer">
                    <td class="a-center">
                        <div class="icheckbox_flat-green item-row" data-itemid="{{$item['id']}}"><input type="checkbox" class="flat" name="table_records" style="position: absolute; opacity: 0;"></div>
                    </td>
                    <td class="gift-thumb-td"><img class="gift-thumb-image" src="{{$item['thumb_image_url']}}"></td>
                    <td>{{$item['gift_name']}}</td>
                    <td>{{$item['htb']}}</td>
                    <td style="cursor: pointer;">{{$item['is_vip']}}</td>
                    <td style="cursor: pointer;">{{$item['is_valid']}}</td>
                    <td>
                        <a href="{{url('intranet/MemberGift/showEditForm')}}/{{$item['id']}}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> {{trans('buttons.edit')}}</a>
                        <a href="javascript:;" class="btn btn-danger btn-xs remove-item" data-itemid="{{$item['id']}}"><i class="fa fa-trash-o"></i> {{trans('buttons.remove')}}</a>
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
@endsection

@section('extra-js')
    <script>
        var listRemoveRoute = '{{$removeRoute}}';
    </script>
    <script src="{{config('custom.staticServerIntranet')}}/js/listRemoveData.js"></script>
@endsection
