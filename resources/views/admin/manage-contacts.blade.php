@extends('layouts.app')

@section('content')
    <section class="content pt-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Manage Contacts</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="{{ route('contact.manage') }}" method="POST">
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
                                        <a href="{{ route('contact.manage') }}" class="btn btn-light"><i
                                                class="fas fa-sync fa-lg px-2"></i></a>
                                    </div>

                                </div>
                            </form>
                            <table id="contactTable" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Full Name</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th>Message</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($contacts as $contact)
                                        <tr>
                                            <td>{{ $contact->fullname }}
                                            </td>
                                            <td>{{ $contact->email }}</td>
                                            <td>{{ $contact->mobile }}</td>
                                            <td>
                                                <p class="mb-0"><strong>Subject: </strong>{{ $contact->subject }}</p>
                                                <p class="mb-0"><strong>Message: </strong>{{ $contact->message }}</p>
                                            </td>
                                            <td>{{ date('Y-m-d', strtotime($contact->created_at)) }}</td>

                                            <td>
                                                <button
                                                    onclick="reply('{{ $contact->contact_id }}','{{ $contact->email }}') "
                                                    class="btn btn-success">Reply</button>
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
        <!-- /.container-fluid -->

        <!-- Modal -->
        <button type="button" id="openModal" hidden class="btn btn-success" data-toggle="modal"
            data-target="#modal-comment">
            Open Modal
        </button>
        <form action="" id="replyForm">
            <div class="modal fade" id="modal-comment">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Comment</h4>
                            <button type="button" class="close close-modal" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body err_msg">
                            <textarea name="comment" id="comment" placeholder="Your Comment..." class="w-100 form-control" rows="5"></textarea>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default close-modal" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
        </form>
        <!-- /.modal -->
    </section>

    <script>
        $(function() {
            $('#contactTable').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "pageLength": 30,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });

            $('#replyForm').validate({
                rules: {
                    comment: {
                        required: true,
                        minlength: 2
                    }
                },
                messages: {
                    comment: {
                        required: "Please enter your Comment",
                        minlength: "Comment must be at least 2 characters"
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

            $('#replyForm').submit(function(event) {
                if ($(this).valid()) {
                    event.preventDefault(); // Prevent the default form submission

                    // Get the comment value from the textarea
                    var comment = $('#comment').val();
                    // Send an AJAX request to the server
                    $.ajax({
                        type: 'POST',
                        url: "{{ URL::to('/sendMail') }}",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            contact_id: $id,
                            email: $email,
                            comment: comment // Include the comment value in the data
                        },
                        success: function(data) {
                            console.log(data);
                            $('#comment').val('');
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
                        }
                    });
                }
            });

        });

        function reply(id, email) {
            $('#openModal').click();
            $id = id;
            $email = email;
            // console.log(id);
            // console.log(email);
        }
    </script>
@endsection
