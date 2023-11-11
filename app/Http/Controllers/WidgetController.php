<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\WidgetService;

class WidgetController extends Controller
{
    public $widgetService;

    /**
     * Display a listing of the resource.
     */

    public function __construct(WidgetService $widgetService) {
        $this->widgetService = $widgetService;
    }

    function showForm() {
        return view('widgetPack');
    }

    public function calculatePacks(Request $request)
    {
        $order = $request->order;
        $packSizes = [250, 500, 1000, 2000, 5000];
        $packs = $this->widgetService->find_packs($packSizes, $order);
        return view('widgetPack', ['packs' => $packs, 'order' => $request->order]); 
    }
}
