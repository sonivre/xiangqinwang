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
        // $item是一个文件全路径，类似/tmp/1JK9sfdj等
//        foreach ($request->trendsFile as $item) {
//            return base64_encode(file_get_contents($item));
//        }

        return $this->userTrends->storeTempAttachedFileToCache($request->trendsFile[0]);
        // 由于我们每次只接收一张图片，所以如下即可
        //return base64_encode(file_get_contents($request->trendsFile[0]));
        //return $request->trendsFile[0]->getClientOriginalName();
    }
}