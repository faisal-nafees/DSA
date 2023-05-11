@extends('layouts.app')

@section('content')
    <ol class="breadcrumb blue-grey lighten-4">
        <li class="breadcrumb-item"><a class="black-text" href="{{ route('enquiry.manage') }}">Manage Enquiries</a><i
                class="fa fa-angle-double-right mx-2" aria-hidden="true"></i></li>
        <li class="breadcrumb-item active">Add Enquiry</li>
    </ol>
    <div class="card card-info mx-4">
        <div class="card-header">
            <h3 class="card-title">Add Enquiry</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form id="addEnquiryForm" class="form-horizontal" action="{{ route('enquiry.add') }}" method="POST">
            @csrf

            <div class="card-body">
                <div class="row">
                    <div class="form-group row col-md-6">
                        <label for="enq_type" class="col-sm-4 col-form-label">Enquiry Type</label>
                        <div class="col-sm-8 err_msg">

                            <select class="form-control" name="enq_type" id="enq_type">
                                <option value="">Select Enquiry Type</option>
                                @foreach ($enq_type as $type)
                                    <option value="{{ $type->enqtype_id }}">{{ $type->enqtype_name }}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>
                    <div class="form-group row col-md-6">
                        <label for="enq_source" class="col-sm-4 col-form-label">Enquiry Source</label>
                        <div class="col-sm-8 err_msg">
                            <select class="form-control" name="enq_source" id="enq_source">
                                <option value="">Select Enquiry Source</option>
                                @foreach ($sources as $source)
                                    <option value="{{ $source->source_id }}">{{ $source->source_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group row col-md-6">
                        <label for="fullname" class="col-sm-4 col-form-label">Full Name</label>
                        <div class="col-sm-8 err_msg">
                            <input type="text" class="form-control" name="fullname" id="fullname"
                                placeholder="Full Name">
                        </div>
                    </div>
                    <div class="form-group row col-md-6">
                        <label for="email" class="col-sm-4 col-form-label">Email</label>
                        <div class="col-sm-8 err_msg">
                            <input type="email" class="form-control" name="email" id="email" placeholder="Email">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group row col-md-6">
                        <label for="mobile" class="col-sm-4 col-form-label">Mobile</label>
                        <div class="col-sm-8 err_msg">
                            <input type="text" class="form-control" name="mobile" id="mobile" placeholder="Mobile">
                        </div>
                    </div>
                    <div class="form-group row col-md-6">
                        <label for="whatsapp" class="col-sm-4 col-form-label">Whatsapp</label>
                        <div class="col-sm-8 err_msg">
                            <input type="text" class="form-control" name="whatsapp" id="whatsapp"
                                placeholder="Whatsapp">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group row col-md-6">
                        <label for="city" class="col-sm-4 col-form-label">City</label>
                        <div class="col-sm-8 err_msg">
                            <input type="text" class="form-control" name="city" id="city" placeholder="City">
                        </div>
                    </div>
                    <div class="form-group row col-md-6">
                        <label for="address" class="col-sm-4 col-form-label">Address</label>
                        <div class="col-sm-8 err_msg">
                            <input type="text" class="form-control" name="address" id="address" placeholder="Address">
                        </div>
                    </div>
                </div>


            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <a href="{{ route('enquiry.manage') }}" class="btn btn-warning">Cancel</a>
                <button type="submit" class="btn btn-info float-right">Add Enquiry</button>
            </div>
            <!-- /.card-footer -->
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        $(function() {
            $('#addEnquiryForm').validate({
                rules: {
                    fullname: {
                        required: true,
                        minlength: 2
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    mobile: {
                        required: true,
                        minlength: 10,
                        maxlength: 13
                    },
                    whatsapp: {
                        required: true,
                        minlength: 10,
                        maxlength: 13
                    },
                    city: {
                        required: true,
                        minlength: 2,
                        maxlength: 10
                    },
                    address: {
                        required: true,
                        minlength: 2
                    },
                    enq_type: {
                        required: true
                    },
                    enq_source: {
                        required: true
                    }
                },
                messages: {
                    fullname: {
                        required: "Please enter your name",
                        minlength: "Name must be at least 2 characters"
                    },
                    email: {
                        required: "Please enter your email",
                        email: "Please enter a valid email address"
                    },
                    mobile: {
                        required: "Please enter your mobile no.",
                        minlength: "Mobile no. must be at least 10 characters",
                        maxlength: "Mobile no. cannot be more than 13 characters long."
                    },
                    whatsapp: {
                        required: "Please enter your whatsapp no.",
                        minlength: "Whatsapp no. must be at least 10 characters",
                        maxlength: "Whatsapp no. cannot be more than 13 characters long."
                    },
                    city: {
                        required: "Please enter your city",
                        minlength: "City must be at least 2 characters",
                        maxlength: "City cannot be more than 10 characters long."
                    },
                    address: {
                        required: "Please enter your city",
                        minlength: "Address must be at least 2 characters"
                    },
                    enq_type: {
                        required: "Please select a enquiry type",
                    },
                    enq_source: {
                        required: "Please select a enquiry source",
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
