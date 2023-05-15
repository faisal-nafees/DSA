@extends('layouts.app')

@section('content')
    <ol class="breadcrumb blue-grey lighten-4">
        <li class="breadcrumb-item"><a class="black-text" href="{{ route('task.manage') }}">Manage Tasks</a><i
                class="fa fa-angle-double-right mx-2" aria-hidden="true"></i></li>
        <li class="breadcrumb-item active">Edit Task</li>
    </ol>
    <div class="card card-info mx-4">
        <div class="card-header">
            <h3 class="card-title">Edit Task</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form id="editTaskForm" action="{{ route('task.edit', ['id' => $task->task_id]) }}" class="form-horizontal"
            method="POST" enctype="multipart/form-data">
            @csrf

            <div class="card-body">
                <div class="row">

                    <div class="form-group col-md-6">
                        <label for="title" class="col-sm-12 col-form-label">Task Status</label>
                        <div class="col-sm-12 err_msg">
                            <input type="text" class="form-control" name="title" id="title"
                                value="{{ old('title', $task->title) }}" placeholder="Enter Task Title">
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="user_id" class="col-sm-12 col-form-label">Task Status</label>
                        <div class="col-sm-12 err_msg">

                            <select class="form-control custom-select" name="user_id" id="user_id">
                                <option value="">Select Task Status</option>
                                @foreach ($report_status as $status)
                                    <option value="{{ $status->status_id }}"
                                        {{ $status->status_id === $task->report_status_id ? 'selected' : '' }}>
                                        {{ $status->status_name }}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="description" class="col-sm-12 col-form-label">Description</label>
                        <div class="col-sm-12 err_msg">
                            <textarea rows="3" class="form-control" name="description" id="description" placeholder="Enter Description">{{ $task->description }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row col-md-6">
                        <div class="form-group col-md-6">
                            <label for="attachment_1" class="col-sm-12 col-form-label">Attachment 1</label>
                            <div class="col-sm-12 err_msg">
                                <input type="file" class="form-control" name="attachment_1" id="attachment_1"
                                    value="{{ old('attachment_1') }}">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="attachment_2" class="col-sm-12 col-form-label">Attachment 2</label>
                            <div class="col-sm-12 err_msg">
                                <input type="file" class="form-control" name="attachment_2" id="attachment_2"
                                    value="{{ old('attachment_2') }}">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            @if ($task->attachment_1)
                                <label for="attachment_1" class="col-form-label"><a
                                        href="/storage/{{ $task->attachment_1 }}" target="blank" class="btn btn-info">Show
                                        Attachment 1</a>
                                </label>
                            @else
                                <label for="" class="col-form-label">
                                    <span class="btn btn-secondary">No Attachment 1</span>
                                </label>
                            @endif
                        </div>
                        <div class="form-group col-md-6">
                            @if ($task->attachment_2)
                                <label for="attachment_2" class="col-form-label"><a
                                        href="/storage/{{ $task->attachment_2 }}" target="blank" class="btn btn-info">Show
                                        Attachment 2</a>
                                </label>
                            @else
                                <label for="" class="col-form-label">
                                    <span class="btn btn-secondary">No Attachment 2</span>
                                </label>
                            @endif
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="form-group col-md-3">
                        <label for="assigned_date" class="col-sm-12 col-form-label">Assigned Date</label>
                        <div class="col-sm-12 err_msg">
                            <input type="date" class="form-control"
                                value="{{ old('assigned_date', $task->assigned_date) }}" name="assigned_date"
                                id="assigned_date">
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="assigned_time" class="col-sm-12 col-form-label">Assigned Time</label>
                        <div class="col-sm-12 err_msg">
                            <input type="time" class="form-control"
                                value="{{ old('assigned_time', $task->assigned_time) }}" name="assigned_time"
                                id="assigned_time">
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="estimate_date" class="col-sm-12 col-form-label">Estimate date</label>
                        <div class="col-sm-12 err_msg">
                            <input type="date" class="form-control"
                                value="{{ old('estimate_date', $task->estimate_date) }}" name="estimate_date"
                                id="estimate_date">
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="estimate_time" class="col-sm-12 col-form-label">Estimate Time</label>
                        <div class="col-sm-12 err_msg">
                            <input type="time" class="form-control"
                                value="{{ old('estimate_time', $task->estimate_time) }}" name="estimate_time"
                                id="estimate_time">
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
                <button type="submit" class="btn btn-info float-right">Edit Task</button>
            </div>
            <!-- /.card-footer -->
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        $(function() {
            $('#editTaskForm').validate({
                rules: {
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
                        required: "Please  Enter Estimate Time",
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
