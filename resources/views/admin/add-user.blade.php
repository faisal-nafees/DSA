@extends('layouts.app')

@section('content')
    <ol class="breadcrumb blue-grey lighten-4">
        <li class="breadcrumb-item"><a class="black-text" href="{{ route('user.manage') }}">Manage Users</a><i
                class="fa fa-angle-double-right mx-2" aria-hidden="true"></i></li>
        <li class="breadcrumb-item active">Edit User</li>
    </ol>
    <div class="card card-info mx-4">
        <div class="card-header">
            <h3 class="card-title">Add User</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form id="addUserForm" action="{{ route('user.add') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-md-6">

                        <label for="firstname" class="col-sm-12 col-form-label">First Name</label>
                        <div class="col-sm-12 err_msg">
                            <input type="text" class="form-control" name="firstname" value="{{ old('firstname') }}"
                                id="firstname" placeholder="Enter First Name">
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="middlename" class="col-sm-12 col-form-label">Middle Name</label>
                        <div class="col-sm-12 err_msg">
                            <input type="text" class="form-control" name="middlename" id="middlename"
                                value="{{ old('middlename') }}" placeholder="Enter Middle Name">
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="form-group col-md-6">
                        <label for="lastname" class="col-sm-12 col-form-label">Last Name</label>
                        <div class="col-sm-12 err_msg">
                            <input type="text" class="form-control" name="lastname" id="lastname"
                                value="{{ old('lastname') }}" placeholder="Enter Last Name">
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="occupation" class="col-sm-12 col-form-label">Occupation</label>
                        <div class="col-sm-12 err_msg">
                            <input type="text" class="form-control" name="occupation" id="occupation"
                                value="{{ old('occupation') }}" placeholder="Enter Occupation">
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="personal_email" class="col-sm-12 col-form-label">Personal Email</label>
                        <div class="col-sm-12 err_msg">
                            <input type="email" class="form-control" name="personal_email" id="personal_email"
                                value="{{ old('personal_email') }}" placeholder="Enter Personal Email">
                            @error('personal_email')
                                <span class="invalid-feedback d-block">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="company_webmail" class="col-sm-12 col-form-label">Company Webmail</label>
                        <div class="col-sm-12 err_msg">
                            <input type="email" class="form-control" name="company_webmail" id="company_webmail"
                                value="{{ old('company_webmail') }}" placeholder="Enter Company Webmail">
                            @error('company_webmail')
                                <span class="invalid-feedback d-block">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="company_gmail" class="col-sm-12 col-form-label">Company Gmail</label>
                        <div class="col-sm-12 err_msg">
                            <input type="email" class="form-control" name="company_gmail" id="company_gmail"
                                value="{{ old('company_gmail') }}" placeholder="Enter Company Gmail">
                            @error('company_gmail')
                                <span class="invalid-feedback d-block">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="gmail_password" class="col-sm-12 col-form-label">Gmail Password</label>
                        <div class="col-sm-12 err_msg">
                            <input type="password" class="form-control" name="gmail_password" id="gmail_password"
                                value="{{ old('gmail_password') }}" placeholder="Enter Gmail Password">
                            @error('gmail_password')
                                <span class="invalid-feedback d-block">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="password" class="col-sm-12 col-form-label">System Password</label>
                        <div class="col-sm-12 err_msg">
                            <input type="text" class="form-control" name="password" id="password"
                                value="{{ old('password') }}" placeholder="Enter Password">
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="marital_status" class="col-sm-12 col-form-label">Marital Status</label>
                        <div class="col-sm-12 err_msg">
                            <select class="form-control" name="marital_status" id="marital_status">
                                <option disabled selected>Select Status</option>
                                <option value="M" {{ old('marital_status'), 'selected' }}>Married</option>
                                <option value="M" {{ old('marital_status'), 'selected' }}>Unmarried</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="blood_group" class="col-sm-12 col-form-label">Blood Group</label>
                        <div class="col-sm-12 err_msg">
                            <input type="text" class="form-control" name="blood_group" id="blood_group"
                                value="{{ old('blood_group') }}"placeholder="Enter Blood Group">
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="adhar_no" class="col-sm-12 col-form-label">Adhaar Card No.</label>
                        <div class="col-sm-12 err_msg">
                            <input type="text" class="form-control" name="adhar_no" id="adhar_no"
                                value="{{ old('adhar_no') }}" placeholder="Enter Adhaar Card No.">
                            @error('adhar_no')
                                <span class="invalid-feedback d-block">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="adhar_pic" class="col-sm-12 col-form-label">Upload Adhaar Card</label>
                        <div class="col-sm-12 err_msg">
                            <input type="file" class="form-control" name="adhar_pic" id="adhar_pic"
                                value="{{ old('adhar_pic') }}" placeholder="Enter Adhaar Card No.">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-3">
                        <label for="pan_no" class="col-sm-12 col-form-label">PAN No.</label>
                        <div class="col-sm-12 err_msg">
                            <input type="text" class="form-control" name="pan_no" id="pan_no"
                                value="{{ old('pan_no') }}" placeholder="Enter PAN No.">
                            @error('pan_no')
                                <span class="invalid-feedback d-block">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="pan_pic" class="col-sm-12 col-form-label">Upload Pan Card</label>
                        <div class="col-sm-12 err_msg">
                            <input type="file" class="form-control" name="pan_pic" id="pan_pic"
                                value="{{ old('pan_pic') }}" placeholder="Enter Adhaar Card No.">
                        </div>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="account_no" class="col-sm-12 col-form-label">Account No.</label>
                        <div class="col-sm-12 err_msg">
                            <input type="text" class="form-control" name="account_no" id="account_no"
                                value="{{ old('account_no') }}"placeholder="Enter Bank Account No.">
                        </div>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="passbook_pic" class="col-sm-12 col-form-label">Passbook Photo</label>
                        <div class="col-sm-12 err_msg">
                            <input type="file" class="form-control" name="passbook_pic" id="passbook_pic"
                                value="{{ old('passbook_pic') }}" placeholder="Enter Adhaar Card No.">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="ifsc_code" class="col-sm-12 col-form-label">IFSC Code</label>
                        <div class="col-sm-12 err_msg">
                            <input type="text" class="form-control" name="ifsc_code" id="ifsc_code"
                                value="{{ old('ifsc_code') }}" placeholder="Enter IFSC Code">
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="dob" class="col-sm-12 col-form-label">Date Of Birth</label>
                        <div class="col-sm-12 err_msg">
                            <input type="date" class="form-control" name="dob" id="dob"
                                value="{{ old('dob') }}">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="joining_date" class="col-sm-12 col-form-label">Date Of Join</label>
                        <div class="col-sm-12 err_msg">
                            <input type="date" class="form-control" name="joining_date" id="joining_date"
                                value="{{ old('joining_date') }}">
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="mobile" class="col-sm-12 col-form-label">Mobile No.</label>
                        <div class="col-sm-12 err_msg">
                            <input type="text" class="form-control" name="mobile" id="mobile"
                                value="{{ old('mobile') }}"placeholder="Enter Mobile No.">
                            @error('mobile')
                                <span class="invalid-feedback d-block">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="temporary_address" class="col-sm-12 col-form-label">Temporary Address</label>
                        <div class="col-sm-12 err_msg">
                            <textarea class="form-control" name="temporary_address" id="temporary_address" placeholder="Temporary Address"
                                cols="30" rows="2">{{ old('temporary_address') }}</textarea>
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="permanent_address" class="col-sm-12 col-form-label">Permanent Address</label>
                        <div class="col-sm-12 err_msg">
                            <textarea class="form-control" name="permanent_address" id="permanent_address" placeholder="Permanent Address"
                                cols="30" rows="2">{{ old('permanent_address') }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="employee_code" class="col-sm-12 col-form-label">Employee Code</label>
                        <div class="col-sm-12 err_msg">
                            <input type="text" class="form-control" id="employee_code" name="employee_code"
                                value="{{ old('employee_code') }}" placeholder="Enter Employee Code">
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="position" class="col-sm-12 col-form-label">Position</label>
                        <div class="col-sm-12 err_msg">
                            <input type="text" class="form-control" id="position" name="position"
                                value="{{ old('position') }}" placeholder="Enter Position">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="duty_in_time" class="col-sm-12 col-form-label">Duty in Time</label>
                        <div class="col-sm-12 err_msg">
                            <input type="time" class="form-control" name="duty_in_time" id="duty_in_time"
                                value="{{ old('duty_in_time') }}">
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="duty_out_time" class="col-sm-12 col-form-label">Duty Out Time</label>
                        <div class="col-sm-12 err_msg">
                            <input type="time" class="form-control" name="duty_out_time" id="duty_out_time"
                                value="{{ old('duty_out_time') }}">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="current_status" class="col-sm-12 col-form-label">Current Status</label>
                        <div class="col-sm-12 err_msg">
                            <input type="text" class="form-control" id="current_status" name="current_status"
                                value="{{ old('current_status') }}" placeholder="Enter Current Status">
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="qualification" class="col-sm-12 col-form-label">Qualification</label>
                        <div class="col-sm-12 err_msg">
                            <input type="text" class="form-control" id="qualification" name="qualification"
                                value="{{ old('qualification') }}" placeholder="Enter Qualification">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="esenceweb_experience" class="col-sm-12 col-form-label">Esenceweb Experience</label>
                        <div class="col-sm-12 err_msg">
                            <input type="text" class="form-control" id="esenceweb_experience"
                                name="esenceweb_experience" value="{{ old('esenceweb_experience') }}"
                                placeholder="Enter Esenceweb Experience">
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="previous_experience" class="col-sm-12 col-form-label">Previous Experience</label>
                        <div class="col-sm-12 err_msg">
                            <input type="text" class="form-control" id="previous_experience"
                                name="previous_experience" value="{{ old('previous_experience') }}"
                                placeholder="Enter Previous Experience">
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="total_experience" class="col-sm-12 col-form-label">Total Experience</label>
                        <div class="col-sm-12 err_msg">
                            <input type="text" class="form-control" id="total_experience" name="total_experience"
                                value="{{ old('total_experience') }}" placeholder="Enter Total Experience">
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="other_experience" class="col-sm-12 col-form-label">Other Experience</label>
                        <div class="col-sm-12 err_msg">
                            <input type="text" class="form-control" id="other_experience" name="other_experience"
                                value="{{ old('other_experience') }}" placeholder="Enter Other Experience">
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="probation_end" class="col-sm-12 col-form-label">Probation End</label>
                        <div class="col-sm-12 err_msg">
                            <input type="date" class="form-control" id="probation_end" name="probation_end"
                                value="{{ old('probation_end') }}">
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="experience" class="col-sm-12 col-form-label">Experience</label>
                        <div class="col-sm-12 err_msg">
                            <input type="text" class="form-control" id="experience" name="experience"
                                value="{{ old('experience') }}" placeholder="Enter Experience">
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="form-group col-md-3">
                        <label for="passport_pic" class="col-sm-12 col-form-label">Passport Photo</label>
                        <div class="col-sm-12 err_msg">
                            <input type="file" class="form-control" id="passport_pic" name="passport_pic"
                                value="{{ old('passport_pic') }}">
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="address_proof_pic" class="col-sm-12 col-form-label">Address Proof</label>
                        <div class="col-sm-12 err_msg">
                            <input type="file" class="form-control" id="address_proof_pic" name="address_proof_pic"
                                value="{{ old('address_proof_pic') }}">
                        </div>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="experience_letter_pic" class="col-sm-12 col-form-label">Experience Letter</label>
                        <div class="col-sm-12 err_msg">
                            <input type="file" class="form-control" id="experience_letter_pic"
                                name="experience_letter_pic" value="{{ old('experience_letter_pic') }}">
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="educational_certificate_pic" class="col-sm-12 col-form-label">Educational
                            Certificate</label>
                        <div class="col-sm-12 err_msg">
                            <input type="file" class="form-control" id="educational_certificate_pic"
                                name="educational_certificate_pic" value="{{ old('educational_certificate_pic') }}">
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="role_id" class="col-sm-12 col-form-label">Role</label>
                        <div class="col-sm-12 err_msg">
                            <select class="form-control" name="role_id" id="role_id">
                                <option value="">Select Role</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->role_id }}"
                                        {{ old('role_id') == $role->role_id ? 'selected' : '' }}>{{ $role->role_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="menu_access" class="col-sm-12 col-form-label">Menu Access</label>
                        <div class="col-sm-12 err_msg">
                            <select class="form-control" multiple id="menu_access">
                                <option value="">Task</option>
                                <option value="">Reporting</option>
                                <option value="">Leaves</option>
                                <option value="">Attendance</option>
                                <option value="">Enquiries</option>
                                <option value="">Users</option>
                            </select>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <a href="{{ route('user.manage') }}" class="btn btn-warning">Cancel</a>
                <button type="submit" class="btn btn-info float-right">Add User</button>
            </div>
            <!-- /.card-footer -->
        </form>
    </div>
@endsection
@section('scripts')
    <script>
        $(function() {
            $('#addUserForm').validate({
                rules: {
                    firstname: {
                        required: true,
                        minlength: 2
                    },
                    middlename: {
                        required: true,
                        minlength: 2
                    },
                    lastname: {
                        required: true,
                        minlength: 2
                    },
                    personal_email: {
                        required: true,
                        email: true
                    },
                    company_webmail: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true,
                        minlength: 8
                    },
                    marital_status: {
                        required: true,
                    },
                    blood_group: {
                        required: true,
                    },
                    account_no: {
                        required: true,
                    },
                    ifsc_code: {
                        required: true,
                    },
                    dob: {
                        required: true,
                    },
                    joining_date: {
                        required: true,
                    },
                    mobile: {
                        required: true,
                        minlength: 2
                    },
                    pan_no: {
                        required: true,
                        minlength: 10,
                        maxlength: 10,
                    },
                    adhar_no: {
                        required: true,
                        minlength: 16,
                        maxlength: 16,
                    },
                    temporary_address: {
                        required: true,
                        minlength: 2
                    },
                    permanent_address: {
                        required: true,
                        minlength: 2
                    },
                    employee_code: {
                        required: true,
                    },
                    position: {
                        required: true
                    },
                    qualification: {
                        required: true
                    },
                    esenceweb_experience: {
                        required: true
                    },
                    previous_experience: {
                        required: true
                    },
                    total_experience: {
                        required: true
                    },
                    other_experience: {
                        required: true
                    },
                    probation_end: {
                        required: true
                    },
                    experience: {
                        required: true
                    },
                    role_id: {
                        required: true
                    },
                },
                messages: {
                    firstname: {
                        required: "Please Enter First Name",
                        minlength: "First name must be at least 2 characters"
                    },
                    middlename: {
                        required: "Please Enter Middle Name",
                        minlength: "Middle name must be at least 2 characters"
                    },
                    lastname: {
                        required: "Please Enter Last Name",
                        minlength: "Last name must be at least 2 characters"
                    },
                    personal_email: {
                        required: "Please Enter Personal Email",
                        email: "Please Enter a valid email address"
                    },
                    company_webmail: {
                        required: "Please Enter Company Email",
                        email: "Please Enter a valid email address"
                    },
                    password: {
                        required: "Please Enter Password",
                        minlength: "Password must be at least 8 characters"
                    },
                    marital_status: {
                        required: "Please Choose Status",
                    },
                    blood_group: {
                        required: "Please Enter Blood Group",
                    },
                    account_no: {
                        required: "Please Enter Bank Account No.",
                    },
                    ifsc_code: {
                        required: "Please Enter IFSC Code",
                    },
                    dob: {
                        required: "Please Enter Date of Birth",
                    },
                    joining_date: {
                        required: "Please Enter Date of Join",
                    },
                    account_no: {
                        required: "Please Enter Bank Account No.",
                    },
                    mobile: {
                        required: "Please Enter Mobile No.",
                        minlength: "Mobile No. must be at least 10 characters"
                    },
                    pan_no: {
                        required: "Please Enter PAN No.",
                        minlength: "PAN no. must be 10 characters",
                        maxlength: "PAN no. must be 10 characters"
                    },
                    adhar_no: {
                        required: "Please Enter Adhaar No.",
                        minlength: "Adhaar no. must be 16 characters",
                        maxlength: "Adhaar no. must be 16 characters"
                    },
                    temporary_address: {
                        required: "Please Enter Temporary Address",
                        minlength: "Address must be at least 2 characters"
                    },
                    permanent_address: {
                        required: "Please Enter Permanent Address",
                        minlength: "Address must be at least 2 characters"
                    },
                    employee_code: {
                        required: "Please Enter Employee Code"
                    },
                    position: {
                        required: "Please Enter Position"
                    },
                    qualification: {
                        required: "Please Enter Qualification"
                    },
                    esenceweb_experience: {
                        required: "Please Enter Esenceweb Experience"
                    },
                    previous_experience: {
                        required: "Please Enter Previous Experience"
                    },
                    total_experience: {
                        required: "Please Enter Total Experience"
                    },
                    other_experience: {
                        required: "Please Enter Other Experience"
                    },
                    probation_end: {
                        required: "Please Enter Probation Period"
                    },
                    experience: {
                        required: "Please Enter Experience"
                    },
                    role_id: {
                        required: "Please select a role"
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
    </script>
@endsection
