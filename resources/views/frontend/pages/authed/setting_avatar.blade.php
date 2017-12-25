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
                    </div>
                    <div class="preview-box-bg" style="border: 1px solid red"></div>
                    <div class="preview-box-sm" style="border: 1px solid red"></div>
                </div>
                <div class="form-trigger">
                    <a class="red-button submit-red-button disabled" href="#">提交，完成</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('additional-js')
    <script>
        $(function () {
        });
    </script>
@endsection