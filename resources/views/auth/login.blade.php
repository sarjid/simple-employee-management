@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card" id="app">
                    <div class="card-header">{{ __('Login') }}</div>

                    <div class="card-body">
                        <user-login></user-login>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
