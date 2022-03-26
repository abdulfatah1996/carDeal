@extends('layouts.appCustomer')


@section('title')
    Car Details
@endsection

@section('m-content')
    <div class="row">
        <div class="col-md-12 col-xl-8 m-auto">
            <div class="card shadow-lg mb-5 rounded">
                <img class="card-img-top" src="{{ asset('users/cars/' . $car->picture) }}" alt="Card image cap">
                <div class="card-body">
                    <h3 class="text-dark">Name</h3>
                    <h6 class="text-secandery">{{ $car->name }}</h6>
                    <h3 class="text-dark">Type and Color of Car</h3>
                    <h6 class="text-secandery text-capitalize">{{ $car->type }} | {{ $car->color }}</h6>
                    <h3 class="text-dark">Description of Car</h3>
                    <h6 class="text-secandery">{{ $car->description }}</h6>
                    <h3 class="text-dark">Price of Car</h3>
                    <h6 class="text-secandery">{{ $car->price }}$</h6>
                    <button type="button" id="{{ $car->id }}" class="btnPuy btn d-block btn-primary fs-3">
                        <i class="fa-solid fa-cart-plus"></i>
                        <span>Puy</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
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
            $(document).on('click', '.btnPuy', function(e) {
                e.preventDefault(e);
                var id = this.id;
                // toastr.error(id);
                $.ajax({
                    type: "POST",
                    url: `/customer/order/store/${id}`,
                    dataType: "JSON",
                    success: function(response) {
                        // console.log(response);
                        Swal.fire({
                            title: 'Are you sure of the purchase?',
                            text: "You won't be able to revert this!",
                            icon: 'info',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes, Puy it!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                Swal.fire({
                                    position: 'center',
                                    icon: 'success',
                                    title: response.success,
                                    showConfirmButton: true,
                                })
                            }
                        })
                    }
                });
            });
        });
    </script>
@endsection
