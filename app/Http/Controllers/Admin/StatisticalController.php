<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Service\Admin\StatisticalAdminService;
use Illuminate\Http\Request;

class StatisticalController extends Controller
{
    private StatisticalAdminService $statisticalAdminService;

    /**
     * @param StatisticalAdminService $statisticalAdminService
     */
    public function __construct(StatisticalAdminService $statisticalAdminService)
    {
        $this->statisticalAdminService = $statisticalAdminService;
    }

    public function getStatisticalProduct(Request $request)
    {
        return $this->statisticalAdminService->statisticalProduct($request);
    }

    public function calculateStatisticalProduct(Request $request)
    {
        return $this->statisticalAdminService->calculateStatisticalProduct($request);
    }

}
