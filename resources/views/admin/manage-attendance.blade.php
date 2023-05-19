@extends('layouts.app')

@section('content')
    @include('admin.alerts')
    @php
        use Carbon\Carbon;
    @endphp

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

                            {{-- <form action="{{ route('attendance') }}" method="POST">
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
                            </form> --}}
                            <div class="row">
                                <form action="{{ route('attendance.manage') }}" method="POST" class="col-md-10">
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
                                            <a href="{{ route('attendance.manage') }}" class="btn btn-light"><i
                                                    class="fas fa-sync fa-lg px-2"></i></a>
                                        </div>
                                    </div>
                                </form>
                                <div class="custom-control custom-checkbox col-md-2 align-self-center">
                                    <form action="{{ route('attendance.today') }}" method="POST" id="todayAttendance">
                                        @csrf
                                        <input class="custom-control-input" type="checkbox" id="todayAttendanceCheckbox">
                                        <label for="todayAttendanceCheckbox" class="custom-control-label">Todays
                                            Attendance</label>
                                    </form>
                                </div>
                            </div>
                            <table id="leavesTable" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Action</th>
                                        <th>Staff</th>
                                        <th>Attendance Date</th>
                                        <th>Att</th>
                                        <th>Late</th>
                                        <th>Reason</th>
                                        <th>Time Log</th>
                                        <th>Actual Hrs</th>
                                        <th>Worked Hrs</th>
                                        <th>Timesheet Log Hrs</th>
                                        <th>Remote IP</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($attendances->sortByDesc('time_login') as $attendance)
                                        @php
                                            $timeLogin = Carbon::parse($attendance->time_login)->format('H:i:s');
                                            $dateLogin = Carbon::parse($attendance->time_login)->format('Y-m-d');
                                            $targetTime = '09:40:00';
                                            $currentDate = Carbon::now()->format('Y-m-d');
                                            $attDate = Carbon::parse($attendance->date)->format('d-M-Y l');
                                        @endphp
                                        <tr>
                                            <td class="text-center"><a href="#"
                                                    onclick="editAttendance({{ $attendance->attn_id }})"><i
                                                        class='fas fa-pen'></i></a>
                                            </td>
                                            <td>{{ $attendance->firstname . ' ' . $attendance->lastname }}</td>
                                            <td>{{ $attDate }}</td>
                                            <td class="text-center">
                                                @php
                                                    $hours = substr($attendance->worked_hours, 0, 1);
                                                @endphp

                                                @if ($attendance->time_logout && $attendance->time_login)
                                                    <span
                                                        class="p-2 {{ $hours < 9 ? 'bg-warning' : 'bg-success' }}">{{ $hours < 9 ? 'H' : 'P' }}</span>
                                                @elseif (!$attendance->time_logout && $attendance->time_login && $dateLogin == $currentDate)
                                                    <span class="p-2 bg-info">W</span>
                                                @elseif ($dateLogin != $currentDate && !$attendance->time_logout)
                                                    <span class="p-2 bg-danger">A</span>
                                                @elseif (!$attendance->time_logout && !$attendance->time_login)
                                                    <span class="p-2 bg-danger">A</span>
                                                @endif

                                            </td>
                                            <td>
                                                @if ($timeLogin > $targetTime)
                                                    <span class="p-2 bg-danger">L</span>
                                                @endif
                                            </td>
                                            <td>{{ $attendance->reason }}
                                            </td>
                                            <td>
                                                <p class="mb-0"><strong>In:
                                                    </strong>{{ $attendance->time_login }}
                                                </p>
                                                <p class="mb-0"><strong>Out: </strong>{{ $attendance->time_logout }}</p>
                                            </td>
                                            <td>{{ $attendance->actual_hours }}</td>
                                            <td>{{ $attendance->worked_hours }}</td>
                                            <td>{{ $attendance->timesheet_log_hrs }}</td>
                                            <td>
                                                <p class="mb-0"><strong>In: </strong>{{ $attendance->remote_ip_in }}</p>
                                                <p class="mb-0"><strong>Out: </strong>{{ $attendance->remote_ip_out }}
                                                </p>
                                            </td>
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

        <!--Add Followup Modal -->
        <button type="button" id="openEditAttendance" hidden class="btn btn-success" data-toggle="modal"
            data-target="#editAttendance">
            Open Modal
        </button>
        <form action="" id="editAttendanceForm">
            <div class="modal fade" id="editAttendance">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Edit Attendance</h4>
                            <button type="button" class="close close-modal" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="row px-4">

                            <div class="form-group col-md-6">
                                <label for="date" class=" col-form-label">Date</label>

                                <div class="err_msg">
                                    <input type="date" class="form-control" name="date" value="{{ old('date') }}"
                                        id="date" readonly>
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="time_logout" class=" col-form-label">Out Time</label>

                                <div class="err_msg">
                                    <input type="time" class="form-control" name="time_logout"
                                        value="{{ old('time_logout') }}" id="time_logout">
                                </div>
                            </div>
                            <input type="text" hidden name="attendance_id" id="attendance_id">
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default close-modal"
                                data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
        </form>
        <!-- /.modal -->

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

            $('#editAttendanceForm').validate({
                rules: {
                    time_logout: {
                        required: true,
                    }
                },
                messages: {
                    time_logout: {
                        required: "Please Enter Out Time",
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

            $(document).ready(function() {
                // Add event listener for checkbox change
                $('#todayAttendanceCheckbox').change(function() {
                    // Check if the checkbox is selected
                    if ($(this).is(':checked')) {
                        // Submit the form
                        $('#todayAttendance').submit();
                    }
                });
            });

        });


        function editAttendance(e) {
            $('#openEditAttendance').click();
            $('.close-modal').click();
            $('#time_logout').val('');
            $attendance_id = e;
            $.ajax({
                type: 'GET',
                url: "{{ URL::to('/edit-attendance/') }}/" + $attendance_id,
                success: function(data) {
                    console.log(data.data);
                    var dateParts = data.data.date.split(" ")[0].split("-");
                    var year = dateParts[0];
                    var month = dateParts[1];
                    var day = dateParts[2];

                    var formattedDate = year + "-" + month + "-" + day;
                    $('#date').val(formattedDate);
                    var timeParts = data.data.date.split(" ")[1].split(":");
                    var hour = timeParts[0];
                    var minute = timeParts[1];
                    var second = timeParts[2];

                    var formattedTime = hour + ":" + minute + ":" + second;
                    $('#attendance_id').val(data.data.attendance_id);
                    $('#time_logout').val(formattedTime);
                    $('.close-modal')
                        .click(); // Hide the modal after successful submission

                }
            });

        }
        $('#editAttendanceForm').submit(function(event) {
            if ($(this).valid()) {
                event.preventDefault(); // Prevent the default form submission

                // Get the time out from the input
                var time_logout = $('#time_logout').val();
                var attendance_id = $('#attendance_id').val();
                var date = $('#date').val();
                // Send an AJAX request to the server
                $.ajax({
                    type: 'POST',
                    url: "{{ URL::to('/edit-attendance/') }}/" + $attendance_id,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        time_logout: time_logout,
                        date: date,
                    },
                    success: function(data) {
                        console.log(data);
                        $('#time_logout').val('');
                        $('.close-modal')
                            .click(); // Hide the modal after successful submission
                        Toastify({
                            text: 'Attendence updated successfully',
                            duration: 3000,
                            destination: "https://github.com/apvarun/toastify-js",
                            newWindow: true,
                            close: true,
                            gravity: "top", // `top` or `bottom`
                            position: "center", // `left`, `center` or `right`
                            stopOnFocus: true, // Prevents dismissing of toast on hover
                            style: {
                                background: "linear-gradient(to right, #61FF57, #96c93d)",
                            },
                            onClick: function() {} // Callback after click
                        }).showToast();
                    }
                });
            }
        });
    </script>
@endsection
