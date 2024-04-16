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
            <h6 class="m-0 font-weight-bold text-primary float-left">Items List</h6>
            <a href="{{route('items.create')}}" class="btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="bottom" title="Add User"><i class="fas fa-plus"></i> Add Items</a>
        </div>
        <div class="card-body">

            <div class="table-responsive">
                @if(count($items)>0)
                    <table class="table table-bordered" id="banner-dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>S.N.</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Product Weight (g)</th>
                            <th>Stock Qty</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>S.N.</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Product Weight (g)</th>
                            <th>Stock Qty</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                        </tfoot>
                        <tbody>

                        @foreach($items as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->item_name}}</td>
                                <td>{{$item->item_description}}</td>
                                <td>{{$item->product_weight}}</td>
                                <td>{{$item->stock_orders_sum_received_quantity}}</td>
                                <td>Rs. {{number_format( $item->price , 2, '.' , ',' )}}</td>

                                <td>

                                    <a href="{{route('items.edit',[$item->id])}}" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="edit" data-placement="bottom"><i class="fas fa-edit"></i></a>



                                    <form method="POST" action="{{route('items.destroy',[$item->id])}}">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger btn-sm dltBtn" data-id={{$item->id}} style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fas fa-trash-alt"></i></button>
                                    </form>

                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <span style="float:right">{{$items->links()}}</span>
                @else
                    <h6 class="text-center">No Items found!!! Please create Items</h6>
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
