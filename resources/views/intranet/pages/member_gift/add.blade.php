<?php
/**
 * Created by PhpStorm.
 * File: add.blade.php
 * User: konohanaruto
 * Blog: http://www.muyesanren.com
 * QQ: 1039814413
 * Wechat Number: wikitest
 * Date: 11/5/2017
 * Time: 5:22 PM
 */
?>

@extends('intranet.layouts.intranet_iframe_style')
@section('page-main')
{{--避免原模版报错--}}
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
            <h2>系统礼物设置</h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a href="{{url('intranet/MemberGift/list')}}"><button type="button" class="btn btn-default btn-sm">{{trans('buttons.view_list')}}</button></a></li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <br>
            <form id="gift-add-form" action="{{url('intranet/MemberGift/store')}}" method="post" class="form-horizontal form-label-left  gift-image-upload-form">
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">{{trans('label_fields.gift_name')}} <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="gift_name" name="gift_name" class="form-control col-md-7 col-xs-12">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">{{trans('label_fields.htb')}} <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="htb" name="htb" class="form-control col-md-7 col-xs-12">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">{{trans('label_fields.only_vip')}}
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12" style="margin-top:5px;">
                        <input type="radio" id="is-vip-true" name="is_vip" value="1" checked>
                        <span style="margin-right: 10px;">{{trans('status.yes')}}</span>
                        <input type="radio" id="is-vip-false" name="is_vip" value="0">
                        <span>{{trans('status.no')}}</span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">{{trans('label_fields.is_valid')}}
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12" style="margin-top:5px;">
                        <input type="radio" name="is_valid" value="1" checked>
                        <span style="margin-right: 10px;">{{trans('status.yes')}}</span>
                        <input type="radio" name="is_valid" value="0">
                        <span>{{trans('status.no')}}</span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">{{trans('label_fields.gift_picture')}} <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12" style="margin-top:5px;">
                        <button type="button" class="js-gift-file-select btn btn-primary btn-xs">{{trans('buttons.click_to_upload')}}</button>
                    </div>
                </div>

                {{--图片预览区域--}}
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">{{trans('common.preview')}} <span class="required"> </span></label>
                    <div class="col-md-6 col-sm-6 col-xs-12 gift-upload-panel" style="margin-top:5px;">
                        <div class="gift-image-preview">
                            <div class="shadow-box">
                                <div class="loading hide">
                                    <img src="{{config('custom.staticServerIntranet')}}/build/images/loading_info.gif" alt="">
                                </div>
                            </div>
                            <div class="image-main-box">
                                {{--<img class="" width="300px" src="http://p0bvwqt56.bkt.clouddn.com/Users/Avatar/Temp/2017-12-04/5a25022427ed3.jpg?e=1512378421&token=O71dPyXqTw17ZdSQ4nUpf9rK2cltu67bLNJLwuAE:4JLuuvxxgKV7f8olCql7Ka1dU0Y=">--}}
                                <img class="hide" width="300px" src="">
                            </div>
                        </div>
                        <div class="small-preview"></div>
                    </div>
                </div>

                <div class="form-group" style="margin-top: 20px;">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        {{csrf_field()}}
                        <input type="hidden" name="gift_image_info" value="">
                        <button type="submit" class="btn btn-success">{{trans('buttons.submit')}}</button>
                        <button class="btn btn-primary" type="reset" onclick="window.location.href=window.location.href;">{{trans('buttons.reset')}}</button>
                    </div>
                </div>
            </form>
            {{--ajax图片上传表单--}}
            <form class="js-ajax-file-upload-form" data-url="{{url('intranet/MemberGift/uploadGiftThumb')}}">
                {{csrf_field()}}
                <input class="js-gift-thumb-upload" type="file" name="gift_thumb" style="display: none;">
                <button class="hide ajax-upload-avatar-btn"></button>
            </form>
        </div>
</div>
@endsection

@section('extra-js')
    <script type="text/javascript" charset="utf-8">
        var inputFileObject = $('input[name="gift_thumb"]');
        inputFileObject.on('change', function () {
            if ($(this).val()) {
                $(this).parent('.js-ajax-file-upload-form').trigger('submit');
            }
        });

        $( "#signupForm1" ).validate( {
            rules: {
                firstname1: "required",
                lastname1: "required",
                username1: {
                    required: true,
                    minlength: 2
                },
                password1: {
                    required: true,
                    minlength: 5
                },
                confirm_password1: {
                    required: true,
                    minlength: 5,
                    equalTo: "#password1"
                },
                email1: {
                    required: true,
                    email: true
                },
                agree1: "required"
            },
            messages: {
                firstname1: "Please enter your firstname",
                lastname1: "Please enter your lastname",
                username1: {
                    required: "Please enter a username",
                    minlength: "Your username must consist of at least 2 characters"
                },
                password1: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 5 characters long"
                },
                confirm_password1: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 5 characters long",
                    equalTo: "Please enter the same password as above"
                },
                email1: "Please enter a valid email address",
                agree1: "Please accept our policy"
            },
            errorElement: "em",
            errorPlacement: function ( error, element ) {
                // Add the `help-block` class to the error element
                error.addClass( "help-block" );

                // Add `has-feedback` class to the parent div.form-group
                // in order to add icons to inputs
                element.parents( ".col-sm-5" ).addClass( "has-feedback" );

                if ( element.prop( "type" ) === "checkbox" ) {
                    error.insertAfter( element.parent( "label" ) );
                } else {
                    error.insertAfter( element );
                }

                // Add the span element, if doesn't exists, and apply the icon classes to it.
                if ( !element.next( "span" )[ 0 ] ) {
                    $( "<span class='glyphicon glyphicon-remove form-control-feedback'></span>" ).insertAfter( element );
                }
            },
            success: function ( label, element ) {
                // Add the span element, if doesn't exists, and apply the icon classes to it.
                if ( !$( element ).next( "span" )[ 0 ] ) {
                    $( "<span class='glyphicon glyphicon-ok form-control-feedback'></span>" ).insertAfter( $( element ) );
                }
            },
            highlight: function ( element, errorClass, validClass ) {
                $( element ).parents( ".col-sm-5" ).addClass( "has-error" ).removeClass( "has-success" );
                $( element ).next( "span" ).addClass( "glyphicon-remove" ).removeClass( "glyphicon-ok" );
            },
            unhighlight: function ( element, errorClass, validClass ) {
                $( element ).parents( ".col-sm-5" ).addClass( "has-success" ).removeClass( "has-error" );
                $( element ).next( "span" ).addClass( "glyphicon-ok" ).removeClass( "glyphicon-remove" );
            }
        } );

    </script>
@endsection