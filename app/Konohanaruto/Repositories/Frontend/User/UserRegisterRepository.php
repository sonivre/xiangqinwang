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
        return DB::table('user')->select('user_id')->where('username', $username)->first();
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

    /**
     * 得到用户地址，根据用户ip
     *
     * @param string $ip
     * @return array province_id 省份 city_id 城市
     */
    public function getUserLocation($ip)
    {
        $data = getUserLocationByIp($ip);
        if ($data) {
            return array('province' => $data['region_id'], 'city' => $data['city_id']);
        }
        return false;
    }

    /**
     * 返回所有的省, 以及通过ip定位当前省的所有市和地区
     */
    public function getLocationSelectData($ip)
    {
        $info = $this->getUserLocation($ip);
        if ($info) {
            $data = DB::table('province')->select('name', 'code')->get();
            foreach ($data as $item) {
                $provinces[$item->code] = $item->name;
                if (! $info['province'] && $item->name == '北京市') {
                    $info['province'] = $item->code;
                }
            }
            if (! $info['city']) {
                $res = DB::table('city')->select('name', 'code')->where('provincecode', $info['province'])->first();
                $info['city'] = $res->code;
            }
            $data = DB::table('city')->select('name', 'code')->where('provincecode', $info['province'])->get()->toArray();
            foreach ($data as $item) {
                $cities[$item->code] = $item->name;
            }

            $data = DB::table('area')->select('name', 'code')->where('citycode', $info['city'])->get()->toArray();
            foreach ($data as $item) {
                $areas[$item->code] = $item->name;
            }

            return array(
                'province' => $provinces,
                'city' => $cities,
                'area' => $areas,
                'currentprovincecode' => $info['province'],
                'currentcitycode' => $info['city'],
            );
        }
        return array();
    }

}