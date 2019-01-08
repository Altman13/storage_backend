<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Catigory;
use App\Device;
use Illuminate\Support\Facades\DB;

class AddCatDevController extends Controller
{
    public function index()
    {

    }
    public function store(Request $request)
    {
        $components=DB::table('components')
            ->join('devices', 'devices.id','=','components.device_iddevice')
            ->select('devices.name as dev_name', 'components.name')
            ->get();
        return $components;
    }
    public function show($id)
    {

    }
    public function update(Request $request, $id)
    {

    }
    public function destroy($id)
    {

    }
}
