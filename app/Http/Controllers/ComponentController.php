<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class ComponentController extends Controller
{
    public function index(){

        $component = DB::table('devices')
            ->join('components', 'devices.id', '=', 'components.device_iddevice')
            ->select('devices.name')
            ->get();
        return $component;

    }
    public function store(Request $request)
    {
        $name = $request->input('name');
        return $name->json();
    }
}
