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
@endsection
{{--content--}}
@section('content')
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
                <div class="feed-filter clearfix hide">
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
                        <img src="{{config('custom.staticServer')}}/images/user-portrait.jpg" alt="">
                        <span class="portrait-truth">非真人头像</span>
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
                    <a href="#"><em class="upload-img"></em><span>上传照片</span></a>
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
@endsection

@section('additional-js')
    <script>
        var staticServer = "{{config('custom.staticServer')}}";
    </script>
    <script src="{{config('custom.staticServer')}}/js/home-nav-bar.js"></script>
@endsection