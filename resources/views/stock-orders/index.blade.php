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
                            <th>State</th>
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
                            <th>State</th>
                            <th>Action</th>
                        </tr>
                        </tfoot>
                        <tbody>

                        @foreach($stock_orders as $stock_order)
                            <tr>
                                <td>{{$stock_order->id}}</td>
                                <td>{{$stock_order->vendor->name}}</td>
                                <td>{{$stock_order->note}}</td>
                                <td>{{$stock_order->expected_date}}</td>
                                <td>{{$stock_order->price}}</td>
                                <td>{{$stock_order->order_quantity}}</td>
                                @if($stock_order->received_quantity)
                                    <td>{{$stock_order->received_quantity}}</td>
                                @else
                                    <td>N/A</td>
                                @endif
                                <td>{{$stock_order->state}}</td>
                                <td>
                                    <div class="flex">
                                        <!-- Edit button -->

                                        <!-- Mark as Received button -->
                                        @if($stock_order->state=='pending')
                                            <button class="btn btn-success btn-sm mr-1 mb-2 markAsReceivedBtn" data-id="{{$stock_order->id}}" data-toggle="modal" data-target="#receiveModal" data-toggle="tooltip" title="Mark as Received"><i class="fas fa-check"></i> Received</button>

                                            <!-- Delete button -->
                                            <form method="POST" action="{{route('stock_orders.destroy',[$stock_order->id])}}">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger btn-sm" data-toggle="tooltip" title="Delete"><i class="fas fa-trash-alt"></i> Delete</button>
                                            </form>
                                        @else
                                            N/A
                                        @endif
                                    </div>
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
        <div class="modal fade" id="receiveModal" tabindex="-1" role="dialog" aria-labelledby="receiveModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="receiveModalLabel">Mark Order as Received</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="receiveForm" method="POST" action="{{ route('stock-orders.receive') }}">
                            @csrf
                            <input type="hidden" id="order_id" name="order_id">
                            <div class="form-group">
                                <label for="receivedQuantity">Received Quantity:</label>
                                <input type="number" class="form-control" id="receivedQuantity" name="received_quantity" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<script>
    $(document).ready(function(){
        $('.markAsReceivedBtn').click(function(){
            var orderId = $(this).data('id'); // Get the order ID
            $('#order_id').val(orderId); // Set the order ID in the hidden input field
        });
    });
</script>
