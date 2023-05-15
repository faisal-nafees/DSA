@extends('layouts.app')

@section('content')
    @include('admin.alerts')

    <section class="content pt-3">
        @if (!$today_report)
            <div class="m-2 alert alert-danger">
                Please submit your todays reportiong of your total worked hours.
            </div>
        @endif

        <div class="card card-info mx-2">
            <div class="card-header">
                <h3 class="card-title">Daily Reporting</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form id="addReportForm" action="{{ route('report.add') }}" class="form-horizontal" enctype="multipart/form-data"
                method="POST">
                @csrf

                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label for="task_id" class="col-sm-12 col-form-label">Report Task</label>
                            <div class="col-sm-12 err_msg">

                                <select class="form-control custom-select" name="task_id" id="task_id">
                                    <option disabled selected>Select task</option>
                                    @foreach ($tasks as $task)
                                        <option value="{{ $task->task_id }}">{{ $task->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="report_description" class="col-sm-12 col-form-label">Report Description</label>
                            <div class="col-sm-12 err_msg">
                                <textarea rows="2" class="form-control" name="report_description" id="report_description"
                                    placeholder="Enter Description"></textarea>
                            </div>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="remark" class="col-sm-12 col-form-label">Report Remark</label>
                            <div class="col-sm-12 err_msg">
                                <textarea rows="2" class="form-control" name="remark" id="remark" placeholder="Enter Remark"></textarea>
                            </div>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="report_date" class="col-sm-12 col-form-label">Report Date</label>
                            <div class="col-sm-12 err_msg">
                                <input type="date" class="form-control" name="report_date" id="report_date"
                                    placeholder="report_date">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-2">
                            <label for="start_task" class="col-sm-12 col-form-label">Start Task</label>
                            <div class="col-sm-12 err_msg">
                                <input type="time" class="form-control" name="start_task" id="start_task"
                                    placeholder="start_task">
                            </div>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="end_task" class="col-sm-12 col-form-label">End Task</label>
                            <div class="col-sm-12 err_msg">
                                <input type="time" class="form-control" name="end_task" id="end_task"
                                    placeholder="end_task">
                            </div>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="attachment" class="col-sm-12 col-form-label">Report Attachment</label>
                            <div class="col-sm-12 err_msg">
                                <input type="file" class="form-control" name="attachment" id="attachment">
                            </div>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="report_status_id" class="col-sm-12 col-form-label">Report Status</label>
                            <div class="col-sm-12 err_msg">

                                <select class="form-control custom-select" name="report_status_id" id="report_status_id">
                                    <option disabled selected>Select Status</option>
                                    @foreach ($report_status as $status)
                                        @if ($status->status_id !== 1)
                                            <option value="{{ $status->status_id }}">{{ $status->status_name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-2 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary">Submit Report</button>

                        </div>

                    </div>

                </div>
            </form>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Report list</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <form action="{{ route('reporting') }}" method="POST" class="col-md-10">
                                    @csrf
                                    <div class="row align-items-end">
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="user_id" class="col-form-label">Staff Name</label>
                                                <select name="user_id" class="custom-select">
                                                    <option value="">Select Staff</option>
                                                    @foreach ($users as $user)
                                                        <option value="{{ $user->user_id }}">
                                                            {{ $user->firstname . $user->lastname . ' (' . $user->role_name . ')' }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group  col-md-2">
                                            <label for="start_date" class="col-form-label">To</label>

                                            <input type="date" class="form-control" name="start_date"
                                                id="start_date">

                                        </div>
                                        <div class="form-group  col-md-2">
                                            <label for="end_date" class="col-form-label">From</label>

                                            <input type="date" class="form-control" name="end_date" id="end_date">

                                        </div>
                                        <div class="form-group  col-md-2">
                                            <button type="submit" class="btn w-100 btn-outline-success">Submit</button>
                                        </div>
                                        <div class="form-group  col-md-1">
                                            <button type="button" onclick="reset(this)"
                                                class="btn btn-outline-secondary">Reset</button>
                                        </div>
                                        <div class="form-group  col-md-1">
                                            <a href="{{ route('reporting') }}" class="btn btn-light"><i
                                                    class="fas fa-sync fa-lg px-2"></i></a>
                                        </div>
                                    </div>
                                </form>
                                <div class="custom-control custom-checkbox col-md-2 align-self-center">
                                    <form action="{{ route('report.today') }}" method="POST" id="todayReport">
                                        @csrf
                                        <input class="custom-control-input" type="checkbox" id="todayReportCheckbox">
                                        <label for="todayReportCheckbox" class="custom-control-label">Todays
                                            Report</label>
                                    </form>
                                </div>
                            </div>
                            <table id="leavesTable" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Report User</th>
                                        <th>Report Timestamp</th>
                                        <th>Task</th>
                                        <th>Reporting</th>
                                        <th>Remark</th>
                                        <th>Attachment</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($reports as $report)
                                        <tr>
                                            <td>{{ $report->firstname . ' ' . $report->lastname }}</td>
                                            <td>{{ $report->report_date }} <br>
                                                {{ $report->start_task . '-' . $report->end_task }}
                                            </td>
                                            <td>{{ $report->title }}</td>
                                            <td>{{ $report->report_description }}</td>
                                            <td>{{ $report->remark }}</td>
                                            <td>
                                                @if ($report->attachment)
                                                    <a href="/storage/{{ $report->attachment }}"
                                                        target="blank">Attachment</a>
                                                @endif
                                            </td>
                                            <td>{{ $report->status_name }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>

        <!-- /.container-fluid -->
    </section>

    <script>
        $(function() {
            $('#leavesTable').DataTable({
                "paging": true,
                "pageLength": 30,
                "lengthChange": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "searching": false,
            })

            $('#addReportForm').validate({
                rules: {
                    task_id: {
                        required: true,
                    },
                    report_description: {
                        required: true,
                    },
                    report_status_id: {
                        required: true,
                    },
                    report_date: {
                        required: true,
                    },
                    start_task: {
                        required: true,
                    },
                    end_task: {
                        required: true
                    }
                },
                messages: {
                    user_id: {
                        required: "Please Choose Task",
                    },
                    report_description: {
                        required: "Please Enter Description",
                    },
                    report_status_id: {
                        required: "Please Enter Description",
                    },
                    report_date: {
                        required: "Please Enter Report Date",
                    },
                    start_task: {
                        required: "Please  Enter Start Task",
                    },
                    end_task: {
                        required: "Please  Enter End Task",
                    }
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
    <script>
        $(document).ready(function() {
            // Add event listener for checkbox change
            $('#todayReportCheckbox').change(function() {
                // Check if the checkbox is selected
                if ($(this).is(':checked')) {
                    // Submit the form
                    $('#todayReport').submit();
                }
            });
        });
    </script>
@endsection
