<?php

namespace App\Http\Controllers;

use App\Service\PurchaserService;
use Illuminate\Http\Request;

class PurchaserController extends Controller
{
    private PurchaserService $purchaserService;

    /**
     * @param PurchaserService $purchaserService
     */
    public function __construct(PurchaserService $purchaserService)
    {
        $this->purchaserService = $purchaserService;
    }

    public function getPurchaser(Request $request)
    {
        return $this->purchaserService->getPurchaser($request);
    }
}
