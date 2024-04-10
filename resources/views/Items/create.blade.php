@extends('layouts.admin')

@section('main-content')
@can('item-add')
    <div class="card">
        <h5 class="card-header">Add Items</h5>
        <div class="card-body">
            <form method="post" action="{{route('items.store')}}" enctype="multipart/form-data" >
                {{csrf_field()}}
                <div class="form-group">
                    <label for="inputTitle" class="col-form-label">Name <span class="text-danger">*</span></label>
                    <input id="inputTitle" type="text" name="item_name" placeholder="Enter Name"  value="{{old('item_name')}}" class="form-control">
                    @error('item_name')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="summary" class="col-form-label">Description</label>
                    <textarea class="form-control" id="item_description" placeholder="Enter Description" name="item_description">{{old('item_description')}}</textarea>
                    @error('item_description')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>


                <div class="form-group">
                    <label for="inputTitle" class="col-form-label">Quantity <span class="text-danger">*</span></label>
                    <input id="inputTitle" type="number" name="quantity" placeholder="Enter quantity"  value="{{old('quantity')}}" class="form-control">
                    @error('quantity')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="inputTitle" class="col-form-label">Price (LKR) <span class="text-danger">*</span></label>
                    <input id="inputTitle" type="text" name="price" placeholder="Enter Price"  value="{{old('price')}}" class="form-control">
                    @error('price')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <button type="reset" class="btn btn-warning">Reset</button>
                    <button class="btn btn-success" type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>

@endcan
@endsection


