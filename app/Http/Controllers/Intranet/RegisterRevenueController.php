<?php

namespace App\Http\Controllers\Intranet;

use Illuminate\Http\Request;
use App\Konohanaruto\Repositories\Intranet\RegisterRevenue\RegisterRevenueRepositoryInterface;
use App\Http\Requests\Intranet\RevenueRangeCreateFormRequest;

class RegisterRevenueController extends CoreController
{
    private $revenueRepo;

    public function __construct(RegisterRevenueRepositoryInterface $revenueRepo)
    {
        $this->revenueRepo = $revenueRepo;
        parent::__construct();
    }

    public function actionList()
    {
        $data = $this->revenueRepo->getList();
        return view('intranet.pages.revenue_range.list', ['list' => $data]);
    }

    public function actionShowAddForm()
    {
        return view('intranet.pages.revenue_range.add');
    }

    public function actionStore(RevenueRangeCreateFormRequest $request)
    {
        $insertStatus = $this->revenueRepo->storeData($request->all());

        if ($insertStatus) {
            // 写入管理员日志
            $this->writeAdminLog("添加了{$request->get('revenue')}收入范围项");
        }

        return redirect('intranet/RegisterRevenue/list');
    }

    public function actionShowEditForm($actionId)
    {
        $detail = $this->revenueRepo->getDetailById(intval($actionId));

        if (empty($detail)) {
            return redirect('intranet/RegisterRevenue/list');
        }

        return view('intranet.pages.revenue_range.edit', ['detail' => $detail]);
    }

    public function actionUpdate(RevenueRangeCreateFormRequest $request)
    {
        $formData = $request->all();
        $updateStatus = $this->revenueRepo->updateData($formData);

        if ($updateStatus !== false && $formData['old_revenue'] != $formData['revenue']) {
            $this->writeAdminLog('将收入范围"' . $formData['old_revenue'] . '"改为"' . $formData['revenue'] . '"');
        }

        return redirect('intranet/RegisterRevenue/list');
    }

    public function actionDelete(Request $request)
    {
        if ($request->ajax()) {
            $removeIds = explode(',', $request->get('action_id'));

            if (empty($removeIds)) {
                return response()->json(array('error' => '参数错误'));
            }

            $relationList = $this->revenueRepo->getListByIds($removeIds);
            // 移除相关记录
            $affects = $this->revenueRepo->removeDataByIds($removeIds);

            // 写入管理员日志
            if ($affects) {
                foreach ($relationList as $item) {
                    $this->writeAdminLog('删除了"' . $item['revenue'] . '"收入范围');
                }
            }

            return response()->json(array('rows' => $affects));
        }

        return response()->json(array('code' => 400, 'errorMsg' => '非法请求'), 404);
    }
}
