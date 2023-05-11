@extends('layouts.app')

@section('content')
    <ol class="breadcrumb blue-grey lighten-4">
        <li class="breadcrumb-item"><a class="black-text" href="{{ route('leave.manage') }}">Manage Leaves</a><i
                class="fa fa-angle-double-right mx-2" aria-hidden="true"></i></li>
        <li class="breadcrumb-item active">Add Leave</li>
    </ol>
    <div class="card card-info mx-4">
        <div class="card-header">
            <h3 class="card-title">Add Leave</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form id="addLeaveForm" action="{{ route('leave.add') }}" class="form-horizontal" method="POST">
            @csrf

            <div class="card-body">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="leave_type" class="col-sm-12 col-form-label">Leave Type</label>
                        <div class="col-sm-12 err_msg">

                            <select class="form-control custom-select" name="leave_type" id="leave_type">
                                <option disabled selected>Select Leave Type</option>
                                <option>Half Day</option>
                                <option>Full Day</option>
                                <option>Sick Leave</option>
                                <option>Emergency</option>

                            </select>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="subject" class="col-sm-12 col-form-label">Suject</label>
                        <div class="col-sm-12 err_msg">
                            <input type="text" class="form-control" name="subject" id="subject"
                                placeholder="Enter Task Title">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="reason" class="col-sm-12 col-form-label">Reason</label>
                        <div class="col-sm-12 err_msg">
                            <textarea rows="3" class="form-control" name="reason" id="reason" placeholder="Enter Reason"></textarea>
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="start_date" class="col-sm-12 col-form-label">Leave Start Date</label>
                        <div class="col-sm-12 err_msg">
                            <input type="date" class="form-control" name="start_date" id="start_date"
                                value="{{ old('start_date') }}" placeholder="Enter Adhaar Card No.">
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="end_date" class="col-sm-12 col-form-label">Leave End Date</label>
                        <div class="col-sm-12 err_msg">
                            <input type="date" class="form-control" name="end_date" id="end_date"
                                value="{{ old('end_date') }}" placeholder="Enter Adhaar Card No.">
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <a href="{{ route('leave.manage') }}" class="btn btn-warning">Cancel</a>
                <button type="submit" class="btn btn-info float-right">Submit</button>
            </div>
            <!-- /.card-footer -->
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        $(function() {
            $('#addLeaveForm').validate({
                rules: {
                    leave_type: {
                        required: true,
                    },
                    subject: {
                        required: true,
                    },
                    reason: {
                        required: true,
                    },
                    start_date: {
                        required: true,
                    },
                    end_date: {
                        required: true,
                    },
                },
                messages: {
                    leave_type: {
                        required: "Please Choose Leave Type",
                    },
                    subject: {
                        required: "Please Enter Subject",
                    },
                    reason: {
                        required: "Please Enter Reason",
                    },
                    start_date: {
                        required: "Please Enter Start Date",
                    },
                    end_date: {
                        required: "Please  Enter End Time",
                    },
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.err_msg').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>
@endsection
