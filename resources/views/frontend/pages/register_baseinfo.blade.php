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

                {{--<div class="current-account">--}}
                    {{--<span>当前账户：1039814413@qq.com</span>--}}
                    {{--<a href="#">切换账号</a>--}}
                {{--</div>--}}
                <form id="register_step_one" action="{{url('User/register')}}" method="post" name="register_step_one" enctype="multipart/form-data">
                <!-- 设置表单token -->
                {{csrf_field()}}
                <div class="form-control">
                    <span class="required-symbol">*</span>
                    <labal>昵 &nbsp; 称：</labal>
                    <input class="col-12"  type="text" id="username" name="username" value="" placeholder="限12个汉字和24个英文字母">
                    <span class="text-icon-tips ajaxload-icon hide"><img src="{{config('custom.staticServer')}}/images/refresh-20x20.gif"></span>
                    <span class="text-icon-tips text-icon-tips-correct">
                	    <em class="icon-correct-check"></em>
                    </span>
                    <span class="text-icon-tips text-icon-tips-incorrect">
                        <em class="icon-incorrect-check"></em>
                        <i class="text-error-tips"></i>
                    </span>
                </div>
                <div class="form-control">
                    <span class="required-symbol">*</span>
                    <labal>性 &nbsp; 别：</labal>
                    <span class="form-inline">
                        <input class="input-radio" type="radio" checked="checked" name="gender" value="1">男
                    </span>
                    <span class="form-inline">
                        <input class="input-radio" type="radio" name="gender" value="2">女
                    </span>
                    <span class="text-icon-tips text-icon-tips-correct">
                	    <em class="icon-correct-check"></em>
                    </span>
                    <span class="text-icon-tips text-icon-tips-incorrect">
                        <em class="icon-incorrect-check"></em>
                        <i class="text-error-tips"></i>
                    </span>
                </div>
                <div class="form-control">
                    <span class="required-symbol">*</span>
                    <labal>生 &nbsp; 日：</labal>
                    <span class="form-inline">
                        <select class="birth" name="birthyear" id="birthyear">
                            <option disabled selected value="">年</option>
                            @foreach ($selectData['birth']['year'] as $year)
                                <option value="{{$year}}">{{$year}}</option>
                            @endforeach
                        </select>
                    </span>
                    <span class="form-inline">
                        <select class="birth" name="birthmonth" id="birthmonth">
                            <option disabled selected value="">月</option>
                            @foreach ($selectData['birth']['month'] as $month)
                                <option value="{{$month}}">{{$month}}</option>
                            @endforeach
                        </select>
                    </span>
                    <span class="form-inline">
                        <select class="birth"  name="birthday" id="birthday">
                            <option disabled selected value="">日</option>
                            @for ($i = 1; $i <= $selectData['birth']['day']; $i++)
                                <option value="{{$i}}">{{$i}}</option>
                            @endfor
                        </select>
                    </span>
                    <span class="text-icon-tips text-icon-tips-correct">
                	    <em class="icon-correct-check"></em>
                    </span>
                    <span class="text-icon-tips text-icon-tips-incorrect">
                        <em class="icon-incorrect-check"></em>
                        <i class="text-error-tips"></i>
                    </span>
                </div>
                <div class="form-control">
                    <span class="required-symbol">*</span>
                    <labal>身 &nbsp; 高：</labal>
                    <span class="form-inline">
                        <select class="select-row col-12" name="height" id="height">
                            <option disabled selected value="">请选择</option>
                            @foreach ($selectData['height'] as $height)
                            <option value="{{$height}}">{{$height}}</option>
                            @endforeach
                        </select>
                    </span>
                    <span class="text-icon-tips text-icon-tips-correct">
                	    <em class="icon-correct-check"></em>
                    </span>
                    <span class="text-icon-tips text-icon-tips-incorrect">
                        <em class="icon-incorrect-check"></em>
                        <i class="text-error-tips"></i>
                    </span>
                </div>
                <div class="form-control">
                    <span class="required-symbol">*</span>
                    <labal>学 &nbsp; 历：</labal>
                    <span class="form-inline">
                        <select class="select-row col-12" name="education" id="education">
                            <option disabled selected value="">请选择</option>
                            @foreach ($selectData['education'] as $education)
                                <option value="{{$education}}">{{$education}}</option>
                            @endforeach
                        </select>
                    </span>
                    <span class="text-icon-tips text-icon-tips-correct">
                	    <em class="icon-correct-check"></em>
                    </span>
                    <span class="text-icon-tips text-icon-tips-incorrect">
                        <em class="icon-incorrect-check"></em>
                        <i class="text-error-tips"></i>
                    </span>
                </div>
                <div class="form-control">
                    <span class="required-symbol">*</span>
                    <labal>居 住 地：</labal>
                    <span class="form-inline">
                        <select class="reside-area col-6" name="resideprovince" id="resideprovince">
                            <option disabled selected value="">请选择</option>
                            @foreach ($selectData['location']['province'] as $key => $item)
                                <option @if($key == $selectData['location']['currentprovincecode']) selected @endif value="{{$key}}">{{$item}}</option>
                            @endforeach
                        </select>
                    </span>
                    <span class="form-inline">
                        <select class="reside-area col-6" name="residecity" id="residecity">
                            <option disabled selected value="">请选择</option>
                            @foreach ($selectData['location']['city'] as $key => $item)
                                <option @if($key == $selectData['location']['currentcitycode']) selected @endif value="{{$key}}">{{$item}}</option>
                            @endforeach
                        </select>
                    </span>
                    <span class="text-icon-tips text-icon-tips-correct">
                	    <em class="icon-correct-check"></em>
                    </span>
                    <span class="text-icon-tips text-icon-tips-incorrect">
                        <em class="icon-incorrect-check"></em>
                        <i class="text-error-tips"></i>
                    </span>
                </div>
                <div class="form-control">
                    <span class="required-symbol">*</span>
                    <labal>月均收入：</labal>
                    <span class="form-inline">
                        <select class="select-row" name="revenue" id="revenue">
                            <option disabled selected value="">请选择</option>
                            @foreach ($selectData['revenue'] as $revenue)
                                <option value="{{$revenue}}">{{$revenue}}</option>
                            @endforeach
                        </select>
                    </span>
                    <span class="text-icon-tips text-icon-tips-correct">
                	    <em class="icon-correct-check"></em>
                    </span>
                    <span class="text-icon-tips text-icon-tips-incorrect">
                        <em class="icon-incorrect-check"></em>
                        <i class="text-error-tips"></i>
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
                        <option>中国大陆+86</option>
                    </select>
                </span>
                <span class="form-inline">
                    <input class="height-common col-7"   name="mobile" id="mobile" placeholder="请输入手机号">
                    <span class="text-icon-tips text-icon-tips-correct">
                	    <em class="icon-correct-check"></em>
                    </span>
                    <span class="text-icon-tips text-icon-tips-incorrect">
                        <em class="icon-incorrect-check"></em>
                        <i class="text-error-tips"></i>
                    </span>
                </span>
                </div>
<!--
                <div class="form-control">
                    <span class="required-symbol">*</span>
                    <labal>验 证 码：</labal>
                    <span class="form-inline">
                        <input class="height-common col-7" name="mobile_verify_code" placeholder="请输入验证码">
                        <span class=""><button type="button" class="verify-code-btn disabled" name="" value="">获取验证码</button></span>
                    </span>
                </div>
-->
                <div class="form-control">
                <span class="form-inline font-11">
                    <input class="agree-checkbox" name="license" id="license" checked="checked" value="1" type="checkbox"><i>我同意花田交友服务条款</i>
                </span>
                </div>

                <div class="form-control">
                    <button class="register-step1-btn" type="submit" name="" value="">下一步</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('addtional-js')
    <script>
        var checkUserUrl = '{{url('User/checkExists')}}';
        var csrfToken = '{{csrf_token()}}';
        var getDaysUrl = '{{url('tools/totalDays')}}';
        var getCitiesUrl = '{{url('tools/cityList')}}';
    </script>
    <script src="{{config('custom.staticServer')}}/js/register-validation.js"></script>
@endsection