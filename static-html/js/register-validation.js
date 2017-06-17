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
                    url: checkUserUrl,
                    data: "username=" + username + "&_token=" + csrfToken,
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
        if ($(this).attr('name') == 'birthyear') {
            if ($("select[name=birthmonth]").val()) {
                refreshCorrentDays($(this).val(), $("select[name=birthmonth]").val());
            }
        }
        if ($(this).attr('name') == 'birthmonth') {
            //console.log($("input[name=birthyear]").val());
            if ($("select[name=birthyear]").val()) {
                refreshCorrentDays($("select[name=birthyear]").val(), $(this).val());
            }
        }
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
        // ajax二级联动
        if ($(this).attr('name') == 'resideprovince') {
            var provinceCode = $(this).val();
            $.ajax({
                context: $(this),
                type: "GET",
                url: getCitiesUrl + '/' + provinceCode,
                success: function (response) {
                    var content = '';
                    if (response.status == 200) {
                        for (var i in response.data) {
                            if (content == '') {
                                var isSelected = ' selected ';
                            } else {
                                var isSelected = '';
                            }
                            content += '<option' + isSelected + ' value="' + i + '">' + response.data[i] + '</option>';
                        }
                        $('select[name=residecity]').html(content);
                    }
                }
            });
        }
        if (! checkSelectChecked($(".reside-area"))) {
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
        if (! checkSelectChecked($('.birth'))) {
            $(".birth").trigger('change');
        }
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

        //agree-checkbox
        if (! $('.agree-checkbox').is(':checked')) {
            alert('您必须同意注册协议！');
            event.preventDefault();
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

function refreshCorrentDays(currentYear, currentMonth)
{
    $.ajax({
        context: $(this),
        type: "GET",
        url: getDaysUrl + '/' + currentYear + '/' + currentMonth,
        success: function (response) {
            if (response.status == 200) {
                var days = response.data;
                var birthDaySelect = $("select[name=birthday]");
                birthDaySelect.html('');
                birthDaySelect.append('<option disabled selected value="">日</option>');
                var content = '';
                for (var i = 1; i <= days; i++) {
                    content += '<option value="'+ i +'">'+ i +'</option>';
                }
                birthDaySelect.append(content);
            }
        }
    });
}