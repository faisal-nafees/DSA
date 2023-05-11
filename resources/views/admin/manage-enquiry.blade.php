@extends('layouts.app')

@section('content')
    @include('admin.alerts')

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

                            <form action="{{ route('enquiry.manage') }}" method="POST">
                                @csrf
                                <div class="row align-items-end">
                                    <div class="col-sm-2">
                                        <!-- select -->
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
                                    <div class="form-group  col-md-1">
                                        <button type="submit" class="btn btn-outline-success">Submit</button>
                                    </div>
                                    <div class="form-group  col-md-1">
                                        <button type="button" onclick="reset(this)"
                                            class="btn btn-outline-secondary">Reset</button>
                                    </div>
                                    <div class="form-group  col-md-2">
                                        <a href="{{ route('enquiry.manage') }}" class="btn btn-light"><i
                                                class="fas fa-sync fa-lg px-2"></i></a>
                                    </div>
                                    <div class="custom-control custom-checkbox col-md-2 align-self-center">
                                        <input class="custom-control-input" type="checkbox" id="customCheckbox2">
                                        <label for="customCheckbox2" class="custom-control-label">Today Followup</label>
                                    </div>
                                </div>
                            </form>
                            <table id="enquiryTable" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Enquiry Type</th>
                                        <th class="exclude-columns">Followup</th>
                                        <th>Full Name</th>
                                        <th>Contact</th>
                                        {{-- <th>Mobile</th>
                                        <th>Whatsapp</th> --}}
                                        <th>Address</th>
                                        <th>City</th>
                                        <th>Date</th>
                                        <th>status</th>
                                        <th class="exclude-columns">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($enquiries as $enquiry)
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
                                <label for="action" class=" col-form-label">Action</label>
                                <div class="form-group">
                                    <select name="action" class="custom-select">
                                        <option disabled value="">Select Action</option>
                                        <option value="">Whatsapp</option>
                                        <option value="">Text</option>
                                        <option value="">Call</option>
                                        <option value="">Email</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="date" class=" col-form-label">Date</label>

                                <div class="err_msg">
                                    <input type="date" class="form-control" name="date"
                                        value="{{ old('date') }}" id="date" placeholder="Date">
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
                                <label for="description" class=" col-form-label">Description</label>

                                <div class=" err_msg">
                                    <input type="text" class="form-control" name="description"
                                        value="{{ old('description') }}" id="description"
                                        placeholder="Description/Remark">
                                </div>
                            </div>
                        </div>
                        <div class="row px-4">
                            <div class="form-group col-md-6">
                                <label for="next_date" class=" col-form-label">Next Followup</label>

                                <div class=" err_msg">
                                    <input type="date" class="form-control" name="next_date"
                                        value="{{ old('next_date') }}" id="next_date">
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="time" class=" col-form-label">Followup Time</label>

                                <div class=" err_msg">
                                    <input type="time" class="form-control" name="time"
                                        value="{{ old('time') }}" id="time">
                                </div>
                            </div>
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

        <!--View Followup Modal -->
        <button type="button" id="openViewFollowup" hidden class="btn btn-success" data-toggle="modal"
            data-target="#view-followup">
            Open Modal
        </button>
        <form action="" id="replyForm">
            <div class="modal fade" id="view-followup">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Comment</h4>
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
                                        <table id="contactTable" class="table table-bordered table-striped table-hover">
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
                                                <tr>
                                                    <td><a href="#" onclick="addFollowup()">Add Followup</a>
                                                    </td>
                                                    <td>Demo</td>
                                                    <td>10/05/2023</td>
                                                    <td>
                                                        10:09
                                                    </td>
                                                    <td>Test</td>

                                                </tr>

                                            </tbody>

                                        </table>
                                    </div>
                                    <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel"
                                        aria-labelledby="custom-tabs-four-profile-tab">
                                        <table id="contactTable" class="table table-bordered table-striped table-hover">
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
                                                    <td>Demo</td>
                                                    <td>Whatsapp</td>
                                                    <td>10/05/2023</td>
                                                    <td>12/05/2023</td>
                                                    <td>
                                                        10:09
                                                    </td>
                                                    <td>Test</td>
                                                    <td>Description</td>
                                                    <td>User</td>

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
                    action: {
                        required: true,
                    },
                    date: {
                        required: true,
                    },
                    title: {
                        required: true,
                        minlength: 2,
                    },
                    description: {
                        required: true,
                        minlength: 2,
                    },
                    next_date: {
                        required: true,
                    },
                    time: {
                        required: true
                    },
                },
                messages: {
                    title: {
                        required: "Please enter title",
                        minlength: "Title must be at least 2 characters"
                    },
                    date: {
                        required: "Please enter date",
                    },
                    action: {
                        required: "Please select action",
                    },
                    description: {
                        required: "Please enter description",
                        minlength: "Whatsapp no. must be at least 10 characters",
                        maxlength: "Whatsapp no. cannot be more than 13 characters long."
                    },
                    next_date: {
                        required: "Please enter date",
                    },
                    time: {
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
            $('#openAddFollowup').click();
            $('.close-modal').click();
            $id = e;
        }

        function viewFollowup(e) {
            $('#openViewFollowup').click();
            $id = e;
        }

        $(document).ready(function() {
            // Get the current date
            var currentDate = new Date();

            // Format the date as YYYY-MM-DD
            var formattedDate = currentDate.toISOString().slice(0, 10);

            // Set the formatted date as the value of the date input field
            $("#date").val(formattedDate);
        });
    </script>
@endsection
