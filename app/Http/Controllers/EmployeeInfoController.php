<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\EmployeeInfo;
use Illuminate\Http\Request;

class EmployeeInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('employee.Information');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $count = count($request->all());
        for ($i = 0; $i < $count; $i++) {
            $tss = new EmployeeInfo();
            $tss->employee_id = $request['id'][$i];
            $tss->address     = $request['address'][$i];
            $tss->phone       = $request['phone'][$i];
            $tss->email       = $request['email'][$i];
            $tss->save();
        }

        return response()->json(['message' => 'Store Success'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EmployeeInfo  $employeeInfo
     * @return \Illuminate\Http\Response
     */
    public function show(EmployeeInfo $employeeInfo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EmployeeInfo  $employeeInfo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EmployeeInfo $employeeInfo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EmployeeInfo  $employeeInfo
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmployeeInfo $employeeInfo)
    {
        //
    }
}
