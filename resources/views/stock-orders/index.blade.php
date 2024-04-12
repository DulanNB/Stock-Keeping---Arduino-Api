@extends('layouts.admin')

@section('main-content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="row">
            <div class="col-md-12">
            @if(session('success'))
                <div class="alert alert-success alert-dismissable fade show">
                    <button class="close" data-dismiss="alert" aria-label="Close">×</button>
                    {{session('success')}}
                </div>
            @endif


            @if(session('error'))
                <div class="alert alert-danger alert-dismissable fade show">
                    <button class="close" data-dismiss="alert" aria-label="Close">×</button>
                    {{session('error')}}
                </div>
            @endif
            </div>
        </div>
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary float-left">Stock Orders List</h6>

            <a href="{{route('stock-orders.create')}}" class="btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="bottom" title="Add User"><i class="fas fa-plus"></i> Add Stock Order</a>

        </div>
        <div class="card-body">

            <div class="table-responsive">
                @if(count($stock_orders)>0)
                    <table class="table table-bordered" id="banner-dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Reference ID</th>
                            <th>Vendor</th>
                            <th>Note</th>
                            <th>Expected Date</th>
                            <th>Price</th>
                            <th>Order Quantity</th>
                            <th>Received Quantity</th>
                            <th>Received Date</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Reference ID</th>
                            <th>Vendor</th>
                            <th>Note</th>
                            <th>Expected Date</th>
                            <th>Price</th>
                            <th>Order Quantity</th>
                            <th>Received Quantity</th>
                            <th>Received Date</th>
                            <th>Action</th>
                        </tr>
                        </tfoot>
                        <tbody>

                        @foreach($stock_orders as $stock_order)
                            <tr>
                                <td>{{$stock_order->reference_id}}</td>
                                <td>{{$stock_order->vendor->name}}</td>
                                <td>{{$stock_order->note}}</td>
                                <td>{{$stock_order->expected_date}}</td>
                                <td>{{$stock_order->price}}</td>
                                <td>{{$stock_order->order_quantity}}</td>
                                <td>{{$stock_order->received_quantity}}</td>
                                <td>{{$stock_order->received_date}}</td>
                                <td>
                                    <!-- Your action buttons here -->
                                    <!-- Example: -->
                                    <a href="{{route('stock_orders.edit',[$stock_order->id])}}" class="btn btn-primary btn-sm" data-toggle="tooltip" title="Edit"><i class="fas fa-edit"></i></a>
                                    <form method="POST" action="{{route('stock_orders.destroy',[$stock_order->id])}}">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-sm" data-toggle="tooltip" title="Delete"><i class="fas fa-trash-alt"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <span style="float:right">{{$stock_orders->links()}}</span>
                @else
                    <h6 class="text-center">No Stock Orders found!!! Please create Items</h6>
                @endif
            </div>
        </div>
    </div>


@endsection
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<script>
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.dltBtn').click(function(e){
            var form=$(this).closest('form');
            var dataID=$(this).data('id');
            // alert(dataID);
            e.preventDefault();
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this data!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                    } else {
                        swal("Your data is safe!");
                    }
                });
        })
    })
</script>
