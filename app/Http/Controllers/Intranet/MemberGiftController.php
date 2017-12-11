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

use App\Http\Requests\Intranet\UploadGiftThumbFormRequest;
use App\Konohanaruto\Services\Intranet\GiftService;
use Illuminate\Http\Request;
use QiniuStorageService;

class MemberGiftController extends CoreController
{
    public $giftService;

    public function __construct(GiftService $giftService)
    {
        $this->giftService = $giftService;
    }

    public function actionList()
    {
        return view('intranet.pages.member_gift.list');
    }

    public function actionShowAddForm()
    {
        return view('intranet.pages.member_gift.add');
    }

    /**
     * @return json
     */
    public function uploadGiftThumb(UploadGiftThumbFormRequest $request)
    {
        if ($request->isMethod('post')) {
            $res = $this->giftService->uploadCoverPicture($request->file('gift_thumb'));
            $response = json_decode($res, true);

            if (! empty($response['img_url'])) {
                $response['img_url'] = config('custom.staticServer') . '/' . $response['img_url'];
            }

            return json_encode($response, JSON_UNESCAPED_SLASHES);
        }
    }
}