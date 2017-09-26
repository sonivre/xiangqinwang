<?php

namespace App\Http\Controllers\Intranet;

use Illuminate\Http\Request;
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
        return view('intranet.pages.education_list', ['list' => $eduList]);
    }

    public function actionShowAddForm()
    {
        return view('intranet.pages.education_add');
    }

    public function actionStore(EducationCreateFormRequest $request)
    {
        $insertStatus = $this->education->storeData($request->all());

        if ($insertStatus) {
            // 写入管理员日志
            $this->writeAdminLog("添加了{$request->get('menu_name')}学历");
        }

        return redirect('intranet/Education/list');
    }

    public function actionShowEditForm($actionId)
    {
        $detail = $this->education->getDetailById(intval($actionId));

        if (empty($detail)) {
            return redirect('intranet/Education/list');
        }

        return view('intranet.pages.education_edit', ['detail' => $detail]);
    }

    public function actionUpdate(EducationCreateFormRequest $request)
    {
        $formData = $request->all();
        $updateStatus = $this->education->updateData($formData);

        if ($updateStatus !== false && $formData['old_name'] != $formData['name']) {
            $this->writeAdminLog('将学历"' . $formData['old_name'] . '"更名为"' . $formData['name'] . '"');
        }

        return redirect('intranet/Education/list');
    }

    public function actionDelete(Request $request)
    {
        if ($request->ajax()) {
            $removeIds = explode(',', $request->get('action_id'));

            if (empty($removeIds)) {
                return response()->json(array('error' => '参数错误'));
            }

            $relationList = $this->education->getListByIds($removeIds);
            // 移除相关记录
            $affects = $this->education->removeDataByIds($removeIds);

            // 写入管理员日志
            if ($affects) {
                foreach ($relationList as $item) {
                    $this->writeAdminLog('删除了"' . $item['name'] . '"学历');
                }
            }

            return response()->json(array('rows' => $affects));
        }

        return response()->json(array('code' => 400, 'errorMsg' => '非法请求'), 404);
    }
}
