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
                <form id="register_step_one" action="{{url('register_step_one')}}" method="post" name="register_step_one" enctype="multipart/form-data">
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
                        </select>
                    </span>
                    <span class="form-inline">
                        <select class="birth" name="birthmonth" id="birthmonth">
                            <option disabled selected value="">月</option>
                        </select>
                    </span>
                    <span class="form-inline">
                        <select class="birth"  name="birthday" id="birthday">
                            <option disabled selected value="">日</option>
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
                        </select>
                    </span>
                    <span class="form-inline">
                        <select class="reside-area col-6" name="residecity" id="residecity">
                            <option disabled selected value="">请选择</option>
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
    {{--<script src="{{config('custom.staticServer')}}/js/register-validation.js"></script>--}}
    <script>
        $(function () {
            var validation = {};
            validation.usernameCheck = false;
            validation.mobileCheck = false;
            validation.birthCheck = false;
            validation.genderCheck = false;
            validation.heightCheck = false;
            validation.educationCheck = false;
            validation.resideCheck = false;
            validation.revenueCheck = false;
            // 监控username
            var usernameInputObject = $("input[name=username]");
            var oldUsername = usernameInputObject.val();
            var usernameExistsText = "用户名已存在";
            usernameInputObject.on({
                blur: function () {
                    var username = $(this).val();
                    // 判断是否已经存在错误的消息框, 防止ajax验证频繁请求服务器
                    var errorText = $(this).parents('.form-control').find('.text-error-tips').html();
                    if (errorText == usernameExistsText && oldUsername == username) {
                        return;
                    }

                    // 验证是否为空
                    if (! isEmpty(username)) {
                        validation.usernameCheck = true;
                        removeError($(this));
                    } else {
                        validation.usernameCheck = false;
                        attachError($(this), '用户名不能为空');
                    }

                    if (validation.usernameCheck) {
                        if (! checkUsernameLength(username, 4, 24)) {
                            validation.usernameCheck = false;
                            attachError($(this), '用户名长度必须在2-12个字之间');
                        } else {
                            validation.usernameCheck = true;
                            removeError($(this));
                        }
                    }
                    // 不为空验证是否存在
                    if (validation.usernameCheck) {
                        oldUsername = username;
                        $(this).parents('.form-control').find('.text-icon-tips-correct').removeClass('on');
                        $(".ajaxload-icon").removeClass('hide');
                        $.ajax({
                            context: $(this),
                            type: "POST",
                            url: "{{url('User/checkExists')}}",
                            data: "username=" + username + "&_token=" + "{{csrf_token()}}",
                            success: function (response) {
                                // 移除加载效果
                                $(".ajaxload-icon").addClass('hide');

                                if (response.valid == false) {
                                    $(this).focus();
                                    attachError($(this), usernameExistsText);
                                    validation.usernameCheck = false;
                                } else {
                                    removeError($(this));
                                    validation.usernameCheck = true;
                                }
                            }
                        });

                    }

                }
            });

            // 性别

            //生日验证
            $('.birth').on('change', function () {
                if (! checkSelectChecked($('.birth'))) {
                    validation.birthCheck = false;
                    attachError($(this), '请选择您的生日');
                } else {
                    validation.birthCheck = true;
                    removeError($(this));
                }
            });

            // 身高
            $("select[name=height]").on('change', function () {
                if (! checkSelectChecked($(this))) {
                    validation.heightCheck = false;
                    attachError($(this), '请选择您的身高');
                } else {
                    validation.heightCheck = true;
                    removeError($(this));
                }
            });

            // 学历
            $("select[name=education]").on('change', function () {
                if (! checkSelectChecked($(this))) {
                    validation.educationCheck = false;
                    attachError($(this), '请选择您的学历');
                } else {
                    validation.educationCheck = true;
                    removeError($(this));
                }
            });

            // 验证居住地
            $(".reside-area").on('change', function () {
                if (! checkSelectChecked($(this))) {
                    validation.resideCheck = false;
                    attachError($(this), '请选择您的居住地');
                } else {
                    validation.resideCheck = true;
                    removeError($(this));
                }
            });

            // 验证月收入
            $("select[name=revenue]").on('change', function () {
                if (! checkSelectChecked($(this))) {
                    validation.revenueCheck = false;
                    attachError($(this), '请选择您的月收入');
                } else {
                    validation.revenueCheck = true;
                    removeError($(this));
                }
            });

            // 手机号的验证
            $("input[name=mobile]").on('blur', function () {
                // 验证是否为空
                var mobile = $.trim($(this).val());
                if (! isEmpty(mobile)) {
                    validation.mobileCheck = true;
                    removeError($(this));
                } else {
                    validation.mobileCheck = false;
                    attachError($(this), '手机号不能为空');
                }

                // 验证手机号格式
                if (validation.mobileCheck == true) {
                    var regExp = /^1(3|4|5|7|8)\d{9}$/;
                    if (mobile.length != 11 && ! regExp.test(mobile)) {
                        validation.mobileCheck = false;
                        attachError($(this), '手机号格式不正确');
                    }
                }
            });

            // 提交事件
            $('#register_step_one').on('submit', function (event) {
                // 触发事件
                validation.genderCheck = false;
                $("input[name=username]").trigger('blur');
                if (checkRadioChecked($("input[name=gender]"))) {
                    validation.genderCheck = true;
                }
                $(".birth").trigger('change');
                $("select[name=height]").trigger('change');
                $("select[name=education]").trigger('change');
                $(".reside-area").trigger('change');
                $("select[name=revenue]").trigger('change');
                $("input[name=mobile]").trigger('blur');

                for (var i in validation) {
                    if (validation[i] == false) {
                        event.preventDefault();
                    }
                }

            });
        });

        function attachError(currentElementObject, content, border)
        {
            if (border) {
                currentElementObject.addClass('invalid-border');
            }
            currentElementObject.parents('.form-control').find('.text-icon-tips-incorrect').addClass('on');
            currentElementObject.parents('.form-control').find('.text-icon-tips-correct').removeClass('on');
            currentElementObject.parents('.form-control').find('.text-error-tips').html(content);
        }

        function removeError(currentElementObject, border)
        {
            if (border) {
                currentElementObject.removeClass('invalid-border');
            }
            currentElementObject.parents('.form-control').find('.text-icon-tips-correct').addClass('on');
            currentElementObject.parents('.form-control').find('.text-icon-tips-incorrect').removeClass('on');
        }

        // 验证radio是否有被选中的
        function checkRadioChecked(queryObjects)
        {
            var status = false;
            queryObjects.each(function (i, n) {
                if ($(n).is(':checked')) {
                    status = true;
                }
            });
            return status;
        }

        // 验证select是否存在被选中的
        function checkSelectChecked(queryObjects)
        {
            var status = true;
            queryObjects.each(function (i, n) {
                var value = $.trim($(n).val());
                if (! value) {
                    status = false;
                }
            });
            return status;
        }

    </script>
@endsection