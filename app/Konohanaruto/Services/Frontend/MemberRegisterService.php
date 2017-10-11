<?php
/**
 * Created by PhpStorm.
 * User: konohanaruto
 * Blog: http://www.muyesanren.com
 * QQ: 1039814413
 * Wechat Number: wikitest
 * Date: 2017/9/30
 * Time: 9:27
 */

namespace App\Konohanaruto\Services\Frontend;
use UserUniversalData;
use Illuminate\Support\Facades\Redis;
use App\Konohanaruto\Repositories\Frontend\MobileVerifyCode\MobileVerifyCodeRepositoryInterface;
use Log;
use App\Konohanaruto\Jobs\Frontend\MobileVerifyCode;
use App\Konohanaruto\Repositories\Frontend\User\UserRepository;
use Illuminate\Support\Facades\Session;
use App\Konohanaruto\Repositories\Frontend\MemberAlbum\MemberAlbumRepositoryInterface;
use Image;
use Request;
use App\Konohanaruto\Repositories\Frontend\MemberPicture\MemberPictureRepositoryInterface;

class MemberRegisterService extends BaseService
{

    /**
     * @param $mobile
     * @return mixed
     */
    public function getSMSInfoByDB($mobile)
    {
        $mobileRepo = app(MobileVerifyCodeRepositoryInterface::class);
        return $mobileRepo->getInfoByMobile($mobile);
    }

    /**
     * @param $mobile
     * @return mixed
     */
    public function getSMSInfoByRedis($mobile)
    {
        $hashKey = config('custom.REDIS_MOBILE_CODE_KEY');
        return json_decode(Redis::hget($hashKey, $mobile), true);
    }

    /**
     * 验证是否可以重新请求手机验证码
     *
     * @param $sendDateTime
     * @return bool
     */
    public function retryVerifyCodeCheck($sendDateTime)
    {
        $retryValidTime = strtotime($sendDateTime) + config('custom.MOBILE_CODE_REFETCH_INTERVAL');
        return ($retryValidTime > time()) ? false : true;
    }

    /**
     * 发送短信验证码
     *
     * @param $mobile
     * @return bool
     */
    public function sendShortMessage($mobile)
    {
        $hashKey = config('custom.REDIS_MOBILE_CODE_KEY');

        $data = array();
        $data['agent'] = UserUniversalData::getUserAgent();
        $data['mobile_number'] = $mobile;
        $data['code'] = UserUniversalData::getMobileVerifyCode();
        $data['type'] = config('custom.MOBILE_CODE_TYPE.T1');
        $data['add_time'] = date('Y-m-d H:i:s');
        $data['expire_time'] = date('Y-m-d H:i:s', strtotime($data['add_time']) + config('custom.MOBILE_CODE_EXPIRE'));

        // redis
        // 关于hset的返回值，新插入成功将是1，更新为0，失败为false
        $status = Redis::hset($hashKey, $data['mobile_number'], json_encode($data, JSON_UNESCAPED_SLASHES));

        if ($status === false) {
            Log::warning(trans('register_service.mobile_code_redis_failed'));
            return false;
        }

        // mysql
        $mobileRepo = app(MobileVerifyCodeRepositoryInterface::class);
        $status = $mobileRepo->replaceDataByMobile($mobile, $data);

        if (! $status) {
            Log::warning(trans('mobile_code_db_failed'));
        }

        // 队列操作
        $job = (new MobileVerifyCode($data['mobile_number'], $data['code']))
            ->onQueue(config('custom.REDIS_MOBILE_CODE_QUEUE'));
        dispatch($job);

        // 记录队列操作
        Log::info(trans('register_service.mobile_code_queue_running'));

        return true;
    }


    /**
     * 得到注册时短信验证码
     *
     * @param $mobile
     * @return bool
     */
    public function getLatestValidMobileCode($mobile)
    {
        // redis
        $hashKey = config('custom.REDIS_MOBILE_CODE_KEY');
        $data = Redis::hget($hashKey, $mobile);
        if (empty($data['code'])) {
            // mysql
            $mobileRepo = app(MobileVerifyCodeRepositoryInterface::class);
            $data = $mobileRepo->getInfoByMobile($mobile);
        }

        if (empty($data['code'])) {
            return false;
        }

        return $data['code'];
    }

    /**
     * 会员头像上传
     *
     * @param $request
     * @return array
     */
    public function uploadAvatar($request)
    {
        $file = $request->file('avatar');

        if (empty($file)) {
            return array('status' => '-200');
        }

        $path = 'avatar/' . date('Ymd');
        $imagePath = $file->store($path, 'uploads');

        if (! empty($imagePath)) {
            $fullPath = config('custom.staticServer') . '/uploads/' . $imagePath;
            // 将图片路径写入session
            session('register.userinfo.avatar', $imagePath);

            return array(
                'msg' => array(
                    'src' => $fullPath,
                    'relationPath' => $imagePath
                )
            );
        }
        return array('status' => '-200');
    }

    /**
     * 添加用户
     *
     * @param array $data
     * @return array
     */
    public function addUser($data = [])
    {
        if (empty($data)) {
            Log::info('新用户注册失败');
            return ['status' => -200];
        }

        $userRepo = app(UserRepository::class);
        $userId = $userRepo->addUser($data);

        if ($userId) {
            Log::info('添加了新用户：' . $data['username']);
            Session::put('register.userinfo', [
                'user_id' => $userId,
                'username' => $data['username']
            ]);
            return ['status' => 200];
        }

        Log::info('新用户注册写入数据库失败');

        return ['status' => -200];
    }

    /**
     * 创建相册
     *
     * @param $albumName 相册名称
     * @param $userId 用户id
     * @param $username 用户名
     * @return mixed
     */
    public function createMemberAlbum($albumName, $userId, $username)
    {
        $memberAlbumRepo = app(MemberAlbumRepositoryInterface::class);

        $albumId = $memberAlbumRepo->insertData([
            'album_name' => $albumName,
            'user_id' => $userId,
            'username' => $username
        ]);

        return $albumId;
    }

    public function storeUserAvatar($userId, $username, $albumId, $avatarPath)
    {
        $avatarFullPath = config('custom.staticServer') . '/uploads/' . $avatarPath;
        $userRepo = app(UserRepository::class);
        $userRepo->updateUserDataByUserId(['avatar' => $avatarPath], $userId);

        $memberPictureRepo = app(MemberPictureRepositoryInterface::class);

        // 得到图片的一些基本信息
        $avatarInfo = explode('.', substr($avatarPath, strrpos($avatarPath, '/')+1));
        // 必须在本机hosts中添加对应域名映射
        $fileHeaders = get_headers($avatarFullPath, 1);

        $picture = [];
        $picture['file_name'] = $avatarInfo[0];
        $picture['file_type'] = $avatarInfo[1];
        $picture['file_size'] = empty($fileHeaders['Content-Length']) ? 0 : $fileHeaders['Content-Length'];
        $picture['is_remote'] = 1;
        $picture['file_path'] = $avatarPath;
        $picture['user_id'] = $userId;
        $picture['username'] = $username;
        $picture['album_id'] = $albumId;
        $picture['action_ip'] = Request::ip();
        //审核状态，0待审核
        $picture['status'] = 0;

        // 插入到用户头像表，并且属于头像相册表中
        return $memberPictureRepo->insertData($picture);
    }
}