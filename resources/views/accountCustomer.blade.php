@extends('layouts.appCustomer')

@section('title')
    Profile
@endsection


@section('m-content')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1">
            <div class="row">
                <div class="col-md-12">
                    <!-- Profile Details -->
                    <div class="card mb-4">
                        <h5 class="card-header">Profile Details</h5>
                        <!-- Account -->
                        <div class="card-body">
                            <form action="{{ route('profile_UpdateImg') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="d-flex align-items-start align-items-sm-center gap-4">
                                    @if ($myProfile->img_path == null)
                                        <img src="{{ asset('users/profile/1.png') }}" alt="user-avatar"
                                            class="d-block rounded" height="100" width="100" id="uploadedAvatar" />
                                    @else
                                        <img src="{{ asset('users/profile/' . $myProfile->img_path) }}" alt="user-avatar"
                                            class="d-block rounded" height="100" width="100" id="uploadedAvatar" />
                                    @endif
                                    <div class="button-wrapper">
                                        <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                            <span class="d-none d-sm-block">Upload new photo</span>
                                            <i class="bx bx-upload d-block d-sm-none"></i>
                                            <input type="file" id="upload" name="img_path" class="account-file-input" hidden
                                                accept="image/png, image/jpeg" />
                                        </label>
                                        <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                                            <i class="bx bx-reset d-block d-sm-none"></i>
                                            <span class="d-none d-sm-block">Reset</span>
                                        </button>
                                        <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <button type="submit" class="btn btn-warning me-2">Save</button>
                                </div>
                            </form>
                        </div>
                        <hr class="my-0" />
                        <div class="card-body">
                            <form>
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label for="name" class="form-label">First Name</label>
                                        <input class="form-control" type="text" id="name" name="name"
                                            value="{{ Auth::user()->name }}" autofocus placeholder="First Name" />
                                        <small class="name-error fs-5 text-danger"></small>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="lname" class="form-label">Last Name</label>
                                        <input class="form-control" type="text" name="lname" id="lname"
                                            value="{{ @$myProfile->lname }}" placeholder="Last Name" />
                                        <small class="lname-error fs-5 text-danger"></small>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="email" class="form-label">E-mail</label>
                                        <input class="form-control" type="text" id="email" name="email"
                                            value="{{ Auth::user()->email }}" placeholder="email@example.com" />
                                        <small class="email-error fs-5 text-danger"></small>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="dob" class="form-label">Date of Birth</label>
                                        <input type="date" class="form-control" id="dob" name="dob"
                                            @if ($myProfile->dob != null) value="{{ $myProfile->dob }}" @else value="{{ date(now()->format('Y-m-d')) }}" @endif />
                                        <small class="dob-error fs-5 text-danger"></small>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label" for="phone">Phone Number</label>
                                        <input type="text" id="phone" name="phone" class="phone form-control"
                                            placeholder="59 325 8547" value="{{ $myProfile->phone }}" />
                                        <small class="phone-error text-danger"></small>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="address" class="form-label">Address</label>
                                        <input type="text" class="form-control" id="address" name="address"
                                            placeholder="Address" value="{{ $myProfile->address }}" />
                                        <small class="address-error fs-5 text-danger"></small>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label" for="gender">Gender</label>
                                        <select id="gender" class="select2 form-select">
                                            <option value="">Select</option>
                                            <option value="Male" @if ($myProfile->gender == 'Male') selected @endif>Male
                                            </option>
                                            <option value="Female" @if ($myProfile->gender == 'Female') selected @endif>Female
                                            </option>
                                        </select>
                                        <small class="gender-error fs-5 text-danger"></small>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="text" class="form-label">National ID</label>
                                        <input type="text" class="national_id form-control" id="national_id"
                                            name="national_id" placeholder="National ID"
                                            value="{{ $myProfile->national_id }}" />
                                        <small class="national_id-error text-danger"></small>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <button type="button" class="btnSaveProfileDetails btn btn-primary me-2">Save
                                        changes</button>
                                    <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                                </div>
                            </form>
                        </div>
                        <!-- /Account -->
                    </div>
                    <div class="card mb-4">
                        <h5 class="card-header">Update Password</h5>
                        <div class="card-body">
                            <form action="{{ route('profile_UpdatePass') }}" method="post">
                                @csrf
                                <div class="row mb-3">
                                    <div class="col-md-4 col-sm-12 form-password-toggle">
                                        <label class="form-label" for="old_password">Old Password</label>
                                        <div class="input-group input-group-merge">
                                            <input type="password" id="old_password"
                                                class="form-control  @if (session('password')) is-invalid @endif"
                                                name="old_password"
                                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                                aria-describedby="old_password" value="{{ old('old_password') }}" />
                                            <span class="input-group-text cursor-pointer"><i
                                                    class="bx bx-hide"></i></span>
                                            @if (session('password'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ session('password') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12 form-password-toggle">
                                        <label class="form-label" for="password">New Password</label>
                                        <div class="input-group input-group-merge">
                                            <input type="password" id="password"
                                                class="form-control @error('password') is-invalid @enderror" name="password"
                                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                                aria-describedby="password" value="{{ old('password') }}" />
                                            <span class="input-group-text cursor-pointer"><i
                                                    class="bx bx-hide"></i></span>
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col form-password-toggle">
                                        <label class="form-label" for="password">password confirm</label>
                                        <div class="input-group input-group-merge">
                                            <input id="password-confirm" type="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                name="password_confirmation"
                                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                                aria-describedby="password" value="{{ old('password_confirmation') }}" />
                                            <span class="input-group-text cursor-pointer"><i
                                                    class="bx bx-hide"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary d-grid">Update Password</button>
                            </form>
                        </div>
                    </div>
                    <div class="card">
                        <h5 class="card-header">Delete Account</h5>
                        <div class="card-body">
                            <div class="mb-3 col-12 mb-0">
                                <div class="alert alert-warning">
                                    <h6 class="alert-heading fw-bold mb-1">Are you sure you want to delete your account?
                                    </h6>
                                    <p class="mb-0">Once you delete your account, there is no going back. Please
                                        be certain.</p>
                                </div>
                            </div>
                            <form method="POST" action="{{ route('user_destroy') }}">
                                @csrf
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" name="accountActivation"
                                        id="accountActivation" />
                                    <label class="form-check-label" for="accountActivation">I confirm my account
                                        deactivation</label>
                                </div>
                                <button type="submit" class="btn btn-danger deactivate-account">Deactivate Account</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- / Content -->
    </div>
    <!-- Content wrapper -->
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
            $(document).on('click', '.btnSaveProfileDetails', function(e) {
                e.preventDefault(e);
                var data = {
                    'name': $('#name').val(),
                    'lname': $('#lname').val(),
                    'email': $('#email').val(),
                    'dob': $('#dob').val(),
                    'phone': $('#phone').val(),
                    'address': $('#address').val(),
                    'gender': $('#gender').val(),
                    'national_id': $('#national_id').val(),
                    'img_path': $('.img_path').val(),
                }

                $.ajax({
                    type: "POSt",
                    url: "/admin/profile/update",
                    data: data,
                    dataType: "JSON",
                    success: function(response) {
                        // console.log(response.errors.phone[0]);
                        $('.phone').removeClass('is-invalid');
                        $('.national_id').removeClass('is-invalid');

                        $('.phone-error').empty();
                        $('.national_id-error').empty();
                        if (response.status == false) {
                            if (response.errors.phone != null) {
                                $('.phone').addClass('is-invalid');
                                $('.phone-error').append(response.errors.phone[0]);
                            }
                            if (response.errors.national_id != null) {
                                $('.national_id').addClass('is-invalid');
                                $('.national_id-error').append(response.errors.national_id[0]);
                            }
                        } else {
                            toastr.success(response.success);
                            window.location.reload();
                        };
                    }
                });
            });
        });
    </script>
@endsection
