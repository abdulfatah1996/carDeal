@extends('layouts.appCustomer')

@section('title')
    Orders
@endsection
@section('m-content')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1">
            <div class="row">
                <div class="col-md-12">
                    <!-- All Cars -->
                    <div class="card">
                        <h5 class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <h2 class="text-primary">All Orders</h2>
                            </div>
                        </h5>
                        <div class="table-responsive text-nowrap">
                            <div id="carTableDiv">
                                <table class="table table-striped" id="CarTable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Car</th>
                                            {{-- <th>Usre</th> --}}
                                            <th>Type</th>
                                            <th>Price</th>
                                            <th>Color</th>
                                            <th>Status</th>
                                            <th>Created</th>
                                        </tr>
                                    </thead>
                                    @if (count($orders) > 0)
                                        <tbody class="table-border-bottom-0">
                                            @php
                                                $count = 1;
                                            @endphp
                                            @foreach ($orders as $order)
                                                <tr>
                                                    <td>{{ $count++ }}</td>
                                                    <td>{{ $order->carName }}</td>
                                                    {{-- <td>{{ $order->userName }}</td> --}}
                                                    <td>{{ $order->type }}</td>
                                                    <td>{{ $order->price }}</td>
                                                    <td>{{ $order->color }}</td>
                                                    <td>
                                                        @if ($order->status == 'complete')
                                                            <span class="badge rounded-pill bg-success">Complete</span>
                                                        @else
                                                            <span class="badge rounded-pill bg-danger">Incomplete</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ \Carbon\Carbon::parse($order->created_at)->diffForHumans() }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <td colspan="2" class="text-center">
                                                    <span class="badge rounded-pill bg-primary">Totall :
                                                        {{ $orders->sum('price') }} $</span>
                                                </td>
                                                <td colspan="2" class="text-center">
                                                    <span class="badge rounded-pill bg-danger">Incomplete :
                                                        {{ $orderIncomplete->sum('price') }} $</span>
                                                </td>
                                                <td colspan="2" class="text-center">
                                                    <span class="badge rounded-pill bg-success">Complete :
                                                        {{$orders->sum('price') - $orderIncomplete->sum('price') }}
                                                        $</span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    @endif
                                </table>
                            </div>
                            <div class="col-12 mt-3 text-center">
                                <button type="button" class="btn btn-primary rounded-0" id="printOrders">
                                    <span class="tf-icons bx bx-printer"></span>&nbsp; Print
                                </button>
                            </div>
                        </div>
                        <div class="card-footer">
                            {{ $orders->links() }}
                        </div>
                    </div>
                    <!-- All Users -->
                </div>
            </div>
        </div>
        <!-- / Content -->
    </div>
    <!-- Content wrapper -->
@endsection

@section('styles')
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#printOrders').click(function() {
                var mywindow = window.open('', 'PRINT', 'height=400,width=600');
                mywindow.document.write('<html><head><title> Orders </title>');
                mywindow.document.write('</head><body >');
                mywindow.document.write('<h1>Orders</h1>');
                mywindow.document.write(document.getElementById('carTableDiv').innerHTML);
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
