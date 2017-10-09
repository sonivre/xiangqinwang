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
use App\Konohanaruto\Infrastructures\Common\PasswordSecure;

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
            $provinces = array();
            $areas = array();
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
            $cities = $this->getCityListByProvinceCode($info['province']);

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

    public function getCityListByProvinceCode($provinceCode)
    {
        $data = DB::table('city')->select('name', 'code')->where('provincecode', $provinceCode)->get()->toArray();
        $result = array();
        foreach ($data as $item) {
            $result[$item->code] = $item->name;
        }
        return $result;
    }

    /**
     * @param $data
     * @return mixed
     */
    public function addUser($data)
    {
        $passwordSecure = app(PasswordSecure::class);
        $insert = [];
        $insert['username'] = $data['username'];
        $insert['email'] = $data['email'];
        $insert['gender'] = $data['gender'];
        $insert['birthyear'] = $data['birthyear'];
        $insert['birthmonth'] = $data['birthmonth'];
        $insert['birthday'] = $data['birthday'];
        $insert['salt'] = $passwordSecure->gernerateSalt();
        $insert['password'] = $passwordSecure->getEncryptPassword($data['password'], $insert['salt']);
        $insert['education'] = $data['education'];
        $insert['resideprovince'] = $data['resideprovince'];
        $insert['residecity'] = $data['residecity'];
        $insert['revenue'] = $data['revenue'];
        $insert['mobile'] = $data['mobile'];
        $insert['height'] = $data['height'];

        return DB::table('user')->insertGetId($insert);
    }

    /**
     * 更新用户信息
     *
     * @param $data
     * @param $where
     * @return mixed
     */
    public function updateUserDataByUserId($data, $userId)
    {
        return DB::table('user')->where('user_id', $userId)->update($data);
    }

}