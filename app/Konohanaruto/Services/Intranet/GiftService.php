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
use App\Konohanaruto\Traits\Intranet\QiniuFileFormat;
use File;

class GiftService extends BaseService
{

    public function __construct(QiniuFileFormat $qiniuFileFormat)
    {
        $this->qiniuFileFormat = $qiniuFileFormat;
    }
    /**
     * @param $file
     * @return mixed
     */
    public function uploadCoverPicture($file)
    {
        $info = [];
        $info['pathname'] = $file->getPathname();
        //$info['filename'] = $file->getClientOriginalName();
        $info['filename'] = $this->qiniuFileFormat->userAvatarImageKey() . '.' . File::extension($file->getClientOriginalName());
        $info['type'] = $file->getClientMimeType();
        $result = QiniuStorageService::formFileUpload($info);

        if ($result == false) {
            return ['img_url' => '', 'status' => -200];
        }

        return $this->qiniuFileFormat->userAvatarImageKey();
    }
}