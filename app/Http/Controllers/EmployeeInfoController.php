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

        foreach ($request->form as $data) {
            EmployeeInfo::create([
                'employee_id' => $data['id'],
                'address' => $data['address'],
                'phone' => $data['phone'],
                'email' => $data['email'],
            ]);
        }
        return response()->json(['message' => 'Store Success'], 200);
    }
}
