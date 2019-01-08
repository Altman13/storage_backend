<?php

namespace App\Http\Controllers\API;

use App\Device;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;


class CatDevController extends Controller
{
    public function index()
    {

    }

    public function create($id)
    {
        DB::insert('insert into catigories (name) values (?)',[$id]);
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
        DB::table('categories')->where('id', $id)
            ->update(['name'=>$input]);
    }

    public function destroy($id)
    {

        DB::table('catigories')->delete($id);
    }
}
