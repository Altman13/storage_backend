<?php
namespace App\Http\Controllers\API;
use App\Models\Core;
use App\Models\Department;
use App\Models\Device;
use App\Models\Emploee;
use App\Models\History;
use Carbon\Carbon;
use foo\bar;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;


class EmpController extends Controller
{
    //TODO: переименовать метод
    public function history($status,$barcode)
    {
        $employee=Emploee::select('devices.name as dev_name', 'devices.status', 'devices.barcode',
            'device_location.name as device_location', 'histories.data')
            ->join('histories', 'histories.employees_id', 'employees.id')
            ->join('devices', 'histories.device_iddevice', 'devices.id')
            ->join('categories', 'devices.category_idcategory', 'categories.id')
            ->join('device_location', 'devices.device_location_id', 'device_location.id')
            ->where([['employees.barcode', $barcode],
                ['devices.status', $status],])
            ->get()->toJson(JSON_UNESCAPED_UNICODE);
        return $employee;
    }
    //TODO: добавить запрос из таблицы user и таблицы departments
    public function insert(Request $request)
    {
        $employee=Emploee::select('employees.id')->where('employees.barcode', $request['barcode'])->first();
        if($employee==null)
        {
            $empl = new Emploee();
            $empl->fio=$request['fio'];
            $empl->barcode=$request['barcode'];
            $empl->phone=$request['phone'];
            $empl->rank=$request['rank'];
            $empl->department_iddepartment=$request['department_iddepartment'];
            $empl->user_iduser=1/*$request['user_iduser']*/;
            $empl->save();
            return response('', 200)
                ->header('Content-Type', 'text/plain');
        }
        else
        {
            return response('no content', 409)
                ->header('Content-Type', 'text/plain');
        }

    }

    //TODO: разобраться какой запрос нужен
    public function show($barcode)
    {
            $employee = Emploee::select('employees.fio', 'employees.barcode', 'departments.name',
                'employees.rank', 'employees.phone', 'departments.id as department_iddepartment')
                ->join('departments', 'employees.department_iddepartment', 'departments.id')
                ->where('employees.barcode', $barcode)
                ->first();/*->toJson(JSON_UNESCAPED_UNICODE);*/
                if($employee!=null) {
                    $employee = json_encode($employee, JSON_UNESCAPED_UNICODE);
                return $employee;
            }
            else {
                return response('', 404)
                    ->header('Content-Type', 'text/plain');
            }


        /*$employee=Emploee::select('employees.id', 'employees.fio', 'employees.barcode', 'employees.phone', 'employees.rank', 'devices.name
            as dev_name', 'devices.status', 'devices.barcode', 'categories.name as category_name', 'device_location.name as device_location')
            ->join('departments', 'employees.department_iddepartment', 'departments.id')
            ->join('histories', 'histories.employees_id', 'employees.id')
            ->join('devices', 'histories.device_iddevice', 'devices.id')
            ->join('categories', 'devices.category_idcategory', 'categories.id')
            ->join('device_location', 'devices.device_location_id', 'device_location.id')
            ->where([
                ['employees.barcode', $barcode],
                ['devices.status', 'в аренде'],
                ])
            ->get()->toJson(JSON_UNESCAPED_UNICODE);
            return $employee;*/
    }
    public function update(Request $request)
    {
        Emploee::where('employees.barcode', $request['barcode'])
                ->update(['fio'=>$request['fio'],
                        'phone'=>$request['phone'],
                        'rank'=>$request['rank'],
                        'department_iddepartment'=>$request['department_iddepartment']]);
        return response('Ok', 200)
                ->header('Content-Type', 'text/plain');
    }
    public function destroy($barcode)
    {
        Emploee::where('employees.barcode', $barcode)->delete();
        return response('Ok', 200)
                ->header('Content-Type', 'text/plain');
    }
}
