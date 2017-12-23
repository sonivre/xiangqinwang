<?php
/**
 * Created by PhpStorm.
 * File: GiftService.php
 * User: konohanaruto
 * Blog: http://www.muyesanren.com
 * QQ: 1039814413
 * Wechat Number: wikitest
 * Date: 11/26/2017
 * Time: 6:22 PM
 */

namespace App\Konohanaruto\Services\Intranet;

use App\Konohanaruto\Repositories\Intranet\MemberGiftType\MemberGiftTypeRepositoryInterface;
use Request;
use File;
use App\Konohanaruto\Services\Intranet\FileStorageServiceInterface;
use Intervention\Image\Facades\Image;
use App\Konohanaruto\Facades\Intranet\SessionService as SessionAccess;
use Log;

class GiftService extends BaseService
{
    use \App\Konohanaruto\Traits\Intranet\QiniuFileFormat;
    use \App\Konohanaruto\Traits\Intranet\FileStorage;

    private $redisData;
    private $fileStorageService;
    private $giftTypeRepo;
    private $uploadDir = 'uploads/intranet/member_gift_setting';

    public function __construct(
        RedisDataService $redisData,
        FileStorageServiceInterface $fileStorageService,
        MemberGiftTypeRepositoryInterface $giftTypeRepo
    )
    {
        $this->redisData = $redisData;
        $this->fileStorageService = $fileStorageService;
        $this->giftTypeRepo = $giftTypeRepo;
    }

    /**
     * @param $file
     * @return mixed
     */
    public function uploadCoverPicture($file)
    {
//        $info = [];
//        $info['pathname'] = $file->getPathname();
//        //$info['filename'] = $file->getClientOriginalName();
//        $info['filename'] = $this->userAvatarTempImageKey() . '.' . File::extension($file->getClientOriginalName());
//        $info['type'] = $file->getClientMimeType();
//        $result = $this->fileStorageService->formFileUpload($info);
//
//        if ($result == false) {
//            return ['img_url' => '', 'status' => -200];
//        }
//
//        return ['img_url' => $result, 'status' => 200];
        $extension = '.' . File::extension($file->getClientOriginalName());
        $savedName = uniqid() . $extension;
        $stream = curl_file_create($file->getPathname(), $file->getClientMimeType(), $savedName);
        $uploadDir = $this->uploadDir . '/' . date('Y-m-d');

        return $this->fileStorageService->formFileUpload($stream, $uploadDir);
    }

    /**
     * 插入记录到member_gift_type表
     *
     * @return mixed
     */
    public function storeData($info)
    {
        // 得到缩略图路径
        $thumbFileName = $this->getThumbImage($info);

        if (empty($thumbFileName)) {
            return false;
        }

        $formCrop = json_decode($info['gift_image_info'], true);

        // 构建保存的数据数组
        $data = array();
        $data['gift_name'] = $info['gift_name'];
        $data['htb'] = $info['htb'];
        $data['htb'] = $info['htb'];
        $data['is_vip'] = $info['is_vip'];
        $data['is_valid'] = $info['is_valid'];
        $data['action_admin_id'] = SessionAccess::getUserId();
        $data['thumb_image_url'] = $thumbFileName;
        $data['original_image_url'] = $formCrop['img_url'];

        return $this->giftTypeRepo->storeGift($data);
    }

    /**
     * 得到图片缩略图路径
     *
     * @param $info
     * @return mixed 成功时返回图片路径，失败时返回false
     */
    public function getThumbImage($info)
    {
        $formCrop = json_decode($info['gift_image_info'], true);
        $cropInfo = array();

        $imagePath = $formCrop['img_host'] . '/' . $formCrop['img_url'];
        $cropInfo['width'] = $formCrop['cropWidth'];
        $cropInfo['height'] = $formCrop['cropHeight'];
        $cropInfo['x'] = $formCrop['cropX'];
        $cropInfo['y'] = $formCrop['cropY'];
        $thumbLocalTempFileName = $this->cropGiftImage($imagePath, $cropInfo);

        if (! $thumbLocalTempFileName) {
            return false;
        }

        // 上传到指定存储服务
        $imageInfo = getimagesize($thumbLocalTempFileName);
        $extension = '.' . pathinfo($thumbLocalTempFileName, PATHINFO_EXTENSION);
        $mimeType = image_type_to_mime_type($imageInfo[2]);
        $savedName = uniqid() . $extension;
        $stream = curl_file_create($thumbLocalTempFileName, $mimeType, $savedName);
        $uploadDir = $this->uploadDir . '/' . date('Y-m-d');

        $result = $this->fileStorageService->formFileUpload($stream, $uploadDir);

        if (! $result) {
            return false;
        }

        // 解析服务端响应，得到最终的图片路径
        $result = json_decode($result, true);
        $thumbFileName = $result['img_url'];
        // 删除临时文件
        @unlink($thumbLocalTempFileName);

        return $thumbFileName;
    }

    /**
     * 裁剪图片，保存到临时缓存目录，并返回该临时图片地址
     *
     * @param $imagePath
     * @param $cropInfo
     * @return bool
     */
    public function cropGiftImage($imagePath, $cropInfo)
    {
        $storageDir = $this->getImageCachePath();
        $extension = pathinfo($imagePath, PATHINFO_EXTENSION);
        $saveFileName = $storageDir . '/' . uniqid() . '.' . $extension;

        // 不存在则尝试去创建目录
        if (! is_dir(dirname($saveFileName))) {
            mkdir(dirname($saveFileName), 0777, true);
        }

        $result = Image::make($imagePath)
            ->crop($cropInfo['width'], $cropInfo['height'], $cropInfo['x'], $cropInfo['y'])
            ->save($saveFileName);

        return $result ? $saveFileName : false;
    }

    /**
     * 返回图片缓存目录
     *
     * @return string
     */
    public function getImageCachePath()
    {
        if (! empty($this->cropImageCachePath)) {
            return $this->cropImageCachePath;
        }

        return storage_path('framework/cache/image/' . date('Y-m-d'));
    }

    /**
     * 返回礼物类型列表
     *
     * @return array
     */
    public function getAllGiftType()
    {
        $list = $this->giftTypeRepo->getAll();

        foreach ($list as $key => $item) {
            $list[$key]['thumb_image_url'] = $this->fileStorageService->getServiceHost() . '/' . $item['thumb_image_url'];
            $list[$key]['original_image_url'] = $this->fileStorageService->getServiceHost() . '/' . $item['original_image_url'];
        }

        return $list;
    }

    /**
     * 返回礼物详细信息
     *
     * @param $id
     * @return mixed
     */
    public function getGiftInfo($id)
    {
        $detail = $this->giftTypeRepo->getDetailById($id);

        if (! empty($detail['original_image_url'])) {
            $detail['original_image_url'] = $this->fileStorageService->getServiceHost() . '/' . $detail['original_image_url'];
        }

        return $detail;
    }

    /**
     * 完成member gift更新logic
     *
     * @param $formData
     * @return mixed
     */
    public function updateMemberGiftInfo($formData)
    {
        $data = [];

        // 上传了新图片
        if (! empty($formData['gift_image_info'])) {
            $thumbFileName = $this->getThumbImage($formData);

            // 图片裁剪失败
            if (! $thumbFileName) {
                return false;
            }

            $formCrop = json_decode($formData['gift_image_info'], true);
            $data['thumb_image_url'] = $thumbFileName;
            $data['original_image_url'] = $formCrop['img_url'];

            // 查询数据库，得到之前的图片
            $detail = $this->giftTypeRepo->getDetailById($formData['action_id']);
            $oldOriginalImage = $detail['original_image_url'];
            $oldThumbImage = $detail['thumb_image_url'];

            // 在保存完成之后，删除之前的图片
        }

        $data['gift_name'] = $formData['gift_name'];
        $data['htb'] = $formData['htb'];
        $data['is_vip'] = $formData['is_vip'];
        $data['is_valid'] = $formData['is_valid'];
        $data['action_admin_id'] = SessionAccess::getUserId();
        $data['action_id'] = $formData['action_id'];

        $status = $this->giftTypeRepo->updateData($data);

        if ($status !== false) {
            // 删除原始图片
            if (isset($oldOriginalImage) && $oldThumbImage) {
                $this->safeRemoveFile(array($oldOriginalImage, $oldThumbImage));
            }

            return true;
        }

        return false;
    }
}