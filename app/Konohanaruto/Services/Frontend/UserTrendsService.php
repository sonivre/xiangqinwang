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
    /**
     * 返回热门标签
     *
     * @return array
     */
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

    /**
     * 发布动态时的图片张数限制，以及单张文件大小配置等
     *
     * @return array
     */
    public function attachedSpecification()
    {
        $specifications = [];
        // unit /kb
        $specifications['single_max_size'] = 8 * 1024; // 8M
        $specifications['single_min_size'] = 10; // 10kb
        $specifications['file_number_limit'] = 3; // 允许的最大图片上传张数

        return $specifications;
    }

    /**
     * 存储发布动态时的临时文件存储到redis
     *
     * @param $tmpFilePath
     * @return mixed
     */
    public function storeTempAttachedFileToCache($tmpFilePath)
    {
        $cacheKey = 'frontend:user:base64uploadtempfile';

        // 格式，唯一字符串+userid+时间戳, 同时需要写一个脚本去过期它
        $keyPrefix = uniqid() . SessionFront::getUserId() . '-' . time();
        $data['lg' . $keyPrefix] = Image::make($tmpFilePath)->encode('data-url');
        $data['sm' . $keyPrefix] = Image::make($tmpFilePath)->fit(127)->encode('data-url');

        // 保存到redis
        Redis::connection('frontend')->hmset($cacheKey, $data);

        return $data;
    }

    /**
     * 删除trends发布时的缓存图片
     *
     * @param array $fields
     * @return integer 返回删除成功的记录数
     */
    public function removeTrendsTempFileFrom($fields = [])
    {
        $cacheKey = 'frontend:user:base64uploadtempfile';

        return Redis::connection('frontend')->hdel($cacheKey, $fields);
    }
}