@extends('layouts.admin')

@section('main-content')
    <div class="card">
        <h5 class="card-header">Add Stock Order</h5>
        <div class="card-body">
            <form method="post" action="{{ route('stock_orders.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="vendor_id" class="col-form-label">Vendor <span class="text-danger">*</span></label>
                    <select id="vendor_id" name="vendor_id" class="form-control">
                        <option value="" selected disabled>Select Vendor</option>
                        @foreach($customers as $customer)
                            <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                        @endforeach
                    </select>
                    @error('vendor_id')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="note" class="col-form-label">Note</label>
                    <textarea class="form-control" id="note" placeholder="Enter Note" name="note">{{ old('note') }}</textarea>
                    @error('note')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="expected_date" class="col-form-label">Expected Date <span class="text-danger">*</span></label>
                    <input id="expected_date" type="date" name="expected_date" value="{{ old('expected_date') }}" class="form-control">
                    @error('expected_date')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="item_id" class="col-form-label">Item <span class="text-danger">*</span></label>
                    <select id="item_id" name="item_id" class="form-control">
                        <option value="" selected disabled>Select Item</option>
                        @foreach($items as $item)
                            <option value="{{ $item->id }}">{{ $item->item_name }}</option>
                        @endforeach
                    </select>
                    @error('item_id')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="price" class="col-form-label">Ordering Price <span class="text-danger">*</span></label>
                    <input id="price" type="text" name="price" placeholder="Enter Price" value="{{ old('price') }}" class="form-control">
                    @error('price')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="order_quantity" class="col-form-label">Order Quantity <span class="text-danger">*</span></label>
                    <input id="order_quantity" type="text" name="order_quantity" placeholder="Enter Order Quantity" value="{{ old('order_quantity') }}" class="form-control">
                    @error('order_quantity')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Add more fields here for other attributes -->

                <div class="form-group mb-3">
                    <button type="reset" class="btn btn-warning">Reset</button>
                    <button class="btn btn-success" type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
