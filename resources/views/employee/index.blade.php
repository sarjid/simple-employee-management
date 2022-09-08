@extends('layouts.app')
@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" id="app">
                        {{ __('Employee List') }}
                        <a href="{{ route('employee.create') }}" class="btn btn-danger rounded-pill"
                            style="float: right;">Add
                            New Employee</a>

                    </div>

                    <div class="card-body">
                        <table class="table table-bordered data-table mt-3">
                            <thead>
                                <tr>
                                    <th>name</th>
                                    <th>designation</th>
                                    <th width="300px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

    <script>
        $(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('employee.index') }}",
                columns: [{
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'designation',
                        name: 'designation'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            })

        });

        ///Delete Call
        $('body').on('click', '.deleteEmployee', function() {

            var em_id = $(this).data("id");

            if (confirm("Are You sure want to delete !"))

            {
                $.ajax({
                    type: "DELETE",
                    url: "{{ url('/employee') }}" + '/' + em_id,
                    success: function(data) {
                        // table.draw();
                        var oTable = $('.data-table').dataTable();
                        oTable.fnDraw();

                    },
                    error: function(data) {
                        console.log('Error:', data);
                    }
                });
            }
        });
    </script>
@endsection
