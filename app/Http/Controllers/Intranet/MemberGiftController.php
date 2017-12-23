<?php
/**
 * Created by PhpStorm.
 * File: MemberGiftController.php
 * User: konohanaruto
 * Blog: http://www.muyesanren.com
 * QQ: 1039814413
 * Wechat Number: wikitest
 * Date: 11/5/2017
 * Time: 5:55 PM
 */

namespace App\Http\Controllers\Intranet;

use App\Http\Requests\Intranet\MemberGiftUpdate;
use App\Http\Requests\Intranet\UploadGiftThumbFormRequest;
use App\Konohanaruto\Providers\Intranet\FileStorageServiceProvider;
use App\Konohanaruto\Repositories\Intranet\MemberGiftType\MemberGiftTypeRepositoryInterface;
use App\Konohanaruto\Services\Intranet\GiftService;
use Illuminate\Http\Request;
use QiniuStorageService;
use App\Http\Requests\Intranet\MemberGift;
use App\Konohanaruto\Services\Intranet\FileStorageServiceInterface;

class MemberGiftController extends CoreController
{
    use \App\Konohanaruto\Traits\Intranet\FileStorage;

    public $giftService;
    private $giftTypeRepo;

    public function __construct(GiftService $giftService, MemberGiftTypeRepositoryInterface $giftTypeRepo)
    {
        $this->giftService = $giftService;
        $this->giftTypeRepo = $giftTypeRepo;

        parent::__construct();
    }

    public function actionList()
    {
        $list = $this->giftService->getAllGiftType();
        $removeRoute = url('intranet/MemberGift/delete');

        return view('intranet.pages.member_gift.list', ['list' => $list, 'removeRoute' => $removeRoute]);
    }

    public function actionShowAddForm()
    {
        return view('intranet.pages.member_gift.add');
    }

    public function store(MemberGift $request)
    {
        $result = $this->giftService->storeData($request->all());

        if ($result) {
            // 写入日志记录
            $this->writeAdminLog('添加了"' . $request->get('gift_name') . '"礼物类型');
            return redirect('intranet/MemberGift/list');
        }

        // reference: https://laravel.com/docs/5.4/redirects#redirecting-with-flashed-session-data

        // 使用with保存在session, blade中使用session访问
        return redirect()
            ->back()
            ->with('errorMsg', trans('message.insert_failed'))
            ->withInput($request->all());
    }

    public function showEditForm($actionId)
    {
        $detail = $this->giftService->getGiftInfo(intval($actionId));

        if (empty($detail)) {
            return redirect('intranet/MemberGift/list');
        }

        return view('intranet.pages.member_gift.edit', ['detail' => $detail]);
    }

    public function update(MemberGiftUpdate $request)
    {
        $result = $this->giftService->updateMemberGiftInfo($request->all());

        if ($result) {
            return redirect('intranet/MemberGift/list');
        }

        return redirect('intranet/MemberGift/showEditForm/' . $request->get('action_id'));
    }

    public function delete(Request $request)
    {
        // 我在客户端加上了accept请求头，表明接收一个json对象
        if ($request->ajax()) {
            $actionId = $request->get('action_id');
            $removeIds = explode(',', $actionId);

            if (empty($actionId) || empty($removeIds)) {
                return array('error' => '参数错误');
            }

            $removeDataList = $this->giftTypeRepo->getListByIds($removeIds);

            // 移除相关记录
            $affects = $this->giftTypeRepo->removeDataByIds($removeIds);

            // 写入管理员日志
            if ($affects) {
                foreach ($removeDataList as $item) {
                    // 删除图片
                    $this->safeRemoveFile(array($item['thumb_image_url'], $item['original_image_url']));
                    // 写入管理员日志
                    $logContent = '删除了"' . $item['gift_name'] . '"礼物';
                    $this->writeAdminLog($logContent);
                }
            }

            return array('rows' => $affects);
        }

        return array('code' => 400, 'errorMsg' => '非法请求');
    }

    /**
     * ajax图片上传
     *
     * @param UploadGiftThumbFormRequest $request
     * @return string
     */
    public function uploadGiftThumb(UploadGiftThumbFormRequest $request)
    {
        if ($request->isMethod('post')) {
            $res = $this->giftService->uploadCoverPicture($request->file('gift_thumb'));
            $response = json_decode($res, true);

            if (! empty($response['img_url'])) {
                $response['img_host'] = config('custom.staticServer');
            }

            return json_encode($response, JSON_UNESCAPED_SLASHES);
        }
    }
}