@extends('layouts.app')

@section('content')
    @include('admin.alerts')

    <section class="content pt-3">
        <div class="card card-info mx-2">
            <div class="card-header">
                <h3 class="card-title">Daily Reporting</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form id="addEnquiryForm" class="form-horizontal" method="POST">
                @csrf

                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label for="task_id" class="col-sm-12 col-form-label">Report Task</label>
                            <div class="col-sm-12 err_msg">

                                <select class="form-control custom-select" name="task_id" id="task_id">
                                    <option disabled selected>Select task</option>
                                    <option>Task 1</option>
                                    <option>Task 2</option>
                                    <option>Task 3</option>

                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="task_title" class="col-sm-12 col-form-label">Report Description</label>
                            <div class="col-sm-12 err_msg">
                                <textarea rows="2" class="form-control" name="description" id="description" placeholder="Enter Description"></textarea>
                            </div>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="description" class="col-sm-12 col-form-label">Report Remark</label>
                            <div class="col-sm-12 err_msg">
                                <textarea rows="2" class="form-control" name="description" id="description" placeholder="Enter Description"></textarea>
                            </div>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="assigned_date" class="col-sm-12 col-form-label">Report Date</label>
                            <div class="col-sm-12 err_msg">
                                <input type="date" class="form-control" name="assigned_date" id="assigned_date"
                                    placeholder="assigned_date">
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="form-group col-md-2">
                            <label for="assigned_date" class="col-sm-12 col-form-label">Start Task</label>
                            <div class="col-sm-12 err_msg">
                                <input type="time" class="form-control" name="assigned_date" id="assigned_date"
                                    placeholder="assigned_date">
                            </div>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="assigned_time" class="col-sm-12 col-form-label">End Task</label>
                            <div class="col-sm-12 err_msg">
                                <input type="time" class="form-control" name="assigned_time" id="assigned_time"
                                    placeholder="assigned_time">
                            </div>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="attachment_1" class="col-sm-12 col-form-label">Report Attachment</label>
                            <div class="col-sm-12 err_msg">
                                <input type="file" class="form-control" name="attachment_1" id="attachment_1"
                                    value="{{ old('attachment_1') }}" placeholder="Enter Adhaar Card No.">
                            </div>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="task_id" class="col-sm-12 col-form-label">Report Status</label>
                            <div class="col-sm-12 err_msg">

                                <select class="form-control custom-select" name="task_id" id="task_id">
                                    <option disabled selected>Select Status</option>
                                    <option>In progress</option>
                                    <option>Completed</option>
                                    <option>Pending</option>
                                    <option>Hold</option>
                                    <option>Cancelled</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-3 d-flex align-items-end">
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

                            <form action="{{ route('reporting') }}" method="POST">
                                @csrf
                                <div class="row align-items-end">

                                    <div class="form-group  col-md-2">
                                        <label for="start_date" class="col-form-label">To</label>

                                        <input type="date" class="form-control" name="start_date" id="start_date">

                                    </div>
                                    <div class="form-group  col-md-2">
                                        <label for="end_date" class="col-form-label">From</label>

                                        <input type="date" class="form-control" name="end_date" id="end_date">

                                    </div>
                                    <div class="form-group  col-md-2">
                                        <button type="submit" class="btn btn-outline-success">Submit</button>
                                    </div>
                                    <div class="form-group  col-md-2">
                                        <button type="button" onclick="reset(this)"
                                            class="btn btn-outline-secondary">Reset</button>
                                    </div>
                                    <div class="form-group  col-md-2">
                                        <a href="{{ route('reporting') }}" class="btn btn-light"><i
                                                class="fas fa-sync fa-lg px-2"></i></a>
                                    </div>
                                </div>
                            </form>
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
                                    {{-- @foreach ($enquiries as $enquiry)
                                        <tr>
                                            <td>{{ $enquiry->enqtype_name }}</td>
                                            <td>
                                                <a href="#" class="cursor-pointer text-primary"
                                                    onclick="addFollowup({{ $enquiry->enq_id }})">
                                                    <i class="fas fa-plus pe-1"></i><span>Add</span>
                                                </a><br>
                                                <a href="#" class="cursor-pointer text-success"
                                                    onclick="viewFollowup({{ $enquiry->enq_id }})">
                                                    <i class="fas fa-eye pe-1"></i>View
                                                </a>

                                            </td>
                                            <td>{{ $enquiry->fullname }}
                                            </td>
                                            <td>
                                                <p class="mb-0"><strong>Email: </strong>{{ $enquiry->email }}</p>
                                                <p class="mb-0"><strong>Mobile: </strong>{{ $enquiry->mobile }}</p>
                                                <p class="mb-0"><strong>Whatsapp: </strong>{{ $enquiry->whatsapp }}</p>
                                            </td>
                                            <td>{{ $enquiry->address }}</td>
                                            <td>{{ $enquiry->city }} {{ $enquiry->status_id }}</td>
                                            <td>{{ date('Y-m-d', strtotime($enquiry->created_at)) }}</td>
                                            <td
                                                class="{{ $enquiry->status_id === 1 ? 'text-success' : ($enquiry->status_id === 2 ? 'text-warning' : ($enquiry->status_id === 3 ? 'text-danger' : 'text-primary')) }}">
                                                {{ $enquiry->status_name }}</td>
                                            <td>
                                                <a href="{{ route('enquiry.edit', ['id' => $enquiry->enq_id]) }}"><i
                                                        class='fas fa-pen 2x mr-4'></i></a>
                                                <a href="{{ route('enquiry.delete', ['id' => $enquiry->enq_id]) }}"
                                                    onclick="return confirm('Are you sure you want to delete this enquiry?')">
                                                    <i class='fas fa-trash-alt text-danger'></i></a>

                                            </td>
                                        </tr>
                                    @endforeach --}}
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
        });
    </script>
@endsection
