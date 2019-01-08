<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class CompController extends Controller
{
    public function index()
    {

    }

    public function store(Request $request)
    {

    }
    public function create(Request $request)
    {
            DB::insert('insert into components (name, device_iddevice) values (?, ?)',
                ['жесткий диск', DB::table('devices')
                                    ->select('id')
                                    ->where('name', 'Монитор Dell')
                                    ->value('id')
                ]);
    }

    public function show($id)
    {

    }

    public function update(Request $request, $id)
    {
        $input = Input::get('name');
        DB::table('components')->where('id', $id)
            ->update(['name'=>$input]);
    }

    public function destroy($id)
    {

        DB::table('components')->delete($id);
    }
}
