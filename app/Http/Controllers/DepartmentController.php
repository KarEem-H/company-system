<?php

namespace App\Http\Controllers;

use App\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the Departments.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $acceptVersion = Request()->header('Accept-version') ? strtolower(Request()->header('Accept-version')) : null;

        switch ($acceptVersion) {

            case 'v2':
                $departments = Department::paginate((int) request()->itemsPerPage);
                break;
            default: {
                    $departments = Department::all();
                }
        }
        return response()->json(compact('departments'), 200);
    }

    /**
     * create a new Department .
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $department = Department::create(array('name' => $request->get('name')));

        return response()->json(compact('department'), 200);
    }


    /**
     * Display the specified Department.
     *
     * @param  \App\Department  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Department $id)
    {
        $department = $id;
        return response()->json(compact('department'), 200);
    }

    /**
     * Display the specified Department profile.
     *
     * @param  \App\Department  $id
     * @return \Illuminate\Http\Response
     */
    public function showProfile(Department $id)
    {

        return response()->json('profile', 200);
    }

    /**
     * Display a listing of the employees that were related to specified the department.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function indexOfRelatedEmployees(int $id)
    {
        $departmentInfo = Department::findOrFail($id);


        $acceptVersion = Request()->header('Accept-version') ? strtolower(Request()->header('Accept-version')) : null;

        switch ($acceptVersion) {

            case 'v2':
                $listingOfRelatedEmployees = $departmentInfo->employee()->paginate((int) request()->itemsPerPage);
                break;
            default: {
                    $listingOfRelatedEmployees = $departmentInfo->employee()->get();
                }
        }

        return response()->json(compact('departmentInfo', 'listingOfRelatedEmployees'), 200);
    }
}
