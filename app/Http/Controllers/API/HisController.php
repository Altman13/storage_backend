<?php

namespace App\Http\Controllers\API;

use App\Models\History;
use App\Models\Device;
use App\Models\Emploee;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HisController extends Controller
{
    public function index()
    {

    }
    public function create()
    {

    }
    public function store(Request $request)
    {
        $date=Carbon::now()->format('Y-m-d');
        $device=Device::select('devices.id', 'devices.status')
            ->where([
                        ['devices.barcode', $request->device_barcode],
                    ])->first();
        $employee=Emploee::select('employees.id')
           ->where([
               ['employees.barcode', $request->employee_barcode],
           ])->first();
        $history= new History;
        $history->data=$date;
        $history->device_iddevice=$device->id;
        $history->employees_id=$employee->id;
        $history->save();
        //TODO: сделать проверку на статус девайса
        //TODO: продумать логику возврата девайса, где находится device_location
        if($device->status=='свободен')
        {
            Device::where('id', $device->id)
                ->update(['status' => 'в аренде',
                         'device_location_id'=>3]);
        }
        elseif ($device->status=='в аренде')
        {
            Device::where('id', $device->id)
                ->update(['status' => 'свободен',
                        'device_location_id'=>1]);
        }
    }
    public function show(Request $request)
    {
        $history=History::select('histories.data as hist_data', 'devices.name', 'categories.name as cat_name')
            ->join('devices', 'histories.device_iddevice', 'devices.id')
            ->join('categories', 'devices.category_idcategory', 'categories.id')
            ->get()->toJson(JSON_UNESCAPED_UNICODE);
        return $history;
    }

    public function edit($id)
    {

    }
    public function update(Request $request, $id)
    {

    }
    public function destroy($id)
    {

    }
}
