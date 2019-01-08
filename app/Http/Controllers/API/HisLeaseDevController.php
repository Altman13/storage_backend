<?php

namespace App\Http\Controllers\API;

use App\Models\Emploee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;



class HisLeaseDevController extends Controller
{
    public function create(/*Request $request*/)
    {
        DB::insert('insert into histories (data, device_iddevice, employees_id) values (NOW(), ?, ?)',
            [DB::table('devices')
                ->select('id')
                ->where('name', 'Монитор Dell')
                ->value('id'),
            DB::table('employees')
                ->select('id')
                ->where('fio', 'Иван Иваныч Иванов')
                ->value('id'),
            ]);
    }

    public function index()
    {

    }

    public function store(Request $request)

    {

    }

    public function show($barcode)
    {
        $employee=Emploee::select('devices.name as dev_name', 'devices.status', 'devices.barcode',
            'device_location.name as device_location', 'histories.data')
            ->join('histories', 'histories.employees_id', 'employees.id')
            ->join('devices', 'histories.device_iddevice', 'devices.id')
            ->join('categories', 'devices.category_idcategory', 'categories.id')
            ->join('device_location', 'devices.device_location_id', 'device_location.id')
            ->where([
                ['employees.barcode', $barcode],
            ])->get()->toJson(JSON_UNESCAPED_UNICODE);
        return $employee;
    }

    public function update(Request $request, $id)
    {

    }

    public function destroy($id)
    {

    }
}
