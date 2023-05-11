@extends('layouts.app')

@section('content')
    @include('admin.alerts')

    <div class="card card-info mx-4">
        <div class="card-header">
            <h3 class="card-title">Edit Profile</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form class="form-horizontal" action="{{ route('editProfile') }}" method="POST">
            @csrf
            {{-- <div class="card-body">
                <div class="form-group row">
                    <label for="name" class="col-sm-4 col-form-label">Name</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}"
                            placeholder="First Name">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-sm-4 col-form-label">Email</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="email" name="email" value="{{ $user->email }}"
                            placeholder="Email" readonly>
                    </div>
                </div>



            </div> --}}

            <div class="card-body">
                <div class="row">
                    <div class="form-group col-md-6">

                        <label for="firstname" class="col-sm-12 col-form-label">First Name</label>
                        <div class="col-sm-12 err_msg">
                            <input type="text" class="form-control" name="firstname"
                                value="{{ old('firstname', $user->firstname) }}" id="firstname"
                                placeholder="Enter First Name">
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="middlename" class="col-sm-12 col-form-label">Middle Name</label>
                        <div class="col-sm-12 err_msg">
                            <input type="text" class="form-control" name="middlename" id="middlename"
                                value="{{ old('middlename', $user->middlename) }}" placeholder="Enter Middle Name">
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="form-group col-md-6">
                        <label for="lastname" class="col-sm-12 col-form-label">Last Name</label>
                        <div class="col-sm-12 err_msg">
                            <input type="text" class="form-control" name="lastname" id="lastname"
                                value="{{ old('lastname', $user->lastname) }}" placeholder="Enter Last Name">
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="occupation" class="col-sm-12 col-form-label">Occupation</label>
                        <div class="col-sm-12 err_msg">
                            <input type="text" class="form-control" name="occupation" id="occupation"
                                value="{{ old('occupation', $user->occupation) }}" placeholder="Enter Occupation">
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="personal_email" class="col-sm-12 col-form-label">Personal Email</label>
                        <div class="col-sm-12 err_msg">
                            <input type="email" class="form-control" name="personal_email" id="personal_email"
                                value="{{ old('personal_email', $user->personal_email) }}"
                                placeholder="Enter Personal Email">
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
                                value="{{ old('company_webmail', $user->company_webmail) }}"
                                placeholder="Enter Company Webmail" readonly>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="company_gmail" class="col-sm-12 col-form-label">Company Gmail</label>
                        <div class="col-sm-12 err_msg">
                            <input type="email" class="form-control" name="company_gmail" id="company_gmail"
                                value="{{ old('company_gmail', $user->company_gmail) }}" placeholder="Enter Company Gmail">
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
                                value="{{ old('gmail_password', $user->gmail_password) }}"
                                placeholder="Enter Gmail Password">
                            @error('gmail_password')
                                <span class="invalid-feedback d-block">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    {{-- <div class="form-group col-md-6">
                        
                        <label for="role_id" class="col-sm-12 col-form-label">Role</label>
                        <div class="col-sm-12 err_msg">
                            <select class="form-control" name="role_id" id="role_id">
                                <option value="">Select Role</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->role_id }}"
                                        {{ old('role_id', $role->role_id === $user->role_id ? 'selected' : '') }}>
                                        {{ $role->role_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div> --}}
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

                    <div class="form-group col-md-6">
                        <label for="blood_group" class="col-sm-12 col-form-label">Blood Group</label>
                        <div class="col-sm-12 err_msg">
                            <input type="text" class="form-control" name="blood_group" id="blood_group"
                                value="{{ old('blood_group', $user->blood_group) }}"placeholder="Enter Blood Group">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="adhar_no" class="col-sm-12 col-form-label">Adhaar Card No.</label>
                        <div class="col-sm-12 err_msg">
                            <input type="text" class="form-control" name="adhar_no" id="adhar_no"
                                value="{{ old('adhar_no', $user->adhar_no) }}" placeholder="Enter Adhaar Card No."
                                readonly>
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="pan_no" class="col-sm-12 col-form-label">PAN No.</label>
                        <div class="col-sm-12 err_msg">
                            <input type="text" class="form-control" name="pan_no" id="pan_no"
                                value="{{ old('pan_no', $user->pan_no) }}" placeholder="Enter PAN No." readonly>
                        </div>
                    </div>

                </div>

                <div class="row">

                    <div class="form-group col-md-6">
                        <label for="account_no" class="col-sm-12 col-form-label">Account No.</label>
                        <div class="col-sm-12 err_msg">
                            <input type="text" class="form-control" name="account_no" id="account_no"
                                value="{{ old('account_no', $user->account_no) }}"placeholder="Enter Bank Account No.">
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="ifsc_code" class="col-sm-12 col-form-label">IFSC Code</label>
                        <div class="col-sm-12 err_msg">
                            <input type="text" class="form-control" name="ifsc_code" id="ifsc_code"
                                value="{{ old('ifsc_code', $user->ifsc_code) }}" placeholder="Enter IFSC Code">
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="dob" class="col-sm-12 col-form-label">Date Of Birth</label>
                        <div class="col-sm-12 err_msg">
                            <input type="date" class="form-control" name="dob" id="dob"
                                value="{{ old('dob', $user->dob) }}" readonly>
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="qualification" class="col-sm-12 col-form-label">Qualification</label>
                        <div class="col-sm-12 err_msg">
                            <input type="text" class="form-control" id="qualification" name="qualification"
                                value="{{ old('qualification', $user->qualification) }}"
                                placeholder="Enter Qualification">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="joining_date" class="col-sm-12 col-form-label">Date Of Join</label>
                        <div class="col-sm-12 err_msg">
                            <input type="date" class="form-control" name="joining_date" id="joining_date"
                                value="{{ old('joining_date', $user->joining_date) }}" readonly>
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="mobile" class="col-sm-12 col-form-label">Mobile No.</label>
                        <div class="col-sm-12 err_msg">
                            <input type="text" class="form-control" name="mobile" id="mobile"
                                value="{{ old('mobile', $user->mobile) }}"placeholder="Enter Mobile No.">
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
                                cols="30" rows="2">{{ old('temporary_address', $user->temporary_address) }}</textarea>
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="permanent_address" class="col-sm-12 col-form-label">Permanent Address</label>
                        <div class="col-sm-12 err_msg">
                            <textarea class="form-control" name="permanent_address" id="permanent_address" placeholder="Permanent Address"
                                cols="30" rows="2">{{ old('permanent_address', $user->permanent_address) }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="employee_code" class="col-sm-12 col-form-label">Employee Code</label>
                        <div class="col-sm-12 err_msg">
                            <input type="text" class="form-control" id="employee_code" name="employee_code"
                                value="{{ old('employee_code', $user->employee_code) }}"
                                placeholder="Enter Employee Code" readonly>
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="position" class="col-sm-12 col-form-label">Position</label>
                        <div class="col-sm-12 err_msg">
                            <input type="text" class="form-control" id="position" name="position"
                                value="{{ old('position', $user->position) }}" placeholder="Enter Position" readonly>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="duty_in_time" class="col-sm-12 col-form-label">Duty in Time</label>
                        <div class="col-sm-12 err_msg">
                            <input type="time" class="form-control" name="duty_in_time" id="duty_in_time"
                                value="{{ old('duty_in_time', $user->duty_in_time) }}" readonly>
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="duty_out_time" class="col-sm-12 col-form-label">Duty Out Time</label>
                        <div class="col-sm-12 err_msg">
                            <input type="time" class="form-control" name="duty_out_time" id="duty_out_time"
                                value="{{ old('duty_out_time', $user->duty_out_time) }}" readonly>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="current_status" class="col-sm-12 col-form-label">Current Status</label>
                        <div class="col-sm-12 err_msg">
                            <input type="text" class="form-control" id="current_status" name="current_status"
                                value="{{ old('current_status', $user->current_status) }}"
                                placeholder="Enter Current Status" readonly>
                        </div>
                    </div>


                </div>




            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-info">Update Profile</button>
            </div>
            <!-- /.card-footer -->
        </form>
    </div>
@endsection
