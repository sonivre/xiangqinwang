<?php
/**
 * Created by PhpStorm.
 * User: konohanaruto
 * Blog: http://www.muyesanren.com
 * QQ: 1039814413
 * Wechat Number: wikitest
 * Date: 2017/10/16
 * Time: 20:27
 */

namespace App\Http\Controllers\Frontend;

use App\Http\Requests\Frontend\TrendsAttachedFilesFromRequest;
use App\Konohanaruto\Services\Frontend\UserTrendsService;
use Illuminate\Http\Request;
use App\Konohanaruto\Services\Frontend\UserService;
use SessionFront;
use App\Http\Requests\Frontend\RemoveTrendsAttachedFilesFromRequest;

class MemberRecommendController extends BasicController
{
    private $userSerivce;
    private $userTrends;

    public function __construct(UserService $userService, UserTrendsService $userTrends)
    {
        $this->userSerivce = $userService;
        $this->userTrends = $userTrends;
    }

    public function actionHome()
    {
        $userId = SessionFront::getUserId();
        $userInfo = $this->userSerivce->getUserBaseInfoById($userId);
        // 热门标签
        $hotTags = $this->userTrends->getHotTags();
        // 附件相关限制的配置
        $attachedSpecification = $this->userTrends->attachedSpecification();

        return view('frontend.pages.authed.home', [
            'userInfo' => $userInfo,
            'hotTags' => $hotTags,
            'attachedSpecification' => $attachedSpecification,
        ]);
    }

    public function uploadTrendsAttachedImage(TrendsAttachedFilesFromRequest $request)
    {
        return $this->userTrends->storeTempAttachedFileToCache($request->trendsFile[0]);
    }

    public function removeTrendsAttachedImage(RemoveTrendsAttachedFilesFromRequest $request)
    {
        $tempFiles = $request->get('tmpImageFile');

        return $this->userTrends->removeTrendsTempFileFrom($tempFiles);
    }

    public function publishTrends(Request $request)
    {
        $imageKeys = $request->get('imageKeys');
        $content = $request->get('content', '');

        if (! empty($imageKeys)) {
            // 插入到用户图片表
            return $this->userTrends->publishTrends($imageKeys, $content);
        }
    }
}