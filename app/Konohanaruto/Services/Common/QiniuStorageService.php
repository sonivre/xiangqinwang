<?php
/**
 * Created by PhpStorm.
 * File: QiniuCloudService.php
 * User: konohanaruto
 * Blog: http://www.muyesanren.com
 * QQ: 1039814413
 * Wechat Number: wikitest
 * Date: 11/20/2017
 * Time: 12:01 AM
 */

namespace App\Konohanaruto\Services\Common;

use Qiniu\Storage\UploadManager;
use Qiniu\Auth;
use Qiniu\Http\Error as QiniuUploadError;
use App\Konohanaruto\Traits\Intranet\QiniuFileFormat;
use File;
use App\Konohanaruto\Services\Intranet\FileStorageServiceInterface;

class QiniuStorageService extends BaseService implements FileStorageServiceInterface
{
    protected $accessKey = null;
    protected $secretKey = null;
    protected $domain = null;
    protected $bucket = null;

    public function __construct()
    {
        $this->accessKey = env('QINIU_ACCESS_KEY');
        $this->secretKey = env('QINIU_SECRET_KEY');
        $this->bucket = env('QINIU_BUCKET');
        $this->domain = env('QINIU_DOMAIN');
    }

    public function pingTest()
    {
        $upManager = new UploadManager();
        $auth = new Auth($this->accessKey, $this->secretKey);
        $token = $auth->uploadToken($this->bucket);
        // 上传字符到七牛云
        //list($ret, $error) = $upManager->put($token, 'formput', 'hello world');
        $filePath = 'upload-demo-image.jpg';
        $key = 'demo.jpg';
        list($ret, $error) = $upManager->putFile($token, $key, $filePath);

        if ($error instanceof QiniuUploadError) {
            return false;
        }

        // return array($ret, $error);

        return $this->getFileDownloadLink($key);
    }

    public function formFileUpload($info)
    {
        $upManager = new UploadManager();
        $auth = new Auth($this->accessKey, $this->secretKey);
        $token = $auth->uploadToken($this->bucket);
        // 上传字符到七牛云
        //list($ret, $error) = $upManager->put($token, 'formput', 'hello world');
        list($ret, $error) = $upManager->putFile($token, $info['filename'], $info['pathname']);

        if ($error instanceof QiniuUploadError) {
            return false;
        }

        // return array($ret, $error);

        return $this->getFileDownloadLink($info['filename']);
    }

    public function getFileDownloadLink($filename)
    {
        $auth = new Auth($this->accessKey, $this->secretKey);
        // 私有空间中的外链 http://<domain>/<file_key>
        $baseUrl = "http://{$this->domain}/$filename";
        // 对链接进行签名
        $signedUrl = $auth->privateDownloadUrl($baseUrl);
        return $signedUrl;
    }
}