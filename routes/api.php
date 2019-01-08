<?php

use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('v1/user/register', 'APIRegisterController@register');
Route::post('v1/user/login', 'APILoginController@login');

Route::middleware('jwt.auth')->get('users', function(Request $request) {
    return auth()->user();
});
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
//изменить место, где находится устройство склад/на руках и т д
/*Route::post('v1/loc_device', 'Api\TestApiController@store');*/
//------------------------------------------------------------
//рабочие маршруты для приложения
//------------------------------------------------------------
//desktop c# добавить новое устройство
Route::post('v1/device', 'Api\DeviceContoller@create');
//desktop c# регистрация новых сотрудников - фио и barcode

//Route::post('v1/employee', 'Api\EmpController@create');
Route::get('v1/employee/{barcode}', 'Api\EmpController@show');
Route::post('v1/employee', 'Api\EmpController@insert');
Route::post('v1/employees', 'Api\EmpController@insert');


//------------------------------------------------------
Route::get('v1/history', 'Api\HisController@show');
Route::get('v1/employee', 'Api\EmpController@show');
//------------------------------------------------------

//Удалить устройство
Route::delete('v1/device/{id}', 'Api\DeviceController@destroy');
//Внести изменения в устройство
Route::patch('v1/device/{id}', 'Api\DeviceController@update');
//История аренды устройств
Route::get('v1/history_device/{id}', 'Api\DeviceController@show');
//добавляет новый компонент на склад
Route::post('v1/component', 'Api\CompController@create');
//Удалить/списать компонент
Route::delete('v1/component/{id}', 'Api\CompController@destroy');
//изменить компонент
Route::patch('v1/component/{id}', 'Api\CompController@update');

//История активности по сотрудникам
//Route::get('v1/employee', 'Api\EmpHistController@show');
//История активности по конкретному сотруднику

Route::get('v1/employee/{id}', 'Api\EmpHistController@show_one');

//сотрудник уволен/сотрудник работает/сотрудник в отпуске
Route::patch('v1/employee/{id}', 'Api\EmpController@update');
//добавить/сдать устройство в аренду для определенного сотрудника

//TODO:как передается пара: сотрудник/устройство
Route::post('v1/history_emp', 'Api\HisLeaseDevController@create');
//История по конкретному сотруднику
Route::get('v1/history_emp/{id}', 'Api\HisLeaseDevController@show');

//новая категория устройства
Route::post('v1/cat_device/{id}', 'Api\CatDevController@create');
//удалить категорию устройства
Route::delete('v1/cat_device/{id}', 'Api\CatDevController@destroy');
//измениь категорию устройства
Route::patch('v1/cat_device/{id}', 'Api\CatDevController@update');
//добавить место, где находится устройство склад/на руках и т д
Route::post('v1/loc_device/{id}', 'Api\LocationController@create');
//удалить место, где находится устройство склад/на руках и т д
Route::delete('v1/loc_device/{id}', 'Api\LocationController@destroy');
//изменить место, где находится устройство склад/на руках и т д
Route::patch('v1/loc_device/{id}', 'Api\LocationController@update');


//изменить место, где находится компонент склад/на руках и т д
//нужно сделать новые миграции, с новыми таблицами
Route::patch('v1/loc_comp/{id}', 'Api\ChangeCompLocController@update');

Route::post('v1/category', 'TempController@show');
