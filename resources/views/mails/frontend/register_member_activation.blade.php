<?php
/**
 * Created by PhpStorm.
 * File: register_member_activation.blade.php
 * User: konohanaruto
 * Blog: http://www.muyesanren.com
 * QQ: 1039814413
 * Wechat Number: wikitest
 * Date: 10/11/2017
 * Time: 5:52 PM
 */
?>
尊敬的<strong>{{$username}}</strong>，<br>
欢迎你注册成为相亲网的会员！<br>
请点击下面的链接进行帐号的激活：<br>
{{$activationUrl}}<br>
如果不能点击链接，请复制到浏览器地址输入框访问。<br>

相亲网<br>
{{date('Y-m-d H:i:s')}}
