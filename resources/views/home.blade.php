@extends('layouts.container')
@section('title')
    Dashboard
@endsection

@section('m-content')
    <div class="row">
        <div class="col-12">
            <h1 class="display-1 font-monospace text-primary"> Cars</h1>
        </div>
        <div class="col-lg-6 col-md-12 col-4 mb-4">
            <div class="card shadow-lg rounded">
                <div class="card-body">
                    <div class="card-header font-monospace fs-3 text-info px-0">
                        Cars Number
                    </div>
                    <div class="card-title d-flex align-items-center justify-content-between">
                        <div class="fs-1">
                            <span class="rounded text-info"><i class="fa-solid fa-car"></i></span>
                        </div>
                        <div class="fs-1">
                            <span class="rounded text-info">{{ $carsCount }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-12 col-4 mb-4">
            <div class="card shadow-lg rounded">
                <div class="card-body">
                    <div class="card-header font-monospace fs-3 text-success px-0">
                        Cars Total Sum
                    </div>
                    <div class="card-title d-flex align-items-center justify-content-between">
                        <div class="fs-1">
                            <span class="rounded text-success"><i class="fa-solid fa-circle-dollar-to-slot"></i></span>
                        </div>
                        <div class="fs-1">
                            <span class="rounded text-success">{{ $sumCarPrise }}
                                <small><i class="fs-3 fa-solid fa-dollar-sign"></i></small>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <h1 class="display-1 font-monospace text-primary"> Orders</h1>
        </div>
        <div class="col-lg-4 col-md-12 col-4 mb-4">
            <div class="card shadow-lg rounded">
                <div class="card-body">
                    <div class="card-header fs-3 font-monospace text-primary px-0">
                        Total Orders
                    </div>
                    <div class="card-title d-flex align-items-center justify-content-between">
                        <div class="fs-1">
                            <span class="rounded text-primary"><i class="fa-solid fa-credit-card"></i></span>
                        </div>
                        <div class="fs-1">
                            <span class="rounded text-primary">{{ $OraderTotalSum->count() }}</span>
                        </div>
                    </div>
                    <h3 class="card-title text-primary fw-semibold mb-2">
                        {{ $OraderTotalSum->sum('price') }} $
                    </h3>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-12 col-4 mb-4">
            <div class="card shadow-lg rounded">
                <div class="card-body">
                    <div class="card-header fs-3 font-monospace text-danger px-0">
                        Orader Incomplete
                    </div>
                    <div class="card-title d-flex align-items-center justify-content-between">
                        <div class="fs-1">
                            <span class="rounded text-danger"><i class="fa-solid fa-credit-card"></i></span>
                        </div>
                        <div class="fs-1">
                            <span class="rounded text-danger">{{ $OraderIncompleteSum->count() }}</span>
                        </div>
                    </div>
                    <h3 class="card-title text-danger fw-semibold mb-2">
                        {{ $OraderIncompleteSum->sum('price') }} $
                    </h3>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-12 col-4 mb-4">
            <div class="card shadow-lg rounded">
                <div class="card-body">
                    <div class="card-header font-monospace fs-3 text-success px-0">
                        Orader Complete
                    </div>
                    <div class="card-title d-flex align-items-center justify-content-between">
                        <div class="fs-1">
                            <span class="rounded text-success"><i class="fa-solid fa-credit-card"></i></span>
                        </div>
                        <div class="fs-1">
                            <span
                                class="rounded text-success">{{ $OraderTotalSum->count() - $OraderIncompleteSum->count() }}</span>
                        </div>
                    </div>
                    <h3 class="card-title text-success fw-semibold mb-2">
                        {{ $OraderTotalSum->sum('price') - $OraderIncompleteSum->sum('price') }} $
                    </h3>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('styles')
    <style>
        .card {
            opacity: 0.7 !important;
        }

        .card:hover {
            opacity: 1 !important;
        }

    </style>
@endsection
