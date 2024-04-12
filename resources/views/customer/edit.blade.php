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


        <div class="card">
            <h5 class="card-header">Edit Customer</h5>
            <div class="card-body">
                <form method="post" action="{{route('customer.update',$customer->id)}}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <label for="name" class="col-form-label">Name <span class="text-danger">*</span></label>
                        <input id="name" type="text" name="name" placeholder="Enter Name" value="{{$customer->name}}" class="form-control" >
                        @error('name')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email" class="col-form-label">Email <span class="text-danger">*</span></label>
                        <input id="email" type="text" name="email" placeholder="Enter Email" value=" {{$customer->email}}" class="form-control" >
                        @error('email')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="address" class="col-form-label">Address <span class="text-danger">*</span></label>
                        <input id="address" type="text" name="address" placeholder="Enter Address" value=" {{$customer->address}}" class="form-control" >
                        @error('address')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="phone_number" class="col-form-label">Phone Number <span class="text-danger">*</span></label>
                        <input id="phone_number" type="text" name="phone_number" placeholder="Enter Phone Number" value=" {{$customer->phone_number}}" class="form-control" >
                        @error('phone_number')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>


                    <div class="form-group mb-3">
                        <button class="btn btn-success" type="submit">Update</button>
                    </div>
                </form>
            </div>
        </div>

@endsection


