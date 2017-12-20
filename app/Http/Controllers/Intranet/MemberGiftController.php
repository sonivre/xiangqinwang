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
use App\Konohanaruto\Services\Intranet\GiftService;
use Illuminate\Http\Request;
use QiniuStorageService;
use App\Http\Requests\Intranet\MemberGift;

class MemberGiftController extends CoreController
{
    public $giftService;

    public function __construct(GiftService $giftService)
    {
        $this->giftService = $giftService;
    }

    public function actionList()
    {
        $list = $this->giftService->getAllGiftType();

        return view('intranet.pages.member_gift.list', ['list' => $list]);
    }

    public function actionShowAddForm()
    {
        return view('intranet.pages.member_gift.add');
    }

    public function store(MemberGift $request)
    {
        $result = $this->giftService->storeData($request->all());

        if ($result) {
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
        echo '<pre>';
        var_dump($request->all());
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