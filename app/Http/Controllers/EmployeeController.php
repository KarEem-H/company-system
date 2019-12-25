<?php

namespace App\Http\Controllers;

use App\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the Employee.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = employee::paginate((int) request()->itemsPerPage);
        return response()->json(compact('employees'), 200);
    }


    /**
     * create a new employee .
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'department_id' => 'required|integer|exists:departments,id',
            'manager_id' => 'required|integer|exists:managers,id'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $employee = Employee::create(array(
            'name' => $request->get('name'),
            'department_id' => $request->get('department_id'),
            'manager_id' => $request->get('manager_id'),
        ));

        return response()->json(compact('employee'), 200);
    }


    /**
     * Display the specified Employee.
     *
     * @param  \App\Employee  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $id)
    {
        $employee = $id;
        return response()->json(compact('employee'), 200);
    }

    /**
     * Display the specified Employee profile.
     *
     * @param  \App\Employee  $id
     * @return \Illuminate\Http\Response
     */
    public function showProfile(Employee $id)
    {
        return response()->json('profile', 200);
    }

}
