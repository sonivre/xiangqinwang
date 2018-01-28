<?php
/**
 * Created by PhpStorm.
 * User: konohanaruto
 * Blog: http://www.muyesanren.com
 * QQ: 1039814413
 * Wechat Number: wikitest
 * Date: 2018/1/26
 * Time: 20:03
 */

namespace App\Konohanaruto\Services\Frontend;

use SessionFront;
use Intervention\Image\Facades\Image;
use Redis;

class UserTrendsService extends BaseService
{
    public function getHotTags()
    {
        return [
            '初雪',
            '2018年',
            '暖心',
            '旅行青蛙',
            '时间是最好的答案'
        ];
    }

    public function attachedSpecification()
    {
        $specifications = [];
        // unit /kb
        $specifications['single_max_size'] = 8 * 1024; // 8M
        $specifications['single_min_size'] = 10; // 10kb
        $specifications['file_number_limit'] = 3; // 10kb

        return $specifications;
    }

    public function storeTempAttachedFileToCache($tmpFilePath)
    {
        $cacheKey = 'frontend:user:base64uploadtempfile';

        // format: 时间戳加上用户id
        $keyPrefix = uniqid() . SessionFront::getUserId();
        $data['lg' . $keyPrefix] = Image::make($tmpFilePath)->encode('data-url');
        $data['sm' . $keyPrefix] = Image::make($tmpFilePath)->fit(127)->encode('data-url');

        // 保存到redis
        Redis::connection('frontend')->hmset($cacheKey, $data);

        return $data;
    }
}