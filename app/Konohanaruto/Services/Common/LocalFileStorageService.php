<?php
/**
 * Created by PhpStorm.
 * File: LocalFileStorageService.php
 * User: konohanaruto
 * Blog: http://www.muyesanren.com
 * QQ: 1039814413
 * Wechat Number: wikitest
 * Date: 12/10/2017
 * Time: 7:06 PM
 */

namespace App\Konohanaruto\Services\Common;

use App\Konohanaruto\Services\Intranet\FileStorageServiceInterface;
use \Curl\Curl;

class LocalFileStorageService extends BaseService implements FileStorageServiceInterface
{
    private $uploadFileApi = 'http://image.xqw.test/upload.php';
    private $removeFileApi = 'http://image.xqw.test/remove.php';

    /**
     * 上传文件
     *
     * @param $curlFileObject
     * @param $uploadDir
     * @return mixed 由于设置了RETURNTRANSFER，则在失败时返回false
     */
    public function formFileUpload($curlFileObject, $uploadDir)
    {
        $ch = curl_init($this->uploadFileApi);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, array(
            'file' => $curlFileObject,
            'directory' => $uploadDir,
        ));

        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }

    public function getServiceHost()
    {
        return config('custom.staticServer');
    }

    public function removeFile($filePath)
    {
        // reference: https://github.com/php-curl-class/php-curl-class
        $curl = new Curl();
        $curl->post($this->removeFileApi, ['file_name' => $filePath]);

        if ($curl->error) {
            return false;
            //echo 'Error: ' . $curl->errorCode . ': ' . $curl->errorMessage . "\n";
        }

        return $curl->response;
    }
}