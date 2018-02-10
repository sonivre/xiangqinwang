<?php
/**
 * Created by PhpStorm.
 * User: konohanaruto
 * Blog: http://www.muyesanren.com
 * QQ: 1039814413
 * Wechat Number: wikitest
 * Date: 2017/10/16
 * Time: 20:18
 */
?>
@extends('frontend.layouts.authed.default')

{{--title--}}
@section('title', '首页')

@section('basic-static-resource')
    @parent
    <link rel="stylesheet" href="{{config('custom.staticServer')}}/css/index.css">
    <link rel="stylesheet" href="{{config('custom.staticServer')}}/css/common.css">
    <script src="{{config('custom.staticServer')}}/js/common.js"></script>
    <style>
        .publish-trend-modal .photo-group > li .process-bar {
            position: absolute;
            left: 0;
            bottom: 0;
            width: 0;
            height: 22px;
            background-color: #68B229;
        }
    </style>
@endsection
{{--content--}}
@section('content')
@inject('UserPresenter', '\App\Konohanaruto\Presenters\Frontend\UserPresenter')
<section id="top-logo">
    <div class="w clearfix">
        <div class="left-area fl">
            <a href="#"></a>
        </div>
        <div class="right-area fr">
            <ul>
                <li><a href="#"><img class="sm-img" src="{{config('custom.staticServer')}}/images/home-portrait/2.jpg" alt=""><em class="sm-svip"></em><dl><dt>星空</dt><dd>湖南长沙</dd></dl></a></li>
                <li><a href="#"><img class="sm-img" src="{{config('custom.staticServer')}}/images/home-portrait/2.jpg" alt=""><em class="sm-vip"></em><dl><dt>星空</dt><dd>湖南长沙</dd></dl></a></li>
                <li><a href="#"><img class="sm-img" src="{{config('custom.staticServer')}}/images/home-portrait/2.jpg" alt=""><em class="sm-vip"></em><span></span></a></li>
                <li><a href="#"><img class="sm-img" src="{{config('custom.staticServer')}}/images/home-portrait/2.jpg" alt=""><em class="sm-vip"></em><span></span></a></li>
                <li><a href="#"><img class="sm-img" src="{{config('custom.staticServer')}}/images/home-portrait/2.jpg" alt=""><em class="sm-svip"></em><span></span></a></li>
                <li><a href="#"><img class="sm-img" src="{{config('custom.staticServer')}}/images/home-portrait/2.jpg" alt=""><em class="sm-vip"></em><span></span></a></li>
                <li><a href="#"><img class="sm-img" src="{{config('custom.staticServer')}}/images/home-portrait/2.jpg" alt=""><em class="sm-vip"></em><span></span></a></li>
                <li><a href="#"><img class="sm-img" src="{{config('custom.staticServer')}}/images/home-portrait/2.jpg" alt=""><em class="sm-svip"></em><span></span></a></li>
                <li><a href="#"><img class="sm-img" src="{{config('custom.staticServer')}}/images/home-portrait/2.jpg" alt=""><em class="sm-vip"></em><span></span></a></li>
                <li><a href="#"><img class="sm-img" src="{{config('custom.staticServer')}}/images/home-portrait/2.jpg" alt=""><em class="sm-vip"></em><span></span></a></li>
            </ul>
        </div>
    </div>
</section>

<section id="middle">
    <div class="w">
        <div class="left-area">
            <div class="search">
                <div class="feed-filter clearfix" style="display: none;">
                    <div class="feed-filter-conditions">
                        <div class="feed-filter-group">
                            <select class="feed-filter-province" name="">
                                <option value="不限">不限</option>
                                <option value="湖南">湖南</option>
                            </select>
                            <select class="feed-filter-city" name="">
                                <option value="不限">不限</option>
                                <option value="长沙">长沙</option>
                            </select>
                        </div>

                        <div class="feed-filter-group">
                            <select class="feed-filter-age-start" name="">
                                <option value="18">18</option>
                            </select>
                            <span>-</span>
                            <select class="feed-filter-age-end" name="">
                                <option value="不限">不限</option>
                                <option value="24">24</option>
                            </select>
                            <span>岁</span>
                        </div>

                        <div class="feed-filter-group">
                            <select class="feed-filter-height-start" name="">
                                <option value="不限">不限</option>
                                <option value="150">150</option>
                            </select>
                            <span>-</span>
                            <select class="feed-filter-height-end" name="">
                                <option value="不限">不限</option>
                                <option value="165">165</option>
                            </select>
                            <span>厘米</span>
                        </div>

                        <div class="feed-filter-group">
                            <select class="feed-filter-education" name="">
                                <option value="不限">不限</option>
                                <option value="大专及以下">大专及以下</option>
                            </select>
                        </div>

                        <div class="feed-filter-group">
                            <select class="feed-filter-revenue-start" name="">
                                <option value="不限">不限</option>
                                <option value="2000">2000</option>
                            </select>
                            <span>-</span>
                            <select class="feed-filter-revenue-end" name="">
                                <option value="不限">不限</option>
                                <option value="4000">4000</option>
                            </select>
                            <span>元月收入</span>
                        </div>
                    </div>
                    <div class="feed-filter-action">
                        <a class="submit-trigger">保存</a>
                        <a class="submit-cancel">取消</a>
                    </div>
                </div>

                <h1>湖北 武汉  18到22岁 的女生<i class="slider-js"></i></h1>
                <div class="open-vip">
                    <span class="to-open"><em></em></em><a href="#">开通高级VIP会员</a>可使用更多推荐条件</span>
                </div>
                <div class="condition-select clearfix">
                    <ul>
                        <li><select name="">
                                <option value="">行业</option>
                            </select>
                        </li>
                        <li><select name="">
                                <option value="">籍贯</option>
                            </select>
                        </li>
                        <li><select name="">
                                <option value="">住房</option>
                            </select>
                        </li>
                        <li><select name="">
                                <option value="">购车</option>
                            </select>
                        </li>
                        <li><select name="">
                                <option value="">星座</option>
                            </select>
                        </li>
                        <li><select name="">
                                <option value="">民族</option>
                            </select>
                        </li>
                        <li><select name="">
                                <option value="">婚姻状况</option>
                            </select>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="user-list clearfix">
                <ul>
                    <li>
                        <div class="left-portrait fl">
                            <a href="#"><img src="{{config('custom.staticServer')}}/images/home-portrait/2717270666533647970.jpg" alt=""></a>
                        </div>
                        <div class="right-info fl">
                            <div class="lt-desc">
                                <dl>
                                    <dt>
                                        <span class="nickname"><a href="#">谁懂我的心</a></span>
                                    <span class="feed-user-info-icon">
                                        <a class="icon-verified-card" href="#"></a>
                                        <a class="icon-verified-mobile" href="#"></a>
                                        <a class="icon-verified-credit" href="#"></a>
                                        <a class="icon-verified-mid-credit" href="#">中信用</a>
                                    </span>
                                    <span class="percent">
                                        <a href="#">
                                            <span>推荐度：</span>
                                            <i>64</i>
                                            <b>%</b>
                                            <em></em>
                                        </a>
                                    </span>
                                    </dt>
                                    <dd class="user-contact-info">
                                        <span>21岁</span>|
                                        <span>165厘米</span>|
                                        <span>大专</span>|
                                        <span>4000-6000元</span>|
                                        <span class="re-pos"><em></em>2张</span>
                                    </dd>
                                    <dd>正在寻找：住在湖北，21-29岁的男生。</dd>
                                </dl>
                                <p>推荐理由：你们已互相满足对方的要求，可进一步了解。</p>
                            </div>
                            <div class="rt-icon">
                                <div class="my-love"><em></em><i class="disable"></i></div>
                                <div class="my-hate"><em></em><i class="disable"></i></div>
                                <div class="my-say"><em></em><i class="disable"></i></div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="left-portrait fl">
                            <a href="#"><img src="{{config('custom.staticServer')}}/images/home-portrait/2717270666533647970.jpg" alt=""></a>
                        </div>
                        <div class="right-info fl">
                            <div class="lt-desc">
                                <dl>
                                    <dt>
                                        <span class="nickname"><a href="#">谁懂我的心</a></span>
                                    <span class="feed-user-info-icon">
                                        <a class="icon-verified-card" href="#"></a>
                                        <a class="icon-verified-mobile" href="#"></a>
                                        <a class="icon-verified-credit" href="#"></a>
                                        <a class="icon-verified-mid-credit" href="#">中信用</a>
                                    </span>
                                    <span class="percent">
                                        <a href="#">
                                            <span>推荐度：</span>
                                            <i>64</i>
                                            <b>%</b>
                                            <em></em>
                                        </a>
                                    </span>
                                    </dt>
                                    <dd class="user-contact-info">
                                        <span>21岁</span>|
                                        <span>165厘米</span>|
                                        <span>大专</span>|
                                        <span>4000-6000元</span>|
                                        <span class="re-pos"><em></em>2张</span>
                                    </dd>
                                    <dd>正在寻找：住在湖北，21-29岁的男生。</dd>
                                </dl>
                                <p>推荐理由：你们已互相满足对方的要求，可进一步了解。</p>
                            </div>
                            <div class="rt-icon">
                                <div class="my-love"><em></em><i class="disable"></i></div>
                                <div class="my-hate"><em></em><i class="disable"></i></div>
                                <div class="my-say"><em></em><i class="disable"></i></div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="left-portrait fl">
                            <a href="#"><img src="{{config('custom.staticServer')}}/images/home-portrait/2717270666533647970.jpg" alt=""></a>
                        </div>
                        <div class="right-info fl">
                            <div class="lt-desc">
                                <dl>
                                    <dt>
                                        <span class="nickname"><a href="#">谁懂我的心</a></span>
                                    <span class="feed-user-info-icon">
                                        <a class="icon-verified-card" href="#"></a>
                                        <a class="icon-verified-mobile" href="#"></a>
                                        <a class="icon-verified-credit" href="#"></a>
                                        <a class="icon-verified-mid-credit" href="#">中信用</a>
                                    </span>
                                    <span class="percent">
                                        <a href="#">
                                            <span>推荐度：</span>
                                            <i>64</i>
                                            <b>%</b>
                                            <em></em>
                                        </a>
                                    </span>
                                    </dt>
                                    <dd class="user-contact-info">
                                        <span>21岁</span>|
                                        <span>165厘米</span>|
                                        <span>大专</span>|
                                        <span>4000-6000元</span>|
                                        <span class="re-pos"><em></em>2张</span>
                                    </dd>
                                    <dd>正在寻找：住在湖北，21-29岁的男生。</dd>
                                </dl>
                                <p>推荐理由：你们已互相满足对方的要求，可进一步了解。</p>
                            </div>
                            <div class="rt-icon">
                                <div class="my-love"><em></em><i class="disable"></i></div>
                                <div class="my-hate"><em></em><i class="disable"></i></div>
                                <div class="my-say"><em></em><i class="disable"></i></div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="left-portrait fl">
                            <a href="#"><img src="{{config('custom.staticServer')}}/images/home-portrait/2717270666533647970.jpg" alt=""></a>
                        </div>
                        <div class="right-info fl">
                            <div class="lt-desc">
                                <dl>
                                    <dt>
                                        <span class="nickname"><a href="#">谁懂我的心</a></span>
                                    <span class="feed-user-info-icon">
                                        <a class="icon-verified-card" href="#"></a>
                                        <a class="icon-verified-mobile" href="#"></a>
                                        <a class="icon-verified-credit" href="#"></a>
                                        <a class="icon-verified-mid-credit" href="#">中信用</a>
                                    </span>
                                    <span class="percent">
                                        <a href="#">
                                            <span>推荐度：</span>
                                            <i>64</i>
                                            <b>%</b>
                                            <em></em>
                                        </a>
                                    </span>
                                    </dt>
                                    <dd class="user-contact-info">
                                        <span>21岁</span>|
                                        <span>165厘米</span>|
                                        <span>大专</span>|
                                        <span>4000-6000元</span>|
                                        <span class="re-pos"><em></em>2张</span>
                                    </dd>
                                    <dd>正在寻找：住在湖北，21-29岁的男生。</dd>
                                </dl>
                                <p>推荐理由：你们已互相满足对方的要求，可进一步了解。</p>
                            </div>
                            <div class="rt-icon">
                                <div class="my-love"><em></em><i class="disable"></i></div>
                                <div class="my-hate"><em></em><i class="disable"></i></div>
                                <div class="my-say"><em></em><i class="disable"></i></div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="left-portrait fl">
                            <a href="#"><img src="{{config('custom.staticServer')}}/images/home-portrait/2717270666533647970.jpg" alt=""></a>
                        </div>
                        <div class="right-info fl">
                            <div class="lt-desc">
                                <dl>
                                    <dt>
                                        <span class="nickname"><a href="#">谁懂我的心</a></span>
                                    <span class="feed-user-info-icon">
                                        <a class="icon-verified-card" href="#"></a>
                                        <a class="icon-verified-mobile" href="#"></a>
                                        <a class="icon-verified-credit" href="#"></a>
                                        <a class="icon-verified-mid-credit" href="#">中信用</a>
                                    </span>
                                    <span class="percent">
                                        <a href="#">
                                            <span>推荐度：</span>
                                            <i>64</i>
                                            <b>%</b>
                                            <em></em>
                                        </a>
                                    </span>
                                    </dt>
                                    <dd class="user-contact-info">
                                        <span>21岁</span>|
                                        <span>165厘米</span>|
                                        <span>大专</span>|
                                        <span>4000-6000元</span>|
                                        <span class="re-pos"><em></em>2张</span>
                                    </dd>
                                    <dd>正在寻找：住在湖北，21-29岁的男生。</dd>
                                </dl>
                                <p>推荐理由：你们已互相满足对方的要求，可进一步了解。</p>
                            </div>
                            <div class="rt-icon">
                                <div class="my-love"><em></em><i class="disable"></i></div>
                                <div class="my-hate"><em></em><i class="disable"></i></div>
                                <div class="my-say"><em></em><i class="disable"></i></div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="left-portrait fl">
                            <a href="#"><img src="{{config('custom.staticServer')}}/images/home-portrait/2717270666533647970.jpg" alt=""></a>
                        </div>
                        <div class="right-info fl">
                            <div class="lt-desc">
                                <dl>
                                    <dt>
                                        <span class="nickname"><a href="#">谁懂我的心</a></span>
                                    <span class="feed-user-info-icon">
                                        <a class="icon-verified-card" href="#"></a>
                                        <a class="icon-verified-mobile" href="#"></a>
                                        <a class="icon-verified-credit" href="#"></a>
                                        <a class="icon-verified-mid-credit" href="#">中信用</a>
                                    </span>
                                    <span class="percent">
                                        <a href="#">
                                            <span>推荐度：</span>
                                            <i>64</i>
                                            <b>%</b>
                                            <em></em>
                                        </a>
                                    </span>
                                    </dt>
                                    <dd class="user-contact-info">
                                        <span>21岁</span>|
                                        <span>165厘米</span>|
                                        <span>大专</span>|
                                        <span>4000-6000元</span>|
                                        <span class="re-pos"><em></em>2张</span>
                                    </dd>
                                    <dd>正在寻找：住在湖北，21-29岁的男生。</dd>
                                </dl>
                                <p>推荐理由：你们已互相满足对方的要求，可进一步了解。</p>
                            </div>
                            <div class="rt-icon">
                                <div class="my-love"><em></em><i class="disable"></i></div>
                                <div class="my-hate"><em></em><i class="disable"></i></div>
                                <div class="my-say"><em></em><i class="disable"></i></div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="left-portrait fl">
                            <a href="#"><img src="{{config('custom.staticServer')}}/images/home-portrait/2717270666533647970.jpg" alt=""></a>
                        </div>
                        <div class="right-info fl">
                            <div class="lt-desc">
                                <dl>
                                    <dt>
                                        <span class="nickname"><a href="#">谁懂我的心</a></span>
                                    <span class="feed-user-info-icon">
                                        <a class="icon-verified-card" href="#"></a>
                                        <a class="icon-verified-mobile" href="#"></a>
                                        <a class="icon-verified-credit" href="#"></a>
                                        <a class="icon-verified-mid-credit" href="#">中信用</a>
                                    </span>
                                    <span class="percent">
                                        <a href="#">
                                            <span>推荐度：</span>
                                            <i>64</i>
                                            <b>%</b>
                                            <em></em>
                                        </a>
                                    </span>
                                    </dt>
                                    <dd class="user-contact-info">
                                        <span>21岁</span>|
                                        <span>165厘米</span>|
                                        <span>大专</span>|
                                        <span>4000-6000元</span>|
                                        <span class="re-pos"><em></em>2张</span>
                                    </dd>
                                    <dd>正在寻找：住在湖北，21-29岁的男生。</dd>
                                </dl>
                                <p>推荐理由：你们已互相满足对方的要求，可进一步了解。</p>
                            </div>
                            <div class="rt-icon">
                                <div class="my-love"><em></em><i class="disable"></i></div>
                                <div class="my-hate"><em></em><i class="disable"></i></div>
                                <div class="my-say"><em></em><i class="disable"></i></div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="left-portrait fl">
                            <a href="#"><img src="{{config('custom.staticServer')}}/images/home-portrait/2717270666533647970.jpg" alt=""></a>
                        </div>
                        <div class="right-info fl">
                            <div class="lt-desc">
                                <dl>
                                    <dt>
                                        <span class="nickname"><a href="#">谁懂我的心</a></span>
                                    <span class="feed-user-info-icon">
                                        <a class="icon-verified-card" href="#"></a>
                                        <a class="icon-verified-mobile" href="#"></a>
                                        <a class="icon-verified-credit" href="#"></a>
                                        <a class="icon-verified-mid-credit" href="#">中信用</a>
                                    </span>
                                    <span class="percent">
                                        <a href="#">
                                            <span>推荐度：</span>
                                            <i>64</i>
                                            <b>%</b>
                                            <em></em>
                                        </a>
                                    </span>
                                    </dt>
                                    <dd class="user-contact-info">
                                        <span>21岁</span>|
                                        <span>165厘米</span>|
                                        <span>大专</span>|
                                        <span>4000-6000元</span>|
                                        <span class="re-pos"><em></em>2张</span>
                                    </dd>
                                    <dd>正在寻找：住在湖北，21-29岁的男生。</dd>
                                </dl>
                                <p>推荐理由：你们已互相满足对方的要求，可进一步了解。</p>
                            </div>
                            <div class="rt-icon">
                                <div class="my-love"><em></em><i class="disable"></i></div>
                                <div class="my-hate"><em></em><i class="disable"></i></div>
                                <div class="my-say"><em></em><i class="disable"></i></div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="left-portrait fl">
                            <a href="#"><img src="{{config('custom.staticServer')}}/images/home-portrait/2717270666533647970.jpg" alt=""></a>
                        </div>
                        <div class="right-info fl">
                            <div class="lt-desc">
                                <dl>
                                    <dt>
                                        <span class="nickname"><a href="#">谁懂我的心</a></span>
                                    <span class="feed-user-info-icon">
                                        <a class="icon-verified-card" href="#"></a>
                                        <a class="icon-verified-mobile" href="#"></a>
                                        <a class="icon-verified-credit" href="#"></a>
                                        <a class="icon-verified-mid-credit" href="#">中信用</a>
                                    </span>
                                    <span class="percent">
                                        <a href="#">
                                            <span>推荐度：</span>
                                            <i>64</i>
                                            <b>%</b>
                                            <em></em>
                                        </a>
                                    </span>
                                    </dt>
                                    <dd class="user-contact-info">
                                        <span>21岁</span>|
                                        <span>165厘米</span>|
                                        <span>大专</span>|
                                        <span>4000-6000元</span>|
                                        <span class="re-pos"><em></em>2张</span>
                                    </dd>
                                    <dd>正在寻找：住在湖北，21-29岁的男生。</dd>
                                </dl>
                                <p>推荐理由：你们已互相满足对方的要求，可进一步了解。</p>
                            </div>
                            <div class="rt-icon">
                                <div class="my-love"><em></em><i class="disable"></i></div>
                                <div class="my-hate"><em></em><i class="disable"></i></div>
                                <div class="my-say"><em></em><i class="disable"></i></div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="left-portrait fl">
                            <a href="#"><img src="{{config('custom.staticServer')}}/images/home-portrait/2717270666533647970.jpg" alt=""></a>
                        </div>
                        <div class="right-info fl">
                            <div class="lt-desc">
                                <dl>
                                    <dt>
                                        <span class="nickname"><a href="#">谁懂我的心</a></span>
                                    <span class="feed-user-info-icon">
                                        <a class="icon-verified-card" href="#"></a>
                                        <a class="icon-verified-mobile" href="#"></a>
                                        <a class="icon-verified-credit" href="#"></a>
                                        <a class="icon-verified-mid-credit" href="#">中信用</a>
                                    </span>
                                    <span class="percent">
                                        <a href="#">
                                            <span>推荐度：</span>
                                            <i>64</i>
                                            <b>%</b>
                                            <em></em>
                                        </a>
                                    </span>
                                    </dt>
                                    <dd class="user-contact-info">
                                        <span>21岁</span>|
                                        <span>165厘米</span>|
                                        <span>大专</span>|
                                        <span>4000-6000元</span>|
                                        <span class="re-pos"><em></em>2张</span>
                                    </dd>
                                    <dd>正在寻找：住在湖北，21-29岁的男生。</dd>
                                </dl>
                                <p>推荐理由：你们已互相满足对方的要求，可进一步了解。</p>
                            </div>
                            <div class="rt-icon">
                                <div class="my-love"><em></em><i class="disable"></i></div>
                                <div class="my-hate"><em></em><i class="disable"></i></div>
                                <div class="my-say"><em></em><i class="disable"></i></div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="left-portrait fl">
                            <a href="#"><img src="{{config('custom.staticServer')}}/images/home-portrait/2717270666533647970.jpg" alt=""></a>
                        </div>
                        <div class="right-info fl">
                            <div class="lt-desc">
                                <dl>
                                    <dt>
                                        <span class="nickname"><a href="#">谁懂我的心</a></span>
                                    <span class="feed-user-info-icon">
                                        <a class="icon-verified-card" href="#"></a>
                                        <a class="icon-verified-mobile" href="#"></a>
                                        <a class="icon-verified-credit" href="#"></a>
                                        <a class="icon-verified-mid-credit" href="#">中信用</a>
                                    </span>
                                    <span class="percent">
                                        <a href="#">
                                            <span>推荐度：</span>
                                            <i>64</i>
                                            <b>%</b>
                                            <em></em>
                                        </a>
                                    </span>
                                    </dt>
                                    <dd class="user-contact-info">
                                        <span>21岁</span>|
                                        <span>165厘米</span>|
                                        <span>大专</span>|
                                        <span>4000-6000元</span>|
                                        <span class="re-pos"><em></em>2张</span>
                                    </dd>
                                    <dd>正在寻找：住在湖北，21-29岁的男生。</dd>
                                </dl>
                                <p>推荐理由：你们已互相满足对方的要求，可进一步了解。</p>
                            </div>
                            <div class="rt-icon">
                                <div class="my-love"><em></em><i class="disable"></i></div>
                                <div class="my-hate"><em></em><i class="disable"></i></div>
                                <div class="my-say"><em></em><i class="disable"></i></div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="left-portrait fl">
                            <a href="#"><img src="{{config('custom.staticServer')}}/images/home-portrait/2717270666533647970.jpg" alt=""></a>
                        </div>
                        <div class="right-info fl">
                            <div class="lt-desc">
                                <dl>
                                    <dt>
                                        <span class="nickname"><a href="#">谁懂我的心</a></span>
                                    <span class="feed-user-info-icon">
                                        <a class="icon-verified-card" href="#"></a>
                                        <a class="icon-verified-mobile" href="#"></a>
                                        <a class="icon-verified-credit" href="#"></a>
                                        <a class="icon-verified-mid-credit" href="#">中信用</a>
                                    </span>
                                    <span class="percent">
                                        <a href="#">
                                            <span>推荐度：</span>
                                            <i>64</i>
                                            <b>%</b>
                                            <em></em>
                                        </a>
                                    </span>
                                    </dt>
                                    <dd class="user-contact-info">
                                        <span>21岁</span>|
                                        <span>165厘米</span>|
                                        <span>大专</span>|
                                        <span>4000-6000元</span>|
                                        <span class="re-pos"><em></em>2张</span>
                                    </dd>
                                    <dd>正在寻找：住在湖北，21-29岁的男生。</dd>
                                </dl>
                                <p>推荐理由：你们已互相满足对方的要求，可进一步了解。</p>
                            </div>
                            <div class="rt-icon">
                                <div class="my-love"><em></em><i class="disable"></i></div>
                                <div class="my-hate"><em></em><i class="disable"></i></div>
                                <div class="my-say"><em></em><i class="disable"></i></div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="left-portrait fl">
                            <a href="#"><img src="{{config('custom.staticServer')}}/images/home-portrait/2717270666533647970.jpg" alt=""></a>
                        </div>
                        <div class="right-info fl">
                            <div class="lt-desc">
                                <dl>
                                    <dt>
                                        <span class="nickname"><a href="#">谁懂我的心</a></span>
                                    <span class="feed-user-info-icon">
                                        <a class="icon-verified-card" href="#"></a>
                                        <a class="icon-verified-mobile" href="#"></a>
                                        <a class="icon-verified-credit" href="#"></a>
                                        <a class="icon-verified-mid-credit" href="#">中信用</a>
                                    </span>
                                    <span class="percent">
                                        <a href="#">
                                            <span>推荐度：</span>
                                            <i>64</i>
                                            <b>%</b>
                                            <em></em>
                                        </a>
                                    </span>
                                    </dt>
                                    <dd class="user-contact-info">
                                        <span>21岁</span>|
                                        <span>165厘米</span>|
                                        <span>大专</span>|
                                        <span>4000-6000元</span>|
                                        <span class="re-pos"><em></em>2张</span>
                                    </dd>
                                    <dd>正在寻找：住在湖北，21-29岁的男生。</dd>
                                </dl>
                                <p>推荐理由：你们已互相满足对方的要求，可进一步了解。</p>
                            </div>
                            <div class="rt-icon">
                                <div class="my-love"><em></em><i class="disable"></i></div>
                                <div class="my-hate"><em></em><i class="disable"></i></div>
                                <div class="my-say"><em></em><i class="disable"></i></div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="right-area">
            <div class="top-info">
                <div class="portrait">
                    <a href="#">
                        <img width="70px" src="{{config('custom.staticServer') . '/'. $userInfo['thumb_avatar']}}" alt="">
                        <span class="portrait-truth {{$UserPresenter->showAvatarTips($userInfo['avatar_verify_status'])}}">{{$UserPresenter->userAvatarVerifyStatusText($userInfo['avatar_verify_status'])}}</span>
                    </a>
                </div>
                <div class="fans">
                    <p>
                        <a href="#" class="user-name">obito</a>
                        <a href="#" class="member-svip"></a>
                    </p>
                    <p>
                        <a href="#" class="icon-sm-credit">低信用</a>
                        <a href="#" class="icon-verified-card"></a>
                        <a href="#" class="icon-verified-mobile"></a>
                        <a href="#" class="icon-verified-company"></a>
                        <a href="#" class="icon-verified-zmxy"></a>
                    </p>
                </div>
                <div class="counter">
                    <a href="#" class="to-fans">喜欢<em>0</em></a>
                    <i></i>
                    <a href="#" class="from-fans">被喜欢<em>0</em></a>
                </div>
                <div class="bottom-line"></div>
                <div class="open-vip-btn">
                    <a href="#" class="open-vip-btn"><em></em><span>开通会员</span></a>
                </div>
                <div class="upload-bar">
                    <a class="g-upload-photo-trigger" href="#"><em class="upload-img"></em><span>上传照片</span></a>
                    <a href="#"><em class="text-emoji"></em><span>文字表情</span></a>
                    <a href="#"><em class="push-date"></em><span>发布约会</span></a>
                </div>
                <div class="get-cb">
                    <p>我的花田币：14个<a href="#">充值</a></p>
                    <p><a href="#"><span class="plus-text">+</span>免费领取花田币</a></p>
                    <p>明日签到可领取3花田币</p>
                </div>
                <div class="invite-member">
                    <p class="top-text"><span>邀好友赢会员</span><em></em><a href="#">立即邀请</a></p>
                </div>
                <div class="up-focus">
                    <p class="top-text"><span>邀好友赢会员</span><a href="#">更多></a></p>
                    <ul class="recommand-user">
                        <li><a href="#"><img src="{{config('custom.staticServer')}}/images/up-focus/1.jpg"><span>10花田币</span></a></li>
                        <li><a href="#"><img src="{{config('custom.staticServer')}}/images/up-focus/1.jpg"><span>10花田币</span></a></li>
                        <li><a href="#"><img src="{{config('custom.staticServer')}}/images/up-focus/1.jpg"><span>10花田币</span></a></li>
                        <li><a href="#"><img src="{{config('custom.staticServer')}}/images/up-focus/1.jpg"><span>10花田币</span></a></li>
                        <li><a href="#"><img src="{{config('custom.staticServer')}}/images/up-focus/1.jpg"><span>10花田币</span></a></li>
                        <li><a href="#"><img src="{{config('custom.staticServer')}}/images/up-focus/1.jpg"><span>10花田币</span></a></li>
                    </ul>
                </div>
                <div class="happy-event">
                    <p class="top-text"><span>花田喜事</span><a href="#">分享喜事</a></p>
                    <div class="couple-photo">
                        <a href="#">
                            <img src="{{config('custom.staticServer')}}/images/happy-event.png" alt="">
                            <p>
                                <span class="from-user">半个灵魂</span>
                                <i class="love"></i>
                                <span class="to-user">指尖星光</span>
                            </p>
                        </a>
                    </div>
                </div>
                <div class="goodnews-list">
                    <ul class="nest-news">
                        <li><em class="love-icon"></em>鸣人与雏田恋爱了1</li>
                        <li><em class="love-icon"></em>鸣人与雏田恋爱了2</li>
                        <li><em class="love-icon"></em>鸣人与雏田恋爱了3</li>
                        <li><em class="love-icon"></em>鸣人与雏田恋爱了4</li>
                        <li><em class="love-icon"></em>鸣人与雏田恋爱了5</li>
                        <li><em class="love-icon"></em>鸣人与雏田恋爱了6</li>
                        <li><em class="love-icon"></em>鸣人与雏田恋爱了7</li>
                        <li><em class="love-icon"></em>鸣人与雏田恋爱了8</li>
                        <li><em class="love-icon"></em>鸣人与雏田恋爱了9</li>
                        <li><em class="love-icon"></em>鸣人与雏田恋爱了10</li>
                    </ul>
                </div>
                <div class="contact-us">
                    <p class="top-text"><span>花田相关</span></p>
                    <ul class="main-info">
                        <li><span>新手上路：</span><a href="#">教你快速找到意中人</a></li>
                        <li><span>安全中心：</span><a href="#">网上交友如何防骗</a></li>
                        <li><span>花田帮助：</span><a href="#">常见反馈问题解答</a></li>
                        <li><span>联系客服：</span><a href="#">咨询花田小红娘</a><br/><span class="wrap-font">电话咨询 020-85105681<br>( 工作日 10点 - 18点 )</span></li>
                        <li class="serval-info">
                            <span>关注花田：</span>
                            <a href="#" class="sina-icon"></a>
                            <a href="#" class="douban-icon"></a>
                            <a href="#" class="wx-icon"></a>
                        </li>
                    </ul>
                </div>
                <div class="hot-activity">
                    <p class="top-text"><span>热门活动</span></p>
                    <a class="ad-banner" href="#">
                        <img src="{{config('custom.staticServer')}}/images/5304673122.jpg" alt="">
                        <p class="ad-link">【十点夜话】</p>
                    </a>
                </div>
                <div class="hot-ad">
                    <img src="{{config('custom.staticServer')}}/images/60409434724.png" alt="">
                </div>
            </div>
        </div>
    </div>
</section>
<section id="float-bar">
    <div>
        <a href="javascript:;" class="a-to-top"><em class="to-top nohl"></em></a>
    </div>
    <div class="feedback-us">
        <a href="javascript:;">意见反馈</a>
    </div>
</section>

<!--发布动态模态框开始-->
<div class="modal-layer publish-trend-modal hide">
    <div class="main-box modal-layer-main">
        <div class="title-row">
            <h3>发布动态</h3>
            <a class="icon-close" href="javascript:;"></a>
        </div>
        <div class="content">
            <p class="title">大家都在聊：</p>
            <ul class="tag-list clearfix">
                @foreach($hotTags as $tag)
                    <li class="js-add-tag">#{{$tag}}#</li>
                @endforeach
                <li class="js-add-tag custom-tag">+自定义标签</li>
            </ul>
            <div class="trend-content-container">
                <p class="js-placeholder placeholder">说出你的心声让大家认识你吧</p>
                <textarea class="js-trend-content trend-content" style="height: 80px;"></textarea>
                <p class="word-count"><span class="js-word-count">0</span>/163</p>
                <ul class="photo-group js-photo-group">
                    <li class="photo-uploader js-photo-uploader js-upload-drag">
                        <p class="bottom-desc">
                            <i class="icon-add-b"></i><br>
                            <span class="text">点击或者拖入上传</span>
                        </p>
                        <form class="js-upload-form" action="{{url('User/Upload/TrendsAttachedImage')}}" method="POST" accept-charset="utf-8" enctype="multipart/form-data">
                            <input class="btn-file add-trends-image-btn" multiple name="uploadPhoto" accept="image/jpg,image/jpeg,image/png,image/gif,image/bmp" type="file">
                        </form>
                    </li>
                </ul>
                <div class="photo-tip">
                    <p class="photo-number">还可上传&nbsp;<span class="js-photo-number">{{$attachedSpecification['file_number_limit']}}</span>&nbsp;张图片（大小支持10K-8M）</p>
                    <p class="js-photo-errors hide photo-errors text-icon-tips-warning">
                        <em class="icon-warning-s"></em>
                        <span class="js-photo-upload-errors-text"></span>
                    </p>
                </div>
            </div>
        </div>
        <div class="foot-row">
            <a class="general-btn red-button publish-btn disabled" href="javascript:;">发布</a>
        </div>
    </div>
</div>
<!--发布动态模态框结束-->

<!--文字传情模态框开始-->
<div class="modal-layer publish-letter-modal hide">
    <div class="main-box modal-layebr-main">
        <div class="title-row">
            <h3>发布动态</h3>
            <span class="text-md poplayer-subtitle">表达爱的心语,遥寄未来的TA</span>
            <a class="icon-close" href="javascript:;"></a>
        </div>
        <div class="content">
            <div class="poplayer-letter-template js-tab">
                <a class="current" data-target-bd="n-letter-title-default" href="javascript:;">无主情话</a>
                <a data-target-bd="n-letter-title-past" href="javascript:;">时光隧道</a>
                <a data-target-bd="n-letter-title-xiaoshipian" href="javascript:;">独居生活</a>
                <a data-target-bd="n-letter-title-unbosom" href="javascript:;">想对你说</a>
            </div>
            <div class="poplayer-letter-content js-content letter-template-default">
                <div class="letter-body">
                    <div class="letter-hd">
                        <h2 class="letter-hd-title">
                            <span class="n-letter-title-default">随便说点情话：</span>
                            <span class="n-letter-title-past">分享我的过去：</span>
                            <span class="n-letter-title-xiaoshipian">记录现在的生活：</span>
                            <span class="n-letter-title-unbosom">写给喜欢的人：</span>
                        </h2>
                    </div>
                    <div class="letter-bd">
                        <div class="poplayer-letter-textarea js-textareaCon">
                            <textarea data-adaptheight rows="3" cols="40" class="ui-scrollbar" style="height: 28px;"></textarea>
                        </div>
                        <p class="poplayer-letter-sign">——by&nbsp;麻瓜</p>
                    </div>
                    <div class="letter-ft"></div>
                </div>
            </div>
        </div>
        <!--<div class="foot-row">-->
        <!--<a class="general-btn red-button publish-btn" href="javascript:;">发布</a>-->
        <!--</div>-->
        <div class="poplayer-letter-ft js-send-btn clearfix">
            <div class="show">
                <div class="poplayer-letter-btn n-btn-box js-btn">
                    <div class="disabled js-btn-txt">
                        <a class="general-btn red-button publish-btn disabled" href="javascript:;">发布</a>
                    </div>
                </div>
                <span class="poplayer-letter-tips js-lineCounter warn">至少输入<b class="char-constantia">10</b>个字</span>
            </div>
            <div class="hide">
            <span class="text-small-tips cGray">
                <em class="icon-correct-s" style="vertical-align: text-top; margin-right: 3px;"></em>
                发布成功！
            </span>
            </div>
        </div>
    </div>
</div>
<!--文字传情模态框结束-->

<!-- 发布状态的模态框开始 -->
<div class="modal-layer publish-status-modal hide">
    <div class="main-box modal-layer-main">
        <div class="content">
            <p class="result-row"><em class="success fail"></em><span class="operation-msg"><!--上传[成功|失败]--></span></p>
            <!-- 成功时的提示 -->
            <p class="success-relation-msg">您的动态将会推送给合适的TA，并同步到您的相册</p>
        </div>
    </div>
</div>
<!-- 发布状态的模态框结束 -->
@endsection

@section('additional-js')
    <script>
        $(function () {
            var attachedFileNumber = 0;
            var attachedConfig = JSON.parse('{!! json_encode($attachedSpecification) !!}');
            var trendsErrorMsgBox = $('.trend-content-container .text-icon-tips-warning');
            var textBox = trendsErrorMsgBox.children('.js-photo-upload-errors-text');
            var uploadFailedNumber = 0;
            var trendsPublishBtn = $('.publish-trend-modal .publish-btn');


            $('.add-trends-image-btn').on('change', function (e) {
                var fileNumber = e.target.files.length;
                var residueNumber = 0;
                var smKey;
                var smDataUrl;
                var lgKey;
                var lgDataUrl;

                // 重置上传错误张数
                uploadFailedNumber = 0;

                
                if (fileNumber < 0 || attachedFileNumber == attachedConfig.file_number_limit) {
                    return false;
                }

                if (fileNumber + attachedFileNumber >= attachedConfig.file_number_limit) {
                    residueNumber = attachedConfig.file_number_limit - attachedFileNumber;

                    if (fileNumber + attachedFileNumber > attachedConfig.file_number_limit) {
                        trendsErrorMsgBox.removeClass('hide');
                        textBox.html('最多只能上传' + attachedConfig.file_number_limit + '张照片');
                    }

                    // 隐藏添加图片的toolbar
                    $('.js-upload-drag').addClass('hide');
                } else {
                    residueNumber = fileNumber;
                    trendsErrorMsgBox.addClass('hide');
                }

                // 为了显示进度条，单张上传/次
                for (let i = 0; i < residueNumber; i++) {
                    var formData = new FormData();
                    formData.append('_token', '{{csrf_token()}}');
                    // 如果是一次上传多个文件，必须加中括号，单个的话可以省略
                    formData.append('trendsFile[]', e.target.files[i]);
                    var progressList = [];

                    $.ajax({
                        xhr: function() {
                            var xhr = new window.XMLHttpRequest();

                            xhr.upload.addEventListener("progress", function(evt) {
                                if (evt.lengthComputable) {
                                    var percentComplete = evt.loaded / evt.total;

                                    if (! progressList[i]) {
                                        progressList[i] = [];
                                    }

                                    progressList[i].push(percentComplete);
                                }
                            }, false);

                            return xhr;
                        },
                        url: '{{url("User/Upload/TrendsAttachedImage")}}',
                        type: "POST",
                        headers: {
                            accept : "application/json; charset=utf-8"
                        },
                        // 参数很重要
                        contentType: false,
                        cache: false,
                        // 参数很重要, 如果不设置成false, 他会将你的formData数据转变成一个string
                        processData: false,
                        data: formData,
                        beforeSend: function () {

                        },
                        success: function (data) {
                            var loopI = 0;

                            for (var j = 0 in data) {
                                if (/^sm\w+/.test(j)) {
                                    smKey = j;
                                    smDataUrl = data[j].encoded;
                                } else if (/^lg\w+/.test(j)) {
                                    lgKey = j;
                                    lgDataUrl = data[j].encoded;
                                }
                            }

                            $('.trend-content-container .js-upload-drag').after('<li class="photo-item js-photo-item"> <a href="javascript:;" class="icon-close-m js-remove-photo"></a> <img src="'+smDataUrl+'"> <p class="bottom-line tip-background js-tip-background"></p> <p class="upload-success bottom-line tip js-tip"></p><p class="process-bar bottom-line tip"></p> </li>');
                            var currentLiObject = $('.js-upload-drag').next('li');
                            var timer = setInterval(function () {
                                if (loopI < progressList[i].length) {
                                    var progressPercent = parseInt(progressList[i][loopI] * 100) + '%';
                                    currentLiObject.find('.process-bar').css('width', progressPercent);
                                    currentLiObject.find('.process-bar').html(progressPercent);
                                    ++loopI;
                                } else {
                                    clearInterval(timer);
                                    currentLiObject.find('.process-bar').addClass('hide');
                                    currentLiObject.find('.upload-success').html('上传成功');
                                }
                            }, 1000);

                            // 判断还可以添加的图片张数
                            $('.js-photo-number').html(attachedConfig.file_number_limit - attachedFileNumber);

                            // 显示错误提示
                            if (uploadFailedNumber > 0) {
                                trendsErrorMsgBox.removeClass('hide');
                                textBox.html(uploadFailedNumber + '张照片大小或格式不合规范');
                            }

                            // 追加image的key、value值，记录到dom，这里必须写data，而不是attr,而且不是字符串，直接参数就是对象
                            currentLiObject.find('.js-remove-photo').data('img-info', {smKey: smKey, lgKey: lgKey});

                            // 取消发布状态的禁用状态
                            trendsPublishBtn.removeClass('disabled');
                        },
                        error: function (request) {
                            ++uploadFailedNumber;
                            --attachedFileNumber;

                            if (attachedFileNumber < attachedConfig.file_number_limit) {
                                $('.js-upload-drag').removeClass('hide');
                            }

                            // 当没有一张图片上传成功时，也就是全部失败时
                            if (residueNumber == uploadFailedNumber) {
                                trendsErrorMsgBox.removeClass('hide');
                                textBox.html(uploadFailedNumber + '张照片大小或格式不合规范');
                            }
                        }
                    });

                    ++attachedFileNumber;
                }

            });

            // 删除上传完成的缓存图片
            $(document).on('click', '.trend-content-container .js-remove-photo', function () {
                var imageInfo = $(this).data('img-info');
                $.ajax({
                    type: "POST",
                    url: "{{url("User/Remove/TrendsAttachedFile")}}",
                    data: {"tmpImageFile[0]": imageInfo['smKey'], "tmpImageFile[1]": imageInfo['lgKey'], "_token": "{{csrf_token()}}"},
                    headers: {
                        accept : "application/json; charset=utf-8"
                    },
                    context: this,
                    success: function (data) {
                        // 返回的是删除成功的条数
                        if (data > 0) {
                            $(this).parent().remove();
                            --attachedFileNumber;

                            if (attachedFileNumber < attachedConfig.file_number_limit) {
                                $('.js-upload-drag').removeClass('hide');
                                trendsErrorMsgBox.addClass('hide');
                            }

                            // 判断还可以添加的图片张数
                            $('.js-photo-number').html(attachedConfig.file_number_limit - attachedFileNumber);

                            if (attachedFileNumber == 0) {
                                // 取消发布状态的禁用状态
                                trendsPublishBtn.addClass('disabled');
                            }
                        }
                    },
                    error: function (request) {
                    }
                });
            });

            // ajax发布个人动态
            trendsPublishBtn.on('click', function (e) {
                if ($(this).hasClass('disabled')) {
                    e.preventDefault();
                }

                var imageKeys = {};
                var content = $('.publish-trend-modal .js-trend-content').val();
                var smKey;
                var lgKey;
                // 得到所有需要保存的图片的缓存的key名
                $('.publish-trend-modal .js-remove-photo').each(function (i, n) {
                    smKey = $(n).data('img-info')['smKey'];
                    lgKey = $(n).data('img-info')['lgKey'];
                    imageKeys[i] = {'smKey': smKey, 'lgKey': lgKey};
                });

                $.ajax({
                    type: "POST",
                    url: "{{url("User/publishTrends")}}",
                    data: {"imageKeys": imageKeys, "content": content, "_token": "{{csrf_token()}}"},
                    headers: {
                        accept : "application/json; charset=utf-8"
                    },
                    context: this,
                    success: function (data) {
                        console.log(data);
                    },
                    error: function (request) {
                    }
                });

                console.log(content);
            });
        });
    </script>
@endsection