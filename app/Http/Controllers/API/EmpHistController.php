<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class EmpHistController extends Controller
{
    const Sunday = 0;
    const Monday = 1;
    public function index()
    {

    }
    public function store(Request $request)
    {

    }
    public function show()
    {
        $history=DB::table('histories')
            ->join('devices', 'devices.id', '=', 'histories.device_iddevice')
            ->join('employees', 'employees.id', '=', 'histories.employees_id')
            ->get()->all();
        return $history;
    }
    public function show_one($id)
    {
        $history=DB::table('histories')
            ->join('devices', 'devices.id', '=', 'histories.device_iddevice')
            ->join('employees', 'employees.id', '=', 'histories.employees_id')
            ->where('employees_id', $id)
            ->get()->all();
        return $history;
    }
    public function update(Request $request, $id)
    {

    }
    public function destroy($id)
    {

    }
}
