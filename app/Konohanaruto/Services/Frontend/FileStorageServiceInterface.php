<?php
/**
 * Created by PhpStorm.
 * File: FileStorageServiceInterface.php
 * User: konohanaruto
 * Blog: http://www.muyesanren.com
 * QQ: 1039814413
 * Wechat Number: wikitest
 * Date: 12/24/2017
 * Time: 4:50 PM
 */

namespace App\Konohanaruto\Services\Frontend;

interface FileStorageServiceInterface
{
    public function uploadFile($data = array());

    public function removeFile($data = array());
}