/**
 * Created by konohanaruto on 2017/4/1.
 */

    /**
     * @see http://rickharrison.github.io/validate.js
     */
    var validator = new FormValidator('register_step_one', [{
        name: 'username',
        rules: 'required|callback_check_username'
    }, {
        name: 'birthyear',
        rules: 'required'
    }, {
        name: 'birthmonth',
        rules: 'required'
    }, {
        name: 'birthday',
        rules: 'required'
    }, {
        name: 'height',
        rules: 'required'
    }, {
        name: 'education',
        rules: 'required'
    }, {
        name: 'resideprovince',
        rules: 'required'
    }, {
        name: 'residecity',
        rules: 'required'
    }, {
        name: 'revenue',
        rules: 'required'
    }, {
        name: 'mobile',
        rules: 'required|callback_check_mobile'
    }, {
        name: 'mobile_verify_code',
        rules: 'required'
    }, {
        name: 'license',
        rules: 'required'
    }], displayErrorMsgBox);

    /**
     * 注册自定义验证手机号规则, 此时按照文档，第一个参数前不需要加"callback_"
     */
    validator.registerCallback('check_mobile', function (value) {
        if(!(/^1[34578]\d{9}$/.test(value))){
            return false;
        }
    });

/**
 * 错误信息回调函数, 如果需要一次返回所有的错误，则需要验证的每个表单元素需要同时具备name和id属性, 缺一不可！
 * @param array|object errors 包含所有错误, 如果判断length > 0 , 每个验证失败的数组将包含四个javascript属性：
 * - id: 被验证的表单元素的id属性值
 * - name: 被验证表单元素的name属性值
 * - message: 错误提示字符串
 * - rule: 未能通过验证的具体失败规则类型
 * @param object event 如果浏览器支持，它将代表onsubmit事件对象被传递
 * @return void
 */
function displayErrorMsgBox(errors, event)
{
    if (errors.length > 0) {
//                var elementName = errors
        console.log(errors);
    }

}