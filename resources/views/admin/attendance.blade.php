@extends('layouts.app')

@section('content')
    @include('admin.alerts')

    <section class="content pt-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Attendance</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                            <form action="{{ route('attendance') }}" method="POST">
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
                                        <a href="{{ route('attendance') }}" class="btn btn-light"><i
                                                class="fas fa-sync fa-lg px-2"></i></a>
                                    </div>
                                </div>
                            </form>
                            <table id="leavesTable" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Attendance Date</th>
                                        <th>Att</th>
                                        <th>Reason</th>
                                        <th>Time Log</th>
                                        <th>Actual Hrs</th>
                                        <th>Worked Hrs</th>
                                        <th>Timesheet Log Hrs</th>
                                        <th>Remote IP</th>
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
