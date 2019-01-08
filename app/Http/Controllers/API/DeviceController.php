<?php

namespace App\Http\Controllers\API;

use App\Models\Device;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class DeviceController extends Controller
{
    public function index()
    {

    }

    public function store(Request $request)
    {

    }

    public function show($barcode)
    {
            $device=Device::select('devices.name as dev_name', 'devices.status', 'devices.barcode',
                'device_location.name as device_location')
                /*->join('departments', 'employees.department_iddepartment', 'departments.id')*/
                /*->join('histories', 'histories.device_iddevice', 'devices.id')*/
                /*->join('devices', 'histories.device_iddevice', 'devices.id')*/
                ->join('categories', 'devices.category_idcategory', 'categories.id')
                ->join('device_location', 'devices.device_location_id', 'device_location.id')
                /*->join('histories', 'device_iddevice', 'devices')*/
                /*->join('devices', 'device_location_id', 'device_location')*/
                ->where([
                    ['devices.barcode', $barcode],
                ])->first()->toJson(JSON_UNESCAPED_UNICODE);
        return $device;
    }

    public function update(Request $request)
    {
        Device::where('barcode', $request->barcode)
               ->update(['name' => $request->name]);
    }
    public function destroy($id)
    {
        DB::table('devices')->delete($id);
    }
}
