<?php
/**
 * Created by PhpStorm.
 * User: konohanaruto
 * Date: 2017/4/23
 * Time: 18:30
 */
?>
@extends('frontend.layouts.default')
@section('title', '注册基本资料')
@section('addtional-css')
    <link rel="stylesheet" href="{{config('custom.staticServer')}}/css/common.css">
    <link rel="stylesheet" href="{{config('custom.staticServer')}}/css/register.css">
@endsection

@section('content')
    <header>
        <div class="top-nav">
            <div class="w">
                <div class="left-area">
                    <div class="logo">
                        <a href="#"></a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="content-box">
        <div class="w">
            <div class="signup-titlebox">
                <div class="sign-title">
                    <h2>欢迎来到网易旗下恋爱交友社区！</h2>
                    <h3>两步完成注册，开启寻爱之旅</h3>
                </div>
                <div class="sign-board">
                    <div class="sign-board-bar">
                        <div class="internal-box"></div>
                    </div>
                    <div class="sign-board-content">
                        <p><i>5,500,000</i> 位用户在花田等你</p>
                        <p><i>300,000</i> 位用户在花田找到对象</p>
                    </div>
                </div>
            </div>
            <div class="signup-menu clearfix">
                <div class="s-tab1 visited fl"><span>创建个人资料</span></div>
                <div class="s-tab2 fl"><span>上传照片，完成注册</span></div>
            </div>
            <div class="signup-form-content">
                <div class="upload-avatar-tips">
                    <p class="text-gray">支持jpg、gif、png格式，单张照片在10k-8M之间；正方形图片，250*250像素显示最佳。</p>
                </div>
                <div class="js-upload-avatar">
                    <div class="preview-img-box">
                        <div class="middle-img-avatar">
                            <img id="user-avatar">
                        </div>
                        <div class="insideloading">
                            <img class="loading-gif" src="{{config('custom.staticServer')}}/images/loading_info.gif">
                        </div>
                    </div>
                </div>
                <div class="img-upload-text">
                    <span class="open-selet-file upload-text active">上传</span>
                    <span class="open-selet-file re-upload-text">重新上传</span>
                </div>
                <form id="user_upload_avatar" method="post" action="" enctype="multipart/form-data">
                <div class="form-control">
                    {{csrf_field()}}
                    <input type="file" class="img-file-input hide" name="avatar">
                    <button class="register-step1-btn" type="submit" name="" value="">提交，完成</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('addtional-js')
    <script>
        var url = '{{url('User/uploadMemberAvatar')}}';
        $(function () {
    		$("#user_upload_avatar").on('submit', function(e){
        		e.preventDefault();
        		$.ajax({
            		url: url,
            		type: "POST",
            		data: new FormData(this),
            		contentType: false,
            		cache: false,
            		processData: false,
            		beforeSend: function () {
                		$('.insideloading').addClass('on');
                	},
            		success: function (data) {
            			$('.insideloading').removeClass('on');
            			if (data.msg) {
                			$('#user-avatar').attr('src', data.msg.src);
                			$('#user-avatar').attr('alt', data.msg.relationPath);
                		}
            			if ('status' in data) {
                			alert('上传失败, 请刷新页面后再试！');
                	    }
                	    // 切换提示
                	    $('.upload-text').removeClass('active');
                	    $('.re-upload-text').addClass('active');
            		},
            		error: function () {} 	        
        		});
    		});
        });
    </script>
@endsection
