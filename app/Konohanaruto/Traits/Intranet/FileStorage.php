<?php
/**
 * Created by PhpStorm.
 * User: konohanaruto
 * Blog: http://www.muyesanren.com
 * QQ: 1039814413
 * Wechat Number: wikitest
 * Date: 2017/12/23
 * Time: 12:40
 */

namespace App\Konohanaruto\Traits\Intranet;

use App\Konohanaruto\Services\Intranet\FileStorageServiceInterface;
use Log;

trait FileStorage
{
    /**
     * 删除文件并写入日志，对于本地存储
     */
    public function safeRemoveFile($files)
    {
        $fileStorage = app(FileStorageServiceInterface::class);

        // 删除多个文件
        if (is_array($files)) {
            foreach ($files as $path) {
                $result = json_decode($fileStorage->removeFile($path), true);

                /**
                 * 将未能删除的垃圾图片资源，写入log系统
                 */
                if (! $result) {
                    Log::error('file path: ' . $path . ', error message: 删除图片请求失败!');
                } elseif($result['status'] == -200) {
                    Log::error('file path: ' . $path . ', error message: ' . $result['errorMsg']);
                }
            }

        } else { //删除单个文件
            $result = json_decode($fileStorage->removeFile($files), true);

            /**
             * 将未能删除的垃圾图片资源，写入log系统
             */
            if (! $result) {
                Log::error('file path: ' . $files . ', error message: 删除图片请求失败!');
            } elseif($result['status'] == -200) {
                Log::error('file path: ' . $files . ', error message: ' . $result['errorMsg']);
            }
        }


        return true;
    }
}