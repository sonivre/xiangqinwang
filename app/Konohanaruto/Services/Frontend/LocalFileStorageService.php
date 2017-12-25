<?php
/**
 * Created by PhpStorm.
 * File: LocalFileStorageService.php
 * User: konohanaruto
 * Blog: http://www.muyesanren.com
 * QQ: 1039814413
 * Wechat Number: wikitest
 * Date: 12/24/2017
 * Time: 4:54 PM
 */

namespace App\Konohanaruto\Services\Frontend;

use \Curl\Curl;
use Log;

class LocalFileStorageService extends BaseService implements FileStorageServiceInterface
{
    private $uploadFileApi = 'http://image.xqw.test/upload.php';
    private $removeFileApi = 'http://image.xqw.test/remove.php';

    /**
     * 上传文件
     *
     * @param array $data
     * @return mixed
     */
    public function uploadFile($data = array())
    {
        // TODO: Implement uploadFile() method.

        // file的值必须是一个curlFile对象， upload_dir是上传文件目录
        if (empty($data['file'])  || empty($data['upload_dir'])) {
            return false;
        }

        $curl = new Curl();
        $curl->post($this->uploadFileApi, [
            'file' => $data['file'],
            'directory' => $data['upload_dir']
        ]);

        return $curl->error ? false : $curl->response;
    }

    public function removeFile($data = array())
    {
        // TODO: Implement removeFile() method.
    }

    /**
     * 返回服务器路径
     *
     * @return mixed
     */
    public function getServiceHost()
    {
        return config('custom.staticServer');
    }
}