@extends('layouts.app')

@section('content')
    @include('admin.alerts')
    @php
        $isFollowup = false;
    @endphp

    <section class="content pt-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Manage Enquiries</h3>
                            <a href="{{ route('enquiry.add') }}" class="btn btn-primary float-end">Add Enquiry</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <form action="{{ route('enquiry.manage') }}" method="POST" class="col-md-10">
                                    @csrf
                                    <div class="row align-items-end">
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="enqtype_id" class="col-form-label">Enquiry Type</label>
                                                <select name="enqtype_id" class="custom-select">
                                                    <option value="">Enquiry Type</option>
                                                    @foreach ($enq_type as $type)
                                                        <option value="{{ $type->enqtype_id }}">{{ $type->enqtype_name }}
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
                                        <div class="form-group  col-md-1">
                                            <a href="{{ route('enquiry.manage') }}" class="btn btn-light"><i
                                                    class="fas fa-sync fa-lg px-2"></i></a>
                                        </div>
                                        {{-- <div class="custom-control custom-checkbox col-md-2 align-self-center">
                                        <input class="custom-control-input" type="checkbox" id="customCheckbox2">
                                        <label for="customCheckbox2" class="custom-control-label">Todays Followup</label>
                                    </div> --}}
                                    </div>
                                </form>
                                <div class="custom-control custom-checkbox col-md-2 align-self-center">
                                    <form action="{{ route('followup.today') }}" method="POST" id="todayFollowup">
                                        @csrf
                                        <input class="custom-control-input" type="checkbox" id="todayFollowupCheckbox">
                                        <label for="todayFollowupCheckbox" class="custom-control-label">Todays
                                            Followup</label>
                                    </form>
                                </div>
                            </div>
                            <table id="enquiryTable" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Enquiry Type</th>
                                        <th class="exclude-columns">Followup</th>
                                        <th>Full Name</th>
                                        <th>Contact</th>
                                        <th>Additonal Info</th>
                                        <th>Address</th>
                                        <th>Created By</th>
                                        <th>Date</th>
                                        <th>status</th>
                                        <th class="exclude-columns">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($enquiries->sortByDesc('created_at') as $enquiry)
                                        <tr>
                                            <td>{{ $enquiry->enqtype_name }}</td>
                                            <td>
                                                <a href="#" class="cursor-pointer text-primary"
                                                    onclick="addFollowup({{ $enquiry->enq_id }})">
                                                    <i class="fas fa-plus pe-1"></i><span>Add</span>
                                                </a><br>

                                                @foreach ($followups as $followup)
                                                    @if ($followup->lead_id == $enquiry->enq_id)
                                                        @php
                                                            $isFollowup = true;
                                                        @endphp
                                                    @endif
                                                @endforeach
                                                @if ($isFollowup)
                                                    <a href="#" class="cursor-pointer text-success"
                                                        onclick="viewFollowup({{ $enquiry->enq_id }})">
                                                        <i class="fas fa-eye pe-1"></i>View
                                                    </a>
                                                @endif

                                            </td>
                                            <td>{{ $enquiry->fullname }}
                                            </td>
                                            <td>
                                                <p class="mb-0"><strong>Email: </strong>{{ $enquiry->email }}</p>
                                                <p class="mb-0"><strong>Mobile: </strong>{{ $enquiry->primary_mobile }}
                                                </p>
                                                <p class="mb-0"><strong>Alternate Mobile:
                                                    </strong>{{ @$enquiry->alternate_mobile }}
                                                </p>
                                                <p class="mb-0"><strong>Whatsapp: </strong>{{ $enquiry->whatsapp }}</p>
                                            </td>
                                            <td>{{ $enquiry->additional_info }}</td>
                                            <td>{{ $enquiry->address }}</td>
                                            <td>{{ $enquiry->firstname . ' ' . $enquiry->lastname }}</td>
                                            <td>{{ $enquiry->enquiry_date }}</td>
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
        <button type="button" id="openAddFollowup" hidden class="btn btn-success" data-toggle="modal"
            data-target="#add-followup">
            Open Modal
        </button>
        <form action="" id="addFollowupForm">
            <div class="modal fade" id="add-followup">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Followup</h4>
                            <button type="button" class="close close-modal" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="row px-4">
                            <div class="form-group col-md-6">
                                <label for="lead_action" class=" col-form-label">Action</label>
                                <div class="err_msg">
                                    <select name="lead_action" class="custom-select">
                                        <option value="">Select Action</option>
                                        @foreach ($lead_actions as $action)
                                            <option value="{{ $action->action_id }}">{{ $action->action_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="followup_date" class=" col-form-label">Date</label>

                                <div class="err_msg">
                                    <input type="date" class="form-control" name="followup_date"
                                        value="{{ old('followup_date') }}" id="followup_date">
                                </div>
                            </div>
                        </div>
                        <div class="row px-4">
                            <div class="form-group col-md-6">
                                <label for="title" class=" col-form-label">Title</label>

                                <div class=" err_msg">
                                    <input type="text" class="form-control" name="title"
                                        value="{{ old('title') }}" id="title" placeholder="Title">
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="remark" class=" col-form-label">Description</label>

                                <div class=" err_msg">
                                    <textarea rows="2" class="form-control" name="remark" id="remark" placeholder="Description/Remark">{{ old('remark') }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row px-4">
                            <div class="form-group col-md-6">
                                <label for="next_followup_date" class=" col-form-label">Next Followup</label>

                                <div class=" err_msg">
                                    <input type="date" class="form-control" name="next_followup_date"
                                        value="{{ old('next_followup_date') }}" id="next_followup_date">
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="followup_time" class=" col-form-label">Followup Time</label>

                                <div class=" err_msg">
                                    <input type="time" class="form-control" name="followup_time"
                                        value="{{ old('followup_time') }}" id="followup_time">
                                </div>
                            </div>
                        </div>
                        <input type="text" hidden name="lead_id" id="lead_id">
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

        <!--View Followup Modal -->
        <button type="button" id="openViewFollowup" hidden class="btn btn-success" data-toggle="modal"
            data-target="#view-followup">
            Open Modal
        </button>
        <form action="" id="viewfollowupForm">
            <div class="modal fade" id="view-followup">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Followup</h4>
                            <button type="button" class="close close-modal" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="card card-primary card-outline card-outline-tabs">
                            <div class="card-header p-0 border-bottom-0">
                                <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill"
                                            href="#custom-tabs-four-home" role="tab"
                                            aria-controls="custom-tabs-four-home" aria-selected="true">Pending</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill"
                                            href="#custom-tabs-four-profile" role="tab"
                                            aria-controls="custom-tabs-four-profile" aria-selected="false">History</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content" id="custom-tabs-four-tabContent">
                                    <div class="tab-pane fade show active" id="custom-tabs-four-home" role="tabpanel"
                                        aria-labelledby="custom-tabs-four-home-tab">
                                        <table id="pendingTable" class="table table-bordered table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Action</th>
                                                    <th>Lead Name</th>
                                                    <th>Followup Date</th>
                                                    <th>Followup Time</th>
                                                    <th>Followup By</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <td colspan="5">No data found</td>
                                            </tbody>

                                        </table>
                                    </div>
                                    <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel"
                                        aria-labelledby="custom-tabs-four-profile-tab">
                                        <table id="historyTable" class="table table-bordered table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Lead Name</th>
                                                    <th>Followup Type</th>
                                                    <th>Followup Date</th>
                                                    <th>Next Followup Date</th>
                                                    <th>Followup Time</th>
                                                    <th>Title</th>
                                                    <th>Remark</th>
                                                    <th>Followup By</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card -->
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
        $(document).ready(function() {
            // Add event listener for checkbox change
            $('#todayFollowupCheckbox').change(function() {
                // Check if the checkbox is selected
                if ($(this).is(':checked')) {
                    // Submit the form
                    $('#todayFollowup').submit();
                }
            });
        });

        $(function() {
            $('#enquiryTable').DataTable({
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
            }).buttons().container().appendTo('#enquiryTable_wrapper .col-md-6:eq(0)')

            // Add Followup validation
            $('#addFollowupForm').validate({
                rules: {
                    lead_action: {
                        required: true,
                    },
                    followup_date: {
                        required: true,
                    },
                    title: {
                        required: true,
                        minlength: 2,
                    },
                    remark: {
                        required: true,
                        minlength: 2,
                    },
                    next_followup_date: {
                        required: true,
                    },
                    followup_time: {
                        required: true
                    },
                },
                messages: {
                    title: {
                        required: "Please enter title",
                        minlength: "Title must be at least 2 characters"
                    },
                    followup_date: {
                        required: "Please enter date",
                    },
                    lead_action: {
                        required: "Please select action",
                    },
                    remark: {
                        required: "Please enter description",
                        minlength: "Whatsapp no. must be at least 10 characters",
                        maxlength: "Whatsapp no. cannot be more than 13 characters long."
                    },
                    next_followup_date: {
                        required: "Please enter date",
                    },
                    followup_time: {
                        required: "Please enter time",
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

        function addFollowup(e) {
            var form = $('#addFollowupForm');
            form[0].reset(); // Clear form fields
            form.validate().resetForm(); // Reset validation
            form.find('.is-invalid').removeClass('is-invalid'); // Remove invalid classes
            $('#openAddFollowup').click();
            $('.close-modal').click();
            var lead_id = e;
            var currentDate = new Date();
            // Format the date as YYYY-MM-DD
            var formattedDate = currentDate.toISOString().slice(0, 10);
            // Set the formatted date as the value of the date input field
            $("#followup_date").val(formattedDate);
            $("#lead_id").val(lead_id);
            $.ajax({
                url: "{{ URL::to('/view-followup') }}/" + lead_id,
                type: 'GET',
                data: {
                    lead_id: lead_id,
                },
                success: function(data) {
                    $('.close-modal')
                        .click(); // Hide the modal after successful submission
                    console.log(data.length);
                    if (data.length > 0) {
                        switch (data.length) {
                            case 1:
                                $('#title').val('2nd Followup')
                                break;
                            case 2:
                                $('#title').val('3rd Followup')
                                break;
                            case 3:
                                $('#title').val('4th Followup')
                                break;
                            case 4:
                                $('#title').val('5th Followup')
                                break;
                            case 5:
                                $('#title').val('6th Followup')
                                break;
                            case 6:
                                $('#title').val('7th Followup')
                                break;
                            default:
                                $('#title').val('nth Followup')
                                break;
                        }
                    }
                },
                error: function(xhr) {
                    // Handle the error response
                    console.log(xhr.responseText);
                }
            });
        }

        function viewFollowup(e) {
            $('#openViewFollowup').click();
            var lead_id = e;
            $.ajax({
                url: "{{ URL::to('/view-followup') }}/" + lead_id,
                type: 'GET',
                data: {
                    lead_id: lead_id,
                },
                success: function(data) {
                    $('.close-modal')
                        .click(); // Hide the modal after successful submission
                    pendingFollowup(data);
                    followupHistory(data);

                },
                error: function(xhr) {
                    // Handle the error response
                    console.log(xhr.responseText);
                }
            });
        }

        $(function() {
            $('#addFollowupForm').submit(function(e) {
                e.preventDefault(); // Prevent default form submission
                var form = $(this);
                var formData = new FormData(this);
                if (form.valid()) {
                    $.ajax({
                        url: "{{ URL::to('/add-followup') }}",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(data) {
                            $('.close-modal')
                                .click(); // Hide the modal after successful submission
                            Toastify({
                                text: data,
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
                        },
                        error: function(xhr) {
                            // Handle the error response
                            console.log(xhr.responseText);
                        }
                    });
                }
            });
        });

        function pendingFollowup(data) {
            var tableBody = $('#pendingTable tbody');
            tableBody.empty(); // Clear existing rows

            $.each(data, function(index, item) {
                if (item.followup_status == 1) {
                    console.log(1234567);
                    var row = $('<tr>');
                    row.append($('<td>').html('<a href="#" onclick="addFollowup(' +
                        item.lead_id + ')">Add Followup</a>'));
                    row.append($('<td>').text(item.fullname));
                    row.append($('<td>').text(item.followup_date));
                    row.append($('<td>').text(item.followup_time));
                    row.append($('<td>').text(item.firstname + ' ' + item.lastname));
                    tableBody.append(row);
                }
            });
        }

        function followupHistory(data) {
            var tableBody = $('#historyTable tbody');
            tableBody.empty(); // Clear existing rows

            $.each(data, function(index, item) {
                if (item.followup_status == 0) {
                    var row = $('<tr>');
                    row.append($('<td>').text(item.fullname));
                    row.append($('<td>').text(item.action_name));
                    row.append($('<td>').text(item.followup_date));
                    row.append($('<td>').text(item.next_followup_date));
                    row.append($('<td>').text(item.followup_time));
                    row.append($('<td>').text(item.title));
                    row.append($('<td>').text(item.remark));
                    row.append($('<td>').text(item.firstname + ' ' + item.lastname));
                    tableBody.append(row);
                }
            });
        }
    </script>
@endsection
