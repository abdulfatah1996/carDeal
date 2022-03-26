@extends('layouts.appCustomer')


@section('title')
    Home
@endsection

@section('m-content')
    <div class="row">
        @foreach ($cars as $car)
            <div class="col-md-6 col-xl-4">
                <div class="card  shadow-lg mb-5  rounded">
                    <img class="card-img-top" src="{{ asset('users/cars/' . $car->picture) }}" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">{{ $car->name }}</h5>
                        <p class="card-text">{{ $car->description }}</p>
                        <p class="card-text text-capitalize">{{ $car->color }} | {{ $car->type }} | <span
                                class="text-danger">{{ $car->price }}$</span></p>
                        <div class="d-flex justify-content-between align-items-center">
                            <p class="card-text">
                                <small class="text-muted">Last updated {{ $car->updated_at->diffforhumans() }}</small>
                            </p>
                            <a href="{{ route('order-create', ['id' => $car->id]) }}"
                                class="btn rounded-pill btn-icon btn-primary">
                                <span class="tf-icons bx bxs-cart-add"></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection


@section('styles')
    <style>
        .card:hover {
            padding: 20px !important;
        }

    </style>
@endsection
