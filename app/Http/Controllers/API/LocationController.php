<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;




class LocationController extends Controller
{
    public function index()
    {

    }
    public function create($name)
    {
        DB::insert('insert into storages (name) values (?)',[$name]);
    }

    public function store(Request $request)
    {

    }

    public function show($id)
    {

    }

    public function update(Request $request, $id)
    {

        $input = Input::get('name');
        DB::table('storages')->where('id', $id)
            ->update(['name'=>$input]);
    }

    public function destroy($id)
    {
        DB::table('storages')->delete($id);
    }
}
