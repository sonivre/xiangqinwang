<?php
/**
 * Created by PhpStorm.
 * File: UserRegisterConfig.php
 * User: konohanaruto
 * Blog: http://www.muyesanren.com
 * QQ: 1039814413
 * Wechat Number: wikitest
 * Date: 9/26/2017
 * Time: 12:37 AM
 */

namespace App\Konohanaruto\Infrastructures\Frontend;

use App\Konohanaruto\Repositories\Intranet\Education\EducationRepositoryInterface;
use App\Konohanaruto\Repositories\Intranet\RegisterRevenue\RegisterRevenueRepositoryInterface;

class UserRegisterConfig
{
    private $educationRepo;

    private $revenueRepo;

    public function __construct(EducationRepositoryInterface $educationRepo,
                                RegisterRevenueRepositoryInterface $revenueRepo)
    {
        $this->educationRepo = $educationRepo;
        $this->revenueRepo = $revenueRepo;
    }

    public function getEducationList()
    {
        return $this->educationRepo->getEducationList();
    }

    public function getRevenueList()
    {
        return $this->revenueRepo->getList();
    }
}