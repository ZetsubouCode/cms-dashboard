@extends('layout.base')

@section('content')
@if(session('messageAlert'))
<div class="bd-example">
    <div class="alert alert-left alert-{{session('messageAlert.type')}} alert-dismissible fade show mb-3" role="alert"> {{-- success/info/warning/danger --}}

        <span> {{session('messageAlert.message')}}</span>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
</div>
@endif
<div class="card col-md-10 mx-auto">
    <div class="card-header d-flex justify-content-between">
        <div class="header-title">
            <h4 class="card-title">Input Product</h4>
        </div>
    </div>
    
    <div class="card-body">
        <p>Please fill out the details below to add a new product</p> 
        <form action="{{ route('product.update', ['id' => $data->id??'']) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Name </label>
                <input type="text" class="form-control" id="exampleInputText1" value="{{$data->name??''}}" placeholder="Enter Name" name="name" required>
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleFormControlTextarea1">Description</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" name="description">{{$data->description??''}}</textarea>
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Price per Unit </label>
                <input type="number" class="form-control" id="exampleInputText1" value="{{$data->price_per_unit??''}}" placeholder="Enter Price" name="price_per_unit" required>
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Unit of Measurement </label>
                <input type="text" class="form-control" id="unit_of_measurement" value="{{$data->unit_of_measurement??''}}" placeholder="Enter Unit of Measurement" name="unit_of_measurement" required>
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Quantity </label>
                <input type="number" class="form-control" id="quantity" value="{{$data->quantity??0}}" placeholder="Enter Quantity" name="quantity" required>
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Date Aquired </label>
                <input type="date" class="form-control" id="date_aquired" value="{{$data->date_aquired??''}}" name="date_aquired" required>
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Location </label>
                <input type="text" class="form-control" id="location" value="{{$data->location??''}}" placeholder="Enter Location" name="location">
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Supplier Name </label>
                <input type="text" class="form-control" id="supplier_name" value="{{$data->quantity??''}}" placeholder="Enter Supplier Name" name="supplier_name">
            </div>
            <div class="form-group">
                <label class="form-label" for="exampleInputText1">Low Stock Percentage </label>
                <input type="number" class="form-control" id="low_stock_percentage" value="{{$data->low_stock_percentage??0}}" placeholder="Enter Percentage" name="low_stock_percentage" min="0" max="100" step="0.01" required>
            </div>
            <div class="form-group">
                <label class="form-label">Status</label>
                <select class="form-select mb-3 shadow-none" name="status">
                    <option selected="">Open this select menu</option>
                    <option value="IN STOCK" {{ $data->status == 'IN STOCK' ? 'selected' : '' }}>IN STOCK</option>
                    <option value="PRE-ORDER" {{ $data->status == 'PRE-ORDER' ? 'selected' : '' }}>PRE-ORDER</option>
                    <option value="LOW STOCK" {{ $data->status == 'LOW STOCK' ? 'selected' : '' }}>LOW STOCK</option>
                    <option value="OUT OF STOCK" {{ $data->status == 'OUT OF STOCK' ? 'selected' : '' }}>OUT OF STOCK</option>
                    <option value="DISCONTINUED" {{ $data->status == 'DISCONTINUED' ? 'selected' : '' }}>DISCONTINUED</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="submit" class="btn btn-danger">cancel</button>
        </form>
    </div>
</div>
@endsection
