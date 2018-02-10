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

use App\Konohanaruto\Repositories\Frontend\MemberAlbum\MemberAlbumRepositoryInterface;
use App\Konohanaruto\Repositories\Frontend\MemberPicture\MemberPictureRepositoryInterface;
use App\Konohanaruto\Repositories\Frontend\MemberTrends\MemberTrendsRepositoryInterface;
use SessionFront;
use Intervention\Image\Facades\Image;
use Redis;
use Log;
use Request;

class UserTrendsService extends BaseService
{
    private $memberAlbum;
    private $memberPic;
    private $memberTrendsRepo;

    public function __construct(
        MemberAlbumRepositoryInterface $memberAlbum,
        MemberPictureRepositoryInterface $memberPic,
        MemberTrendsRepositoryInterface $memberTrendsRepo
    )
    {
        $this->memberAlbum = $memberAlbum;
        $this->memberPic = $memberPic;
        $this->memberTrendsRepo = $memberTrendsRepo;
    }

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

    /**
     * 发布trends
     *
     * @param $imageKeys
     * @param $content
     * @return mixed
     */
    public function publishTrends($imageKeys, $content)
    {
        $trendsData = [];
        $userId = SessionFront::getUserId();
        $parsedContent = $this->parseContent($content);
        // 为用户创建默认相册
        if (! empty($imageKeys)) {
            $albumInfo = $this->memberAlbum->checkTrendsAlbumById($userId);
            $trendsAlbumId = empty($albumInfo) ? $this->memberAlbum->createTrendsAlbum() : $albumInfo['album_id'];
            $picIds = $this->memberPic->storePublicTrendsImage($imageKeys, $trendsAlbumId);
        } else {
            $picIds = '';
        }

        // 构造数据
        $trendsData['user_id'] = $userId;
        $trendsData['pic_id'] = implode(',', $picIds);
        $trendsData['username'] = SessionFront::getUsername();
        $trendsData['tag_name'] = $parsedContent['tag'];
        $trendsData['content'] = $parsedContent['content'];
        $trendsData['client_type'] = Request::header('User-Agent');
        $trendsData['ip'] = Request::ip();
        $trendsId = $this->memberTrendsRepo->insertData($trendsData);

        if (! $trendsId) {
            Log::error('用户"' . $trendsData['username'] . '"发布个人动态失败！');

            return false;
        }

        return true;
    }

    /**
     * 得到trends存储临时文件目录
     *
     * @return string
     */
    public function getTrendsTempFileUploadDir()
    {
        return 'uploads/frontend/trends/' . SessionFront::getUserId() . '/' . date('Y-m-d');
    }

    /**
     * 解析内容，并返回tag和content
     *
     * @param $content
     * @return array
     */
    public function parseContent($content)
    {
        // 匹配#字符，直到第二次出现, 并返回他们所在的position
        $matches = preg_match_all('/#/', $content, $result, PREG_OFFSET_CAPTURE);
        $tag = '';

        if ($matches > 1) {
            $tag = trim(substr($content, $result[0][0][1], ($result[0][1][1] - $result[0][0][1]) + 1), '#');
        }

        return ['tag' => $tag, 'content' => $content];
    }
}