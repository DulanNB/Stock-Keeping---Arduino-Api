@extends('layouts.admin')

@section('main-content')

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
                    <label for="inputTitle" class="col-form-label">Product Weight (g)  <span class="text-danger">*</span></label>
                    <input id="inputTitle" type="number" name="product_weight" placeholder="Enter Product Weight in grams"  value="{{old('product_weight')}}" class="form-control">
                    @error('product_weight')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="inputTitle" class="col-form-label">Low stock margin <span class="text-danger">*</span></label>
                    <input id="inputTitle" type="text" name="low_stock_margin" placeholder="Enter Low stock margin"  value="{{old('low_stock_margin')}}" class="form-control">
                    @error('low_stock_margin')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="inputTitle" class="col-form-label">Sensor Id <span class="text-danger">*</span></label>
                    <input id="inputTitle" type="text" name="sensor_id" placeholder="Enter sensor id"  value="{{old('sensor_id')}}" class="form-control">
                    @error('sensor_id')
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


@endsection


