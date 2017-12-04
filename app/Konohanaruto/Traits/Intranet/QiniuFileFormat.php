<?php
/**
 * Created by PhpStorm.
 * User: konohanaruto
 * Blog: http://www.muyesanren.com
 * QQ: 1039814413
 * Wechat Number: wikitest
 * Date: 2017/12/3
 * Time: 12:18
 */

/**
 * 主要用于实现七牛云的图片命名规则
 */

namespace App\Konohanaruto\Traits\Intranet;

trait QiniuFileFormat
{
    public function userAvatarTempImageKey()
    {
        return 'Users/Avatar/Temp/' . date('Y-m-d') . '/' . $this->uniqueString();
    }

    public function uniqueString()
    {
        return uniqid();
    }
}