@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header" id="app">
                        {{ __('Employee List') }}
                        <a href="{{ route('employee.index') }}" class="btn btn-danger rounded-pill" style="float: right;">
                            Employee List</a>
                    </div>

                    <div class="card-body">
                        <div id="app">
                            <add-new-employee></add-new-employee>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
