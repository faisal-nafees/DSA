@extends('layouts.app')

@section('content')
    @include('admin.alerts')

    <section class="content pt-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Leaves</h3>
                            <a href="{{ route('leave.add') }}" class="btn btn-primary float-end">Add Leave</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                            <form action="{{ route('leave.manage') }}" method="POST">
                                @csrf
                                <div class="row align-items-end">
                                    <div class="col-sm-2">
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
                                        <a href="{{ route('leave.manage') }}" class="btn btn-light"><i
                                                class="fas fa-sync fa-lg px-2"></i></a>
                                    </div>
                                </div>
                            </form>
                            <table id="leavesTable" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <td>Action</td>
                                        <td>Username</td>
                                        <th>Leave Type</th>
                                        <th>Subject</th>
                                        <th>Reason</th>
                                        <th>Start</th>
                                        <th>End</th>
                                        <th>Status</th>
                                        <th>Created Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($leaves as $leave)
                                        <tr>
                                            <td class="text-center"><a
                                                    href="{{ route('leave.edit', ['id' => $leave->leave_id]) }}"><i
                                                        class='fas fa-pen'></i></a></td>
                                            <td>{{ $leave->firstname . ' ' . $leave->lastname }}</td>
                                            <td>{{ $leave->type }}</td>
                                            <td>{{ $leave->subject }}
                                            </td>
                                            <td>
                                                {{ $leave->reason }}
                                            </td>
                                            <td>{{ $leave->leave_start }}</td>
                                            <td>{{ $leave->leave_end }}</td>
                                            <td
                                                class="{{ $leave->leave_status_name == 'Approved' ? 'text-success' : ($leave->leave_status_name == 'Canceled' ? 'text-danger' : '') }}">
                                                {{ $leave->leave_status_name }}</td>
                                            <td>{{ date('Y-m-d', strtotime($leave->created_at)) }}</td>

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
        });
    </script>
@endsection
