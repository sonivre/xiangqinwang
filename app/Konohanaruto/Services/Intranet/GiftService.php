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

use Request;
use File;
use App\Konohanaruto\Services\Intranet\FileStorageServiceInterface;

class GiftService extends BaseService
{
    use \App\Konohanaruto\Traits\Intranet\QiniuFileFormat;

    private $redisData;
    private $fileStorageService;

    public function __construct(
        RedisDataService $redisData,
        FileStorageServiceInterface $fileStorageService
    )
    {
        $this->redisData = $redisData;
        $this->fileStorageService = $fileStorageService;
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
        $info['filename'] = $this->userAvatarTempImageKey() . '.' . File::extension($file->getClientOriginalName());
        $info['type'] = $file->getClientMimeType();
        $result = $this->fileStorageService->formFileUpload($info);

        if ($result == false) {
            return ['img_url' => '', 'status' => -200];
        }

        return ['img_url' => $result, 'status' => 200];
    }
}