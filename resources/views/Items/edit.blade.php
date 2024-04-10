@extends('layouts.admin')

@section('main-content')

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

    @can('item-edit')
    <div class="card">
        <h5 class="card-header">Edit Item</h5>
        <div class="card-body">
            <form method="post" action="{{route('items.update',$item->id)}}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label for="inputTitle" class="col-form-label">Name <span class="text-danger">*</span></label>
                    <input id="inputTitle" type="text" name="item_name" placeholder="Enter Name"  value="{{$item->item_name}}" class="form-control">
                    @error('item_name')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="summary" class="col-form-label">Description</label>
                    <textarea class="form-control" id="item_description" placeholder="Enter Description" name="item_description">{{$item->item_description}}</textarea>
                    @error('item_description')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>


                <div class="form-group">
                    <label for="inputTitle" class="col-form-label">Quantity <span class="text-danger">*</span></label>
                    <input id="inputTitle" type="number" name="quantity" placeholder="Enter quantity"  value="{{$item->quantity}}" class="form-control">
                    @error('quantity')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="inputTitle" class="col-form-label">Price (LKR) <span class="text-danger">*</span></label>
                    <input id="inputTitle" type="text" name="price" placeholder="Enter Price"  value="{{$item->price}}" class="form-control">
                    @error('price')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <button class="btn btn-success" type="submit">Update</button>
                </div>
            </form>
        </div>
    </div>
    @endcan
@endsection


