<?php
/**
 * Created by PhpStorm.
 * User: konohanaruto
 * Date: 2017/3/25
 * Time: 19:39
 */
?>
@extends('frontend.layouts.default')
<!--标题-->
@section('title', '登录')
@section('addtional-css')
    <link rel="stylesheet" href="{{config('custom.staticServer')}}/css/login.css" />
@endsection
@section('content')
    <section id="top-login">
        <div class="w login-shadow">
            <div class="certification">
                <div class="login-logo"></div>
                <div class="login-frame">
                    <ul class="line-bar clearfix">
                        <li class="active">登录</li>
                        <li>注册</li>
                        <li>下载APP</li>
                    </ul>
                    <div class="content content-1">
                        <div class="left-form fl">
                            <p>网易邮箱可以直接登录开通</p>
                            <form>
                                <div class="login-input">
                                    <i class="user-icon"></i>
                                    <input type="text" name="username" placeholder="邮箱账号/邮箱地址/手机号"/>
                                    <i class="clear-text"></i>
                                </div>
                                <div class="login-input" style="margin-top:-1px;">
                                    <i class="pass-icon"></i>
                                    <input type="password" name="password" placeholder="6-16位密码，区分大小写"/>
                                </div>
                                <div class="err-dialog"><i></i><span>请输入密码</span></div>
                                <div>
                                    <input type="submit" class="submit-btn enable" value="登&nbsp;&nbsp;录"/>
                                </div>
                                <div class="remember">
                                    <input type="checkbox" name="remember" value="1">
                                    <div class="fl">
                                        <a href="#">十天免费登录</a> |
                                        <a href="#">免费登录</a>
                                    </div>

                                </div>
                            </form>
                        </div>
                        <div class="right-bar fr">
                            <div class="share-top">
                                其他帐号登录：
                            </div>
                            <div class="share-bot">
                                <div class="fl">
                                    <span>或</span>
                                </div>
                                <div class="fr">
                                    <a href="#"></a>
                                    <a href="#"></a>
                                    <a href="#"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="content content-2 hide">
                        <div class="left-form fl">
                            <p>网易邮箱可以直接登录开通<a class="fr" href="#">没有网易邮箱？开通>></a></p>
                            <form action="{{action('Frontend\BasicController@login')}}" method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="login-input">
                                    <i class="user-icon"></i>
                                    <input type="text" name="username" placeholder="邮箱账号/邮箱地址/手机号"/>
                                    <i class="clear-text"></i>
                                </div>
                                <div class="login-input" style="margin-top:-1px;">
                                    <i class="pass-icon"></i>
                                    <input type="password" name="password" placeholder="6-16位密码，区分大小写"/>
                                </div>
                                <div class="err-dialog @php if (! empty($errors->first())) echo 'active'; @endphp"><i></i>
                                    <span>
                                        @php
                                        if (! empty($errors->first())) {
                                            echo $errors->first();
                                        }
                                        @endphp
                                    </span>
                                </div>
                                <div>
                                    <input type="submit" class="submit-btn enable" value="登&nbsp;&nbsp;录"/>
                                </div>
                                <div class="remember">
                                    <input type="checkbox" name="remember" value="1">
                                    <div class="fl">
                                        <a href="#">十天免费登录</a> |
                                        <a href="#">免费登录</a>
                                    </div>

                                </div>
                            </form>
                        </div>
                        <div class="right-bar fr">
                            <div class="share-top">
                                其他帐号登录：
                            </div>
                            <div class="share-bot">
                                <div class="fl">
                                    <span>或</span>
                                </div>
                                <div class="fr">
                                    <a href="#"></a>
                                    <a href="#"></a>
                                    <a href="#"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="content content-3 hide">
                        <div class="down-app">
                            <div class="left-area fl">
                                <a href=""></a>
                                <a href=""></a>
                                <a href=""></a>
                            </div>
                            <div class="right-area fr"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="middle">
        <div class="w">
            <div class="top-new">
                <div class="top-ad">
                    <img src="{{config('custom.staticServer')}}/images/slogan_v140723.jpg" />
                    <p>已有 <b>19,000,000</b> 位单身男女在花田注册</p>
                    <h1>花田是什么？</h1>
                    <p>
                        网易花田是网易旗下的恋爱交友社区，在这里可以谈恋爱也可以交朋友。花田沟通免费，私信随便发，招呼随便打
                        注册花田需要身份认证，在这里交友特安全。也许你一个人生活也不错，说不定两个人一起更快活。
                    </p>
                </div>
            </div>
            <div class="banner1">
                <img src="{{config('custom.staticServer')}}/images/mac.png" alt="">
                <div class="left-iphone"></div>
            </div>
        </div>
    </section>
    <section id="user-portrait">
        <div class="w">
            <div class="top">
                <h1>不用寻找，推荐你喜欢的人给你<a href="#">查看我的推荐>></a></h1>
            </div>
        </div>
        <div class="content">
            <div class="line">
                <img src="{{config('custom.staticServer')}}/images/portrait/4.jpg" alt="">
                <img src="{{config('custom.staticServer')}}/images/portrait/4.jpg" alt="">
                <img src="{{config('custom.staticServer')}}/images/portrait/4.jpg" alt="">

                <img src="{{config('custom.staticServer')}}/images/portrait/4.jpg" alt="">
                <img src="{{config('custom.staticServer')}}/images/portrait/4.jpg" alt="">
                <img src="{{config('custom.staticServer')}}/images/portrait/4.jpg" alt="">

                <img src="{{config('custom.staticServer')}}/images/portrait/1.jpg" alt="">
                <img src="{{config('custom.staticServer')}}/images/portrait/1.jpg" alt="">
                <img src="{{config('custom.staticServer')}}/images/portrait/1.jpg" alt="">

                <img src="{{config('custom.staticServer')}}/images/portrait/1.jpg" alt="">
                <img src="{{config('custom.staticServer')}}/images/portrait/1.jpg" alt="">
                <img src="{{config('custom.staticServer')}}/images/portrait/1.jpg" alt="">

                <img src="{{config('custom.staticServer')}}/images/portrait/2.jpg" alt="">
                <img src="{{config('custom.staticServer')}}/images/portrait/2.jpg" alt="">
                <img src="{{config('custom.staticServer')}}/images/portrait/2.jpg" alt="">

                <img src="{{config('custom.staticServer')}}/images/portrait/2.jpg" alt="">
                <img src="{{config('custom.staticServer')}}/images/portrait/2.jpg" alt="">
                <img src="{{config('custom.staticServer')}}/images/portrait/2.jpg" alt="">

                <!--2 line img-->
                <img src="{{config('custom.staticServer')}}/images/portrait/4.jpg" alt="">
                <img src="{{config('custom.staticServer')}}/images/portrait/4.jpg" alt="">
                <img src="{{config('custom.staticServer')}}/images/portrait/4.jpg" alt="">

                <img src="{{config('custom.staticServer')}}/images/portrait/4.jpg" alt="">
                <img src="{{config('custom.staticServer')}}/images/portrait/4.jpg" alt="">
                <img src="{{config('custom.staticServer')}}/images/portrait/4.jpg" alt="">

                <img src="{{config('custom.staticServer')}}/images/portrait/1.jpg" alt="">
                <img src="{{config('custom.staticServer')}}/images/portrait/1.jpg" alt="">
                <img src="{{config('custom.staticServer')}}/images/portrait/1.jpg" alt="">

                <img src="{{config('custom.staticServer')}}/images/portrait/1.jpg" alt="">
                <img src="{{config('custom.staticServer')}}/images/portrait/1.jpg" alt="">
                <img src="{{config('custom.staticServer')}}/images/portrait/1.jpg" alt="">

                <img src="{{config('custom.staticServer')}}/images/portrait/2.jpg" alt="">
                <img src="{{config('custom.staticServer')}}/images/portrait/2.jpg" alt="">
                <img src="{{config('custom.staticServer')}}/images/portrait/2.jpg" alt="">

                <img src="{{config('custom.staticServer')}}/images/portrait/2.jpg" alt="">
                <img src="{{config('custom.staticServer')}}/images/portrait/2.jpg" alt="">
                <img src="{{config('custom.staticServer')}}/images/portrait/2.jpg" alt="">
            </div>
            <div class="left-area">
                <div data-index="0" class="arrows"></div>
                <div class="fff-shadow"></div>
            </div>
            <div class="right-area">
                <div data-index="0" class="arrows"></div>
                <div class="fff-shadow"></div>
            </div>
        </div>
    </section>
    <section id="down-info">
        <div class="w clearfix">
            <h1>随时随地 花田就在你身边</h1>
            <div class="left-area fl">
                <div class="d1"></div>
                <div class="d2"></div>
                <div class="d3"></div>
            </div>
            <div class="right-area fl">
                <h3>花田手机客户端</h3>
                <div class="d1"></div>
                <a href="#"></a>
                <a href="#"></a>
                <div class="qr">
                    <img src="{{config('custom.staticServer')}}/images/default.jpg" alt="">
                    <p>扫描二维码直接下载</p>
                </div>
            </div>
        </div>
    </section>

    <section id="float-login">
        <div class="w">
            <div class="left-area fl">
                已有 <i>19,000,000</i> 用户在花田等你
            </div>
            <div class="right-area fr">
                <a href="#"></a>
                <a href="#"></a>
                <a href="#"></a>
            </div>
        </div>
    </section>
@endsection

@section('addtional-js')
    <script type="text/javascript" src="{{config('custom.staticServer')}}/js/login.js"></script>
@endsection