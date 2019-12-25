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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', 'UserController@register');
Route::post('login', 'UserController@authenticate');



Route::get('department/{department_id}/employee', 'DepartmentController@indexOfRelatedEmployees');

Route::get('manager/{manager_id}/employee', 'ManagerController@indexOfRelatedEmployees');

Route::group(['middleware' => ['jwt.verify']], function() {
    Route::get('user', 'UserController@getAuthenticatedUser');

    
    Route::get('department/{id}/profile', 'DepartmentController@showProfile');
    Route::get('department/{id}', 'DepartmentController@show');
    Route::get('department', 'DepartmentController@index');
    Route::post('department', 'DepartmentController@create');

    Route::get('manager/{id}/profile', 'ManagerController@showProfile');
    Route::get('manager/{id}', 'ManagerController@show');
    Route::get('manager', 'ManagerController@index');
    Route::post('manager    ', 'ManagerController@create');

    Route::get('employee/{id}/profile', 'EmployeeController@showProfile');
    Route::get('employee/{id}', 'EmployeeController@show');
    Route::get('employee', 'EmployeeController@index');
    Route::post('employee', 'EmployeeController@create');


});