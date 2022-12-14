<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Models\Employee;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class EmployeeController extends Controller
{

    public function all(Request $request)
    {
        $limit = $request->limit;
        $q = Employee::select('id', 'name', 'designation');
        if ($request->search != null) {
            $q->where(function ($qry) use ($request) {
                $qry->orWhere('designation', 'like', '%' . $request->search . '%');
            });
        }
        $employees = $q->paginate($limit);


        return response()->json($employees, 200);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $employee = Employee::all();

            if ($request->ajax()) {
                return DataTables::of($employee)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $btn = '<a href="javascript:void(0)" data-toggle="modal"
                            data-target="#editModal"  data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn-outline rounded-pill btn-sm editEmployee" >Edit</a>';
                        $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-outline-del rounded-pill btn-sm deleteEmployee" >Delete</a>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
            return view('employee.index', compact('employee'));
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeRequest $request)
    {
        try {
            Employee::create($request->validated());
            return response()->json(['message' => 'added Success'], 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        return response()->json($employee, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeeRequest $request, Employee $employee)
    {
        try {
            $employee->update($request->validated());
            return response()->json(['message' => 'Update Success'], 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        try {
            $employee->delete();
            return response()->json(['message' => 'Delete Success'], 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }
}
