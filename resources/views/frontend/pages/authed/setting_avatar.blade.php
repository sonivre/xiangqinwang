<?php
/**
 * Created by PhpStorm.
 * File: setting_avatar.blade.php
 * User: konohanaruto
 * Blog: http://www.muyesanren.com
 * QQ: 1039814413
 * Wechat Number: wikitest
 * Date: 12/24/2017
 * Time: 10:08 PM
 */
?>

@extends('frontend.layouts.authed.default')

{{--title--}}
@section('title', '上传头像')

@section('basic-static-resource')
    @parent
    <link rel="stylesheet" href="{{config('custom.staticServer')}}/css/avatar-update.css">
    <style>
        .upload-loading-img-box {
            position: relative;
            width: 375px;
            height: 375px;
            background-color: #fff;
            border: 1px solid #e7e7e7;
            z-index: 3;
        }
        
        .preview {
            overflow: hidden;
        }

        .upload-loading-img-box img {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 48px;
            height: 48px;
        }

        .avatar-preview-box {
            width: 375px;
            height: 375px;
            position: absolute;
            top: 0;
            left: 0;
            overflow: hidden;
        }

        .avatar-preview-box img {
            width: 100%;
        }

        .reset-box {
            margin-top: 10px;
            width: 375px;
        }

        .reset-box a {
            margin: 0 auto;
            display: block;
            color: #4D97EF;
            font-size: 12px;
            text-align: center;
        }
    </style>
@endsection

@section('content')
<section id="middle">
    <div class="w">
        <div class="contentbox-inner">
            <div class="title-bar">
                <h2>修改头像</h2>
            </div>
            <div class="setting-box">
                <div class="upload-avatar-tips">
                    <dl class="text-gray">
                        <dt>请上传清晰美观的个人近照，给别人留下美好的第一印象。</dt>
                        <dd>支持jpg、gif、png格式，单张照片在10k-8M之间；<span class="upload-avatar-common-tips">正方形图片，250*250像素显示最佳。</span></dd>
                    </dl>
                </div>
                <div class="avatar-update">
                    <div class="update-js-avatar">
                        <div class="add-avatar-file">
                            <em class="add-file-icon"></em>
                            <p class="select-file-tips">从电脑选取照片</p>
                            <p class="file-size-tips">大小在10K-8M之间</p>
                        </div>
                        {{--正在加载图片...--}}
                        <div class="upload-loading-img-box hide">
                            <img src="{{config('custom.staticServer')}}/images/loading_info.gif" alt="">
                        </div>
                        <div class="avatar-preview-box hide">
                            <img src="">
                        </div>
                    </div>
                    <div class="preview preview-box-bg">
                        <img src="{{$userInfo['thumb_avatar']}}" width="140px">
                    </div>
                    <div class="preview preview-box-sm">
                        <img src="{{$userInfo['thumb_avatar']}}" width="70px">
                    </div>
                </div>
                {{--重新添加--}}
                <div class="reset-box hide">
                    <a class="js-reset-avatar" href="javascript:;">重新添加</a>
                </div>
                <form class="avatar-image-upload-form" action="{{url('setting/face/updateRequest')}}" method="POST">
                <div class="form-trigger">
                    {{csrf_field()}}
                    <input type="hidden" name="avatar_image_info" value="">
                    <a class="red-button submit-red-button disabled" href="javascript:;">提交，完成</a>
                </div>
                </form>

                <form class="js-ajax-file-upload-form" data-url="{{url('setting/face/upload')}}">
                    {{csrf_field()}}
                    <input class="avatar-file-input" name="avatar_file" type="file" style="display: none;">
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
@section('additional-js')
    <script>
        $(function () {
            $('.add-avatar-file').on('click', function () {
                $('.avatar-file-input').trigger('click');
            });

            $('.js-reset-avatar').on('click', function () {
                $('.avatar-file-input').trigger('click');
            });

            $('.avatar-image-upload-form .submit-red-button').on('click', function () {
                $('.avatar-image-upload-form').submit();
            });

            var avatarFileInput = $('.avatar-file-input');
            // 判断如果选择了文件，则上传头像
            avatarFileInput.on('change', function () {
                if ($(this).val()) {
                    $(this).parents('form').trigger('submit');
                }

                //显示提交按钮
                $('.avatar-image-upload-form .submit-red-button').removeClass('disabled');
            });

            // 通用的ajax图片上传表单
            $(".js-ajax-file-upload-form").on('submit', function(e){
                var url = $(this).data('url');
                var addFileToolBar = $('.add-avatar-file');
                var shadowBox = $('.upload-loading-img-box');
                var imagePreviewObject = $('.avatar-preview-box');
                e.preventDefault();
                $.ajax({
                    url: url,
                    type: "POST",
                    headers: {
                        accept : "application/json; charset=utf-8"
                    },
                    // 参数很重要
                    contentType: false,
                    cache: false,
                    // 参数很重要, 如果不设置成false, 他会将你的formData数据转变成一个string
                    processData: false,
                    data: new FormData(this),
                    beforeSend: function () {
                        //addFileToolBar.addClass('hide');
                        shadowBox.removeClass('hide');
                        imagePreviewObject.addClass('hide');
                    },
                    success: function (data) {
                        //console.log(data);
                        //{"status":200,"img_url":"uploads/frontend/avatars/1/2017-12-27/5a43891076a09.jpg"}
                        var response = JSON.parse(data);

                        // 显示重新上传
                        $('.reset-box').removeClass('hide');
                        addFileToolBar.addClass('hide');

                        if (response.status == -200) {
                            shadowBox.addClass('hide');
                            if (! imagePreviewObject.children('img').attr('src')) {
                                addFileToolBar.removeClass('hide');
                            } else {
                                imagePreviewObject.removeClass('hide');
                            }

                            alert("上传失败，请稍后再试！\n\n");
                        } else {
                            // 先作废之前的crop box区域
                            $('.avatar-preview-box img').cropper('destroy');
                            // 用于保存图片的地址，裁剪尺寸等信息
                            var imageInfo = {};
                            var imageCropInputObject = $('.avatar-image-upload-form input[name="avatar_image_info"]');
                            //imagePreviewObject.attr('src', response.img_url);
                            imagePreviewObject.fadeOut(1500, function() {
                                imagePreviewObject.children('img').attr('src', response.img_host + '/' + response.img_url);
                                imagePreviewObject.removeClass('hide').fadeIn(1500);
                            });

                            imageInfo.img_url = response.img_url;
                            imageInfo.img_host = response.img_host;

                            imagePreviewObject.removeClass('hide');
                            shadowBox.addClass('hide');
                            addFileToolBar.addClass('hide');

                            // 裁剪区域显示
                            var boxSizeConfig = {width: 314, height: 314};
                            $('.avatar-preview-box img').cropper({
                                aspectRatio: 1,
                                preview: '.preview',
                                viewMode: 1,
                                toggleDragModeOnDblclick: false,
                                responsive: false,
                                data: boxSizeConfig,
                                cropBoxResizable: false,
                                zoomOnWheel: false,
                                crop: function (e) {
                                    imageInfo.cropWidth = Math.round(e.width);
                                    imageInfo.cropHeight = Math.round(e.height);
                                    imageInfo.cropX = Math.round(e.x);
                                    imageInfo.cropY = Math.round(e.y);
                                    imageCropInputObject.val(JSON.stringify(imageInfo));
                                },
                                // 下面两个事件固定了crop box的大小，哪怕是重新选择的crop区域
                                cropstart: function () {
                                    $(this).cropper('setData', boxSizeConfig);
                                },
                                cropend: function () {
                                    $(this).cropper('setData', boxSizeConfig);
                                },
                                // 裁剪框的move事件
                                cropmove: function () {
                                    var info = $(this).cropper('getData');
                                    imageInfo.cropWidth = Math.round(info.width);
                                    imageInfo.cropHeight = Math.round(info.height);
                                    imageInfo.cropX = Math.round(info.x);
                                    imageInfo.cropY = Math.round(info.y);

                                    imageCropInputObject.val(JSON.stringify(imageInfo));
                                }
                            });
                        }
                    },
                    error: function (request, status, error) {
                        //console.log(request.responseText);
                        var response = JSON.parse(request.responseText);
                        var errorContent = "上传错误：\n\n";

                        if (request.responseText) {
                            for (var item in response) {
                                for (var subItem in response[item]) {
                                    errorContent += response[item][subItem] + "\n";
                                    //console.log(response[item][subItem]);
                                }
                            }
                        }

                        shadowBox.addClass('hide');

                        // 如果之前上传过图片，则显示之前的
                        if (imagePreviewObject.children('img').attr('src')) {
                            imagePreviewObject.removeClass('hide');
                        }

                        alert(errorContent);
                    }
                });
            });
        });
    </script>
@endsection