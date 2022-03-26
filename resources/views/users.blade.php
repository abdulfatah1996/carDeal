@extends('layouts.container')

@section('title')
    All Users
@endsection


@section('m-content')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1">
            <div class="row">
                <div class="col-md-12">
                    <!-- All Users -->
                    <div class="card">
                        <h5 class="card-header">All Users</h5>
                        <div class="table-responsive text-nowrap">
                            <table class="table table-striped" id="UserTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>E-mail</th>
                                        <th>role</th>
                                        <th>Created</th>
                                        <th>Updated</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @if (count($users) > 0)
                                        @php
                                            $count = 1;
                                        @endphp
                                        @foreach ($users as $user)
                                            <tr>
                                                <td>{{ $count++ }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->role }}</td>
                                                <td>{{ $user->created_at->diffforhumans() }}</td>
                                                <td>{{ $user->updated_at->diffforhumans() }}</td>
                                                <td>
                                                    <button type="button" id="{{ $user->id }}"
                                                        class="btn btnEditUsres btn-sm btn-s rounded-pill btn-icon btn-outline-info">
                                                        <span class="tf-icons bx bx-edit"></span>
                                                    </button>
                                                    <button type="button" id="{{ $user->id }}"
                                                        class="btn btnDeleteUsres btn-sm btn-s rounded-pill btn-icon btn-outline-danger">
                                                        <span class="tf-icons fa-solid fa-trash"></span>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                            {{ $users->links() }}
                        </div>
                    </div>
                    <!-- All Users -->
                </div>
            </div>
        </div>
        <!-- / Content -->
    </div>
    <!-- Content wrapper -->
    <!--modal-->
    <div class="modal fade" id="modalUsers" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Users Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <input type="hidden" name="id" id="id">
                            <label for="nameWithTitle" class="form-label">Name</label>
                            <input type="text" id="name" class="form-control" placeholder="Enter Name">
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-0">
                            <label for="emailWithTitle" class="form-label">Email</label>
                            <input type="email" id="email" disabled class="form-control" placeholder="xxxx@xxx.xx">
                        </div>
                        <div class="col mb-0">
                            <label for="roleWithTitle" class="form-label">Role</label>
                            <select name="role" id="role" class="form-select">
                                <option value="Administrator">Administrator</option>
                                <option value="Customer">Customer</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="button" class="btn btn-primary btnSaveUserInfo">Save changes</button>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script src="{{ asset('assets/js/pages-account-settings-account.js') }}"></script>
    @if (session('success'))
        <script>
            toastr.success('{{ session('success') }}');
        </script>
    @endif

    @if (session('error'))
        <script>
            toastr.error('{{ session('error') }}');
        </script>
    @endif


    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(document).on('click', '.btnEditUsres', function(e) {
                e.preventDefault(e);
                var id = this.id;
                // console.log(id);
                $.ajax({
                    type: "GET",
                    url: `/admin/users/edit/${id}`,
                    dataType: "JSON",
                    success: function(response) {
                        // console.log(response.success.id);
                        $("#id").val(response.success.id);
                        $("#name").val(response.success.name);
                        $("#email").val(response.success.email);
                        $("#role").val(response.success.role);
                        $('#modalUsers').modal('show');
                    }
                });

            });

            $(document).on('click', '.btnSaveUserInfo', function(e) {
                e.preventDefault(e);
                let data = {
                    'id': $('#id').val(),
                    'name': $('#name').val(),
                    'role': $('#role').val(),
                };
                $.ajax({
                    type: "POST",
                    url: "/admin/users/update",
                    data: data,
                    dataType: "JSON",
                    success: function(response) {
                        // console.log(response);
                        if (response.status == true) {
                            $('#modalUsers').modal('hide');
                            $("#UserTable").load(location.href + " #UserTable");

                            toastr.success(response.success);
                        }
                    }
                });
            });

            $(document).on('click', '.btnDeleteUsres', function(e) {
                e.preventDefault(e);
                var id = this.id;
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "GET",
                            url: `/admin/users/destroy/${id}`,
                            dataType: "JSON",
                            success: function(response) {
                                console.log(response);
                                if (response.status == true) {
                                    Swal.fire(
                                        'Deleted!',
                                        response.success,
                                        'success'
                                    )

                                }
                                $("#UserTable").load(location.href + " #UserTable");
                            }
                        });

                    }
                })
            });


        });
    </script>
@endsection
