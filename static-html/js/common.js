/**
 * Created by konohanaruto on 2016/9/18.
 */

$(function(){
    $('.top-nav .right-area > a:eq(2)').hover(function(){
        $(this).css('background-color','#fff');
        $(this).children('span').css({"background":"url(../images/icon_v150709.png) -112px -259px no-repeat"});
        $('.today-base').hide();
        $('.msg-box').show();
    },
    function(){
        $(this).css('background-color','transparent');
        $(this).children('span').css({"background":"url(../images/icon_v150709.png) -72px -259px no-repeat"});
        $('.today-base').show();
        $('.msg-box').hide();
    });
    $('.msg-box').hover(function(){
        var obj = $('.top-nav .right-area > a:eq(2)');
        obj.children('span').css({"background":"url(../images/icon_v150709.png) -112px -259px no-repeat"});
        obj.css('background-color','#fff');
        $(this).show();
        $('.today-base').hide();
    },
    function(){
        var obj = $('.top-nav .right-area > a:eq(2)');
        obj.children('span').css({"background":"url(../images/icon_v150709.png) -72px -259px no-repeat"});
        obj.css('background-color','transparent');
        $(this).hide();
        $('.today-base').show();
    });


    $('.top-nav .right-area > a:eq(3)').hover(function(){
            $(this).css('background-color','#fff');
            $(this).children('span').css({"background":"url(../images/icon_v150709.png) -36px -259px no-repeat"});
            $('.msg-box1').show();
        },
        function(){
            $(this).css('background-color','transparent');
            $(this).children('span').css({"background":"url(../images/icon_v150709.png) 0 -259px no-repeat"});
            $('.msg-box1').hide();
        });
    $('.msg-box1').hover(function(){
            var obj = $('.top-nav .right-area > a:eq(3)');
            obj.children('span').css({"background":"url(../images/icon_v150709.png) -36px -259px no-repeat"});
            obj.css('background-color','#fff');
            $(this).show();
        },
        function(){
            var obj = $('.top-nav .right-area > a:eq(3)');
            obj.children('span').css({"background":"url(../images/icon_v150709.png) 0 -259px no-repeat"});
            obj.css('background-color','transparent');
            $(this).hide();
        });

    //banner区域
    $('#top-logo .right-area li a').hover(
        function(){
            $(this).children('img').removeClass();
            $(this).children('img').addClass('md-img');
            var vipType = $(this).find('em').attr('class');
            $(this).find('em').removeClass();
            if(vipType == 'sm-vip'){
                $(this).find('em').addClass('md-vip');
            }else{
                $(this).find('em').addClass('md-svip');
            }
            $(this).width(125);
            $(this).height(125);
            $(this).css({left:-18,top:-18,'z-index':1});
        },
        function(){
            $(this).children('img').removeClass();
            $(this).children('img').addClass('sm-img');
            var vipType = $(this).find('em').attr('class');
            $(this).find('em').removeClass();
            if(vipType == 'md-vip'){
                $(this).find('em').addClass('sm-vip');
            }else{
                $(this).find('em').addClass('sm-svip');
            }
            $(this).width(70);
            $(this).height(70);
            $(this).css({left:0,top:0,'z-index':0});
        }
    );

    var newTimer = setInterval(function(){
        var obj = $('.nest-news');
        var top = parseInt(obj.css('top'));
        var step = 3;
        var top = top - step;
        //console.log(top);
        if(top <= -196){
            obj.css({top:0});
        }else{
            obj.css({top:top});
        }
    },170);

    $('#float-bar .a-to-top').hover(
        function(){
            $('#float-bar .a-to-top em').removeClass('hl');
            $('#float-bar .a-to-top em').addClass('nohl');
        },
        function(){
            $('#float-bar .a-to-top em').removeClass('nohl');
            $('#float-bar .a-to-top em').addClass('hl');
        }
    );

    $('#float-bar .a-to-top').on('click',function(){
        document.getElementsByTagName('body')[0].scrollTop = 0;
    });

    $('.switch-search').on('click',function(){
        $('.current-focus').animate({
            height:0
        },500);

        //$('.custom-search-terms').show();
        $('.custom-search-terms').animate({
            height:56
        },500);
    });

    $('.cancel-submit').on('click',function(){
        //$('.custom-search-terms').animate({
        //    height:0
        //},1000);

        $('.custom-search-terms').animate({
            height:0
        },500);
        $('.current-focus').animate({
            height:30
        },500);
    });

    $('.relation-favor-text').hover(
        function(){
            $(this).find('em').removeClass();
            $(this).find('em').addClass('icon-like-h');
        },
        function(){
            $(this).find('em').removeClass();
            $(this).find('em').addClass('icon-like-s');
        }
    );

    $('.relation-unfavor-text').hover(
        function(){
            $(this).find('em').removeClass();
            $(this).find('em').addClass('icon-unlike-h');
        },
        function(){
            $(this).find('em').removeClass();
            $(this).find('em').addClass('icon-unlike-s');
        }
    );

    $('.right-contact-btn a').hover(
        function(){
            if($(this).index() == 1){
                $(this).find('em').addClass('invoke');
            }
            $(this).addClass('current');
        },
        function(){
            if($(this).index() == 1){
                $(this).find('em').removeClass('invoke');
            }
            $(this).removeClass('current');
        }
    );

    $('.trend-content-media img').on('click',function(){
        $('#layer').show();
    });

    $('.hot-recommand .fold-trigger').on('click',function(){
        if($('.hot-recommand .fold-arrows').hasClass('up-switch')) {
            $('.hot-recommand .fold-arrows').removeClass('up-switch').addClass('down-switch');
            $('.hot-recommand').css({height:28});
        }else{
            $('.hot-recommand .fold-arrows').removeClass('down-switch').addClass('up-switch');
            $('.hot-recommand').css({height:'auto'});
        }
    });
    $('.condition-filter .select-filter').on({
        'mouseover':function(){
            discoverSelectFilterHover($(this));
        },
        'mouseout':function(){
            discoverSelectFilterOut($(this));
        },
        'click': function () {
            closeAllSelectFilter();
            if (!$(this).children('.select-bg-arrows').hasClass('up-arrows')) {
                $(this).unbind('mouseover mouseout');
                $(this).addClass('border-bot-click');
                discoverSelectFilterClick($(this));
                $(this).children('.border-r-bg').hide();
                $(this).next('.folder-item').show();
                $(this).parents('.filter-parent').addClass('fold-item-actived');
            } else {
                $(this).children('.border-r-bg').show();
                $(this).next('.folder-item').hide();
                $(this).removeClass('border-bot-click');
                discoverSelectFilterHover($(this));
                $(this).bind('mouseover', function () {
                    discoverSelectFilterHover($(this));
                });
                $(this).bind('mouseout', function () {
                    discoverSelectFilterOut($(this));
                });
                $(this).parents('.filter-parent').removeClass('fold-item-actived');
            }
        }

    });

    $('.condition-filter .fold-trigger').on('click',function(){
        if($('.condition-filter .fold-arrows').hasClass('up-switch')) {
            $('.condition-filter .fold-arrows').removeClass('up-switch').addClass('down-switch');
            $('.condition-filter .t-l').show();
        }else{
            $('.condition-filter .fold-arrows').removeClass('down-switch').addClass('up-switch');

            $('.condition-filter .t-l').hide();
        }
    });

    $(".view-recommand-user .tigger-bar .next-page").on('click',function(){
        var center = $('.center-side');
        var index = center.index();
        center.removeClass('center-side z-index-1 z-index-2').addClass('left-side z-index-1');
        if(!center.next().hasClass('js-item')){
            $('.view-recommand-user').hide();
        }
        center.next().removeClass('right-side z-index-1 z-index-2').addClass('center-side z-index-2');
    });

    $(document).on('click','.view-recommand-user .user-item .center-side',function(){
        window.location.href = window.location.href;
    });

    $('.park-nav .park-nav-item').on({
        'mouseover':function(){
            if(!$(this).hasClass('current')){
                $(this).find('.park-nav-icon').addClass('hovered');
                $(this).find('.park-nav-marked').show();
                $(this).find('.box-icon').show();
            }
        },
        'mouseout':function(){
            if(!$(this).hasClass('current')){
                $(this).find('.park-nav-icon').removeClass('hovered');
                $(this).find('.park-nav-marked').hide();
                $(this).find('.box-icon').hide();
            }
        }
    });

    $('.topic-module-forum .topic-category li').on({
        'mouseover':function(){
            var currentBg = $(this).data('bg');
            $(this).addClass('bg-' + currentBg);
            $(this).find('.topic-cat-name').addClass('active');
        },
        'mouseout':function(){
            var currentBg = $(this).data('bg');
            $(this).removeClass('bg-' + currentBg);
            $(this).find('.topic-cat-name').removeClass('active');
        }
    });

    $('.recommand-user li').on({
        'mouseover':function(){
            $(this).addClass('hovered');
            $(this).find('.view-shadow').show();
        },
        'mouseout':function(){
            $(this).removeClass('hovered');
            $(this).find('.view-shadow').hide();
        }
    });

    $('.park-dating-list li').on({
        'mouseover':function(){
            $(this).addClass('hovered');
            $(this).find('.dating-list-response').addClass('hovered');
            $(this).find('.icon-response').addClass('hovered visit');
            $(this).find('.icon-response em').addClass('hovered');
        },
        'mouseout':function(){
            $(this).removeClass('hovered');
            $(this).find('.dating-list-response').removeClass('hovered');
            $(this).find('.icon-response').removeClass('hovered visit');
            $(this).find('.icon-response em').removeClass('hovered');
        }
    });

    $('.icon-response').on({
        'mouseover':function(){
            $(this).removeClass('visit');
            $(this).addClass('hovered');
        },
        'mouseout':function(){
            $(this).removeClass('hovered');
        }
    });

    $('.gift-list-box li').on({
        'mouseover':function(){
            $(this).find('.gift-item-desc-text').addClass('hovered');
        },
        'mouseout':function(){
            $(this).find('.gift-item-desc-text').removeClass('hovered');
        }
    });
    //$(document).on('click',function(){
    //    closeAllSelectFilter();
    //});

});

function closeAllSelectFilter()
{
    $('.condition-filter .select-filter').each(function (i, n) {
        if (!$(n).next('.folder-item').is(':hidden')) {
            $(n).children('.border-r-bg').show();
            $(n).next('.folder-item').hide();
            $(n).removeClass('border-bot-click');
            //discoverSelectFilterHover($(this));
            $(n).bind('mouseover', function () {
                discoverSelectFilterHover($(this));
            });
            $(n).bind('mouseout', function () {
                discoverSelectFilterOut($(this));
            });
            $(n).parents('.filter-parent').removeClass('fold-item-actived');
        }
    });
}

function discoverSelectFilterHover(obj)
{
    obj.children('.select-bg-arrows').removeClass('up-arrows white-arrows down-arrows').addClass('white-arrows');
    obj.addClass('select-bor-bg-hover');
    obj.children('.border-r-bg').addClass('border-r-bg-hover');
}

function discoverSelectFilterOut(obj)
{
    obj.children('.select-bg-arrows').removeClass('up-arrows white-arrows down-arrows').addClass('down-arrows');
    obj.removeClass('select-bor-bg-hover');
    obj.children('.border-r-bg').removeClass('border-r-bg-hover');
}

function discoverSelectFilterClick(obj)
{
    obj.children('.select-bg-arrows').removeClass('up-arrows white-arrows down-arrows').addClass('up-arrows');
    obj.removeClass('select-bor-bg-hover');
    obj.children('.border-r-bg').removeClass('border-r-bg-hover');
}
