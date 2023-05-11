@extends('layouts.app')

@section('content')
    <ol class="breadcrumb blue-grey lighten-4">
        <li class="breadcrumb-item"><a class="black-text" href="{{ route('task.manage') }}">Manage Tasks</a><i
                class="fa fa-angle-double-right mx-2" aria-hidden="true"></i></li>
        <li class="breadcrumb-item active">Add Task</li>
    </ol>
    <div class="card card-info mx-4">
        <div class="card-header">
            <h3 class="card-title">Add Task</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form id="addTaskForm" class="form-horizontal" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="card-body">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="user_id" class="col-sm-12 col-form-label">Staff Name</label>
                        <div class="col-sm-12 err_msg">

                            <select class="form-control custom-select" name="user_id" id="user_id">
                                <option value="">Select Staff Name</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->user_id }}">
                                        {{ $user->firstname . ' ' . $user->lastname . ' ' . '(' . $user->role_name . ')' }}
                                    </option>
                                @endforeach

                            </select>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="title" class="col-sm-12 col-form-label">Task Title</label>
                        <div class="col-sm-12 err_msg">
                            <input type="text" class="form-control" name="title" id="title"
                                placeholder="Enter Task Title">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="description" class="col-sm-12 col-form-label">Description</label>
                        <div class="col-sm-12 err_msg">
                            <textarea rows="2" class="form-control" name="description" id="description" placeholder="Enter Description"></textarea>
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="attachment_1" class="col-sm-12 col-form-label">Attachment 1</label>
                        <div class="col-sm-12 err_msg">
                            <input type="file" class="form-control" name="attachment_1" id="attachment_1"
                                value="{{ old('attachment_1') }}" placeholder="Enter Adhaar Card No.">
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="attachment_1" class="col-sm-12 col-form-label">Attachment 2</label>
                        <div class="col-sm-12 err_msg">
                            <input type="file" class="form-control" name="attachment_1" id="attachment_1"
                                value="{{ old('attachment_1') }}" placeholder="Enter Adhaar Card No.">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-3">
                        <label for="assigned_date" class="col-sm-12 col-form-label">Assigned Date</label>
                        <div class="col-sm-12 err_msg">
                            <input type="date" class="form-control" name="assigned_date" id="assigned_date"
                                placeholder="assigned_date">
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="assigned_time" class="col-sm-12 col-form-label">Assigned Time</label>
                        <div class="col-sm-12 err_msg">
                            <input type="time" class="form-control" name="assigned_time" id="assigned_time"
                                placeholder="assigned_time">
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="estimate_date" class="col-sm-12 col-form-label">Estimate date</label>
                        <div class="col-sm-12 err_msg">
                            <input type="date" class="form-control" name="estimate_date" id="estimate_date"
                                placeholder="estimate_date">
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="estimate_time" class="col-sm-12 col-form-label">Estimate Time</label>
                        <div class="col-sm-12 err_msg">
                            <input type="time" class="form-control" name="estimate_time" id="estimate_time"
                                placeholder="estimate_time">
                        </div>
                    </div>
                </div>

                {{-- Hidden field for Assigned By --}}
                <input type="text"
                    value="{{ auth()->user()->firstname . ' ' . auth()->user()->middlename . ' ' . auth()->user()->lastname }}"
                    class="form-control" name="assigned_by" id="assigned_by" hidden>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <a href="{{ route('task.manage') }}" class="btn btn-warning">Cancel</a>
                <button type="submit" class="btn btn-info float-right">Add Task</button>
            </div>
            <!-- /.card-footer -->
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        $(function() {
            $('#addTaskForm').validate({
                rules: {
                    user_id: {
                        required: true,
                    },
                    title: {
                        required: true,
                    },
                    description: {
                        required: true,
                    },
                    assigned_date: {
                        required: true,
                    },
                    assigned_time: {
                        required: true,
                    },
                    estimate_date: {
                        required: true
                    },
                    estimate_time: {
                        required: true
                    }
                },
                messages: {
                    user_id: {
                        required: "Please Choose Staff Name",
                    },
                    title: {
                        required: "Please Enter Task Title",
                    },
                    description: {
                        required: "Please Enter Description",
                    },
                    assigned_date: {
                        required: "Please Enter Assigned Date",
                    },
                    assigned_time: {
                        required: "Please  Enter Assigned Time",
                    },
                    estimate_date: {
                        required: "Please  Enter Estimate Date",
                    },
                    estimate_time: {
                        required: "Please  Enter Estimate Date",
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
