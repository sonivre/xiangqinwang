<?php
/**
 * Created by PhpStorm.
 * User: konohanaruto
 * Date: 2017/4/11
 * Time: 18:37
 */

/**
 * 生成年月日下拉框数据
 */
namespace App\Konohanaruto\Infrastructures\Common;

class BirthDate
{
    private $startYear = 1901;
    private $endYear;

    public function __construct($startYear = 0, $endYear = 0)
    {
        $startYear = intval($startYear);
        $endYear = intval($endYear);

        if ($startYear) {
            $this->startYear = $startYear;
        }


        if ($endYear) {
            $this->endYear = $endYear;
        } else {
            $this->endYear = date('Y');
        }

        if ($this->startYear > $this->endYear) {
            throw new Exception('结束年份不能小于开始年份');
        }
    }

    public function getYearList()
    {
        $yearList = array();
        for ($year = $this->startYear; $year <= $this->endYear; $year++) {
            array_push($yearList, $year);
        }
        return $yearList;
    }

    public function getMonthList()
    {
        $monthList = array();
        for ($month = 1; $month <= 12; $month++) {
            array_push($monthList, $month);
        }
        return $monthList;
    }

    public function getDays($year = 0, $month = 0)
    {
        $year = intval($year);
        $month = intval($month);
        if (! $year && ! $this->checkMonth($month)) {
            return 31;
        }
        if (! $year || ! $this->checkMonth($month)) {
            throw new \Exception('参数错误');
        }

        switch ($month) {
            case 1:
            case 3:
            case 5:
            case 7:
            case 8:
            case 10:
            case 12:
                $days = 31;
                break;
            case 4:
            case 6:
            case 9:
            case 11:
                $days = 30;
                break;
            case 2:
                // 判断平年或闰年
                if ($year %4 == 0 && $year % 100 != 0 || $year % 400 == 0) {
                    $days = 29;
                } else {
                    $days = 28;
                }
                break;
            default:
                throw new \Exception('月份输入错误');
        }
        return $days;
    }

    private function checkMonth($month)
    {
        return ($month >= 1 && $month <= 12) ? true : false;
    }
}