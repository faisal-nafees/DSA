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
                        <label for="type" class="col-sm-12 col-form-label">Leave Type</label>
                        <div class="col-sm-12 err_msg">

                            <select class="form-control custom-select" name="type" id="type">
                                <option value="">Select Leave Type</option>
                                <option value="Half Day (1st Half 9:30 am - 2:00 pm)">Half Day (1st Half 9:30 am - 2:00 pm)
                                </option>
                                <option value="Half Day (2nd Half 2:00 pm - 6:30 pm)">Half Day (2nd Half 2:00 pm - 6:30 pm)
                                </option>
                                <option value="Full Day (9:30 am - 6:30 pm)">Full Day (9:30 am - 6:30 pm)</option>
                                <option value="Emergency">Emergency</option>
                                <option value="Sick Leave">Sick Leave</option>

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
                        <label for="leave_start" class="col-sm-12 col-form-label">Leave Start Date</label>
                        <div class="col-sm-12 err_msg">
                            <input type="date" class="form-control" name="leave_start" id="leave_start"
                                value="{{ old('leave_start') }}" placeholder="Enter Adhaar Card No.">
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="leave_end" class="col-sm-12 col-form-label">Leave End Date</label>
                        <div class="col-sm-12 err_msg">
                            <input type="date" class="form-control" name="leave_end" id="leave_end"
                                value="{{ old('leave_end') }}" placeholder="Enter Adhaar Card No.">
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
