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
     *
     * @bugs
     * @link https://stackoverflow.com/questions/7620910/regexp-in-preg-match-function-returning-browser-error
     * description:
     * 图片的base64字符串过大，导致正则匹配失败
     *
     * Stacksize   pcre.recursion_limit
     *   64 MB      134217
     *   32 MB      67108
     *   16 MB      33554
     *   8 MB       16777
     *   4 MB       8388
     *   2 MB       4194
     *   1 MB       2097
     *   512 KB     1048
     *   256 KB     524
     */
    public function detectImageExtensionFromBase64($baseString)
    {
        if ($firstPos = strpos($baseString, ';base64,')) {
            return str_replace('data:image/', '', substr($baseString, 0, $firstPos));
        }

        // 没有文件识别头的base64字符串
        $fileObject = finfo_open();
        $mimeType = finfo_buffer($fileObject, base64_decode($baseString), FILEINFO_MIME_TYPE);

        return str_replace('image/', '', $mimeType);
    }
}