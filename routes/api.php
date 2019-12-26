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

/**
 * Endpoint description: register a new account.
 * Route parameters: null
 * Query string parameters: null
 * Header parameters: null
 * Body parameters:  "name" , "email", "password" , and "password_confirmation" .
 * Expected return:  the user information and  a token
 * 
 */
Route::post('register', 'UserController@register');

/**
 * Endpoint description: login to an existing account.
 * Route parameters:null
 * Query string parameters: null
 * Header parameters: null
 * Body parameters : "email" and "password" 
 * Expected return: the token
 * 
 * 
 */
Route::post('login', 'UserController@authenticate');


/**
 * Endpoint description: The Api show without authentication 
 *                       each department with its employees 
 * Route parameters: "department_id"
 * Query string parameters: "itemsPerPage" and  "page"
 * Header parameters: "Accept-version"(V1 or V2) 
 * Body parameters : null
 * Expected return:  the department information  with its employees
 * 
 * 
 */
Route::get('department/{department_id}/employee', 'DepartmentController@indexOfRelatedEmployees');

/**
 * Endpoint description: The Api show without authentication 
 *                       each manager with his/her employees.
 * Route parameters: "manager_id"
 * Query string parameters: "itemsPerPage" and "page"
 * Header parameters: "Accept-version"(V1 or V2) 
 * Body parameters : null
 * Expected return: The manager inofrmation with his/her employees.
 * 
 * 
 */
Route::get('manager/{manager_id}/employee', 'ManagerController@indexOfRelatedEmployees');


Route::group(['middleware' => ['jwt.verify']], function () {

    /**
     * Endpoint description: display the authenticated user account information
     * Route parameters: null
     * Query string parameters: null
     * Header parameters:"Authorization"
     * Body parameters: null
     * Expected return: the authenticated user account information
     * 
     * 
     */
    Route::get('user', 'UserController@getAuthenticatedUser');


    /**
     * Endpoint description: display a specific department profile (include only the word profile)
     * Route parameters: department id
     * Query string parameters: null
     * Header parameters: "Authorization"
     * Body parameters : null
     * Expected return: only the word profile
     * 
     * 
     */
    Route::get('department/{id}/profile', 'DepartmentController@showProfile');
    /**
     * Endpoint description: display a specific department information
     * Route parameters: department id
     * Query string parameters: null
     * Header parameters: "Authorization"
     * Body parameters: null
     * Expected return: the department information
     * 
     * 
     */
    Route::get('department/{id}', 'DepartmentController@show');

    /**
     * Endpoint description: Display a listing of the Departments
     * Route parameters: null
     * Query string parameters: "itemsPerPage" and "page"
     * Header parameters: "Authorization" , "Accept-version"(V1 or V2) 
     * Body parameters : null 
     * Expected return: listing of the Departments
     * 
     * 
     */

    Route::get('department', 'DepartmentController@index');

    /**
     * Endpoint description: create a new Department .
     * Route parameters: null
     * Query string parameters: null
     * Header parameters: "Authorization"
     * Body parameters : "name"
     * Expected return: the new Department information
     * 
     * 
     */
    Route::post('department', 'DepartmentController@create');
    // -----------------------------------------------------------------------------

    /**
     * Endpoint description: display a specific manager profile (include only the word profile)
     * Route parameters: manager id
     * Query string parameters: null
     * Header parameters: "Authorization"
     * Body parameters : null
     * Expected return: only the word profile
     * 
     * 
     */
    Route::get('manager/{id}/profile', 'ManagerController@showProfile');

    /**
     * Endpoint description: display a specific manager information
     * Route parameters: manager id
     * Query string parameters: null
     * Header parameters: "Authorization"
     * Body parameters: null
     * Expected return: the manager information
     * 
     * 
     */
    Route::get('manager/{id}', 'ManagerController@show');

    /**
     * Endpoint description: Display a listing of the managers
     * Route parameters: null
     * Query string parameters: "itemsPerPage" and "page"
     * Header parameters: "Authorization" , "Accept-version"(V1 or V2) 
     * Body parameters : null 
     * Expected return: listing of the managers
     * 
     * 
     */
    Route::get('manager', 'ManagerController@index');

    /**
     * Endpoint description: create a new manager .
     * Route parameters: null
     * Query string parameters: null
     * Header parameters: "Authorization"
     * Body parameters : "name", "department_id"
     * Expected return: the new manager information
     * 
     * 
     */
    Route::post('manager', 'ManagerController@create');
    // ---------------------------------------------------------------------


    /**
     * Endpoint description: display a specific employee profile (include only the word profile)
     * Route parameters: employee id
     * Query string parameters: null
     * Header parameters: "Authorization"
     * Body parameters : null
     * Expected return: only the word profile
     * 
     * 
     */
    Route::get('employee/{id}/profile', 'EmployeeController@showProfile');

    /**
     * Endpoint description: display a specific employee information
     * Route parameters: employee id
     * Query string parameters: null
     * Header parameters: "Authorization"
     * Body parameters: null
     * Expected return: the employee information
     * 
     * 
     */
    Route::get('employee/{id}', 'EmployeeController@show');

    /**
     * Endpoint description: Display a listing of the employees
     * Route parameters: null
     * Query string parameters: "itemsPerPage" and "page"
     * Header parameters: "Authorization" , "Accept-version"(V1 or V2) 
     * Body parameters : null 
     * Expected return: listing of the employees
     * 
     * 
     */

    Route::get('employee', 'EmployeeController@index');

    /**
     * Endpoint description: create a new employee .
     * Route parameters: null
     * Query string parameters: null
     * Header parameters: "Authorization"
     * Body parameters : "name","department_id","manager_id"
     * Expected return: the new employee information
     * 
     * 
     */
    Route::post('employee', 'EmployeeController@create');
});
