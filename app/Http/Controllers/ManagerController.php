<?php

namespace App\Http\Controllers;

use App\Manager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ManagerController extends Controller
{
    /**
     * Display a listing of the Manager.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $managers = manager::paginate((int) request()->itemsPerPage);
        return response()->json(compact('managers'), 200);
    }

    /**
     * create a new manager .
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'department_id' => 'required|integer|exists:departments,id'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $manager = manager::create(array(
            'name' => $request->get('name'),
            'department_id' => $request->get('department_id'),
        ));

        return response()->json(compact('manager'), 200);
    }

    /**
     * Display the specified Manager.
     *
     * @param  \App\Manager  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Manager $id)
    {
        $manager = $id;
        return response()->json(compact('manager'), 200);
    }


    /**
     * Display the specified Manager.
     *
     * @param  \App\Manager  $id
     * @return \Illuminate\Http\Response
     */
    public function showProfile(Manager $id)
    {
       
        return response()->json('profile', 200);
    }


    /**
     * Display a listing of the employees that were related to specified the manager.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function indexOfRelatedEmployees(int $id)
    {
        $managerInfo = manager::findOrFail($id);
        $listingOfRelatedEmployees = $managerInfo->employee()->paginate((int) request()->itemsPerPage);

        return response()->json(compact('managerInfo', 'listingOfRelatedEmployees'), 200);
    }

    
}
