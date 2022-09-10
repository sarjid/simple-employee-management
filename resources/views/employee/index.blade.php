@extends('layouts.app')
@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center" id="app">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        {{ __('Employee List') }}

                        <add-employee></add-employee>

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




    <!-- edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Employee</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="employeeEditForm" name="employeeEditForm" class="form-horizontal ">
                        <input type="hidden" name="employee_id" id="employee_id">
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-12">
                                <input type="text" id="nameAdd" name="name" class="form-control"
                                    placeholder="Enter name" maxlength="50" required="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Designation</label>
                            <div class="col-sm-12">
                                <input type="text" id="designation" name="designation "class="form-control"
                                    placeholder="Enter designation">
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-del rounded-pill"
                                data-dismiss="modal">Close</button>
                            <button type="button" id="updateBtn" name="updateBtn" class="btn btn-outline rounded-pill">Save
                                changes</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

    <script>
        $(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var table = $('.data-table').DataTable({
                "order": [
                    [0, 'desc']
                ],
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
                        var oTable = $('.data-table').dataTable();
                        oTable.fnDraw();
                    },
                    error: function(data) {
                        console.log('Error:', data);
                    }
                });
            }
        });

        // Edit call
        $('body').on('click', '.editEmployee', function() {
            var emp_id = $(this).data('id');
            $.get("{{ url('/employee/') }}" + '/' + emp_id, function(res) {
                $('#employee_id').val(res.id);
                $('#nameAdd').val(res.name);
                $('#designation').val(res.designation);
            })
        });

        $('body').on('click', '#updateBtn', function(e) {
            e.preventDefault();
            var id = $('#employee_id').val();
            var name = $('#nameAdd').val();
            var designation = $('#designation').val();
            // console.log(dat);
            $.ajax({
                data: {
                    name: name,
                    designation: designation
                },
                url: "/employee/" + id,
                type: "PUT",
                dataType: 'json',
                success: function(data) {
                    $('#employeeEditForm').trigger("reset");
                    var oTable = $('.data-table').dataTable();
                    oTable.fnDraw();
                    $(".close").click();

                },
                error: function(data) {}

            });
        });
    </script>
@endsection
