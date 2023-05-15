@extends('layouts.app')

@section('content')
    @include('admin.alerts')

    <section class="content pt-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Manage Tasks</h3>
                            <a href="{{ route('task.add') }}" class="btn btn-primary float-end">Add Task</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                            {{-- <form action="{{ route('task.manage') }}" method="POST">
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
                                    <div class="form-group  col-md-1">
                                        <button type="button" onclick="reset(this)"
                                            class="btn btn-outline-secondary">Reset</button>
                                    </div>
                                    <div class="form-group  col-md-2">
                                        <a href="{{ route('task.manage') }}" class="btn btn-light"><i
                                                class="fas fa-sync fa-lg px-2"></i></a>
                                    </div>
                                </div>
                            </form> --}}
                            <div class="row">
                                <form action="{{ route('task.manage') }}" method="POST" class="col-md-10">
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

                                            <input type="date" class="form-control" name="start_date" id="start_date">

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
                                            <a href="{{ route('task.manage') }}" class="btn btn-light"><i
                                                    class="fas fa-sync fa-lg px-2"></i></a>
                                        </div>
                                    </div>
                                </form>
                                <div class="custom-control custom-checkbox col-md-2 align-self-center">
                                    <form action="{{ route('task.today') }}" method="POST" id="todayTask">
                                        @csrf
                                        <input class="custom-control-input" type="checkbox" id="todayTaskCheckbox">
                                        <label for="todayTaskCheckbox" class="custom-control-label">Todays Task</label>
                                    </form>
                                </div>
                            </div>
                            <table id="taskTable" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Action</th>
                                        <th>Task Title</th>
                                        <th>Description</th>
                                        <th>Assigned TAT</th>
                                        <th>Estimate TAT</th>
                                        <th>Completed TAT</th>
                                        <th>Attachment</th>
                                        <th>Assigned By</th>
                                        <th>Assigned To</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tasks as $task)
                                        <tr>
                                            <td>
                                                <a href="{{ route('task.edit', ['id' => $task->task_id]) }}"><i
                                                        class='fas fa-pen'></i></a>
                                                <a href="{{ route('task.delete', ['id' => $task->task_id]) }}"
                                                    class="ml-2"
                                                    onclick="return confirm('Are you sure you want to delete this task?')">
                                                    <i class='fas fa-trash-alt text-danger '></i></a>
                                            </td>
                                            <td>{{ $task->title }}</td>
                                            <td>{{ $task->description }}
                                            </td>
                                            <td>
                                                <p class="mb-0"><strong>Date: </strong>{{ $task->assigned_date }}</p>
                                                <p class="mb-0"><strong>Time: </strong>{{ $task->assigned_time }}</p>
                                            </td>
                                            <td>
                                                <p class="mb-0"><strong>Date: </strong>{{ $task->estimate_date }}</p>
                                                <p class="mb-0"><strong>Time: </strong>{{ $task->estimate_time }}</p>
                                            </td>
                                            <td></td>
                                            <td>
                                                @if ($task->attachment_1)
                                                    <a href="/storage/{{ $task->attachment_1 }}" target="blank">Attachment
                                                        1</a>
                                                @endif
                                                @if ($task->attachment_2)
                                                    <a href="/storage/{{ $task->attachment_2 }}" target="blank">Attachment
                                                        2</a>
                                                @endif
                                            </td>
                                            <td>{{ $task->assigned_by }}</td>
                                            <td>{{ $task->firstname . ' ' . $task->lastname }}</td>
                                            <td>{{ $task->status_name }}</td>
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
            $('#taskTable').DataTable({
                "paging": true,
                "pageLength": 30,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "buttons": [{
                        extend: 'excel',
                        exportOptions: {
                            columns: ':visible:not(.exclude-columns)' // Exclude columns with 'exclude-columns' class
                        },
                        customize: function(xlsx) {
                            var sheet = xlsx.xl.worksheets['sheet1.xml'];
                            $('row c[r^="A"]', sheet).attr('s',
                                '2'); // Set style to hide the heading
                        }
                    },
                    {
                        extend: 'pdf',
                        exportOptions: {
                            columns: ':not(.exclude-columns)'
                        },
                        customize: function(doc) {
                            doc.content.splice(0,
                                1); // Remove the first element (heading) from the content array
                        }
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: ':not(.exclude-columns)'
                        },
                        customize: function(win) {
                            $(win.document.body).find('h1')
                                .remove(); // Remove the heading element from the print view
                        }
                    }
                ]
            }).buttons().container().appendTo('#taskTable_wrapper .col-md-6:eq(0)')

        });
    </script>

    <script>
        $(document).ready(function() {
            // Add event listener for checkbox change
            $('#todayTaskCheckbox').change(function() {
                // Check if the checkbox is selected
                if ($(this).is(':checked')) {
                    // Submit the form
                    $('#todayTask').submit();
                }
            });
        });
    </script>
@endsection
