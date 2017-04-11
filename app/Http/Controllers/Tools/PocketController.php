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
use Illuminate\Http\Request;
use App\Konohanaruto\Infrastructures\Common\BirthDate;

class PocketController
{

    public function getDaysByYearMonth(Request $request)
    {
        if ($request->ajax()) {
            $year = $request->get('year');
            $month = $request->get('month');
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
}