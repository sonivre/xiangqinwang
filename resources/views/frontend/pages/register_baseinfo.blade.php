<?php
/**
 * Created by PhpStorm.
 * User: konohanaruto
 * Date: 2017/3/28
 * Time: 20:34
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
                <div class="current-account">
                    <span>当前账户：1039814413@qq.com</span>
                    <a href="#">切换账号</a>
                </div>
                <div class="form-control">
                    <span class="required-symbol">*</span>
                    <labal>昵 &nbsp; 称：</labal>
                    <input class="col-12" type="text" name="" placeholder="限12个汉字和24个英文字母">
                </div>
                <div class="form-control">
                    <span class="required-symbol">*</span>
                    <labal>性 &nbsp; 别：</labal>
                <span class="form-inline">
                    <input class="input-radio" type="radio" name="sex">男
                </span>
                <span class="form-inline">
                    <input class="input-radio" type="radio" name="sex">女
                </span>
                </div>
                <div class="form-control">
                    <span class="required-symbol">*</span>
                    <labal>生 &nbsp; 日：</labal>
                <span class="form-inline">
                    <select class="birth" required>
                        <option disabled selected value="">年</option>
                        <option value="">1994</option>
                        <option value="">1995</option>
                    </select>
                </span>
                <span class="form-inline">
                    <select class="birth" required>
                        <option disabled selected value="">月</option>
                        <option value="">12</option>
                    </select>
                </span>
                <span class="form-inline">
                    <select class="birth" required>
                        <option disabled selected value="">日</option>
                        <option value="">30</option>
                    </select>
                </span>
                </div>
                <div class="form-control">
                    <span class="required-symbol">*</span>
                    <labal>身 &nbsp; 高：</labal>
                <span class="form-inline">
                    <select class="select-row col-12" required>
                        <option disabled selected value="">请选择</option>
                        <option value="">167</option>
                        <option value="">168</option>
                    </select>
                </span>
                </div>
                <div class="form-control">
                    <span class="required-symbol">*</span>
                    <labal>学 &nbsp; 历：</labal>
                <span class="form-inline">
                    <select class="select-row col-12" required>
                        <option disabled selected value="">请选择</option>
                        <option value="">大学</option>
                        <option value="">小学</option>
                    </select>
                </span>
                </div>
                <div class="form-control">
                    <span class="required-symbol">*</span>
                    <labal>居 住 地：</labal>
                <span class="form-inline">
                    <select class="col-6" required>
                        <option disabled selected value="">请选择</option>
                        <option value="">湖北</option>
                        <option value="">湖南</option>
                    </select>
                </span>
                <span class="form-inline">
                    <select class="col-6" required>
                        <option disabled selected value="">请选择</option>
                        <option value="">武汉</option>
                        <option value="">长沙</option>
                    </select>
                </span>
                </div>
                <div class="form-control">
                    <span class="required-symbol">*</span>
                    <labal>月均收入：</labal>
                <span class="form-inline">
                    <select class="select-row" required>
                        <option disabled selected value="">请选择</option>
                        <option value="">6000</option>
                        <option value="">7000</option>
                    </select>
                </span>
                </div>
                <div class="verify-tips">
                    <p>
                        <span class="tips-text">手机认证，多一份安全与信赖</span>
                    </p>
                </div>

                <div class="form-control">
                    <span class="required-symbol">*</span>
                    <labal>手 机 号：</labal>
                <span class="form-inline ">
                    <select class="height-common col-5">
                        <option value="">中国大陆+86</option>
                        <option value="">湖北</option>
                        <option value="">湖南</option>
                    </select>
                </span>
                <span class="form-inline">
                    <input class="height-common col-7" name="" placeholder="请输入手机号">
                </span>
                </div>

                <div class="form-control">
                    <span class="required-symbol">*</span>
                    <labal>验 证 码：</labal>
                <span class="form-inline">
                    <input class="height-common col-7" name="" placeholder="请输入验证码">
                    <span class=""><button type="button" class="verify-code-btn disabled" name="" value="">获取验证码</button></span>
                </span>
                </div>

                <div class="form-control">
                <span class="form-inline font-11">
                    <input class="agree-checkbox" name="" type="checkbox"><i>我同意花田交友服务条款</i>
                </span>
                </div>

                <div class="form-control">
                    <button class="register-step1-btn" type="submit" name="" value="">下一步</button>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('addtional-js')
    <script type="text/javascript" src="{{config('custom.staticServer')}}/js/common.js"></script>
    <script>
        $(function () {

        })
    </script>
@endsection