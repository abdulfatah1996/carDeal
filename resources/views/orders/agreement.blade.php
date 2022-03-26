@extends('layouts.container')

@section('title')
    Agreement
@endsection
@section('m-content')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1">
            <div class="row">
                <div class="col-md-12">
                    <div class="card px-5">
                        <div class="card-body" id="agreement">
                            <h2 class="card-title text-center">CAR SALE AGREEMENT</h2>
                            <h5 class="card-title text-dark fw-bolder">BACKGROUND.</h5>
                            <p class="card-text">
                                WHEREAS, Seller desires to sell the vehicle described below, known herein as the "
                                {{ $carOrader->name }} ", under the terms and conditions set forth below;
                                WHEREAS, Buyer desires to purchase the Acquired Vehicle offered for sale by Seller under the
                                terms and conditions set forth below; and, therefore,
                            </p>
                            <h5 class="card-title text-dark fw-bolder">Description of Acquired Car.</h5>
                            <ol>
                                <li>
                                    <p class="card-text">Name of Car : {{ $carOrader->name }} .</p>
                                </li>
                                <li>
                                    <p class="card-text">Type of Car : {{ $carOrader->type }} .</p>
                                </li>
                                <li>
                                    <p class="card-text">Price of Car : {{ $carOrader->price }} .</p>
                                </li>
                                <li>
                                    <p class="card-text">Color of Car : {{ $carOrader->color }} .</p>
                                </li>
                                <li>
                                    <p class="card-text">Description of Car : {{ $carOrader->description }} .</p>
                                </li>
                            </ol>
                            <h5 class="card-title text-dark fw-bolder">Buyer's data.</h5>
                            <ol>
                                <li>
                                    <p class="card-text">Name : {{ $customerOrader->name }}
                                        {{ $customerOrader->Profile->lname }}</p>
                                </li>
                                <li>
                                    <p class="card-text">E-mail : {{ $customerOrader->email }}</p>
                                </li>
                                <li>
                                    <p class="card-text">National Id : {{ $customerOrader->Profile->national_id }}
                                    </p>
                                </li>
                                <li>
                                    <p class="card-text">Phone : {{ $customerOrader->Profile->phone }}</p>
                                </li>
                                <li>
                                    <p class="card-text">address : {{ $customerOrader->Profile->address }}</p>
                                </li>
                            </ol>
                            <div class="d-flex">
                                <div class="col-md-5 my-2">
                                    <h5 class="card-title text-dark fw-bolder mb-3">SELLER</h5>
                                    <p class="card-text">_____________________________</p>
                                </div>
                                <div class="col-md-5 my-2">
                                    <h5 class="card-title text-dark fw-bolder mb-3">BUYER</h5>
                                    <p class="card-text">_____________________________</p>
                                </div>
                            </div>
                            <p class="card-text"><small class="text-muted">{{ Date(Now()) }}</small></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mt-1 m-auto">
                    <div class="card-body d-flex justify-content-between">
                        <a href="{{ route('order-update', ['id' => $Orader->id]) }}"
                            class="btn bt-xl btn-success">Apply</a>
                        <button type="button" class="btn btn-primary" id="printOrders">
                            <span class="tf-icons bx bx-printer"></span>&nbsp; Print
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- / Content -->
    </div>
    <!-- Content wrapper -->
@endsection


@section('scripts')
    <script>
        $(document).ready(function() {
            $('#printOrders').click(function() {
                var mywindow = window.open('', 'PRINT', '');
                mywindow.document.write('<html><head><title> CAR SALE AGREEMENT</title>');
                mywindow.document.write('</head><body >');
                mywindow.document.write(document.getElementById('agreement').innerHTML);
                mywindow.document.write('</body></html>');
                mywindow.document.close(); // necessary for IE >= 10
                mywindow.focus(); // necessary for IE >= 10*/
                mywindow.print();
                mywindow.close();
                return true;
            });
        });
    </script>
@endsection
