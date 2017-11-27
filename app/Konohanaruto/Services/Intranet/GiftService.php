<?php
/**
 * Created by PhpStorm.
 * File: GiftService.php
 * User: konohanaruto
 * Blog: http://www.muyesanren.com
 * QQ: 1039814413
 * Wechat Number: wikitest
 * Date: 11/26/2017
 * Time: 6:22 PM
 */

namespace App\Konohanaruto\Services\Intranet;

use App\Konohanaruto\Facades\Common\QiniuStorage;
use QiniuStorageService;
use Request;

class GiftService extends BaseService
{
    /**
     * @param $file
     * @return mixed
     */
    public function uploadCoverPicture($file)
    {
        $info = [];
        $info['pathname'] = $file->getPathname();
        $info['filename'] = $file->getClientOriginalName();
        $info['type'] = $file->getClientMimeType();

        return QiniuStorageService::formFileUpload($info);
    }
}