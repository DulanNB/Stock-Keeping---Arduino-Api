@extends('layouts.admin')

@section('main-content')


    <div class="card">
        <h5 class="card-header">Add Customer Details</h5>
        <div class="card-body">
            <form method="post" action="{{route('customer.store')}}" enctype="multipart/form-data" >
                {{csrf_field()}}
                <div class="form-group">
                    <label for="name" class="col-form-label">Name <span class="text-danger">*</span></label>
                    <input id="name" type="text" name="name" placeholder="Enter Name" value=" {{old('name')}}" class="form-control" >
                    @error('name')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email" class="col-form-label">Email <span class="text-danger">*</span></label>
                    <input id="email" type="text" name="email" placeholder="Enter Email" value=" {{old('email')}}" class="form-control" >
                    @error('email')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="address" class="col-form-label">Address <span class="text-danger">*</span></label>
                    <input id="address" type="text" name="address" placeholder="Enter Address" value=" {{old('address')}}" class="form-control" >
                    @error('address')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="phone_number" class="col-form-label">Phone Number <span class="text-danger">*</span></label>
                    <input id="phone_number" type="text" name="phone_number" placeholder="Enter Phone Number" value=" {{old('phone_number')}}" class="form-control" >
                    @error('phone_number')
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


