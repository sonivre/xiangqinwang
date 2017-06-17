<?php
/**
 * Created by PhpStorm.
 * User: konohanaruto
 * Date: 2017/4/11
 * Time: 18:56
 */

/**
 * 处理专用的ajax请求接口
 */

namespace App\Http\Controllers\Tools;
use App\Konohanaruto\Exceptions\Frontend\NotFoundException;
use App\Konohanaruto\Repositories\Frontend\User\UserRepository;
use Illuminate\Http\Request;
use App\Konohanaruto\Infrastructures\Common\BirthDate;

class PocketController
{
    private $registerRepo;

    public function __construct(UserRepository $userRegister)
    {
        $this->registerRepo = $userRegister;
    }

    public function getDaysByYearMonth(Request $request, $year, $month)
    {
        if ($request->ajax()) {
            $data = array();
            try {
                $birthDate = new BirthDate();
                $data['data'] = $birthDate->getDays($year, $month);
                $data['status'] = 200;
            } catch(\Exception $e) {
                $data['status'] = 404;
                $data['detail'] = $e->getMessage();
            }
            return response()->json($data);
        }
        throw new NotFoundException;
    }

    public function getCitiesByProvinceCode(Request $request, $provinceCode)
    {
        if ($request->ajax()) {
            $data = $this->registerRepo->getCityListByProvinceCode($provinceCode);
            return response()->json(array('status' => 200, 'data' => $data));
        }
        throw new NotFoundException;
    }
}