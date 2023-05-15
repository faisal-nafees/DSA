@extends('layouts.app')

@section('content')
    <ol class="breadcrumb blue-grey lighten-4">
        <li class="breadcrumb-item"><a class="black-text" href="{{ route('enquiry.manage') }}">Manage Enquiries</a><i
                class="fa fa-angle-double-right mx-2" aria-hidden="true"></i></li>
        <li class="breadcrumb-item active">Edit Enquiry</li>
    </ol>
    <div class="card card-info mx-4">
        <div class="card-header">
            <h3 class="card-title">Edit Enquiry</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form id="editEnquiryForm" class="form-horizontal" action="{{ route('enquiry.edit', ['id' => $enquiry->enq_id]) }}"
            method="POST">
            @csrf

            <div class="card-body">
                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="enq_type" class="col-12 col-form-label">Enquiry Type</label>
                        <div class="col-12 err_msg">
                            <select class="form-control" name="enq_type" id="enq_type">
                                <option value="">Select Enquiry Type</option>
                                @foreach ($enq_type as $type)
                                    <option value="{{ $type->enqtype_id }}"
                                        {{ $type->enqtype_id === $enquiry->enq_type ? 'selected' : '' }}>
                                        {{ $type->enqtype_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="enq_source" class="col-12 col-form-label">Enquiry Source</label>
                        <div class="col-12 err_msg">
                            <select class="form-control" name="enq_source" id="enq_source">
                                <option value="">Select Enquiry Source</option>
                                @foreach ($sources as $source)
                                    <option value="{{ $source->source_id }}"
                                        {{ $source->source_id === $enquiry->enq_source ? 'selected' : '' }}>
                                        {{ $source->source_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="interest" class="col-12 col-form-label">Interested In</label>
                        <div class="col-12 err_msg">
                            <select class="form-control" name="interest" id="interest">
                                <option value="">Select Interest</option>
                                <option value="Interest 1" {{ $enquiry->interest === 'Interest 1' ? 'selected' : '' }}>
                                    Interest 1</option>
                                <option value="Interest 2" {{ $enquiry->interest === 'Interest 2' ? 'selected' : '' }}>
                                    Interest 2</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="enquiry_date" class="col-12 col-form-label">Enquiry Date</label>
                        <div class="col-12 err_msg">
                            <input type="date" class="form-control" name="enquiry_date" id="enquiry_date"
                                value="{{ $enquiry->enquiry_date }}">
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="fullname" class="col-12 col-form-label">Full Name</label>
                        <div class="col-12 err_msg">
                            <input type="text" class="form-control" name="fullname" id="fullname"
                                value="{{ $enquiry->fullname }}" placeholder="Enter Full Name">
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="email" class="col-12 col-form-label">Email</label>
                        <div class="col-12 err_msg">
                            <input type="email" class="form-control" name="email" id="email"
                                value="{{ $enquiry->email }}" placeholder="Enter Email">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="primary_mobile" class="col-12 col-form-label">Primary Mobile No.</label>
                        <div class="col-12 err_msg">
                            <input type="text" class="form-control" name="primary_mobile" id="primary_mobile"
                                value="{{ $enquiry->primary_mobile }}" placeholder="Enter Primary Mobile No.">
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="alternate_mobile" class="col-12 col-form-label">Alternate Mobile No.</label>
                        <div class="col-12 err_msg">
                            <input type="text" class="form-control" name="alternate_mobile" id="alternate_mobile"
                                value="{{ $enquiry->alternate_mobile }}" placeholder="Enter Alternate Mobile No.">
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="whatsapp" class="col-12 col-form-label">Whatsapp No.</label>
                        <div class="col-12 err_msg">
                            <input type="text" class="form-control" name="whatsapp" id="whatsapp"
                                value="{{ $enquiry->whatsapp }}" placeholder="Enter Whatsapp No.">
                        </div>
                    </div>
                </div>

                <div class="row">

                    <div class="form-group col-md-4">
                        <label for="address" class="col-12 col-form-label">Permanent Address</label>
                        <div class="col-12 err_msg">
                            <textarea rows="2" class="form-control" name="address" id="address" placeholder="Enter Address">{{ $enquiry->address }}</textarea>
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="additional_info" class="col-12 col-form-label">Additional Info</label>
                        <div class="col-12 err_msg">
                            <textarea rows="2" class="form-control" name="additional_info" id="additional_info"
                                placeholder="Enter Additional Info">{{ $enquiry->additional_info }}</textarea>
                        </div>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="status_id" class="col-12 col-form-label">Status</label>
                        <div class="col-12 err_msg">
                            <select class="form-control" name="status_id" id="status_id">
                                <option value="">Select Status</option>
                                @foreach ($status as $item)
                                    <option value="{{ $item->status_id }}"
                                        {{ $item->status_id === $enquiry->status_id ? 'selected' : '' }}>
                                        {{ $item->status_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>


            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <a href="{{ route('enquiry.manage') }}" class="btn btn-warning">Cancel</a>
                <button type="submit" class="btn btn-info float-right">Update Enquiry</button>
            </div>
            <!-- /.card-footer -->
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        $(function() {
            $('#editEnquiryForm').validate({
                rules: {
                    fullname: {
                        required: true,
                        minlength: 2
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    primary_mobile: {
                        required: true,
                        minlength: 10,
                        maxlength: 13
                    },
                    alternate_mobile: {
                        minlength: 10,
                        maxlength: 13
                    },
                    whatsapp: {
                        required: true,
                        minlength: 10,
                        maxlength: 13
                    },
                    address: {
                        required: true,
                        minlength: 2
                    },
                    additional_info: {
                        required: true,
                        minlength: 2
                    },
                    enq_type: {
                        required: true
                    },
                    enq_source: {
                        required: true
                    },
                    status_id: {
                        required: true
                    },
                    status_id: {
                        required: true
                    },
                    enquiry_date: {
                        required: true
                    },
                    interest: {
                        required: true
                    }
                },
                messages: {
                    fullname: {
                        required: "Please Enter Name",
                        minlength: "Name must be at least 2 characters"
                    },
                    email: {
                        required: "Please Enter Email",
                        email: "Please enter a valid email address"
                    },
                    primary_mobile: {
                        required: "Please Enter Moile No.",
                        minlength: "Mobile no. must be at least 10 characters",
                        maxlength: "Mobile no. cannot be more than 13 characters long."
                    },
                    alternate_mobile: {
                        minlength: "Mobile no. must be at least 10 characters",
                        maxlength: "Mobile no. cannot be more than 13 characters long."
                    },
                    whatsapp: {
                        required: "Please Enter Whatsapp no.",
                        minlength: "Whatsapp no. must be at least 10 characters",
                        maxlength: "Whatsapp no. cannot be more than 13 characters long."
                    },
                    address: {
                        required: "Please Enter Address",
                        minlength: "Address must be at least 2 characters"
                    },
                    additional_info: {
                        required: "Please Enter Additional Info",
                        minlength: "Additional Info must be at least 2 characters"
                    },
                    enq_type: {
                        required: "Please Select a Enquiry Type",
                    },
                    enq_source: {
                        required: "Please Select a Enquiry Source",
                    },
                    status_id: {
                        required: "Please Select Status",
                    },
                    enquiry_date: {
                        required: "Please Enter Date",
                    },
                    interest: {
                        required: "Please Select Interest",
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
@endsection
