@extends('layouts.app')


@section('title')
    404 Error
@endsection

@section('content')
    <div class="bg-light  min-vh-100 d-flex align-items-center justify-content-center">
        <div class="col-8 p-5">
            <img class="img-fluid mb-3" src="{{ asset('assets/img/illustrations/404.svg') }}" alt="404">
        </div>
        <div class="col-4">
            <h3 class="text-danger fw-blod">You do not have permissions on this page...!</h3>
            <a href="{{ url('/home') }}" class="btn shadow-none rounded-0 btn-danger">Go To Home</a>
        </div>

    </div>
@endsection
