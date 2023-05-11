@extends('layouts.app')

@section('content')
    @include('admin.alerts')

    <section class="content pt-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Manage Users</h3>
                            <a href="{{ route('user.add') }}" class="btn btn-primary float-end">Add User</a>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="{{ route('user.manage') }}" method="POST">
                                <div class="row align-items-end">
                                    @csrf
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
                                        <a href="{{ route('user.manage') }}" class="btn btn-light"><i
                                                class="fas fa-sync fa-lg px-2"></i></a>
                                    </div>
                                    {{-- <div class="col-sm-12 col-md-2">
                                        <div id="contactTable_filter" class="dataTables_filter">
                                            <label>Search:
                                                <input type="search" class="form-control form-control-sm" placeholder=""
                                                    aria-controls="contactTable">
                                            </label>
                                        </div>
                                    </div> --}}
                                </div>
                            </form>
                            <table id="usersTable" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Full Name</th>
                                        <th>Contact</th>
                                        <th>Documents</th>
                                        <th>Role name</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            {{-- <td>{{ $user->branch }}</td> --}}
                                            <td>{{ $user->firstname . ' ' . $user->middlename . ' ' . $user->lastname }}
                                            </td>
                                            <td>
                                                <p class="mb-0">
                                                    <strong>Mobile:</strong> {{ $user->mobile }}
                                                </p>
                                                <p class="mb-0">
                                                    <strong>Email:</strong> {{ $user->company_webmail }}
                                                </p>
                                                <p class="mb-0">
                                                    <strong>Address:</strong> {{ $user->permanent_address }}
                                                </p>
                                            </td>
                                            <td>
                                                <p class="mb-0">
                                                    <strong>Pan No.:</strong> {{ $user->pan_no }}
                                                </p>
                                                <p class="mb-0">
                                                    <strong>Adhaar No.:</strong> {{ $user->adhar_no }}
                                                </p>
                                            </td>

                                            <td>{{ $user->role_name }}</td>
                                            <td class="{{ $user->user_status === '1' ? 'text-success' : 'text-danger' }}">
                                                {{ $user->user_status === '1' ? 'Active' : 'Inactive' }}</td>
                                            <td>{{ date('Y-m-d', strtotime($user->created_at)) }}</td>
                                            <td>
                                                <a href="{{ route('user.edit', ['id' => $user->user_id]) }}"><i
                                                        class='fas fa-pen'></i></a>
                                                <a href="{{ route('user.delete', ['id' => $user->user_id]) }}"
                                                    class="ml-2"
                                                    onclick="return confirm('Are you sure you want to delete this user?')">
                                                    <i class='fas fa-trash-alt text-danger '></i></a>
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
    </section>

    <script>
        $(function() {
            $('#usersTable').DataTable({
                "paging": true,
                "pageLength": 30,
                "lengthChange": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                'searching': true
            });

        });
    </script>
    {{-- <script>
        function reset(e) {
            e.preventDefault();
            $ {
                '#start_date'
            }.val('');
            $ {
                '#end_date'
            }.val('');

        }
    </script> --}}
@endsection
