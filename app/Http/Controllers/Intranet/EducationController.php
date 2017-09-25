<?php

namespace App\Http\Controllers\Intranet;

use App\Http\Requests\Intranet\EducationCreateFormRequest;
use App\Konohanaruto\Repositories\Intranet\Education\EducationRepositoryInterface;

class EducationController extends CoreController
{

    private $education;

    public function __construct(EducationRepositoryInterface $education)
    {
        $this->education = $education;
        parent::__construct();
    }

    public function actionList()
    {
        $eduList = $this->education->getEducationList();
        return view('intranet.pages.education_list', array('list' => $eduList));
    }

    public function actionShowAddForm()
    {
        return view('intranet.pages.education_add');
    }

    public function actionStore(EducationCreateFormRequest $request)
    {
        $insertStatus = $this->education->storeData($request->all());

        if ($insertStatus) {
            $logContent = "添加了{$request->get('menu_name')}学历";
        } else {
            $logContent = "添加{$request->get('menu_name')}学历";
        }

        // 写入管理员日志
        $this->writeAdminLog($logContent);
        return redirect('intranet/Education/list');
    }
}
