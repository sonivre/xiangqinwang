<?php
/**
 * Created by PhpStorm.
 * User: konohanaruto
 * Blog: http://www.muyesanren.com
 * QQ: 1039814413
 * Wechat Number: wikitest
 * Date: 2018/2/5
 * Time: 19:41
 */

namespace App\Konohanaruto\Helpers;

class FileHelper
{
    /**
     * 根据base64字符串得到文件类型, jpeg, jpg, png, gif等
     *
     * @param $baseString
     * @return mixed
     */
    public function detectImageExtensionFromBase64($baseString)
    {
        $reg = '/image\/(.*);base64,/';

        if (preg_match($reg, $baseString, $match) && ! empty($match[1])) {
            return $match[1];
        }

        // 没有文件识别头的base64字符串
        $fileObject = finfo_open();
        $mimeType = finfo_buffer($fileObject, base64_decode($baseString), FILEINFO_MIME_TYPE);

        return str_replace('image/', '', $mimeType);
    }
}