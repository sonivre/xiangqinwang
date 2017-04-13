<?php
/**
 * Created by PhpStorm.
 * User: konohanaruto
 * Date: 2017/4/6
 * Time: 19:24
 */

namespace App\Konohanaruto\Repositories\Frontend\User;
use Illuminate\Support\Facades\DB;
use App\Konohanaruto\Infrastructures\Common\BirthDate;

class UserRegisterRepository implements UserRepository
{
    /**
     * @param $userId
     * @return 用户信息
     */
    public function find($userId)
    {
        // TODO: Implement find() method.
    }

    public function getUserList()
    {
        // TODO: Implement getUserList() method.
    }

    /**
     * @param $username
     * @return mixed
     */
    public function getUserInfoByName($username)
    {
        return DB::table('xqw_user')->select('user_id')->where('username', $username)->first();
    }

    /**
     * 验证用户是否存在
     * @param String $username
     * @return boolean true|false
     */
    public function checkUserExists($username)
    {
        $info = $this->getUserInfoByName($username);
        if (! empty($info->user_id)) {
            return false;
        }
        return true;
    }

    public function getBirthSelectData()
    {
        $birthDate = new BirthDate();
        $data = array();
        try {
            $data['year'] = $birthDate->getYearList();
            $data['month'] = $birthDate->getMonthList();
            $data['day'] = 31;
        } catch (\Exception $e) {
        }
        return $data;
    }

    public function getHeightSelectData()
    {
        $heightFillData = array();
        $startHeight = config('operation.registerHeightSelect.startHeight');
        $endHeight = config('operation.registerHeightSelect.endHeight');
        for ($i = $startHeight; $i <= $endHeight; $i++) {
            array_push($heightFillData, $i);
        }
        return $heightFillData;
    }

    /**
     * 得到学历数据
     *
     * @param void
     * @return array
     */
    public function getEducationSelectData()
    {
        if (config('operation.educationLevel')) {
            return config('operation.educationLevel');
        }
        return array();
    }

    /**
     * 得到收入下拉框数据
     *
     * @param void
     * @return array
     */
    public function getRevenueSelectData()
    {
        if (config('operation.revenueLevel')) {
            return config('operation.revenueLevel');
        }
        return array();
    }
}